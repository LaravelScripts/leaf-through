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

    private $mailbox;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Mailbox $mailbox)
    {
        //
        $this->mailbox = $mailbox;
        Log::info("LinkShared Event fired at ".\Carbon\Carbon::now());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::info("LinkShared Broadcast fired at ".\Carbon\Carbon::now()." for user ".$this->mailbox->user_id);
        return new PrivateChannel('inbox-'.$this->mailbox->user_id);
    }
}
