<?php

namespace App\Conversations;

use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use App\Conversations\Conversation;
use Mpociot\BotMan\Question;
use Mpociot\BotMan\BotMan;

class ChooseTopicConversation extends Conversation
{
    public function askForTopic()
    {
        $question = Question::create('So about which topic do you want me to talk about now?')
            ->fallback('Unable to choose topic')
            ->callbackId('choose_topic')
            ->addButtons([
                Button::create('Skills')->value('skills'),
                Button::create('Personal')->value('personal'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'skills') {
                    $this->bot->startConversation(new SkillsConversation());
                }
            }
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'personal') {
                    $this->bot->startConversation(new  PersonalConversation());
                }
            }
        });
    }

    public function run()
    {
        $this->askForTopic();
    }
}
