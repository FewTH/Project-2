<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use Illuminate\Http\Request;

class SpinresultController extends Controller
{
    //แสดงหน้ารายชื่อผู้ได้รับรางวัล
    public function index()
    {
        //ดึงข้อมูลผลการสุ่มทั้งหมด พร้อมกับข้อมูลของรางวัลที่ผูกกันไว้
        $spinresults = Spinresult::with('reward')->latest()->get();

        return view('admin.history_random',[
            'spinresults' => $spinresults,
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
