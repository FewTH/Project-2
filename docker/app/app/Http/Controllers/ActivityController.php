<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Event;
use App\Models\Reward;
use App\Models\spin_wheels;
use App\Models\EventRegistration;
use App\Models\EventRewardDraw;
use App\Models\Assessment;
use App\Models\Spinresult;
use Illuminate\Http\Request;
// .
use App\Http\Controllers\Concerns\ManagesRewardStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\HeaderUtils;


class ActivityController extends Controller
{
    use ManagesRewardStock;
    // เอาไว้ดึงข้อมูลกิจกรรมมาใช้งานซ้ำ พร้อมเช็คว่ามีอยู่จริงมั้ย
    private function getEvent(int $eventId): Event
    {
        return Event::with(['wheel.rewards.category', 'registrations'])->findOrFail($eventId);
    }


    // ส่วนของ admin ไม่ต้องมี wrapper เพราะ route เรียกเมธอดข้างล่างตรง ๆ ได้เลย ($role จะเป็น admin ให้เอง)
    // ส่วนของ manager
    //แสดงหน้ารายการกิจกรรมของ manager
    public function managerIndex()
    {
        return $this->index('manager');
    }

    //แสดงฟอร์มสร้างกิจกรรมของ manager
    public function managerCreate()
    {
        return $this->create('manager');
    }

    //บันทึกกิจกรรมใหม่ของ manager
    public function managerStore(Request $request)
    {
        return $this->store($request, 'manager');
    }

    //แสดงหน้ารายละเอียดกิจกรรมของ manager
    public function managerShowDetails($eventId)
    {
        return $this->showviewdetails($eventId, 'manager');
    }

    //แสดงฟอร์มแก้ไขกิจกรรมของ manager
    public function managerEdit($eventId)
    {
        return $this->editactivity($eventId, 'manager');
    }

    //บันทึกการแก้ไขกิจกรรมของ manager
    public function managerUpdate(Request $request, $eventId)
    {
        return $this->updateactivity($request, $eventId, 'manager');
    }

    //ลบกิจกรรมของ manager
    public function managerDelete($eventId)
    {
        return $this->deletedata($eventId, 'manager');
    }

    //แสดงหน้าสุ่มรางวัลของ manager
    public function managerRandomReward($eventId)
    {
        return $this->randomReward($eventId, 'manager');
    }

    //ปิด Register ของ manager (closeRegister ใช้ back() ได้ทั้ง admin และ manager)
    public function managerCloseRegister($eventId)
    {
        return $this->closeRegister($eventId);
    }

    
    // ส่วนที่ admin กับ manager ใช้ร่วมกัน ($role จะเป็น admin หรือ manager เอาไว้บอกว่าจะใช้ view กับ redirect ไปทางไหน ถ้าไม่ส่งมาจะเป็น admin)
    // แสดงฟอร์มสร้างกิจกรรม ของหน้าcreate_activity
    public function create($role = 'admin')
    {
        return view($role . '.create_activity', [
            'prefix' => $role,
            'user' => Auth::user(),
        ]);
    }

    // แสดงหน้าเว็บสุ่มรางวัล หน้าrandom_reward
    public function randomReward($eventId, $role = 'admin')
    {
        $event = $this->getEvent($eventId);

        $nameData = $event->registrations->where('is_drawn', false)->map(fn($r) => [
            'id' => $r->registration_id,
            'label' => $r->full_name,
            'percent' => 1
        ])->values();

        $rewardData = $event->wheel
            ? $event->wheel->rewards
                ->filter(fn($r) => ($r->pivot->quantity_selected ?? 0) > 0)->map(fn($r) => [
                'id' => $r->reward_id,
                'label' => $r->name,
                'percent' => $r->rate ?? 0,
                'quantity' => $r->pivot->quantity_selected ?? 0
            ])->values() : collect();

        // ดึงผู้โชคดีล่าสุด 6 คน พร้อมชื่อรางวัลจริงจาก reward_id ที่บันทึกไว้ตอนสุ่ม
        $latestwinners = $event->registrations()->where('is_drawn', true)->with('reward')->orderByDesc('drawn_at')->take(6)->get();

        return view($role . '.random_reward', [
            'event' => $event,
            'nameData' => $nameData,
            'rewardData' => $rewardData,
            'latestwinners' => $latestwinners,
            'prefix' => $role,
            'user' => Auth::user(),
        ]);
    }


