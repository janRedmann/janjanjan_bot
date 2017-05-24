<?php

namespace App\Conversations;

use Mpociot\BotMan\Button;
use Mpociot\BotMan\Question;

class PersonalConversation extends Conversation
{
    public function tellAboutPersonal()
    {
        $this->bot->typesAndWaits(3);
        $this->say(sprintf(config('janbot.personal.introduction'), $this->bot->userStorage()->get()->get('name')));
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.personal.paragraph_1'));
        $this->bot->typesAndWaits(6);
        $this->say(config('janbot.personal.paragraph_2'));
        $this->bot->typesAndWaits(6);
        $this->ask(config('janbot.personal.question_1'), [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(6);
                    $this->say(config('janbot.personal.paragraph_3'));
                    $this->bot->typesAndWaits(6);
                    $this->say(config('janbot.personal.paragraph_4'));
                    $this->bot->typesAndWaits(6);
                    $this->say(config('janbot.personal.question_2'));
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say(config('janbot.personal.question_3'));
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create(config('janbot.personal.question_1'))
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
