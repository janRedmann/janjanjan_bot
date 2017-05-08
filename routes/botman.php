<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('(.*) your name', function($bot){
    $bot->reply('My name is janbot');
});

$botman->hears('test', function($bot){
    $bot->typesAndWaits(3);
    $bot->reply('Hello ' . $bot->getUser()->getFirstName() . '! I am a big fan of tests. Even Test Driven Development.');
});


// Commnands
$botman->hears('/start', BotManController::class.'@startOnboardingConversation');

$botman->hears('/help', function($bot) {
    $bot->reply('here is a list of commands you can use');
});

$botman->hears('/topics', BotManController::class.'@showAllTopics');

// Keywords for the topics

$botman->hears('skills', BotManController::class.'@startSkillsConversation');

$botman->hears('goals', BotManController::class.'@startGoalsConversation');

$botman->hears('personal', BotManController::class.'@startPersonalConversation');

$botman->hears('work experience', BotManController::class.'@startWorkExperienceConversation');

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand what you just said. Here is a list of commands I understand: ...');
});
