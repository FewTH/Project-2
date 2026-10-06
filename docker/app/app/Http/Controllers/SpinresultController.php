<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\Assessment;
use Illuminate\Http\Request;
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

        return view('admin.senditgmail',[
            'spinresults' => $spinresults,
            'assessment' => $assessment,
            'failedlist' => $failedlist,
        ]);
    }
    
    //ส่งอีเมลใหม่ทีละรายการ (ปุ่ม "ส่งใหม่")
    public function resendone(Request $request, $id)
    {
        $spinresults = Spinresult::findOrFail($id);

        //ตรงนี้จะใส่ logic ส่งอีเมลจริงทีหลัง ตอนนี้ขอจำลองว่าส่งสำเร็จไปก่อน
        $spinresults->update([
            'email_status' => 'sent',
            'email_sent_at' => now(),
        ]);

        return back();
    }

    //ส่งอีเมลทั้งหมดที่ล้มเหลวอีกครั้ง (ปุ่ม "ส่งใหม่ทั้งหมดที่ล้มเหลว")
    public function resendallfailed(Request $request, $assessment_id)
    {
        $failedlist = Spinresult::where('assessment_id', $assessment_id)->where('email_status', 'failed')->get();

        foreach ($failedlist as $item) {
            //ตรงนี้จะใส่ logic ส่งอีเมลจริงทีหลัง ตอนนี้ขอจำลองว่าส่งสำเร็จไปก่อน
            $item->update([
                'email_status' => 'sent',
                'email_sent_at' => now(),
            ]);
        }

        return back();
    }

}