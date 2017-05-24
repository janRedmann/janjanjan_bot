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
        $this->bot->typesAndWaits('2');
        $this->say(config('janbot.goals.paragraph_1'));
        $this->bot->typesAndWaits('6');
        $this->say(sprintf(config('janbot.goals.paragraph_2'), $this->bot->userStorage()->get()->get('company')));
    }

    public function run()
    {
        $this->tellAboutGoals();
    }

}
