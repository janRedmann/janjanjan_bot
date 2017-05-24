<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;
use App\Common\EmojiHelper;

class GoalsConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    public function tellAboutGoals()
    {
        $this->bot->typesAndWaits('2');
        $this->say(config('janbot.goals.paragraph_1'));
        $this->bot->typesAndWaits('6');
        $this->say(sprintf(config('janbot.goals.paragraph_2'),
            $this->bot->userStorage()->get()->get('company'),
            $this->emojiHelper->display('winking face')
        ));
    }

    public function run()
    {
        $this->tellAboutGoals();
    }

}
