<?php
use App\Http\Controllers\BotManController;
use Mpociot\BotMan\BotMan;
// Don't use the Facade in here to support the RTM API too :)
$botman = resolve('botman');

$botman->hears('test', function($bot){
    $bot->typesAndWaits(5);
    $bot->reply('Hello ' . $bot->getUser()->getFirstName() . '! I am a big fan of tests. Even Test Driven Development.');
});


// Commnands
$botman->hears('/start', BotManController::class.'@startOnboardingConversation');

$botman->hears('/help', function($bot) {
    $bot->reply('here is a list of commands you can use');
});

$botman->hears('/topics', BotManController::class.'@showAllTopics');


$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
