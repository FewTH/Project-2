<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\spin_wheels;
use App\Models\WheelItem;
use App\Models\WheelAssessment;

class WheelController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('category')->orderByDesc('reward_id')->get();
        return view('admin.managespin', compact('rewards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'=>'required|array|min2',
            'items.*.reward_id'=>'required|exists:reward,reward_id',
            'items.*.quantity_selected'=>'required|integer|min1',
            'assessment_ids'=>'required|array|min1',
            'assessment_ids.*'=>'required|integer|exists:assessments,assessment_id',
        ]);

        try{
            DB::transaction(function()use($request){
                //สร้างวงล้อ
                $wheel=spin_wheels::create([
                    'name'=>'วงล้อรางวัล' . now()->format('d/m/Y H:1'),
                    'is_active' => 1,
                    'created_by'=>auth()->id(),
                ]);
            // เพิ่มของรางวัลเข้าไปในวงล้อ
            foreach($request->items as $item){
                WheelItem::create([
                    'wheel_id' =>$wheel->wheel_id,
                    'reward_id' =>$item['reward_id'],
                    'quantity_selected' =>$item['quantity_selected'],
                ]);
            }
            // เชื่อมวงล้่อทีสร้างเข้ากับแบบประเมิน
            foreach($request->assessment_ids as $assessmentId){
                WheeelAssessment::create([
                    'wheel_id' =>$wheel->wheel_id,
                    'assessment_id'=>$assessmentId,
                ]);
            }
            });
                return response()->json([
                'success' => true,
                'message' => 'บันทึกวงล้อสำเร็จ'
        ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success'=> false,
                'message'=>$e->getMessage()
            ],500);
        }
    }
}
