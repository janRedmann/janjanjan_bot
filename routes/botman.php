<?php
use App\Http\Controllers\BotManController;
use App\Common\EmojiHelper;

$botman = resolve('botman');
$emojiHelper = new EmojiHelper();

$botman->hears('(.*) your name', function($bot) use ($emojiHelper) {
    $bot->reply('My name is Janbot ' . $emojiHelper->display(['robot face']));
});

$botman->hears('hello|hi|hey', function($bot) use ($emojiHelper){
    $bot->reply('Hi there ' . $emojiHelper->display(['smiling face with smiling eyes']));
});

$botman->hears('test', function($bot) use ($emojiHelper) {
    $bot->typesAndWaits(2);
    $bot->reply('Yes i am here and fully functional. '
        . $emojiHelper->display(['thumbs up sign'])
        . ' I am a big fan of tests. Even Test Driven Development.'
        . $emojiHelper->display(['smiling face with open mouth'])
    );
});

$botman->hears('(.*) bye', function($bot){
    $bot->typesAndWaits(2);
    $bot->reply('Good bye. I enjoyed talking to you and i hope i could help.');
});

$botman->hears('/start', BotManController::class.'@startOnboardingConversation');

$botman->hears('help', function($bot) use($emojiHelper) {
    $bot->typesAndWaits(2);
    $bot->reply(sprintf(config('janbot.help.paragraph_1'),
        $emojiHelper->display(['computer']),
        $emojiHelper->display(['man']),
        $emojiHelper->display(['worker']),
        $emojiHelper->display(['target'])
    ));
    $bot->typesAndWaits(2);
    $bot->reply(sprintf(config('janbot.help.paragraph_2'),
        $emojiHelper->display(['thumbs up sign'])
    ));
});

$botman->hears('topics', BotManController::class.'@showAllTopics');

// Keywords for the topics
$botman->hears('skills', BotManController::class.'@startSkillsConversation');

$botman->hears('goals', BotManController::class.'@startGoalsConversation');

$botman->hears('personal', BotManController::class.'@startPersonalConversation');

$botman->hears('work experience', BotManController::class.'@startWorkExperienceConversation');

// the fallback if not other keyword matches
$botman->fallback(function($bot) use($emojiHelper){
    $bot->reply(sprintf(config('janbot.fallback_1'),
        $emojiHelper->display(['man shrugging'])
    ));
    $bot->typesAndWaits(2);
    $bot->reply(config('janbot.fallback_2'));
    $bot->typesAndWaits(2);
    $bot->reply(config('janbot.fallback_3'));
    $bot->typesAndWaits(2);
    $bot->reply(config('janbot.fallback_4'));
});