    //แสดงหน้ารายการกิจกรรมทั้งหมด ของหน้าแบบประเมิน/กิจกรรมassessment
    public function index($role = 'admin')
    {
        // หน้านึงจำกัดการแสดงแค่6กิจกรรมเท่านั้น
        $events = Event::with(['wheel.rewards', 'registrations'])->orderBy('created_at', 'desc')->paginate(6);

        $now = Carbon::now();

        // เช็คแต่ละกิจกรรมว่าหมดเวลาไปแล้วหรือยัง เอาไปแสดงสถานะให้ตรงกับหน้าview_details
        $events->each(function ($event) use ($now) {
            $closeat = Carbon::parse($event->register_close_at);
            $event->isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
        });

        // ดึงแบบประเมินทั้งหมดกับวงล้อที่บันทึกไว้
        $assessments = Assessment::with('WheelAssessment.wheel.rewards')
            ->orderBy('created_at', 'desc')
            ->get();

        // ส่งค่ากับไปที่หน้าโค้ดassessment.blade.php admin กับ manager
        // id ของแบบประเมินที่มีผลสุ่มอย่างน้อย 1 รายการ
        $spunAssessmentIds = Spinresult::distinct()->pluck('assessment_id')->all();

        return view($role . '.assessment', [
            'events'      => $events,
            'assessments' => $assessments,
            // 'spunAssessmentIds' => $spunAssessmentIds,
            'prefix'      => $role,
            'user'        => Auth::user(),
        ]);
    }


    //แสดงฟอร์มแก้ไขกิจกรรม เอาข้อมูลเดิมมาโชว์ในฟอร์ม ของหน้าedit_activity
    public function editactivity($eventId, $role = 'admin')
    {
        $event = $this->getEvent($eventId);

        // เช็คว่ากิจกรรมหมดเวลาไปแล้วหรือยัง ใช้แบบเดียวกับหน้า view_details
        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        // ถ้าปิดไปแล้ว ไม่ให้เข้าหน้าแก้ไข ส่งกลับไปหน้ารายละเอียด
        if ($isexpired) {
            return redirect()->route($role . '.activity.detail', $event->event_id);
        }

        //ดึงของรางวัลที่เลือกไว้แล้ว เอาไปติ๊กในหน้าแก้ไขกิจกรรมอัตโนมัติ ของหน้าedit_activity
        $selectedrewards = $event->wheel
            ? $event->wheel->rewards->pluck('pivot.quantity_selected', 'reward_id')->toArray() : [];

        // เช็คว่ากิจกรรมนี้จำกัดจำนวนผู้เข้าร่วมหรือไม่ (null = ไม่จำกัด)
        $limited = !is_null($event->max_participants);

        return view($role . '.edit_activity', [
            'event' => $event,
            'selectedrewards' => $selectedrewards,
            'limited' => $limited,
            'prefix' => $role,
            'user' => Auth::user(),
        ]);
    }


