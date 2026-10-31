<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventRegistrationController extends Controller
{
    private const TOKEN_COOKIE = 'reg_token';

    //เอาไว้ดึงข้อมูลกิจกรรมมาใช้งานซ้ำ และเช็คว่ามีอยู่จริงมั้ย
    private function getevent($eventId)
    {
        return Event::findOrFail($eventId);
    }

    //หาแถวที่ลงทะเบียนไว้ทั้งหมดของคนนี้ (ล็อกอินใช้ user_id, ไม่ล็อกอินใช้รหัสเครื่องในคุกกี้)
    private function myRegistrations(Request $request, $eventId)
    {
        $token = $request->cookie(self::TOKEN_COOKIE);

        if (!Auth::check() && empty($token)) {
            return collect();
        }

        return EventRegistration::where('event_id', $eventId)
            ->where(function ($q) use ($token) {
                if (Auth::check()) {
                    $q->orWhere('user_id', Auth::id());
                }
                if (!empty($token)) {
                    $q->orWhere('guest_token', $token);
                }
            })
            ->orderBy('registration_id')
            ->get();
    }

    //แสดงฟอร์มลงทะเบียนเข้าร่วมกิจกรรม (ไม่ต้องล็อกอิน)
    public function create(Request $request, $eventId)
    {
        $event = $this->getevent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
        $event->isexpired = $isexpired;
        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);

        $mine = $this->myRegistrations($request, $eventId);

        //สิทธิ์ลงเพิ่มที่เหลือของคนนี้ (รวมทุกแถวของเขา)
        $extraLeft = (int) $mine->sum('extra_allowed');

        //ลงทะเบียนแล้วและไม่มีสิทธิ์ลงเพิ่ม = โชว์หน้าลงทะเบียนเรียบร้อย
        $alreadyRegistered = $mine->isNotEmpty() && $extraLeft === 0;

        //ชื่อที่เติมให้อัตโนมัติ: ใช้ชื่อที่เคยลงล่าสุด ไม่มีก็ใช้ชื่อในบัญชี
        $prefillName = $mine->last()?->full_name ?? '';

        return view('user.register_event', [
            'event' => $event,
            'remainingseconds' => $remainingseconds,
            'isexpired' => $isexpired,
            'alreadyRegistered' => $alreadyRegistered,
            'myRegistrationIds' => $mine->pluck('registration_id')->all(),
            'extraLeft' => $extraLeft,
            'prefillName' => $prefillName,
        ]);
    }

    //บันทึกการลงทะเบียนเข้าร่วมกิจกรรม (ไม่ต้องล็อกอิน)
    public function store(Request $request, $eventId)
    {
        $this->getevent($eventId);

        $request->validate([
            'full_name' => ['nullable', 'string', 'max:200'],
        ]);

        //รหัสเครื่อง: ใช้อันเดิมถ้ามี ไม่มีก็สร้างใหม่
        $token = $request->cookie(self::TOKEN_COOKIE) ?: (string) Str::uuid();

        DB::beginTransaction();

        try {

            //ล็อกแถว event กันคนส่งฟอร์มพร้อมกันแล้วข้อมูลชนกัน
            $event = Event::where('event_id', $eventId)->lockForUpdate()->first();

            $closeat = Carbon::parse($event->register_close_at);

            if ($event->status !== 'open' || Carbon::now()->gte($closeat)) {
                DB::rollBack();
                return back()->withErrors(['status' => 'กิจกรรมนี้ปิดรับลงทะเบียนแล้ว']);
            }

            //เช็คว่าลงทะเบียนเต็มแล้วหรือยัง (null = ไม่จำกัด) ใช้กับทุกกรณี ทั้งลงครั้งแรกและลงเพิ่ม
            $registeredcount = EventRegistration::where('event_id', $event->event_id)->count();
            if ($event->max_participants !== null && $registeredcount >= $event->max_participants) {
                DB::rollBack();
                return back()->withErrors(['limitmax' => 'ลงทะเบียนเต็มจำนวนแล้ว']);
            }

            //แถวที่คนนี้เคยลงไว้
            $mine = $this->myRegistrations($request, $event->event_id);
            $grantRow = $mine->firstWhere(fn($r) => $r->extra_allowed > 0);

            if ($mine->isNotEmpty()) {
                //เคยลงแล้ว: ต้องมีสิทธิ์ลงเพิ่มถึงจะลงได้อีก
                if (!$grantRow) {
                    DB::rollBack();
                    return back()->withErrors(['full_name' => 'คุณลงทะเบียนกิจกรรมนี้ไปแล้ว']);
                }

                //ตัดสิทธิ์ลงเพิ่มของแถวนี้ 1 ครั้ง (ล็อกแถวกันกดซ้ำพร้อมกันแล้วใช้สิทธิ์เกิน)
                $grantRow = EventRegistration::where('registration_id', $grantRow->registration_id)->lockForUpdate()->first();
                if ($grantRow->extra_allowed < 1) {
                    DB::rollBack();
                    return back()->withErrors(['full_name' => 'คุณลงทะเบียนกิจกรรมนี้ไปแล้ว']);
                }
                $grantRow->extra_allowed = $grantRow->extra_allowed - 1;
                $grantRow->save();

                //ครั้งที่ 2 ไม่ต้องพิมพ์ชื่อ ใช้ชื่อเดิมถ้าช่องว่าง
                $fullName = trim((string) $request->input('full_name')) ?: $mine->last()->full_name;
            } else {
                //ลงทะเบียนครั้งแรก: ต้องกรอกชื่อ
                $fullName = trim((string) $request->input('full_name'));
                if ($fullName === '') {
                    DB::rollBack();
                    return back()->withErrors(['full_name' => 'กรุณากรอกชื่อ-นามสกุลด้วย'])->withInput();
                }
            }

            $registration = new EventRegistration();
            $registration->event_id = $event->event_id;
            $registration->user_id = Auth::id();          // ไม่ล็อกอิน = null
            $registration->guest_token = $token;
            $registration->full_name = $fullName;
            $registration->registered_at = now();
            $registration->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง']);
        }

        //จำรหัสเครื่องไว้ 1 ปี เอาไว้กันลงซ้ำและให้ลงเพิ่มได้
        Cookie::queue(self::TOKEN_COOKIE, $token, 525600);

        return back();
    }

    //แอดมิน/manager กดให้คนที่ลงทะเบียนแล้วลงเพิ่มได้อีก 1 ครั้ง (route ต้องอยู่หลัง auth)
    public function grantExtra($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);
        $registration->increment('extra_allowed');   // สิทธิ์ที่เหลือ (ลดเมื่อใช้)
        $registration->increment('extra_granted');   // สิทธิ์ที่เคยให้สะสม (ไม่ลด)

        return back();
    }

    //ส่งจำนวนผู้ลงทะเบียนล่าสุดกลับเป็น JSON เอาไว้ให้หน้า view_details ถามเป็นระยะ (เบากว่าดึงทั้งหน้า)
    public function registrationCount($eventId)
    {
        $count = EventRegistration::where('event_id', $eventId)->count();
        $last = EventRegistration::where('event_id', $eventId)->max('registration_id');

        return response()->json(['count' => $count, 'last' => $last]);
    }
}