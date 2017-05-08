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
        $this->bot->typesAndWaits(3);
        $this->say('here i tell you something personal');
        $this->bot->typesAndWaits(3);
        $this->ask('Do you want to hear more about this topic?', [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->continueConversation();
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Alright. Which topic are you interested in now?');
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create('Do you want to hear more about skills?')
                        ->addButtons([
                            Button::create('Oh yeah')->value('yes'),
                            Button::create('Oh no')->value('no'),
                        ]);
                    $this->repeat($newQuestion);
                }
            ],

        ]);
    }

    public function continueConversation()
    {
        $this->say('here i continue the conversation');
    }

    public function run()
    {
        $this->tellAboutPersonal();
    }


}
