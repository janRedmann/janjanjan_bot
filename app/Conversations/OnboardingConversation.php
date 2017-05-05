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

    protected $bot;

    public function __construct()
    {
        $this->bot = app('botman');
    }

    /**
     * First question
     */
    public function askName()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            $this->username = $answer->getText();

            $this->say('Nice to meet you, ' . $this->username . ' ' . html_entity_decode('&#x1F603;', 0, 'UTF-8'));

            $this->bot->userStorage()->save(['name' => $this->username]);

            $this->bot->startConversation(new ChooseTopicConversation());
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

