<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Mail\RewardNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class SpinresultController extends Controller
{
    //แสดงหน้ารายชื่อผู้ได้รับรางวัล manager
    public function managerindex($assessmentId)
    {
        return $this->index($assessmentId, 'manager');
    }

    //แสดงหน้ารายชื่อผู้ได้รับรางวัล
    public function index($assessment_id, $role = 'admin')
    {
        //ดึงข้อมูลผลการสุ่มทั้งหมด พร้อมกับข้อมูลของรางวัลที่ผูกกันไว้
        $spinresults = Spinresult::with('reward')->where('assessment_id', $assessment_id)->latest()->get();

        //หาข้อมูลแบบประเมินนี้ เอาไว้แสดงชื่อบนลิงค์หน้าเว็บเป็น id
        $assessment = Assessment::findOrFail($assessment_id);

        return view($role . '.history_random', [
            'assessment'  => $assessment,
            'spinresults' => $spinresults,
            'prefix'      => $role,
            'user'        => Auth::user(),
        ]);
    }

    //บันทึกการยืนยันรับของรางวัลพร้อมเปลี่ยนสถานะเป็น "รับแล้ว"
    public function receive(Request $request, $id)
    {
        //หาแถวผลการสุ่มที่จะอัพเดทแล้วให้มันบันทึกสถานะใหม่ลงไป
        $spinresults = Spinresult::findOrFail($id);
        $spinresults->update([
            'receive_status' => 'received',
            'received_at' => now(),

        ]);

        return back();
    }

    //แสดงหน้าส่งอีเมลให้ผู้ได้รับรางวัล
    public function senditgmail($assessment_id)
    {
        //ดึงข้อมูลผลการสุ่มทั้งหมดของแบบประเมินนี้ พร้อมกับข้อมูลของรางวัลที่ผูกกันไว้
        $spinresults = Spinresult::with('reward')->where('assessment_id', $assessment_id)->latest()->get();

        //หาข้อมูลแบบประเมินนี้ เอาไว้แสดงชื่อบนลิงค์หน้าเว็บ
        $assessment = Assessment::findOrFail($assessment_id);

        //กรองเฉพาะรายการที่ส่งล้มเหลว เอาไว้โชว์ในกล่องรายการที่ล้มเหลว
        $failedlist = $spinresults->where('email_status', 'failed');

        return view('admin.button_senditgmail',[
            'spinresults' => $spinresults,
            'assessment' => $assessment,
            'failedlist' => $failedlist,
        ]);
    }
    
    //ส่งอีเมลใหม่ทีละรายการ (ปุ่ม "ส่งใหม่")
    public function resendone(Request $request, $id)
    {
        $spinresults = Spinresult::with('reward')->findOrFail($id);

        try {
            Mail::to($spinresults->winner_email)->send(new RewardNotification($spinresults));

            $spinresults->update([
                'email_status' => 'sent',
                'email_sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            $spinresults->update(['email_status' => 'failed']);
            \Log::error('ส่งอีเมลล้มเหลว: ' . $spinresults->winner_email . ' - ' . $e->getMessage());
        }

        return back();
    }

    //ส่งอีเมลทั้งหมดที่ล้มเหลวอีกครั้ง (ปุ่ม "ส่งใหม่ทั้งหมดที่ล้มเหลว")
    public function resendallfailed(Request $request, $assessment_id)
    {
        $failedlist = Spinresult::with('reward')
            ->where('assessment_id', $assessment_id)
            ->where('email_status', 'failed')
            ->get();

        foreach ($failedlist as $item) {
            try {
                Mail::to($item->winner_email)->send(new RewardNotification($item));

                $item->update([
                    'email_status' => 'sent',
                    'email_sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                \Log::error('ส่งอีเมลล้มเหลว: ' . $item->winner_email . ' - ' . $e->getMessage());
            }
        }

        return back();
    }

    //ส่งอีเมลให้ทุกคนที่ยังไม่ได้ส่ง (ปุ่ม "ส่งอีเมลทั้งหมด")
    public function sendall(Request $request, $assessment_id)
    {
        $pendinglist = Spinresult::with('reward')
            ->where('assessment_id', $assessment_id)
            ->where('email_status', 'pending')
            ->get();

        foreach ($pendinglist as $item) {
            try {
                Mail::to($item->winner_email)->send(new RewardNotification($item));

                $item->update([
                    'email_status' => 'sent',
                    'email_sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                $item->update(['email_status' => 'failed']);
                \Log::error('ส่งอีเมลล้มเหลว: ' . $item->winner_email . ' - ' . $e->getMessage());
            }
        }

        return back();
    }

}