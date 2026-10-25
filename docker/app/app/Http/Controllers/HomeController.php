<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spinresult;
use App\Models\Reward;
use App\Services\AssessmentApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(AssessmentApi $assessmentApi)
    {
        $user = Auth::user();

        // ของรางวัลที่เคยได้รับของ user คนนี้ 
        $winReward = Spinresult::where('winner_email', $user->email)
                                ->with('reward')
                                ->latest()
                                ->get();

        // ของรางวัลยอดนิยม
        $popularRewards = Reward::select('reward.*', DB::raw('COUNT(spin_results.reward_id) as total_wins'))
                                ->leftJoin('spin_results', 'reward.reward_id', '=', 'spin_results.reward_id')
                                ->groupBy('reward.reward_id')
                                ->orderBy('total_wins', 'desc')
                                ->take(3)
                                ->get();

        if ($popularRewards->isEmpty()) {
            $popularRewards = Reward::latest()->take(3)->get();
        }

        // แบบประเมินที่ทำล่าสุด
        $latestAssessments = collect();
        try {
            $spinResults = Spinresult::where('winner_email', $user->email)
                                    ->whereNotNull('assessment_id')
                                    ->latest()
                                    ->take(2)
                                    ->get();

            $latestAssessments = $spinResults->map(function($spin) use ($assessmentApi) {
                $assessmentName = 'แบบประเมินความพึงพอใจ';
                if ($spin->assessment_id) {
                    try {
                        // ดึงข้อมูลแบบประเมินรายรายการจาก API ของรุ่นพี่
                        $assessObj = $assessmentApi->find($spin->assessment_id);
                        if ($assessObj && isset($assessObj->name)) {
                            $assessmentName = $assessObj->name;
                        }
                    } catch (\Exception $e) {
                        // ถ้าเรียก API ไม่ผ่าน ใช้ชื่อสำรอง
                    }
                }

                return (object) [
                    'created_at' => $spin->created_at,
                    'name' => $assessmentName,
                ];
            });
        } catch (\Exception $e) {
            $latestAssessments = collect();
        }

        return view('user.home', compact('user', 'winReward', 'popularRewards', 'latestAssessments'));
    }
}