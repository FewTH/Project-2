<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reward;
use App\Models\spin_wheels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityController extends Controller
{
    // เอาไว้ดึงข้อมูลกิจกรรมมาใช้งานซ้ำ พร้อมเช็คว่ามีอยู่จริงมั้ย
    private function getEvent(int $eventId): Event
    {
        return Event::with(['wheel.rewards.category', 'registrations'])->findOrFail($eventId);
    }

    // แสดงฟอร์มสร้างกิจกรรม พร้อมรายการของรางวัลทั้งหมด
    public function create()
    {
        $rewards = Reward::with('category')->get();
        return view('admin.create_activity', ['rewards' => $rewards]);
    }

    // บันทึกกิจกรรมใหม่
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:300',
            'event_date'          => 'required|date',
            'register_close_time' => 'required',
            'max_participants'    => 'nullable|integer|min:1',
            'rewards'             => 'required|array|min:1',
            'rewards.*.qty'       => 'required|integer|min:1',
        ], [
            'title.required'               => 'กรุณากรอกชื่อกิจกรรมด้วย',
            'event_date.required'          => 'กรุณากรอกวันที่จัดกิจกรรมด้วย',
            'register_close_time.required' => 'กรูณาเลือกเวลาปิด Register ด้วย',
            'max_participants.integer'    => 'จำนวนผู้เข้าร่วมต้องเป็นตัวเลขเท่านั้น',
            'max_participants.min'        => 'จำนวนผู้เข้าร่วมต้องมีอย่างน้อย 1 คน',
            'rewards.required'             => 'กรุณาเลือกของรางวัลอย่างน้อย 1 รายการ',
            'rewards.*.qty.required'       => 'กรุณาเลือกจำนวนของรางวัลด้วย',
            'rewards.*.qty.integer'        => 'จำนวนของรางวัลต้องเป็นตัวเลขเท่านั้น',
            'rewards.*.qty.min'            => 'จำนวนของรางวัลต้องมีอย่างน้อย 1 ชิ้น',
        ]);

        // กำหนดจำนวนผู้เข้าร่วมให้เป็น 1 ถ้าไม่มีการกรอกใหม่
        $data['max_participants'] = $data['max_participants'] ?? 1;

        // ตรวจสอบของรางวัลฝั่ง server เผื่อมีคนมาเปลี่ยนแปลงข้อมูลหน้าบ้าน
        foreach ($data['rewards'] as $rewardId => $item) {
            $reward = Reward::find($rewardId);

            // หากเช็คแล้วไม่พบของรางวัลหรือจำนวนที่เลือกให้ส่งกลับมาพร้อม Error
            if (!$reward || $item['qty'] > $reward->quantity_reward) {
                return back()->withErrors([
                    "rewards.{$rewardId}.qty" => "จำนวนของรางวัล \"" . ($reward->name ?? '') . "\" เกินจำนวนของรางวัลที่มี"
                ])->withInput();            
            }
        }

        // รวมวันและเวลาปิดลงทะเบียน
        $registercloseat = $data['event_date'] . ' ' . $data['register_close_time'];

        // ลบ key ออกจาก $data ก่อนบันทึกลงตาราง events
        unset($data['rewards'], $data['event_date'], $data['register_close_time']);

        // บันทึกข้อมูลแบบ transaction
        $event = DB::transaction(function () use ($data, $request, $registercloseat) {

            // สร้างวงล้อสำหรับกิจกรรมนี้
            $wheel = spin_wheels::create([
                'name'       => $data['title'] . '- วงล้อ',
                'is_active'  => 1,
                'created_by' => Auth::id() ?? 1,
            ]);
            
            // ผูกของรางวัลเข้ากับวงล้อ
            foreach ($request->input('rewards', []) as $rewardId => $item) {
                $wheel->rewards()->attach($rewardId, [
                    'quantity_selected' => $item['qty'],
                ]);
            }

            // บันทึกและ return Event ลง database
            return Event::create([
                'wheel_id'          => $wheel->wheel_id,
                'title'             => $data['title'],
                'register_close_at' => $registercloseat,
                'max_participants'  => $data['max_participants'],
                'status'            => 'open', 
                'created_by'        => Auth::id() ?? 1,
            ]);
        });

        // เปลี่ยนหน้าไปหน้ารายละเอียดกิจกรรมเมื่อทำเสร็จ
        return redirect()
            ->route('admin.activity.detail', $event->event_id)
            ->with('success', '✓ สร้างกิจกรรมสำเร็จแล้ว');
    }

    // แสดงหน้ารายละเอียดกิจกรรม
    public function show($eventId)
    {   
        $event = $this->getEvent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);


        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);

        return view('admin.view_details',[
            'event' => $event,
            'remainingseconds' => $remainingseconds,
            'isexpired' => $isexpired,
        ]);
            
    }

    // ปิด Register กิจกรรม
    public function closeRegister($eventId)
    {
        $event = $this->getEvent($eventId);
        $event->update(['status' => 'closed']);

        return back()->with('success', '✓ ปิด Register กิจกรรมแล้ว');
    }
}