<?php

namespace App\Listeners;

use App\Events\ConversationRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mpociot\BotMan\BotMan;
use App\Conversations\SkillsConversation;
use App\Conversations\GoalsConversation;
use App\Conversations\PersonalConversation;
use App\Conversations\WorkExperienceConversation;


class StartNewConversation
{
    protected $bot;

    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        $this->bot = app('botman');
    }

    /**
     * Handle the event.
     *
     * @param  ConversationRequested  $event
     * @return void
     */
    public function handle(ConversationRequested $event)
    {
        $conversations = [
            'Skills' => 'App\Conversations\SkillsConversation',
            'Personal' => 'App\Conversations\PersonalConversation',
            'Work Experience' => 'App\Conversations\WorkExperienceConversation',
            'Goals' => 'App\Conversations\GoalsConversation'
        ];

//        $topic = $event->topic;

        $this->bot->startConversation(new $conversations[$event->topic]);
    }
}
