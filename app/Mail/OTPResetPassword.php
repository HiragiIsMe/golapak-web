<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $otp;
    private $nama;
    public function __construct($nama,$otp)
    {
        $this->otp = $otp;
        $this->nama = $nama;
    }

    public function build()
    {
        return $this->view('emails.otp')->with([
            'kodeotp' => $this->otp,
            'nama' => $this->nama
        ]);
    }
}
