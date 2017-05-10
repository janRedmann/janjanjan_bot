<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;
use Mpociot\BotMan\Messages\Message;
use App\Common\EmojiHelper;

class OnboardingConversation extends Conversation
{
    protected $emojiHelper;

    protected $username;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    /**
     * First question
     */
    public function askName()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            $this->username = $answer->getText();

            $this->say('Nice to meet you, ' . $this->username . ' ' . $this->emojiHelper->display('smileyFace'));


            $this->bot->userStorage()->save(['name' => $this->username]);

            $this->bot->typesAndWaits('2');
            $this->say(config('janbot.onboarding.introduction_1'));
            $this->bot->typesAndWaits('4');
            $this->say(config('janbot.onboarding.introduction_2'));
            $this->bot->typesAndWaits('4');
            //$this->say(config('janbot.onboarding.introduction_3'));
            $this->askForCompany();
        });

        //$this->askForCompany();
    }

    public function askForCompany()
    {
        $this->ask('One last thing. May i also ask for which company you are working?', function(Answer $answer) {
            

            $message = Message::create()
                ->image('https://media.giphy.com/media/l3V0wkQ2KKcAeW8Cs/giphy.gif');
            $this->bot->typesAndWaits('3');
            $this->bot->reply($message);
            $this->bot->typesAndWaits('2');
            $this->say('Great. That\'s it. Which topic are you most interested in?');
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

