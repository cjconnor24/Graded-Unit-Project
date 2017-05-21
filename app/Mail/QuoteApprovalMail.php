<?php

namespace App\Mail;

use App\Order;
use App\QuoteApproval;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Mailable for quote approval
 * @package App\Mail
 */
class QuoteApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User belonging to quote
     * @var User object
     */
    public $user;
    /**
     * Approval for quotation
     * @var Quote Approval
     */
    public $approval;

    /**
     * Quotation itself
     * @var Order Details
     */
    public $quotation;

    /**
     * QuoteApprovalMail constructor.
     * @param User $user User belonging to quote
     * @param QuoteApproval $approval The approval
     * @param Order $quotation The quote itself
     */
    public function __construct(User $user, QuoteApproval $approval, Order $quotation)
    {
        $this->user = $user;
        $this->approval = $approval;
        $this->quotation = $quotation;
    }

    /**
     * Build the message using the view.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quoteapprove');
    }
}
