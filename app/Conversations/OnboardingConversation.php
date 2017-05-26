<?php

namespace App\Conversations;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Drivers\TelegramDriver;

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
    protected function askName()
    {
        $this->bot->typesAndWaits(3);
        $this->ask('Hello! What is your name?', function(Answer $answer) {

            $this->bot->userStorage()->save(['name' => $answer->getText()]);

            $this->bot->userStorage()->save(['count' => '0']);

            $this->bot->typesAndWaits('5');
            $this->say(sprintf(config('janbot.onboarding.greeting_1') ,
                $this->bot->userStorage()->get()->get('name'),
                $this->emojiHelper->display(['smiling face with open mouth'])
            ));

            $this->bot->typesAndWaits('4');
            $this->say(sprintf(config('janbot.onboarding.introduction_1'),
                $this->emojiHelper->display(['robot face'])
            ));
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_2'));
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_3'));
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_4'));
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_5'));
            $this->bot->typesAndWaits('6');
            $this->askForCompany();
        });
    }

    protected function askForCompany()
    {
        $this->ask(config('janbot.onboarding.question'), function(Answer $answer) {
            $company = $answer->getText();
            $this->displayCompanyMessage($company);
            $this->bot->userStorage()->save(['company' => $company]);
            $this->displaySpecialMessage($company);
            $this->bot->typesAndWaits('6');
            $this->say(config('janbot.onboarding.introduction_6'));
            $this->sendNotification();
        });
    }

    protected function displayCompanyMessage($company)
    {
        if (array_key_exists($company, config('janbot.onboarding.companies'))) {
                $this->bot->typesAndWaits('6');
                $this->say(config('janbot.onboarding.companies.'.$company));
                $this->bot->typesAndWaits('6');
                $this->say($this->emojiHelper->display(['thumbs up sign', 'winking face']));
        }
    }

    protected function displaySpecialMessage($company)
    {
        if ($message = $this->checkForSpecialMessage($company)) {
            $this->bot->typesAndWaits('6');
            $this->say($message);
            $this->bot->typesAndWaits('6');
            $this->say($this->emojiHelper->display(['weary cat face', 'winking face']));
        }
    }

    protected function sendNotification()
    {
        $this->bot->say(sprintf(config('janbot.notification.message'),
            $this->bot->userStorage()->get()->get('name'),
            $this->bot->userStorage()->get()->get('company')),
            config('janbot.notification.chat_id'),
            config('janbot.notification.driver')
        );
    }

    protected function checkForSpecialMessage($company)
    {
        $username = strtolower($this->bot->userStorage()->get()->get('name'));
        $companyArray = config('janbot.onboarding.' . strtolower($company));
        if (array_key_exists($username, $companyArray)) {
            return config('janbot.onboarding.' . $company . '.' . $username);
        }

        return false;
    }
    
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askName();
    }
}
