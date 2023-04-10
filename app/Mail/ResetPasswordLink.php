<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $reset_password_uuid;
    public $firstname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->reset_password_uuid = $data['reset_password_uuid'];
        $this->firstname = $data['firstname'];
    }

    public function build()
    {
        $data['reset_password_uuid'] = $this->reset_password_uuid;
        $data['firstname'] = $this->firstname;

        return $this->view('emails.resetPassword', compact('data'))
            ->text('emails.resetPassword', compact('data'))
            ->subject('Reset Your Password');
    }
}
