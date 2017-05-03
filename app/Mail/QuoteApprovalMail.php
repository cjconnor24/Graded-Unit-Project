<?php

namespace App\Mail;

use App\Order;
use App\QuoteApproval;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User object
     */
    public $user;
    /**
     * @var Quote Approval
     */
    public $approval;

    /**
     * @var Order Details
     */
    public $quotation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, QuoteApproval $approval, Order $quotation)
    {
        $this->user = $user;
        $this->approval = $approval;
        $this->quotation = $quotation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quoteapprove');
    }
}
