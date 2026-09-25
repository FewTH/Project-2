<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\Assessment;
use Illuminate\Http\Request;

class SpinresultController extends Controller
{
    //แสดงหน้ารายชื่อผู้ได้รับรางวัล
    public function index($assessment_id)
    {
        //ดึงข้อมูลผลการสุ่มทั้งหมด พร้อมกับข้อมูลของรางวัลที่ผูกกันไว้
        $spinresults = Spinresult::with('reward')->where('assessment_id', $assessment_id)->latest()->get();

        //หาข้อมูลแบบประเมินนี้ เอาไว้แสดงชื่อบนลิงค์หน้าเว็บเป็น id
        $assessment = Assessment::findOrFail($assessment_id);

        return view('admin.history_random',[
            'spinresults' => $spinresults,
            'assessment' => $assessment,
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

}
