<?php

namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Conversations\ChooseTopicConversation;
use App\Events\ConversationRequested;
use Illuminate\Http\Request;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Button;
use Mpociot\BotMan\Question;

class BotManController extends Controller
{
    protected $bot;

    public function __construct()
    {
        $this->bot = app('botman');
    }

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
        $botman->verifyServices(env('TOKEN_VERIFY'));

        $botman->listen();
    }

    /**
     * Loaded through routes/botman.php
     *
     */
    public function startOnboardingConversation()
    {
        $this->bot->startConversation(new OnboardingConversation());
    }

    public function startChooseTopicConversation()
    {
        $this->bot->startConversation(new ChooseTopicConversation());
    }





    public function showAllTopics()
    {
        $topics = ['Skills', 'Personal', 'Work Experience', 'Goals'];

        $buttons= [];

        foreach ($topics as $topic) {
            array_push($buttons, Button::create($topic)->value($topic));
        }
            $question = Question::create('Here is an overview of all the topics. Just click on one and i tell you more.')
                ->fallback('Unable to show topics')
                ->callbackId('show_topics')
                ->addButtons($buttons);
            $this->bot->ask($question, function (Answer $answer) {
              if ($answer->isInteractiveMessageReply()) {
                  $topic = $answer->getValue();
                  event(new ConversationRequested($topic));
              }
            });




    }

}

