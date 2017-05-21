<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use App\QuoteApproval;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Listener to Create Quote Approval
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App\Listeners
 */
class CreateQuoteApproval
{
    /**
     * CreateQuoteApproval constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create Quote Approval
     * @param QuoteCreated $event
     */
    public function handle(QuoteCreated $event)
    {
        $approval = new QuoteApproval;
        $approval->user_id = $event->user->id;
        $approval->order_id = $event->order->id;
        $approval->token = str_random(16);
        $approval->save();
        $event->activation = $approval;

    }
}