    // บันทึกกิจกรรมใหม่ ของหน้าcreate_activity
    public function store(Request $request, $role = 'admin')
{
    $data = $request->validate([
        'title'               => 'required|string|max:300',
        'event_date'          => 'required|date',
        'register_close_time' => 'required',
        'limit_enabled'       => 'nullable|boolean',
        'max_participants'    => 'required_if:limit_enabled,1|nullable|integer|min:1',
        'rewards'             => 'required|array|min:1',
        'rewards.*.qty'       => 'required|integer|min:1',
    ], [
        'title.required'               => 'กรุณากรอกชื่อกิจกรรมด้วย',
        'event_date.required'          => 'กรุณากรอกวันที่จัดกิจกรรมด้วย',
        'register_close_time.required' => 'กรุณาเลือกเวลาปิด Register ด้วย',
        'max_participants.min'         => 'จำนวนผู้เข้าร่วมต้องมีอย่างน้อย 1 คน',
        'max_participants.required_if' => 'กรุณากรอกจำนวนผู้เข้าร่วมสูงสุดด้วย',
        'rewards.required'             => 'กรุณาเลือกของรางวัลอย่างน้อย 1 รายการ',
        'rewards.*.qty.required'       => 'กรุณาเลือกจำนวนของรางวัลด้วย',
        'rewards.*.qty.min'            => 'จำนวนของรางวัลต้องมีอย่างน้อย 1 ชิ้น',
    ]);
 
    // กำหนดจำนวนผู้เข้าร่วมให้เป็น null ถ้าไม่ได้จำกัด ของหน้าcreate_activity
    $data['max_participants'] = $request->boolean('limit_enabled') ? (int) $data['max_participants'] : null;
 
    // [แก้] ย้ายการตรวจจำนวนของรางวัลเข้าไปทำใน transaction (adjustRewardStock)
    // จะได้ตรวจและหักพร้อมกันแบบล็อกแถว กันสองคนกดพร้อมกันแล้วของติดลบ
 
    // รวมวันและเวลาปิดลงทะเบียน ของหน้าcreate_activity
    $registercloseat = $data['event_date'] . ' ' . $data['register_close_time'];
    // ลบ key ออกจาก $data ก่อนบันทึกลงตาราง events ของหน้าcreate_activity
    unset($data['rewards'], $data['event_date'], $data['register_close_time']);
 
    // [reward_id => จำนวนที่เลือก]
    $selectedQty = collect($request->input('rewards', []))
        ->map(fn ($item) => (int) $item['qty'])
        ->all();
 
    // บันทึกข้อมูลแบบ transaction ของหน้าcreate_activity
    $event = DB::transaction(function () use ($data, $registercloseat, $selectedQty) {
 
        // [ใหม่] หักจำนวนของรางวัลออกจากคลัง ถ้าไม่พอจะเด้งกลับหน้าเดิมพร้อม error
        // และจะไม่บันทึกกิจกรรมหรือวงล้อใด ๆ เลย
        $this->adjustRewardStock($selectedQty);
 
        // สร้างวงล้อสำหรับกิจกรรมนี้ ของหน้าcreate_activity
        $wheel = spin_wheels::create([
            'name'       => $data['title'] . '- วงล้อ',
            'is_active'  => 1,
            'created_by' => Auth::id(),
        ]);
 
        // ผูกของรางวัลเข้ากับวงล้อ ของหน้าcreate_activity
        foreach ($selectedQty as $rewardId => $qty) {
            $wheel->rewards()->attach($rewardId, ['quantity_selected' => $qty]);
        }
 
        // บันทึกและ return Event ลง database ของหน้าcreate_activity
        return Event::create([
            'wheel_id'          => $wheel->wheel_id,
            'title'             => $data['title'],
            'register_close_at' => $registercloseat,
            'max_participants'  => $data['max_participants'],
            'status'            => 'open',
            'created_by'        => Auth::id(),
        ]);
    });
 
    // เปลี่ยนไปหน้ารายละเอียดกิจกรรมview_detailsเมื่อทำเสร็จ ของหน้าcreate_activity
    return redirect()->route($role . '.activity.detail', $event->event_id);
}


