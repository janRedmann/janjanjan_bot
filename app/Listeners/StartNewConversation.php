<?php

namespace App\Listeners;

use App\Events\ConversationRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StartNewConversation
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
     * @param  ConversationRequested  $event
     * @return void
     */
    public function handle(ConversationRequested $event)
    {
        //
    }
}
