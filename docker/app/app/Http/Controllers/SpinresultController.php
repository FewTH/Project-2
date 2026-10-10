<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Mail\RewardNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $spinresults->update(['receive_status' => 'received','received_at' => now(),]);

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

        return view('admin.button_senditgmail', ['spinresults' => $spinresults,'assessment' => $assessment,'failedlist' => $failedlist,]);
    }


    //ส่วนของการส่งอีเมล

    //เช็คว่าอีเมลนี้ส่งได้ไหม ถ้าส่งได้ return true ถ้าส่งไม่ได้ return false
    private function isEmailUsable($email)
    {
        //ถ้าอีเมลว่างก็ส่งไม่ได้
        if ($email == '') {
            return false;
        }

        //เช็ครูปแบบอีเมลกับเช็คว่าโดเมนหลัง @ มีอยู่จริงไหม (เช็คชื่อหน้า @ ไม่ได้)
        $check = Validator::make(['email' => $email],['email' => 'email:rfc,dns']);

        if ($check->fails()) {
            return false;
        }

        return true;
    }

    //ส่งอีเมลให้ผู้ชนะ 1 คน แล้วบันทึกสถานะลง database (sent หรือ failed)
    private function sendReward($item)
    {
        //ตัดช่องว่างหน้าหลังอีเมลออกก่อน
        $email = trim($item->winner_email);

        //ถ้าอีเมลส่งไม่ได้ให้ขึ้นล้มเหลวเลย ไม่ต้องลองส่ง
        if (!$this->isEmailUsable($email)) {
            $item->update(['email_status' => 'failed']);
            return;
        }

        //ลองส่งอีเมลจริง ใช้ try catch เอาไว้กันเว็บพังตอนส่งไม่ผ่าน
        try {
            Mail::to($email)->send(new RewardNotification($item));

            //ส่งสำเร็จบันทึกว่าส่งแล้วพร้อมเวลา (ส่งแล้วไม่ได้แปลว่าถึงผู้รับ ถ้าชื่อหน้า @ ผิดเมลจะตีกลับเข้ากล่องคนส่ง)
            $item->update(['email_status' => 'sent','email_sent_at' => now(),]);
        } catch (\Exception $e) {
            //ส่งไม่สำเร็จบันทึกว่าล้มเหลว
            $item->update(['email_status' => 'failed']);
        }
    }

    //ส่งอีเมลใหม่ทีละรายการ (ปุ่ม "ส่งใหม่")
    public function resendone(Request $request, $id)
    {
        $spinresults = Spinresult::with('reward')->findOrFail($id);

        $this->sendReward($spinresults);

        return back();
    }

    //ส่งอีเมลทั้งหมดที่ล้มเหลวอีกครั้ง (ปุ่ม "ส่งใหม่ทั้งหมดที่ล้มเหลว")
    public function resendallfailed(Request $request, $assessment_id)
    {
        //เอาเฉพาะรายการที่สถานะ failed ของแบบประเมินนี้
        $failedlist = Spinresult::with('reward')->where('assessment_id', $assessment_id)->where('email_status', 'failed')->get();

        //วนส่งทีละคน
        foreach ($failedlist as $item) {$this->sendReward($item);}

        return back();
    }

    //ส่งอีเมลให้ทุกคนที่ยังไม่ได้ส่ง (ปุ่ม "ส่งอีเมลทั้งหมด")
    public function sendall(Request $request, $assessment_id)
    {
        //เอาเฉพาะรายการที่สถานะ pending (ยังไม่ได้ส่ง) ของแบบประเมินนี้
        $pendinglist = Spinresult::with('reward')->where('assessment_id', $assessment_id)->where('email_status', 'pending')->get();

        //วนส่งทีละคน
        foreach ($pendinglist as $item) {$this->sendReward($item);}

        return back();
    }
}