<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;

class SkillsConversation extends Conversation
{
    public function tellAboutSkills()
    {
        $this->bot->typesAndWaits(3);
        $this->say('Alright ' . $this->bot->userStorage()->get()->get('name') . ', i will tell you something about Jan\'s skills.');
        $this->say(config('janbot.personal.paragraph_1'));
        $this->bot->typesAndWaits(3);
        $this->ask('Do you want to hear more?', [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->moreInfo();
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Okay, i see. Which topic are you interested in now? Remember, the other topics are: Skills, Work Experience and Goals');
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create('Do you want to hear more about the professional poker?')
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
        $this->tellAboutSkills();
    }

}
