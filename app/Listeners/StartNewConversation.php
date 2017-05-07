<?php

namespace App\Listeners;

use App\Events\ConversationRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mpociot\BotMan\BotMan;

class StartNewConversation
{
    protected $bot;

    /**
     * Create the event listener.
     * @param BotMan $bot
     * @return void
     */
    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
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
            'Skills' => 'SkillsConversation',
            'Personal' => 'PersonalConversation',
            'Work Experience' => 'WorkExperienceConversation',
            'Goals' => 'GoalsConversation'
        ];

        $topic = $event->topic;

        $this->bot->startConversation(new $conversations[$topic]);
    }
}
