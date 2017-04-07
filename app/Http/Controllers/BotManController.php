<?php

namespace janjanjan_bot\Http\Controllers;

use janjanjan_bot\Conversations\OnboardingConversation;
use Illuminate\Http\Request;
use Mpociot\BotMan\BotMan;

class BotManController extends Controller
{
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
     * @param  BotMan $bot
     */
    public function startOnboardingConversation(BotMan $bot)
    {
        $bot->startConversation(new OnboardingConversation($bot));
    }
}

