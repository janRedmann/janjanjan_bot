<?php

namespace App\Conversations;

use Mpociot\BotMan\Button;
use Mpociot\BotMan\Question;

class SkillsConversation extends Conversation
{
    /**
     * @var App\Common\EmojiHelper
     */
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    public function tellAboutSkills()
    {
        $this->bot->typesAndWaits(1);
        $this->say(sprintf(config('janbot.skills.intro'),
            $this->bot->userStorage()->get()->get('name'),
            $this->emojiHelper->display(['computer'])
        ));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_1'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_1_a'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_1_b'));

        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_2'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_2_a'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.skills.paragraph_3'));
        $this->bot->typesAndWaits(3);
        $this->say(sprintf(config('janbot.skills.paragraph_3_a'),
            $this->emojiHelper->display(['robot face']),
            $this->emojiHelper->display(['weary cat face'])
        ));
        $this->ask('Do you want to hear more?', [
            [
                'pattern' => 'yes|yeah|yep|ya',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say(sprintf(config('janbot.skills.paragraph_4'),
                        $this->emojiHelper->display(['chart'])
                    ));
                    $this->bot->typesAndWaits(3);
                    $this->say(config('janbot.skills.paragraph_4_a'));
                    $this->bot->typesAndWaits(3);
                    $this->say(sprintf(config('janbot.skills.question_1'),
                        $this->emojiHelper->display(['heavy check mark'])
                    ));
                    $this->bot->typesAndWaits(3);
                    $this->say(sprintf(config('janbot.skills.question_1_a'),
                        $this->bot->userStorage()->get()->get('name')
                    ));
                    $this->bot->typesAndWaits(3);
                    $this->say(config('janbot.skills.question_1_b'));
                }
            ],
            [
                'pattern' => 'no|nope|na',
                'callback' => function () {
                    $this->bot->typesAndWaits(2);
                    $this->say(sprintf(config('janbot.skills.question_2'),
                        $this->bot->userStorage()->get()->get('name')
                    ));
                    $this->bot->typesAndWaits(2);
                    $this->say(config('janbot.skills.question_2_a'));
                }
            ],
            [
                'pattern' => '.*',
                'callback' => function () {
                    $this->bot->typesAndWaits(3);
                    $this->say('Sorry but i did not understand your answer.');
                    $this->bot->typesAndWaits(3);
                    $newQuestion = Question::create('Do you want to hear more?')
                        ->addButtons([
                            Button::create('Oh yeah')->value('yes'),
                            Button::create('Oh no')->value('no'),
                        ]);
                    $this->repeat($newQuestion);
                }
            ],
        ]);
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->tellAboutSkills();
    }
}
