<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WheelAssessment;
use App\Models\Assessment;
use App\Models\AssessmentRespondent;
use App\Models\Spinresult;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function availableAssessments()
    {
        // ดึงรายชื่อ assessment_id ที่ถูกผูกกับวงล้อไปแล้ว (ทุกวงล้อ ไม่ใช่แค่วงล้อนี้)
        $usedAssessmentIds = WheelAssessment::pluck('assessment_id')->toArray();
        
        // เอาเฉพาะอันที่ยังไม่เคยถูกเพิ่มวงล้อออกมา
        $available = Assessment::whereNotIn('assessment_id',$usedAssessmentIds)
        ->where('is_open',1)
        ->get()
        ->map(fn($a)=>[
            'id'=>$a->assessment_id,
            'name'=>$a->name,
            'created_by'=>$a->created_by_name,
            'closed_at'=>$a->closed_at?->format('d M Y'),
        ]);

        return response()->json($available);
    }
    public function randomreward($id)
    {
        $assessment=Assessment::with('wheelAssessment.wheel.rewards')->findOrfail($id);
        // ถ้าแบบประเมินนี้ยังไม่มีวงล้อจะแสดงข้อความไม่พบวงล้อ
        if(!$assessment->wheelAssessment){
            return back()->with('error', 'แบบประเมินนี้ไม่พบวงล้อรางวัล');
        }
        $wheel = $assessment->wheelAssessment->wheel;
        $respondents = AssessmentRespondent::where('assessment_id',$id)
            ->where('is_drawn',0)
            ->get();
        return view('admin.spinwheel',[
            'assessment' => $assessment,
            'wheel' => $wheel,
            'respondents' => $respondents, //เพิ่มให้มันส่งผู้ตอบแบบประเมินมาด้วย
        ]);
    }
    // ฟังก์ชันนี้ทำหลายอย่างมากตั้งแต่สุ่มวงล้อแล้วลดจำนวนรางวัลกับบันทึกลงดา้ตาเบส
    public function spin($id)
    {
        $assessment = Assessment::with('wheelAssessment.wheel.rewards')->findOrFail($id);
        if (!$assessment->wheelAssessment){
            return response()->json(['success'=>false,'message'=>'ไม่พบวงล้อรางวัล'],422);
        }
        $wheel = $assessment->wheelAssessment->wheel;
        
        //อันนี้ไว้ตรวจดูของรางวัลในวงล้อ
        $availableRewards = $wheel->rewards->filter(fn($r)=>$r->pivot->quantity_selected > 0);
        if($availableRewards->isEmpty()){
            return response()->json(['success'=>false,'message'=>'รางวัลในวงหมดแล้ว'],422);
        }

        // ไว้เช็ครายชื่อที่ยังเหลืออยู่
        $availableRespondents = AssessmentRespondent::where('assessment_id',$id)
            ->where('is_drawn',0)
            ->get();
        if ($availableRespondents->isEmpty()){
            return response()->json(['success'=> false, 'message'=>'รายชื่อถูกสุ่มหมดแล้ว'],422);
        }
        // อันนี้จะเป็นส่วนของการสุ่ม
        $totalWeight = $availableRewards->sum(fn($r)=> $r->rate * $r->pivot->quantity_selected);
        $randomPoint = mt_rand(1,(int) ($totalWeight*100))/100;
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
        
        $spinResult = DB::transaction(function () use ($wheel,$winnerReward,$winnerRespondent,$assessment){
            // อันนี้จะเป็นส่วนที่คอยลดจำนวนรางวัลในวงล้อทุกครั้งที่มีการกดสุ่ม
            $wheel -> rewards()->updateExistingPivot($winnerReward->reward_id, [
                'quantity_selected'=>$winnerReward->pivot->quantity_selected -1,
            ]);

        // อันนี้เป็นการอัพเดตค่าผู้ที่ทำแบบประเมินว่าคนที่ถูกสุ่มได้จะมีสถานะเป็น is_drawn เป็น 1
        $winnerRespondent->update([
            'is_drawn'=> 1,
            'drawn_at'=> now(),
        ]);

        return Spinresult::create([
            'reward_id' => $winnerReward->reward_id,
            'assessment_id'=> $assessment->assessment_id,
            'qr_code' => (string) Str::uuid(), //เป็นการสร้าง qr_codeแบบจำลองไว้ก่อน
            'winner_name'=> $winnerRespondent->full_name,
            'winner_email'=> $winnerRespondent->email,
            'receive_status' => 'not-received',
            'receive_deadline' => now()->addDays(7),
            'checked_by_user_id' => null,
        ]);
    });
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
    $remainingRespondents = AssessmentRespondent::where('assessment_id', $assessment->assessment_id)
        ->where('is_drawn',0)
        ->get()
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

}
