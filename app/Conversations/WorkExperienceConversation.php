<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;

class WorkExperienceConversation extends Conversation
{
    public function tellAboutWorkExperience()
    {
        $this->say('here i tell you something about my work experience');
    }

    public function run()
    {
        $this->tellAboutWorkExperience();
    }

}
