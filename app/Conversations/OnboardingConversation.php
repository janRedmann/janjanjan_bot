<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Messages\Message;

class OnboardingConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    /**
     * First question
     */
    protected function askName()
    {
        $this->bot->typesAndWaits(2);
        $this->ask('Hello! What is your name?', function(Answer $answer) {

            $this->bot->userStorage()->save(['name' => $answer->getText()]);

            $this->bot->userStorage()->save(['count' => '0']);

            $this->bot->typesAndWaits('1');
            $this->say(sprintf(config('janbot.onboarding.greeting_1') ,
                $this->bot->userStorage()->get()->get('name'),
                $this->emojiHelper->display(['smiling face with open mouth'])
            ));

            $this->bot->typesAndWaits('1');
            $this->say(sprintf(config('janbot.onboarding.introduction_1'),
                $this->emojiHelper->display(['robot face'])
            ));
            $this->bot->typesAndWaits('2');
            $this->say(config('janbot.onboarding.introduction_2'));
            $this->bot->typesAndWaits('3');
            $this->say(config('janbot.onboarding.introduction_3'));
            $this->bot->typesAndWaits('3');
            $this->say(config('janbot.onboarding.introduction_3_a'));
            $this->bot->typesAndWaits('3');
            $this->say(sprintf(config('janbot.onboarding.introduction_4'),
                $this->emojiHelper->display(['computer']),
                $this->emojiHelper->display(['man']),
                $this->emojiHelper->display(['worker']),
                $this->emojiHelper->display(['target'])
            ));
            $this->bot->typesAndWaits('3');
            $this->say(sprintf(config('janbot.onboarding.introduction_5'),
                $this->emojiHelper->display(['man shrugging'])
            ));
            $this->bot->typesAndWaits('3');
            $this->askForCompany();
        });
    }

    protected function askForCompany()
    {
        $this->ask(sprintf(config('janbot.onboarding.question'), $this->emojiHelper->display(['office building'])), function(Answer $answer) {
            $company = $answer->getText();
            $this->displayCompanyMessage($company);
            $this->bot->userStorage()->save(['company' => $company]);
            $this->displaySpecialMessage($company);
            $this->bot->typesAndWaits('3');
            $this->say(sprintf(config('janbot.onboarding.introduction_6'),
                $this->emojiHelper->display(['ok hand'])
            ));
            $this->sendNotification();
        });
    }

    protected function displayCompanyMessage($company)
    {
        if (array_key_exists($company, config('janbot.onboarding.companies'))) {
                $this->bot->typesAndWaits('3');
                $this->say(config('janbot.onboarding.companies.'.$company));
                $this->bot->typesAndWaits('3');
                $this->say($this->emojiHelper->display(['thumbs up sign', 'winking face']));
        }
    }

    protected function displaySpecialMessage($company)
    {
        if ($message = $this->checkForSpecialMessage($company)) {
            $this->bot->typesAndWaits('3');
            $this->say(config('janbot.onboarding.special_1'));
            $this->bot->typesAndWaits('2');
            $gif = Message::create('')->image('https://media.giphy.com/media/fpXxIjftmkk9y/giphy.gif');
            $this->say($gif);
            $this->bot->typesAndWaits('2');
            $this->say($message);
            $this->bot->typesAndWaits('2');
            $this->say($this->emojiHelper->display(['weary cat face', 'winking face']));
        }
    }

    /**
     * Checks if a special message exists for the current user working for the given company
     *
     * @param string $company
     *
     * @return string | bool
     */
    protected function checkForSpecialMessage($company)
    {
        $username = strtolower($this->bot->userStorage()->get()->get('name'));
        if ($companyArray = config('janbot.onboarding.' . strtolower($company))) {
            if (array_key_exists($username, $companyArray)) {
                return config('janbot.onboarding.' . strtolower($company) . '.' . $username);
            }
        }
        return false;
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

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askName();
    }
}
