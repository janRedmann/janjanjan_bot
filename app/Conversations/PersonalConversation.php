<?php


namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Question;

class PersonalConversation extends Conversation
{
    public function tellAboutPersonal()
    {
        $this->say('here i tell you something personal');
    }

    public function run()
    {
        $this->tellAboutPersonal();
    }


}
