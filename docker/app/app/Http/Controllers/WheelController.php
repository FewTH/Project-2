<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Http\Controllers\Controller;

class WheelController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('category')->orderByDesc('reward_id')->get();
        return view('admin.managespin', compact('rewards'));
    }

    public function store(Request $request)
    {

        $items = $request->input('items');
        $assessmentIds = $request->input('assessment_ids');


        return response()->json([
        'success' => true,
        'message' => 'บันทึกวงล้อสำเร็จ'
        ]);
    }
}
