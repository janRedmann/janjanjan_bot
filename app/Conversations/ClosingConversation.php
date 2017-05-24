<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;
use Mpociot\BotMan\Messages\Message;
use App\Common\EmojiHelper;

class ClosingConversation extends Conversation
{
    /**
     * First question
     */
    public function closeConversation()
    {
        $this->bot->say('Okay. We\'re done. I told you everything i know.');
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->closeConversation();
    }
}
