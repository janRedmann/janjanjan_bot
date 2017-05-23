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
        $this->say(sprintf(config('janbot.skills.intro'), $this->bot->userStorage()->get()->get('name')));
        $this->bot->typesAndWaits(4);
        $this->say(config('janbot.skills.paragraph_1'));
        $this->bot->typesAndWaits(4);
        $this->say(config('janbot.skills.paragraph_2'));
        $this->bot->typesAndWaits(3);
        $this->ask('Do you want to hear more?', [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say(config('janbot.skills.paragraph_3'));
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say(config('janbot.skills.question'));
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create('Do you want to hear more?')
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
