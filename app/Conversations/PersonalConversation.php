<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;

class PersonalConversation extends Conversation
{
    public function tellAboutPersonal()
    {
        $this->bot->typesAndWaits(3);
        $this->say('Alright ' . $this->bot->userStorage()->get()->get('name') . ', i will tell you something personal about Jan.');
        $this->bot->typesAndWaits(4);
        $this->say(config('janbot.personal.paragraph_1'));
        $this->bot->typesAndWaits(3);
        $this->ask(config('janbot.personal.question'), [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(2);
                    $this->say(config('janbot.personal.paragraph_2'));
                    $this->bot->typesAndWaits(2);
                    $this->say('What topic are you interested in now? Other topics are: skills, work experience and goals.');
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
                    $newQuestion = Question::create(config('janbot.personal.question'))
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
        $this->tellAboutPersonal();
    }


}
