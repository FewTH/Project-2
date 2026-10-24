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
        $hasReward = (bool) $this->spinresult->reward;

        $qrimage = $hasReward
            ? (string) QrCode::format('png')->size(300)->generate($this->spinresult->qr_code)
            : null;

        return $this->subject($hasReward ? 'คุณได้รับรางวัล' : 'ขอบคุณที่ร่วมกิจกรรม')
            ->view('email.reward-notification')
            ->with([
                'spinresult' => $this->spinresult,
                'qrimage'    => $qrimage,
            ]);
    }
}