    // บันทึกการแก้ไขข้อมูล กิจกรรม ของหน้า edit_activity
    public function updateactivity(Request $request, $eventId, $role = 'admin')
{
    $event = $this->getEvent($eventId);
 
    // กันเหนียวอีกชั้น เผื่อมีคนเปิดฟอร์มค้างไว้แล้วกิจกรรมหมดเวลาไปแล้วระหว่างนั้น
    $now = Carbon::now();
    $closeat = Carbon::parse($event->register_close_at);
 
    $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
 
    if ($isexpired) {
        return redirect()->route($role . '.activity.detail', $event->event_id);
    }
 
    $data = $request->validate([
        'title'               => 'required|string|max:300',
        'event_date'          => 'required|date',
        'register_close_time' => 'required',
        'limit_enabled'       => 'nullable|boolean',
        'max_participants'    => 'required_if:limit_enabled,1|nullable|integer|min:1',
        'rewards'             => 'required|array|min:1',
        'rewards.*.qty'       => 'required|integer|min:1',
    ], [
        'title.required'               => 'กรุณากรอกชื่อกิจกรรมด้วย',
        'event_date.required'          => 'กรุณากรอกวันที่จัดกิจกรรมด้วย',
        'register_close_time.required' => 'กรุณาเลือกเวลาปิด Register ด้วย',
        'max_participants.min'         => 'จำนวนผู้เข้าร่วมต้องมีอย่างน้อย 1 คน',
        'max_participants.required_if' => 'กรุณากรอกจำนวนผู้เข้าร่วมสูงสุดด้วย',
        'rewards.required'             => 'กรุณาเลือกของรางวัลอย่างน้อย 1 รายการ',
        'rewards.*.qty.required'       => 'กรุณาเลือกจำนวนของรางวัลด้วย',
        'rewards.*.qty.min'            => 'จำนวนของรางวัลต้องมีอย่างน้อย 1 ชิ้น',
    ]);
 
    // ถ้าไม่ได้จำกัดจำนวนผู้เข้าร่วม ให้เป็น null ของหน้า edit_activity
    $data['max_participants'] = $request->boolean('limit_enabled') ? (int) $data['max_participants'] : null;
 
    // [แก้] ลบการตรวจแบบเดิมออก เพราะเดิมเทียบกับจำนวนคงเหลือในคลังตรง ๆ
    // ซึ่งตอนนี้ถูกหักส่วนของกิจกรรมนี้ไปแล้ว จะทำให้แจ้ง error ผิด
    // ตอนนี้ตรวจจากส่วนต่างแทน (ใน adjustRewardStock)
 
    $registercloseat = $data['event_date'] . ' ' . $data['register_close_time'];
    unset($data['rewards'], $data['event_date'], $data['register_close_time']);
 
    // จำนวนใหม่จากฟอร์ม [reward_id => จำนวน]
    $newQty = collect($request->input('rewards', []))
        ->map(fn ($item) => (int) $item['qty'])
        ->all();
 
    DB::transaction(function () use ($data, $registercloseat, $event, $newQty) {
 
        $event->update([
            'title'             => $data['title'],
            'register_close_at' => $registercloseat,
            'max_participants'  => $data['max_participants'],
        ]);
 
        if ($event->wheel) {
            // [ใหม่] จำนวนเดิมที่กิจกรรมนี้จองไว้ [reward_id => จำนวน]
            $oldQty = $event->wheel->rewards()->get()
                ->pluck('pivot.quantity_selected', 'reward_id')
                ->map(fn ($qty) => (int) $qty)
                ->all();
 
            // [ใหม่] ส่วนต่าง: บวก = หักเพิ่มจากคลัง, ลบ = คืนเข้าคลัง
            // เช่น เดิม 10 แก้เป็น 6 = คืน 4 / เดิมไม่มี เพิ่มมา 3 = หัก 3 / ติ๊กออก = คืนทั้งหมด
            $changes = [];
            foreach (array_unique(array_merge(array_keys($oldQty), array_keys($newQty))) as $rewardId) {
                $changes[$rewardId] = ($newQty[$rewardId] ?? 0) - ($oldQty[$rewardId] ?? 0);
            }
            $this->adjustRewardStock($changes);
 
            // ลบของรางวัลเดิมก่อน แล้วผูกของรางวัลใหม่เข้าไปแทน
            $event->wheel->rewards()->detach();
 
            foreach ($newQty as $rewardId => $qty) {
                $event->wheel->rewards()->attach($rewardId, ['quantity_selected' => $qty]);
            }
        }
    });
 
    return redirect()->route($role . '.activity.detail', $event->event_id);
}


    // แสดงหน้ารายละเอียดกิจกรรม ของหน้าview_details
    public function showviewdetails($eventId, $role = 'admin')
    {
        $event = $this->getEvent($eventId);

        $now = Carbon::now();
        $closeat = Carbon::parse($event->register_close_at);

        $isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);

        $remainingseconds = $isexpired ? 0 : (int) $now->diffInSeconds($closeat);

