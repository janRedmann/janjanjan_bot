<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Button;
use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Question;

class OnboardingConversation extends Conversation
{

    protected $username;

    /**
     * First question
     */
    public function askName()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            $this->username = $answer->getText();

            $this->say('Nice to meet you, ' . $this->username . ' ' . html_entity_decode('&#x1F603;', 0, 'UTF-8'));

            $this->bot->userStorage()->save(['name' => $this->username]);

            $this->bot->typesAndWaits('2');
            $this->say(config('janbot.onboarding.introduction_1'));
            $this->bot->typesAndWaits('4');
            $this->say(config('janbot.onboarding.introduction_2'));
            $this->bot->typesAndWaits('4');
            $this->say(config('janbot.onboarding.introduction_3'));
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askName();
    }

}

