<?php

namespace App\Listeners;

use App\Events\LinkShared;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLinkSharedEmail
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
     * Handle the event.
     *
     * @param  LinkShared  $event
     * @return void
     */
    public function handle(LinkShared $event)
    {
        //
    }
}
