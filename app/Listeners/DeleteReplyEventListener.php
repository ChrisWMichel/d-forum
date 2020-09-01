<?php

namespace App\Listeners;

use App\Events\DeleteReplyEvent;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteReplyEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  DeleteReplyEvent  $event
     * @return void
     */
    public function handle(DeleteReplyEvent $event)
    {

    }


}
