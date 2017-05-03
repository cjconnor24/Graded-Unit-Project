<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use App\Mail\QuoteApprovalMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendApprovalMail
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
     * Send approval mail to customer
     * @param QuoteCreated $event
     */
    public function handle(QuoteCreated $event)
    {
        \Log::info('Send mail',['user'=>$event->user,'order'=>$event->order,'activation'=>$event->activation]);

        Mail::to($event->user->email)->send(new QuoteApprovalMail($event->user,$event->activation,$event->order));

    }
}
