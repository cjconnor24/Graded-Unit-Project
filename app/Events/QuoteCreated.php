<?php

namespace App\Events;

use App\Order;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class QuoteCreated - Event sequence to trigger when Quote is created
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App\Events
 */
class QuoteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User related to quotation
     * @var User
     */
    public $user;

    /**
     * Quotation created
     * @var Order
     */
    public $order;

    /**
     * Activation code for quotation
     * @var string
     */
    public $activation;

    /**
     * QuoteCreated constructor.
     * @param User $user User belonging to quotation
     * @param Order $order Quotation itself
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }


}
