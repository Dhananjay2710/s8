<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateTicket
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $service_request;

    public function __construct(array $service_request)
    {
        $this->service_request = $service_request;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
