<?php

namespace App\Conversations;

use Mpociot\BotMan\Conversation as BaseConversation;
use Mpociot\BotMan\Message;

abstract class Conversation extends BaseConversation
{
    /**
     * Should the conversation be removed and stopped (permanently).
     * @param  Message $message
     * @return bool
     */
    public function stopConversation(Message $message)
    {
        return $message->getMessage() === 'help';
    }
}
