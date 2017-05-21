<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

/**
 * Mailable for Password Resets
 * @package App\Mail
 */
class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user
     * @var User
     */
    var $user;
    /**
     * Reset code for password
     * @var string
     */
    var $resetCode;

    /**
     * PasswordReset constructor.
     * @param User $user
     * @param $resetCode
     */
    public function __construct(User $user, $resetCode)
    {
        $this->user = $user;
        $this->resetCode = $resetCode;
    }

    /**
     * Build the message using the template
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('login.emails.forgot');
    }
}
