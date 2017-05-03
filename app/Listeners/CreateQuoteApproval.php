<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use App\QuoteApproval;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateQuoteApproval
{
    /**
     * Create the event listener.
     *
     * @return void
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
