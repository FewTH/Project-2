<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WheelAssessment;
use App\Models\Spinresult;
use App\Models\AssessmentAssignment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
// เพิ่มคลาสแบ่งหน้า
use Illuminate\Pagination\LengthAwarePaginator;
// ประกาศเพื่อให้controller ไปเรียก Api มาได้
use App\Services\AssessmentApi;


class AssessmentController extends Controller
{
    private function attachWheels($list)
    {
        $wheels = WheelAssessment::with('wheel.rewards')
            ->whereIn('assessment_id', $list->pluck('assessment_id'))
            ->get()->keyBy('assessment_id');

        return $list->each(function ($a) use ($wheels) {
            $a->wheelAssessment = $wheels->get($a->assessment_id);
            $a->WheelAssessment = $a->wheelAssessment;
        });
    }
    
    public function availableAssessments(AssessmentApi $api)
    {
        // ดึงรายชื่อ assessment_id ที่ถูกผูกกับวงล้อไปแล้ว
        $usedAssessmentIds = WheelAssessment::pluck('assessment_id')->all();
        
        // เอาเฉพาะอันที่ยังไม่เคยถูกเพิ่มวงล้อออกมา
        $available = $api->all()
        ->filter(fn($a) => $a->is_open && !in_array($a->assessment_id, $usedAssessmentIds))
        ->map(fn($a)=>[
            'id'=>$a->assessment_id,
            'name'=>$a->name,
            'created_by'=>$a->created_by_name,
            'closed_at'=>$a->closed_at?->format('d M Y'),
        ])->values();

        return response()->json($available);
    }
    public function randomreward($id, AssessmentApi $api)
    {
        $assessment = $api->find((int) $id);
        abort_if(!$assessment, 404); 
        $assessment = $this->attachWheels(collect([$assessment]))->first();
        
        // ถ้าไม่มีวงล้อในแบบประเมินจะแสดงข้อความตามนี้
        if (!$assessment->wheelAssessment) {
            return back()->with('error', 'แบบประเมินนี้ยังไม่มีวงล้อรางวัล');
        }
        $wheel = $assessment->wheelAssessment->wheel;
        $respondents = $api->respondents((int) $id)->where('is_drawn', 0)->values();
        
        // เป็นการให้ตัวแปรนี้เก็บค่า role ของผู้ใช้และเมื่อมีการเรียกใช้หน้านี้ก็จะถูกเช็คว่าคนที่เรียกใช้อยู่ในrole อะไร
        $view = auth()->user()->role === 'manager' ? 'manager.spinwheel' : 'admin.spinwheel';
        return view($view,[
            'assessment' => $assessment,
            'wheel' => $wheel,
            'respondents' => $respondents, //เพิ่มให้มันส่งผู้ตอบแบบประเมินมาด้วย
        ]);
    }
    // ฟังก์ชันนี้ทำหลายอย่างมากตั้งแต่สุ่มวงล้อแล้วลดจำนวนรางวัลกับบันทึกลงดา้ตาเบส
    public function spin($id, AssessmentApi $api)
    {
        $wheelAssessment = WheelAssessment::with('wheel.rewards')->where('assessment_id', $id)->first();
        if (!$wheelAssessment) {
            return response()->json(['success' => false, 'message' => 'ไม่พบวงล้อรางวัล'], 422);
        }
        $wheel = $wheelAssessment->wheel;
        
        //อันนี้ไว้ตรวจดูของรางวัลในวงล้อ
        $availableRewards = $wheel->rewards->filter(fn($r)=>$r->pivot->quantity_selected > 0);
        if($availableRewards->isEmpty()){
            return response()->json(['success'=>false,'message'=>'รางวัลในวงหมดแล้ว'],422);
        }

        // ไว้เช็ครายชื่อที่ยังเหลืออยู่
        $availableRespondents = $api->respondents((int) $id)->where('is_drawn',0)->values();
        
        if ($availableRespondents->isEmpty()){
            return response()->json(['success'=> false, 'message'=>'รายชื่อถูกสุ่มหมดแล้ว'],422);
        }
        // อันนี้จะเป็นส่วนของการสุ่ม
        $totalWeight = $availableRewards->sum(fn($r)=> $r->rate * $r->pivot->quantity_selected);
        $randomPoint = mt_rand(1, max(1, (int) ($totalWeight * 100))) / 100;
        $cumulative = 0;
        $winnerReward = null;
        foreach ($availableRewards as $reward){
            $cumulative += $reward->rate * $reward->pivot->quantity_selected;
            if($randomPoint <= $cumulative){
                $winnerReward = $reward;
                break;
            }
        }
        $winnerReward = $winnerReward ?? $availableRewards->last();
        // อันนี้จะสุ่มรายชื่อผู้ทำแบบประเมินนั้นๆ
        $winnerRespondent = $availableRespondents->random();
        
        $spinResult = DB::transaction(function () use ($wheel,$winnerReward,$winnerRespondent,$id){
            // อันนี้จะเป็นส่วนที่คอยลดจำนวนรางวัลในวงล้อทุกครั้งที่มีการกดสุ่ม
            $wheel -> rewards()->updateExistingPivot($winnerReward->reward_id, [
                'quantity_selected'=>$winnerReward->pivot->quantity_selected -1,
            ]);

        // อันนี้เป็นการอัพเดตค่าผู้ที่ทำแบบประเมินว่าคนที่ถูกสุ่มได้จะมีสถานะเป็น is_drawn เป็น 1
        // $winnerRespondent->update([
        //     'is_drawn'=> 1,
        //     'drawn_at'=> now(),
        // ]);

        return Spinresult::create([
            'reward_id' => $winnerReward->reward_id,
            'assessment_id'=> (int) $id,
            'drawn_by' => Auth::user()->user_id,
            'qr_code' => (string) Str::uuid(), //เป็นการสร้าง qr_codeแบบจำลองไว้ก่อน
            'winner_name'=> $winnerRespondent->full_name,
            'winner_email'=> $winnerRespondent->email,
            'receive_status' => 'not-received',
            'receive_deadline' => now()->addDays(7),
            'checked_by_user_id' => null,
        ]);
    });

    // บันทึกผลสำเร็จแล้วค่อยแจ้ง API ถ้าเจ๊งให้เก็บ log ไว้
     try {
        $api->markDrawn($winnerRespondent->respondent_id);
     }catch (\Throwable $e){
        \Log::error('markDrawn failed',[
            'respondent_id' => $winnerRespondent->respondent_id,
            'error' => $e->getMessage(),
        ]);
     }
    // อันนี้ประมาณว่าส่งข้อมูลที่เหลือหลังจากสุ่มกลับไปวาดวงล้อใหม่
    $remainingRewards = $wheel->rewards()->get()
    ->filter(fn($r) => $r->pivot->quantity_selected > 0)
    ->map(fn($r) =>[
        'id'=>$r->reward_id,
        'label'=>$r->name,
        'weight'=>$r->rate * $r->pivot->quantity_selected,
        'quantity_selected' => $r->pivot->quantity_selected, 
    ])->values();
    // ****
    $remainingRespondents = $availableRespondents
        ->where('respondent_id', '!=', $winnerRespondent->respondent_id)
        ->map(fn($r) => ['id' => $r->respondent_id,'label' => $r->full_name])
        ->values();
    
    return response()->json([
        'success' => true,
        'winner_reward_id'=> $winnerReward->reward_id,
        'winner_reward_label'=> $winnerReward->name,
        'winner_respondent_id'=> $winnerRespondent->respondent_id,
        'winner_name'=> $winnerRespondent->full_name,
        'remaining_rewards'=> $remainingRewards,
        'remaining_respondents' => $remainingRespondents,
    ]);
    }
    // ฟังก์ชันนี้ก็ประมาณว่าดึงแบบบประเมินที่ยังไม่มีวงล้อทั้งหมดมาแสดงที่popupพร้อมรายชื่อmanager
    public function getAssignData(AssessmentApi $api)
    {
        // สร้างตัวแปรนี้มาเพื่อดักจับแบบประเมินที่ผูกวงล้อแล้ว
        $used = WheelAssessment::pluck('assessment_id')
        ->merge(AssessmentAssignment::pluck('assessment_id'))
        ->all();

        // ส่วนนี้จะดึงแบบประเมินที่ยังไม่ได้ผูกวงล้อและยังไม่ได้ถูกมอบหมาย
        $assessments = $api->all()
        ->filter(fn($a) => $a->is_open && !in_array($a->assessment_id, $used))
        ->map(fn($a) => [
            'id'         => $a->assessment_id,
            'name'       => $a->name,
            'created_by' => $a->created_by_name,
            'closed_at'  => $a->closed_at ? $a->closed_at->format('d M Y') : '-',
        ])->values();

            // ดึงรายชื่อคนที่เป็น manager ในระบบทั้งหมดมา
            $managers = User::where('role', 'manager')->get()->map(fn($m)=>[
                'id' => $m->user_id,
                'name' => $m->full_name,
            ]);

            return response()->json([
                'assessments' => $assessments,
                'managers' => $managers
            ]);
    }

