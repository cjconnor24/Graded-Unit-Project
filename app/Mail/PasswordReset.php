<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    var $user;
    var $resetCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $resetCode)
    {
        $this->user = $user;
        $this->resetCode = $resetCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('login.emails.forgot');
    }
}
