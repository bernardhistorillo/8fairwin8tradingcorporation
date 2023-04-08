<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $firstname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->otp = $data['otp'];
        $this->firstname = $data['firstname'];
    }

    public function build()
    {
        $data['otp'] = $this->otp;
        $data['firstname'] = $this->firstname;

        return $this->view('emails.emailVerification', compact('data'))
            ->text('emails.emailVerification', compact('data'))
            ->subject('Verify Your Email Address');
    }
}
