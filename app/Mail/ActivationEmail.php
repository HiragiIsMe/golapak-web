<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $token;
    private $nama;
    public function __construct($nama, $token)
    {
        $this->nama = $nama;
        $this->token = $token;
    }

    public function build()
    {
        $url = route('activate.account', ['token' => $this->token]);

        return $this->view('emails.activation')
                    ->with([
                        'penerima' => $this->nama,
                        'activationUrl' => $url,
                    ]);

    }
}
