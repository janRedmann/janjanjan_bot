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
        $this->say(config('janbot.work_experience.paragraph_1'));
        $this->bot->typesAndWaits(3);
        $this->ask('Do you want to hear more?', [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('here i tell you some more');
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Okay, i see. Which topic are you interested in now? Remember, the other topics are: Skills, Personal and Goals');
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand that answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create('Should i tell you more?')
                        ->addButtons([
                            Button::create('Oh yeah')->value('yes'),
                            Button::create('Oh no')->value('no'),
                        ]);
                    $this->repeat($newQuestion);
                }
            ],

        ]);
    }

    public function run()
    {
        $this->tellAboutWorkExperience();
    }

}
