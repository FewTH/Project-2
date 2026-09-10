<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
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


    // แสดงฟอร์มสร้างกิจกรรม ของหน้าcreate_activity
    public function create()
    {
        return view('admin.create_activity');
    }


    // แสดงหน้าเว็บสุ่มรางวัล หน้าrandom_reward
    public function randomreward($eventId)
    {
        $event = $this->getEvent($eventId);

        return view('admin.random_reward', ['event' => $event]);
    }


    //แสดงหน้ารายการกิจกรรมทั้งหมด ของหน้าแบบประเมิน/กิจกรรมassessment
    public function index()
    {
        $events = Event::with(['wheel.rewards', 'registrations'])->orderBy('created_at', 'desc')->get();

            $now = Carbon::now();

        // เช็คแต่ละกิจกรรมว่าหมดเวลาไปแล้วหรือยัง เอาไปแสดงสถานะให้ตรงกับหน้าview_details
        $events->each(function ($event) use ($now) {
            $closeat = Carbon::parse($event->register_close_at);
            $event->isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
        });

            return view('admin.assessment', ['events' => $events]);
    }


    //แสดงฟอร์มแก้ไขกิจกรรม เอาข้อมูลเดิมมาโชว์ในฟอร์ม ของหน้าedit_activity
    public function editactivity($eventId)
    {
        $event = $this->getEvent($eventId);

        // เช็คว่ากิจกรรมหมดเวลาไปแล้วหรือยัง ใช้แบบเดียวกับหน้า view_details
        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        // ถ้าปิดไปแล้ว ไม่ให้เข้าหน้าแก้ไข ส่งกลับไปหน้ารายละเอียด
        if ($isexpired) {
            return redirect()->route('admin.activity.detail', $event->event_id);
        }


        //ดึงของรางวัลที่เลือกไว้แล้ว เอาไปติ๊กในหน้าแก้ไขกิจกรรมอัตโนมัติ ของหน้าedit_activity
        $selectedrewards = $event->wheel
            ? $event->wheel->rewards->pluck('pivot.quantity_selected', 'reward_id')->toArray(): [];

        return view('admin.edit_activity',['event' => $event,'selectedrewards' => $selectedrewards,]);
    }


    // บันทึกกิจกรรมใหม่ ของหน้าcreate_activity
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
            'register_close_time.required' => 'กรุณาเลือกเวลาปิด Register ด้วย',
            'max_participants.min'        => 'จำนวนผู้เข้าร่วมต้องมีอย่างน้อย 1 คน',
            'rewards.required'             => 'กรุณาเลือกของรางวัลอย่างน้อย 1 รายการ',
            'rewards.*.qty.required'       => 'กรุณาเลือกจำนวนของรางวัลด้วย',
            'rewards.*.qty.min'            => 'จำนวนของรางวัลต้องมีอย่างน้อย 1 ชิ้น',
        ]);

        // กำหนดจำนวนผู้เข้าร่วมให้เป็น 1 ถ้าไม่มีการกรอกใหม่ ของหน้าcreate_activity
        $data['max_participants'] = $data['max_participants'] ?? 1;

        // ตรวจสอบของรางวัลฝั่ง server เผื่อมีคนมาเปลี่ยนแปลงข้อมูลหน้าบ้าน ของหน้าcreate_activity
        foreach ($data['rewards'] as $rewardId => $item) {
            $reward = Reward::find($rewardId);

            // ถ้าไม่พบของรางวัลเลย ให้ error แยกจากกรณีจำนวนเกิน กัน error ตอนอ้าง $reward->name
            if (!$reward) {
                return back()->withErrors(["rewards.{$rewardId}.qty" => "ไม่พบของรางวัลที่เลือก กรุณาเลือกใหม่อีกครั้ง"])->withInput();
            }

            // หากจำนวนที่เลือกเกินที่มีให้ส่งกลับมาพร้อม Error ของหน้าcreate_activity
            if ($item['qty'] > $reward->quantity_reward) {
                return back()->withErrors(["rewards.{$rewardId}.qty" => "จำนวนของรางวัล \"{$reward->name}\" เกินจำนวนของรางวัลที่มี"])->withInput();
            }
        }

        // รวมวันและเวลาปิดลงทะเบียน ของหน้าcreate_activity
        $registercloseat = $data['event_date'] . ' ' . $data['register_close_time'];
        // ลบ key ออกจาก $data ก่อนบันทึกลงตาราง events ของหน้าcreate_activity
        unset($data['rewards'], $data['event_date'], $data['register_close_time']);

        // บันทึกข้อมูลแบบ transaction ของหน้าcreate_activity
        $event = DB::transaction(function () use ($data, $request, $registercloseat) {

            // สร้างวงล้อสำหรับกิจกรรมนี้ ของหน้าcreate_activity
            $wheel = spin_wheels::create([
                'name'       => $data['title'] . '- วงล้อ',
                'is_active'  => 1,
                'created_by' => Auth::id() ?? 1,
            ]);
            
            // ผูกของรางวัลเข้ากับวงล้อ ของหน้าcreate_activity
            foreach ($request->input('rewards', []) as $rewardId => $item) {
                $wheel->rewards()->attach($rewardId, ['quantity_selected' => $item['qty'],]);
            }

            // บันทึกและ return Event ลง database ของหน้าcreate_activity
            return Event::create([
                'wheel_id'          => $wheel->wheel_id,
                'title'             => $data['title'],
                'register_close_at' => $registercloseat,
                'max_participants'  => $data['max_participants'],
                'status'            => 'open', 
                'created_by'        => Auth::id() ?? 1,
            ]);
        });

        // เปลี่ยนไปหน้ารายละเอียดกิจกรรมview_detailsเมื่อทำเสร็จ ของหน้าcreate_activity
        return redirect()->route('admin.activity.detail', $event->event_id);
    }

    

    // บันทึกการแก้ไขข้อมูล กิจกรรม ของหน้า edit_activity
    public function updateactivity(Request $request, $eventId)
    {
        $event = $this->getEvent($eventId);

        // กันเหนียวอีกชั้น เผื่อมีคนเปิดฟอร์มค้างไว้แล้วกิจกรรมหมดเวลาไปแล้วระหว่างนั้น
        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        if ($isexpired) {
            return redirect()->route('admin.activity.detail', $event->event_id);
        }

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
            'register_close_time.required' => 'กรุณาเลือกเวลาปิด Register ด้วย',
            'max_participants.min'        => 'จำนวนผู้เข้าร่วมต้องมีอย่างน้อย 1 คน',
            'rewards.required'             => 'กรุณาเลือกของรางวัลอย่างน้อย 1 รายการ',
            'rewards.*.qty.required'       => 'กรุณาเลือกจำนวนของรางวัลด้วย',
            'rewards.*.qty.min'            => 'จำนวนของรางวัลต้องมีอย่างน้อย 1 ชิ้น',
        ]);

        // ถ้าไม่กรอกจำนวนผู้เข้าร่วมมา ให้เป็น 1 ไปต่อไป ของหน้า edit_activity
        $data['max_participants'] = $data['max_participants'] ?? 1;


        // ตรวจสอบของรางวัลฝั่ง server อีกรอบ เผื่อมีคนมาเปลี่ยนแปลงข้อมูลหน้าบ้าน ของหน้า edit_activity
        foreach ($data['rewards'] as $rewardId => $item) {
            $reward = Reward::find($rewardId);

            // ถ้าไม่พบของรางวัลเลย ให้ error แยกจากกรณีจำนวนเกิน (กัน error ตอนอ้าง $reward->name)
            if (!$reward) {
                return back()->withErrors([
                    "rewards.{$rewardId}.qty" => "ไม่พบของรางวัลที่เลือก กรุณาเลือกใหม่อีกครั้ง"
                ])->withInput();
            }

            if ($item['qty'] > $reward->quantity_reward){
                   return back()->withErrors([
                    "rewards.{$rewardId}.qty" => "จำนวนของรางวัล \"{$reward->name}\" เกินจำนวนของรางวัลที่มี"
                ])->withInput();          
            }
        }


        $registercloseat = $data['event_date'] . ' ' . $data['register_close_time'];
        unset($data['rewards'], $data['event_date'], $data['register_close_time']);

        DB::transaction(function () use ($data, $request, $registercloseat, $event){
            
            $event->update([
                'title' => $data['title'],
                'register_close_at' => $registercloseat,
                'max_participants' => $data['max_participants'],
            ]);

            // ลบของรางวัลเดิมก่อน แล้วผูกของรางวัลใหม่เข้าไปแทน
            if ($event->wheel) {
                $event->wheel->rewards()->detach();

                foreach ($request->input('rewards', []) as $rewardId => $item) {
                    $event->wheel->rewards()->attach($rewardId, ['quantity_selected' => $item['qty'],
                    ]);
                }
            }
        });

        return redirect()->route('admin.activity.detail', $event->event_id);
    }







    // แสดงหน้ารายละเอียดกิจกรรม ของหน้าview_details
    public function showviewdetails($eventId)
    {   
        $event = $this->getEvent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);


        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);

        return view('admin.view_details',['event' => $event,'remainingseconds' => $remainingseconds,'isexpired' => $isexpired,
        ]);
            
    }
    

    // ลบกิจกรรม พร้อมข้อมูลที่เกี่ยวข้องทั้งหมดและกลับไปหน้าassessment ของหน้าview_details
    public function deletedata($eventId)
    {
        $event = $this->getEvent($eventId);

        DB::transaction(function () use ($event){

            $event->registrations()->delete();

            if($event->wheel){
                $event->wheel->rewards()->detach();
                $event->wheel->delete();
            }
            
            $event->delete();
        });
        
        return redirect()->route('admin.assessment');
    }


    // สามารถให้ปุ่มบันทึกใช้งานได้และโหลดQrcodeเป็นPNG ของหน้าview_details
    public function downloadQrCode($eventId)
    {
        $event = $this->getEvent($eventId);
        $url = url('user/register_event/' . $event->event_id);

        // สร้างชื่อไฟล์จากชื่อกิจกรรม แปลงอักขระที่ไม่เหมาะสมออกกันปัญหาไฟล์เสีย
        $safeTitle = preg_replace('/[^\p{L}\p{N}_\-]/u', '_', $event->title);
        $filename = 'QRCode-' . $safeTitle . '.png';

        return response(QrCode::format('png')->size(600)->generate($url))
        ->header('Content-Type', 'image/png')->header('Content-Disposition', 'attachment; filename='. $filename .'');
    }



    // ปิด Register กิจกรรม ของหน้าview_details
    public function closeRegister($eventId)
    {
        $event = $this->getEvent($eventId);
        $event->update(['status' => 'closed']);

        return back();
    }

}