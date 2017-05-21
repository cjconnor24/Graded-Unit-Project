<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Mailable for when user rejects a quotation
 * @package App\Mail
 */
class UserQuoteRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The quotation
     * @var Order
     */
    public $quote;


    /**
     * UserQuoteRejected constructor.
     * @param Order $quotation
     */
    public function __construct(Order $quotation)
    {
        $this->quote = $quotation;
    }

    /**
     * Build the message using the view.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('UserQuoteRejected');
    }
}
