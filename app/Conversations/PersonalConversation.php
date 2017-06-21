<?php

namespace App\Conversations;

use Mpociot\BotMan\Button;
use Mpociot\BotMan\Question;

class PersonalConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    public function tellAboutPersonal()
    {
        $this->bot->typesAndWaits(3);
        $this->say(sprintf(config('janbot.personal.introduction'),
            $this->bot->userStorage()->get()->get('name'),
            $this->emojiHelper->display(['man'])
        ));
        $this->bot->typesAndWaits(4);
        $this->say(config('janbot.personal.paragraph_1'));
        $this->bot->typesAndWaits(4);
        $this->say(sprintf(config('janbot.personal.paragraph_2'),
            $this->emojiHelper->display(['dog face']),
            $this->emojiHelper->display(['runner']),
            $this->emojiHelper->display(['joker'])
        ));
        $this->bot->typesAndWaits(4);
        $this->ask(config('janbot.personal.question_1'), [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(4);
                    $this->say(config('janbot.personal.paragraph_3'));
                    $this->say(sprintf(config('janbot.personal.paragraph_3'),
                        $this->emojiHelper->display(['money bag'])
                    ));
                    $this->bot->typesAndWaits(4);
                    $this->say(config('janbot.personal.paragraph_4'));
                    $this->say(sprintf(config('janbot.personal.paragraph_4'),
                        $this->emojiHelper->display(['calculator']),
                        $this->emojiHelper->display(['balance scale'])
                    ));
                    $this->bot->typesAndWaits(4);
                    $this->say(sprintf(config('janbot.personal.question_2'),
                        $this->emojiHelper->display(['heavy check mark']),
                        $this->bot->userStorage()->get()->get('name')
                    ));
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say(sprintf(config('janbot.personal.question_3'),
                        $this->bot->userStorage()->get()->get('name')
                    ));
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create(config('janbot.personal.question_1'))
                        ->addButtons([
                            Button::create('Oh yeah')->value('yes'),
                            Button::create('Oh no')->value('no'),
                        ]);
                    $this->repeat($newQuestion);
                }
            ],
        ]);
    }

    public function run()
    {
        $this->tellAboutPersonal();
    }
}