    public function index(AssessmentApi $api)
{
    $user = auth()->user();
    $assignments = AssessmentAssignment::pluck('assigned_to', 'assessment_id');
    $all = $api->all();

    if ($user->role === 'manager') {
        // manager เห็นเฉพาะแบบประเมินที่ admin มอบหมายให้
        $assessments = $all->filter(fn($a) => ($assignments[$a->assessment_id] ?? null) == $user->user_id)->sortByDesc('assessment_id')->values();
        $view = 'manager.assessment';
    } else {
        // admin เห็นแบบประเมินที่ยังไม่ถูกมอบหมาย
        $assessments = $all->filter(fn($a) => !isset($assignments[$a->assessment_id]))->sortByDesc('assessment_id')->values();
        $view = 'admin.assessment';
    }
    $assessments = $this->attachWheels($assessments);

    // จัดการจำนวนแบบประเมินที่จะให้แสดงตามจำนวนที่กำหนดแบบแบ่งหน้า
    $perPage = 10;
    $assessmentPage = LengthAwarePaginator::resolveCurrentPage('assessment_page');
    $assessments = new LengthAwarePaginator(
        $assessments->forPage($assessmentPage, $perPage)->values(),
        $assessments->count(),
        $perPage,
        $assessmentPage,
        [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'assessment_page'
        ]
    );

    $events = Event::with('wheel.rewards', 'registrations')
        ->orderBy('created_at', 'desc')
        ->paginate(6, ['*'], 'event_page');

    $now = Carbon::now();
    $events->each(function ($event) use ($now) {
        $closeat = Carbon::parse($event->register_close_at);
        $event->isexpired = $event->status !== 'open' || $now->greaterThanOrEqualTo($closeat);
    });

    return view($view, compact('assessments', 'events', 'user'));
}
    
    
    // บันทึกการมอบหมายแบบประเมินลงดาต้าเบส
        public function storeAssignment(Request $request, AssessmentApi $api)
    {
        $request->validate([
            'assessment_id' => 'required|integer',            // ตัด exists:assessments ออก
            'manager_id'    => 'required|exists:users,user_id',
        ]);

    // เช็กว่าแบบประเมินมีอยู่จริงใน API
    abort_if(!$api->find((int) $request->assessment_id), 404);

    AssessmentAssignment::updateOrCreate(
        ['assessment_id' => $request->assessment_id],
        ['assigned_to'   => $request->manager_id]
    );

        return response()->json([
            'success' => true,
            'message' => 'มอบหมายแบบประเมินสำเร็จ',
        ]);
    }
}
