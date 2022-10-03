<?php

namespace App\Events;

use App\User;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender_id;
    public $rec_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender_id,$rec_id)
    {
        $this->sender_id = $sender_id;
        $this->rec_id = $rec_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notify');
    }
    public function broadcastAs()
    {
        return 'notify';
    }

}
