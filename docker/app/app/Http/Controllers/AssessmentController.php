<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WheelAssessment;
use App\Models\Assessment;
use App\Models\AssessmentRespondent;

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
    // public function spin($id)
    // {
    //     $assessment = Assessment::with('wheelAssessment.wheel.rewards')->findOrFail($id);
    //     if (!$assessment->wheelAssessment){
    //         return response()->json(['success'=>false,'message'=>'ไม่พบวงล้อรางวัล'],422);
    //     }
    //     $wheel = $assessment->wheelAssessment->wheel;
        
    //     //อันนี้ไว้ตรวจดูของรางวัลในวงล้อ
    //     $availableRewards = $wheel->rewards->filter(fn($r)=>$r->pivot->quantity_selected > 0);
    //     if($availableRewards->isEmpty()){
    //         return response()->json(['success'=>false,'message'=>'รางวัลในวงหมดแล้ว'],422);
    //     }

    //     // ไว้เช็ครายชื่อที่ยังเหลืออยู่
    //     $availableRespondents = AssessRespondent::where('assessment_id',$id)
    //         ->where('is_drawn',0)
    //         ->get();
    //     if ($availableRespondents->isEmpty()){
    //         return response()->json(['success'=>'message'=>'รายชื่อถูกสุ่มหมดแล้ว'],422);
    //     }
    //     // อันนี้จะเป็นส่วนของการสุ่ม
    //     $totalWeight = $availableRewards->sum(fn($r)=> $r->rate * $r->pivot->quantity_selected);
    //     $randomPoint = mt_rand(1,(int) ($totalWeight*100))/100;

    // }

}
