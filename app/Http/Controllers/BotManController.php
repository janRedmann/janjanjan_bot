<?php

namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Conversations\ChooseTopicConversation;
use App\Conversations\GoalsConversation;
use App\Conversations\PersonalConversation;
use App\Conversations\SkillsConversation;
use App\Conversations\WorkExperienceConversation;
use App\Events\ConversationRequested;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Button;
use Mpociot\BotMan\Question;

class BotManController extends Controller
{
    protected $bot;

    protected $emojiHelper;

    public function __construct()
    {
        $this->bot = app('botman');
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
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

    public function startPersonalConversation()
    {
        $this->bot->startConversation(new PersonalConversation());
    }

    public function startGoalsConversation()
    {
        $this->bot->startConversation(new GoalsConversation());
    }

    public function startSkillsConversation()
    {
        $this->bot->startConversation(new SkillsConversation());
    }

    public function startWorkExperienceConversation()
    {
        $this->bot->startConversation(new WorkExperienceConversation());
    }

    public function showAllTopics()
    {
        $topics = ['Skills', 'Personal', 'Work Experience', 'Goals'];

        $buttons= [];

        foreach ($topics as $topic) {
            array_push($buttons, Button::create($topic)->value($topic));
        }
            $question = Question::create('Here is an overview of all the topics. Just click on one'.
                $this->emojiHelper->display(['finger pointing down']) .
                'and i tell you more' . $this->emojiHelper->display(['robot face']))
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
