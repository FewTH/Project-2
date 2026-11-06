<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\Reward;
use App\Services\AssessmentApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

        // แบบประเมินที่ทำแล้ว (ดึงจาก API ตามอีเมลผู้ตอบ)
        $latestAssessments = collect();
        try {
            $latestAssessments = $assessmentApi->assessmentsByEmail($user->email);
        } catch (\Throwable $e) {
            report($e);
        }

        return view('user.home', compact('user', 'winReward', 'popularRewards', 'latestAssessments'));
    }
}