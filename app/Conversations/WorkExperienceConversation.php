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
        $this->bot->typesAndWaits(3);
        $this->say('OK, ' . $this->bot->userStorage()->get()->get('name') . ', i will tell you something about Jan\'s work experience.');
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.work_experience.paragraph_1'));
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.work_experience.paragraph_2'));
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.work_experience.paragraph_3'));
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.work_experience.question'));
    }

    public function run()
    {
        $this->tellAboutWorkExperience();
    }

}
