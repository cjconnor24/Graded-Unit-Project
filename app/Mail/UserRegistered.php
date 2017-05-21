<?php

namespace App\Mail;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Mailable for when user registers
 * @package App\Mail
 */
class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Registered user
     * @var User
     */
    public $user;

    /**
     * Registration activation
     * @var Activation
     */
    public $activation;

    /**
     * UserRegistered constructor.
     * @param User $user Registered user
     */
    public function __construct(User $user, $activationCode)
    {
        $this->user = $user;
        $this->activation =$activationCode;

    }

    /**
     * Build the message using the view.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration.registered');
    }
}
