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

    // แบบประเมินที่ user คนนี้ได้รางวัลแล้ว ดูจาก spin_results ใน database ตรงๆ (เห็นทันทีหลังสุ่ม ไม่ต้องรอแคช)
    private function wonAssessmentIds(string $email): array
    {
        if ($email === '') {
            return [];
        }

        return Spinresult::whereRaw('LOWER(TRIM(winner_email)) = ?', [$email])
            ->whereNotNull('assessment_id')
            ->pluck('assessment_id')
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    public function index()
    {
        $user  = Auth::user();
        $email = strtolower(trim((string) $user->email));

        // เดิม: เรียก API ขอรายชื่อผู้ตอบทีละแบบประเมินจนครบทุกครั้งที่เปิดหน้า (ช้า)
        // ใหม่: ใช้ดัชนีอีเมลที่แคชไว้ร่วมกับหน้าหลัก ได้ทั้งรายการแบบประเมินและสถานะถูกสุ่มแล้วในครั้งเดียว
        $assessments = collect();
        try {
            $assessments = $this->assessmentApi->assessmentsByEmail($email);
        } catch (\Throwable $e) {
            report($e);
        }

        // ถ้าเพิ่งได้รางวัล (มีใน spin_results แล้ว) ให้ขึ้น "สุ่มแล้ว" ทันที แม้แคชยังไม่อัปเดต
        $won = array_flip($this->wonAssessmentIds($email));
        $assessments->each(function ($assessment) use ($won) {
            if (isset($won[(int) $assessment->assessment_id])) {
                $assessment->is_drawn = 1;
            }
        });

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

        // เดิมเรียก API ขอรายชื่อผู้ตอบทั้งหมดของแบบประเมินนี้ ตอนนี้ดูจากดัชนีที่แคชไว้แทน
        try {
            $drawnInApi = $this->assessmentApi->isDrawn((int) $id, $email);
        } catch (\Throwable $e) {
            report($e);
            $drawnInApi = false;
        }

        $isDrawn = $drawnInApi
            || Spinresult::where('assessment_id', $id)->exists();

        return view('user.history_random_spin', compact('history', 'user', 'isDrawn'));
    }
}