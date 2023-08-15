<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TransferVerification extends Mailable
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

        return $this->view('emails.winnersGemTransferVerification', compact('data'))
            ->text('emails.winnersGemTransferVerificationText', compact('data'))
            ->subject('Verify Your Winners Gem Transfer');
    }
}
