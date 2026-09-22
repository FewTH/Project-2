<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WheelAssessment;

class AssessmentController extends Controller
{
    public function availableAssessments()
    {
        // ดึงรายชื่อ assessment_id ที่ถูกผูกกับวงล้อไปแล้ว (ทุกวงล้อ ไม่ใช่แค่วงล้อนี้)
        $usedAssessmentIds = WheelAssessment::pluck('assessment_id')->toArray();

        // // ดึงรายชื่อแบบประเมินทั้งหมดจาก API ภายนอก mock อยู่รอapiจากพี่กรีน
        // $allAssessments = [
        //     ['id' => 1, 'name' => 'แบบประเมิน1', 'created_by' => 'Admin', 'closed_at' => '30 มิ.ย. 2569'],
        //     ['id' => 2, 'name' => 'แบบประเมิน1', 'created_by' => 'Admin', 'closed_at' => '30 มิ.ย. 2569'],
        //     ['id' => 3, 'name' => 'แบบประเมิน3', 'created_by' => 'Admin', 'closed_at' => '15 ก.ค. 2569'],
        // ];

        // เอาเฉพาะอันที่ยังไม่เคยถูกเพิ่มวงล้อออกมา
        $available = Assessment::whereNotIn('assessment_id',$useIds)
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
}
