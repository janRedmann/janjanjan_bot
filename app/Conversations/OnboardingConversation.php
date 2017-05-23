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
        $this->bot->typesAndWaits(3);
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {

            $this->bot->userStorage()->save(['name' => $answer->getText()]);

            $this->say(sprintf(config('janbot.onboarding.greeting_1') ,$this->bot->userStorage()->get()->get('name'),$this->emojiHelper->display('smiling face with open mouth')));

            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_1'));
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_2'));
            $this->bot->typesAndWaits('6');
            $this->askForCompany();
        });
    }

    public function askForCompany()
    {
        $this->ask(config('janbot.onboarding.question'), function(Answer $answer) {
            $company = $answer->getText();
            if (array_key_exists($company, config('janbot.onboarding.companies'))) {
                $this->bot->typesAndWaits('2');
                $this->say(config('janbot.onboarding.companies.'.$company));
            }
            $this->bot->userStorage()->save(['company' => $company]);
//            $message = Message::create()
//                ->image('https://media.giphy.com/media/tczJoRU7XwBS8/giphy.gif');
//            $this->bot->typesAndWaits('5');
//            $this->bot->reply($message);
            $this->bot->typesAndWaits('2');
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
