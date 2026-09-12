<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EventRegistrationController extends Controller
{
    
    //เอาไว้ดึงข้อมูลกิจกรรมมาใช้งานซ้ำ และเช็คว่ามีอยู่จริงมั้ย
    private function getevent($eventId)
    {
        $event = Event::findOrFail($eventId);
        return $event;
    }

    //แสดงฟอมลงทะเบียนเข้าร่วมกิจกรรม
    public function create($eventId)
    {
        $event = $this->getevent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
        $event->isexpired = $isexpired;
        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);
        return view('user.register_event',['event' => $event,'remainingseconds' => $remainingseconds,'isexpired' => $isexpired,]);
    }

    //บันทึกการลงทะเบียนเข้าร่วมกิจกรรม
    public function store(Request $request, $eventId)
    {
        $event = $this->getevent($eventId);

        $data = $request->validate([
            'full_name' => [
                            'required',
                            'string',
                            'max:200',
                                Rule::unique('event_registrations', 'full_name')->where(function ($query) use ($eventId) {
                                return $query->where('event_id', $eventId);
                }),
            ],

        ], [
            'full_name.required' => 'กรุณากรอกชื่อ-นามสกุลด้วย',
            'full_name.unique' => 'ชื่อนี้ลงทะเบียนกิจกรรมนี้ไปแล้ว',

        ]);


        //การสร้างเซฟพอยต์เพื่อความปลอดภัยของข้อมูล
        DB::beginTransaction();

        try {

            //ล็อกแถว event กันคนส่งฟอร์มพร้อมกันแล้วข้อมูลชนกัน
            $event = Event::where('event_id', $eventId)->lockForUpdate()->first();

            //คำนวณเวลาปิด Register จากข้อมูล event ล่าสุดที่ล็อกไว้
            $closeat = Carbon::parse($event->register_close_at);

            //เอาไว้เช็คว่ายังเปิดให้ลงทะเบียนอยู่มั้ย
            if ($event->status !== 'open' || Carbon::now()->gte($closeat)) {
                DB::rollBack();
                return back()->withErrors(['status' => 'กิจกรรมนี้ปิดรับลงทะเบียนแล้ว']);
            }

            //เอาไว้เช็คว่าลงทะเบียนเต็มยัง
            $registeredcount = EventRegistration::where('event_id', $event->event_id)->count();

            //เช็คว่าลงทะเบียนเต็มแล้วหรือยัง
            if ($registeredcount >= $event->max_participants) {
                DB::rollBack();
                return back()->withErrors(['limitmax' => 'ลงทะเบียนเต็มจำนวนแล้ว']);
            }

            //กันเหนียวอีกชั้น เผื่อมีคนส่งฟอร์มพร้อมกันด้วยชื่อเดียวกัน
            $isduplicate = EventRegistration::where('event_id', $event->event_id)
                ->where('full_name', $data['full_name'])
                ->exists();

            if ($isduplicate) {
                DB::rollBack();
                return back()->withErrors(['full_name' => 'ชื่อนี้ลงทะเบียนกิจกรรมนี้ไปแล้ว']);
            }

            $registration = new EventRegistration();
            $registration->event_id = $event->event_id;
            $registration->user_id = Auth::id() ?? 1;
            $registration->full_name = $data['full_name'];
            $registration->registered_at = now();
            $registration->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง']);
        }

        return back()->with('success', '✓ ลงทะเบียนเข้าร่วมกิจกรรมสำเร็จแล้ว');

    }

}