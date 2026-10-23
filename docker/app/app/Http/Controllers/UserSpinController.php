<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        $userAssessments = [];

        foreach ($allAssessments as $assessment) {
            $respondents = $this->assessmentApi->respondents($assessment->assessment_id);

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
        $user  = Auth::user();
        $email = strtolower(trim((string) $user->email));

        $history = Spinresult::with('reward')
            ->where('assessment_id', $id)
            ->whereRaw('LOWER(TRIM(winner_email)) = ?', [$email])
            ->latest()
            ->get();

        $respondent = $this->assessmentApi->respondents((int) $id)
            ->first(fn($r) => strtolower(trim((string) $r->email)) === $email);

        $isDrawn = (bool) ($respondent->is_drawn ?? false)
            || Spinresult::where('assessment_id', $id)->exists();

        return view('user.history_random_spin', compact('history', 'user', 'isDrawn'));
    }
}