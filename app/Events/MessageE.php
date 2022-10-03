<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageE implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_id;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$message)
    {
        $this->user_id=$user_id;
        $this->message=$message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return['chat'];
    }
    public function broadcastAs()
    {
        return 'message';
    }
}
