<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;

class GoalsConversation extends Conversation
{
    public function tellAboutGoals()
    {
        $this->say(config('janbot.goals.paragraph_1'));
    }

    public function run()
    {
        $this->tellAboutGoals();
    }

}
