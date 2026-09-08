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
    private function getevent(int $eventId): Event
    {
        return Event::findOrFail($eventId);
    }

    //แสดงฟอมลงทะเบียนเข้าร่วมกิจกรรม
    public function create($eventId)
    {
        $event = $this->getevent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);
        return view('user.register_event',[
            'event' => $event,
            'remainingseconds' => $remainingseconds,
            'isexpired' => $isexpired,
        ]);
    }

    //บันทึกการลงทะเบียนเข้าร่วมกิจกรรม
    public function store(Request $request, $eventId)
    {
        $event = $this->getevent($eventId);

        $data = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => [
                        'required',
                        'email:rfc,dns',
                        'max:200',

                        //เช็คว่า email นี้เคยลงทะเบียนกิจกรรมนี้แล้วหรือยัง
                        Rule::unique('event_registrations', 'email')->where(function ($query) use ($event){
                        return $query->where('event_id', $event->event_id);
        }),
            ],


        ], [
            'full_name.required' => 'กรุณากรอกชื่อ-นามสกุลด้วย',
            'email.required' => 'กรุณากรอกอีเมลด้วย',
            'email.email' => 'กรุณากรอกอีเมลที่ถูกต้องและมีอยู่จริง',
            'email.unique' => 'อีเมลนี้ลงทะเบียนกิจกรรมนี้ไปแล้ว',

        ]);


        //เปิด transaction เตรียมเช็คสถานะ+จำนวนคน
        DB::beginTransaction();

        //ล็อกแถว event กันคนส่งฟอร์มพร้อมกันแล้วข้อมูลชนกัน
        $event = Event::where('event_id', $eventId)->lockForUpdate()->first();

        //คำนวณเวลาปิด Register จากข้อมูล event ล่าสุดที่ล็อกไว้
        $closeat = Carbon::parse($event->register_close_at);    

        //เอาไว้เช็คว่ายังเปิดให้ลงทะเบียนอยู่มั้ย
        if ($event->status !== 'open' || Carbon::now()->greaterThanOrEqualTo($closeat)){
            DB::rollBack();
            return back()->withErrors(['status' => 'กิจกรรมนี้ปิดรับลงทะเบียนแล้ว']);

        }

        //เอาไว้เช็คว่าลงทะเบียนเต็มยัง
        $registeredcount = $event->registrations()->count();

        //เช็คว่าลงทะเบียนเต็มแล้วหรือยัง
        if ($registeredcount >= $event->max_participants) {
            DB::rollBack();
            return back()->withErrors(['limitmax' => 'ลงทะเบียนเต็มจำนวนแล้ว']);
        }


        EventRegistration::create([
            'event_id' => $event->event_id,
            'user_id' => Auth::id() ?? 1,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'registered_at' => now(),

        ]);


        DB::commit();

        return back()->with('success', '✓ ลงทะเบียนเข้าร่วมกิจกรรมสำเร็จแล้ว');

    }

}
