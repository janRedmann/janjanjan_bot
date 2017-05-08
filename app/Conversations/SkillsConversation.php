<?php


namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Question;

class SkillsConversation extends Conversation
{
    public function tellAboutSkills()
    {
        $this->say('Hey ' . $this->bot->userStorage()->get()->get('name') . ', here i tell you something about skills');
    }

    public function run()
    {
        $this->tellAboutSkills();
    }

}