       return view($role . '.view_details', [
            'event' => $event,
            'remainingseconds' => $remainingseconds,
            'isexpired' => $isexpired,
            'prefix' => $role,
            'user' => Auth::user(),
        ]);
    }


    // ลบกิจกรรม พร้อมข้อมูลที่เกี่ยวข้องทั้งหมดและกลับไปหน้าassessment ของหน้าview_details
    public function deletedata($eventId, $role = 'admin')
{
    $event = $this->getEvent($eventId);
 
    DB::transaction(function () use ($event) {
 
        $event->registrations()->delete();
 
        if ($event->wheel) {
            // [ใหม่] quantity_selected ที่เหลือในวงล้อ = ของที่ยังไม่ได้แจก ให้คืนเข้าคลัง
            $remaining = $event->wheel->rewards()->get()
                ->pluck('pivot.quantity_selected', 'reward_id')
                ->map(fn ($qty) => -1 * (int) $qty) // ค่าลบ = คืนเข้าคลัง
                ->all();
            $this->adjustRewardStock($remaining);
 
            $event->wheel->rewards()->detach();
            $event->wheel->delete();
        }
 
        $event->delete();
    });
 
    return redirect()->route($role . '.assessment');
}


    // สามารถให้ปุ่มบันทึกใช้งานได้และโหลดQrcodeเป็นPNG ของหน้าview_details
    public function downloadQrCode($eventId)
    {
        $event = $this->getEvent($eventId);
        $url = url('user/register_event/' . $event->event_id);


        $filename = 'QRCode' . '.png';

        $png = QrCode::format('png')->size(800)->generate($url);

        return response($png)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                $filename
            ));
    }


    // ปิด Register กิจกรรม ของหน้าview_details
    public function closeRegister($eventId)
    {
        $event = $this->getEvent($eventId);
        $event->update(['status' => 'closed']);

        return back();
    }


    // บันทึกผลการสุ่มรางวัล ของหน้า random_reward (เรียกจาก JS หลังวงล้อหมุนเสร็จ)
    public function saveRandomResult(Request $request, $eventId)
    {
        $event = $this->getEvent($eventId);

        $data = $request->validate([
            'registration_id' => 'nullable|integer',
            'reward_id'       => 'nullable|integer',
        ]);

        DB::transaction(function () use ($data, $event) {

            // mark ว่ารายชื่อนี้ถูกสุ่มไปแล้ว (ทำเฉพาะตอนมี registration_id ส่งมาจริง)
            if (!empty($data['registration_id'])) {
                EventRegistration::where('registration_id', $data['registration_id'])
                    ->where('event_id', $event->event_id)
                    ->update([
                        'is_drawn'  => 1,
                        'drawn_at'  => now(),
                        'reward_id' => $data['reward_id'] ?? null,
                        'drawn_by'  => Auth::user()->user_id,
                    ]);
            }

            // ลดจำนวนของรางวัลที่เหลือลง 1 (ทำเฉพาะตอนมี reward_id ส่งมาจริง และยังมีของเหลืออยู่)
            if (!empty($data['reward_id']) && $event->wheel) {
                $event->wheel->rewards()
                    ->wherePivot('reward_id', $data['reward_id'])
                    ->wherePivot('quantity_selected', '>', 0)
                    ->updateExistingPivot($data['reward_id'], [
                        'quantity_selected' => DB::raw('quantity_selected - 1'),
                    ]);
            }

            // สุ่มรางวัลอย่างเดียว ไม่มีรายชื่อ เก็บผลไว้ที่ตารางนี้ เอาไว้นับในแดชบอร์ด
            if (empty($data['registration_id']) && !empty($data['reward_id'])) {
                EventRewardDraw::create([
                    'event_id'  => $event->event_id,
                    'reward_id' => $data['reward_id'],
                    'drawn_at'  => now(),
                    'drawn_by'  => Auth::user()->user_id,
                ]);
            }
        });

        return response()->json(['success' => true]);
    }

    //บันทึกหรือล้างลิงก์แบบประเมินของกิจกรรม (ใช้ร่วมกันทั้ง admin และ manager)
    public function saveAssessmentUrl(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        if ($request->has('clear')) {
            $event->assessment_url = null;
            $event->save();
            return back();
        }

        $request->validate([
            'assessment_url' => ['required', 'url:http,https', 'max:2000'],
        ], [
            'assessment_url.required' => 'กรุณาใส่ลิงก์แบบประเมิน',
            'assessment_url.url' => 'ลิงก์ไม่ถูกต้อง ต้องขึ้นต้นด้วย http:// หรือ https://',
        ]);

        $event->assessment_url = $request->input('assessment_url');
        $event->save();

        return back();
    }

}