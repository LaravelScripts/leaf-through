<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\{User,Mailbox};
use Log;

class LinkShared implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    private $recipientId;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $recipientId)
    {
        //
        $this->recipientId = $recipientId;
        $this->user = \Auth::user()->name;
        Log::info("LinkShared Event fired at ".\Carbon\Carbon::now());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::info("LinkShared Broadcast fired at ".\Carbon\Carbon::now()." for user ".$this->recipientId);
        return new PrivateChannel('inbox-'.$this->recipientId);
    }
}
