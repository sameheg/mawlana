<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('orders');
    }
}
