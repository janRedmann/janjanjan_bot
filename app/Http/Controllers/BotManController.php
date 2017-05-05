<?php

namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Conversations\ChooseTopicConversation;
use Illuminate\Http\Request;
use Mpociot\BotMan\BotMan;

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
        $topics = [];

    }
}

