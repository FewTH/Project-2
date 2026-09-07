<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    
    //เอาไว้ดุงข้อมูลกิจกรรมมาใช้งานซ้ำ และเช็คว่ามีอยู่จริงมั้ย
    private function getevent(int $eventId): Event
    {
        return Event::findOrFail($eventId);
    }

    //แสดงฟอมลงทะเบียนเข้าร่วมกิจกรรม
    public function create($eventId)
    {
        $event = $this->getevent($eventId);
        return view('user.register_event', ['event' => $event]);
    }

    //บันทึกการลงทะเบียนเข้าร่วมกิจกรรม
    public function store(Request $request, $eventId)
    {
        $event = $this->getevent($eventId);

        $data = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|email:rfc,dns|max:200',

        ],[
            'full_name.required' => 'กรุณากรอกชื่อ-นามสกุลด้วย',
            'email.required' => 'กรุณากรอกอีเมลด้วย',
            'email.email' => 'กรุณากรอกอีเมลที่ถูกต้องและมีอยู่จริง',

        ]);

        //เอาไว้เช็คว่ายังเปิดให้ลงทะเบียนอยู่มั้ย
        if ($event->status !== 'open'){
            return back()->withErrors(['status' => 'กิจกรรมนี้ปิดรับลงทะเบียนแล้ว']);

        }

        //เอาไว้เช็คว่าลงทะเบียนเต็มยัง
        $registeredcount = $event->registrations()->count();
        if ($registeredcount >= $event->max_participants) {
            return back()->withErrors(['limitmax' => 'ลงทะเบียนเต้มจำนวนแล้ว']);
        }


        EventRegistration::create([
            'event_id' => $event->event_id,
            'user_id' => Auth::id() ?? 1,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'registered_at' => now(),

        ]);

        return back()->with('success', '✓ ลงทะเบียนเข้าร่วมกิจกรรมสำเร็จแล้ว');

    }

}
