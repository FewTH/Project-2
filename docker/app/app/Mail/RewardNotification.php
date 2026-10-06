<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RewardNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Spinresult $spinresult) {}

    public function build()
    {
        return $this->subject('คุณได้รับรางวัล')->view('email.reward-notification')->with(['spinresult' => $this->spinresult])->attach(storage_path('app/public/qrcodes/' . $this->spinresult->qr_code . '.png'), ['as' => 'qrcode.png','mime' => 'image/png', ]);
    }
}
