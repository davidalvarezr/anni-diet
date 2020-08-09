<?php

namespace App\Models;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FireworkEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    private $event;


    public function __construct($message, $event)
    {
        $this->message = $message;
        $this->event = $event;
    }

    public function broadcastOn()
    {
        return ['private-firework'];
    }

    public function broadcastAs()
    {
        return $this->event;
    }
}

