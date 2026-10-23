<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\AssessmentApi;
use App\Models\Spinresult;

class UserSpinController extends Controller
{
    protected AssessmentApi $assessmentApi;

    public function __construct(AssessmentApi $assessmentApi)
    {
        $this->assessmentApi = $assessmentApi;
    }

    public function index()
    {
        $user = Auth::user();

        $allAssessments = $this->assessmentApi->all();

        $email = strtolower(trim((string) $user->email));

        // log ชั่วคราว: ดู email ที่ login และจำนวนแบบประเมินที่ API ส่งมา
        Log::info('spin debug', [
            'user_email'  => $email,
            'assessments' => $allAssessments->count(),
        ]);

        $userAssessments = [];

        foreach ($allAssessments as $assessment) {
            $respondents = $this->assessmentApi->respondents($assessment->assessment_id);

            // log ชั่วคราว: ดูรายชื่อ email ผู้ตอบของแต่ละแบบประเมิน
            Log::info('spin respondents', [
                'assessment_id' => $assessment->assessment_id,
                'count'         => $respondents->count(),
                'emails'        => $respondents->pluck('email')->all(),
            ]);

            $matchedRespondent = $respondents->first(
                fn($r) => strtolower(trim((string) $r->email)) === $email
            );

            if ($matchedRespondent) {
                $assessment->is_drawn = $matchedRespondent->is_drawn;
                $userAssessments[] = $assessment;
            }
        }

        $assessments = collect($userAssessments);

        return view('user.spin', compact('user', 'assessments'));
    }

    public function history($id)
    {
        $history = \App\Models\Spinresult::with('reward')
            ->where('assessment_id', $id)
            ->where('user_id', auth()->id())
            ->get();

        return view('user.history_random_spin', compact('history'));
    }
}