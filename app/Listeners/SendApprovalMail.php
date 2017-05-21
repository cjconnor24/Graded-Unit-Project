<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use App\Mail\QuoteApprovalMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

/**
 * Listener to Send approval E-Email to Customer
 * @package App\Listeners
 */
class SendApprovalMail
{
    /**
     * SendApprovalMail constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Send approval mail to customer
     * @param QuoteCreated $event
     */
    public function handle(QuoteCreated $event)
    {
//        LOG FOR DEBUGGING
//        \Log::info('Send mail',['user'=>$event->user,'order'=>$event->order,'activation'=>$event->activation]);
        Mail::to($event->user->email)->send(new QuoteApprovalMail($event->user,$event->activation,$event->order));

    }
}
