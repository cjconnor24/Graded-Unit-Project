<?php

namespace App\Mail;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;
    /**
     * @var Activation
     */
    public $activation;

    /**
     * UserRegistered constructor.
     * @param User $user
     */
    public function __construct(User $user, $activationCode)
    {
        $this->user = $user;
        $this->activation =$activationCode;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration.registered');
    }
}
