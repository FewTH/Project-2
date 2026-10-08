<?php

namespace App\Mail;

use App\Models\Spinresult;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RewardNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Spinresult $spinresult) {}

    public function build()
    {
        //สร้างรูป QR จากค่า qr_code ตอนกดส่ง
        $qrimage = (string) QrCode::format('png')->size(300)->generate($this->spinresult->qr_code);

        return $this->subject('คุณได้รับรางวัล')->view('email.reward-notification')->with(['spinresult' => $this->spinresult,'qrimage' => $qrimage,]);
    }
}