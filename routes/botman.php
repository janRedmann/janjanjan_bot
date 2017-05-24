<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('(.*) your name', function($bot){
    $bot->reply('My name is Janbot');
});

$botman->hears('hello|hi|hey', function($bot){
    $bot->reply('Hi there');
});

$botman->hears('test', function($bot){
    $bot->typesAndWaits(3);
    $bot->reply('Yes i am here and fully functional. I am a big fan of tests. Even Test Driven Development.');
});

$botman->hears('(.*) bye', function($bot){
    $bot->typesAndWaits(2);
    $bot->reply('Good bye. I enjoyed talking to you and i hope i could help.');
});

$botman->hears('/start', BotManController::class.'@startOnboardingConversation');

$botman->hears('help', function($bot) {
    $bot->typesAndWaits(3);
    $bot->reply(config('janbot.help.paragraph_1'));
    $bot->typesAndWaits(3);
    $bot->reply(config('janbot.help.paragraph_2'));
});

$botman->hears('topics', BotManController::class.'@showAllTopics');

// Keywords for the topics
$botman->hears('skills', BotManController::class.'@startSkillsConversation');

$botman->hears('goals', BotManController::class.'@startGoalsConversation');

$botman->hears('personal', BotManController::class.'@startPersonalConversation');

$botman->hears('work experience', BotManController::class.'@startWorkExperienceConversation');

$botman->fallback(function($bot) {
    $bot->reply(config('janbot.fallback'));
});
