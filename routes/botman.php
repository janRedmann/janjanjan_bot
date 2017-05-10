<?php
use App\Http\Controllers\BotManController;
use Mpociot\BotMan\Messages\Message;
use Mpociot\BotMan\Middleware\ApiAi;

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
    $bot->typesAndWaites(2);
    $bot->reply('Good bye. I enjoyed talking to you and i hope i could help.');
});

$botman->hears('.*', function($bot) {
    // The incoming message matched the "my_api_action" on API.ai
    // Retrieve API.ai information:
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $apiAction = $extras['apiAction'];
    $apiIntent = $extras['apiIntent'];

    $bot->reply($apiReply);


})->middleware(ApiAi::create('7087597e60af4da69ddd993a19e660be')->listenForAction());


// Commnands
$botman->hears('/start', BotManController::class.'@startOnboardingConversation');

$botman->hears('help', function($bot) {
    $bot->reply('here is a list of commands you can use');
});

$botman->hears('/topics', BotManController::class.'@showAllTopics');

// Keywords for the topics

$botman->hears('skills', BotManController::class.'@startSkillsConversation');

$botman->hears('goals', BotManController::class.'@startGoalsConversation');

$botman->hears('personal', BotManController::class.'@startPersonalConversation');

$botman->hears('work experience', BotManController::class.'@startWorkExperienceConversation');

//$botman->fallback(function($bot) {
//    $bot->reply('Sorry, I did not understand what you just said. Here is a list of commands I understand: ...');
//});
