<?php

namespace App\Conversations;

class GoalsConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    public function tellAboutGoals()
    {
        $this->bot->typesAndWaits('2');
        $this->say(sprintf(config('janbot.goals.paragraph_1'),
            $this->emojiHelper->display(['target'])
        ));
        $this->bot->typesAndWaits('2');
        $this->say(config('janbot.goals.paragraph_1_a'));
        $this->bot->typesAndWaits('2');
        $this->say(config('janbot.goals.paragraph_1_b'));
        $this->bot->typesAndWaits('2');
        $this->say(config('janbot.goals.paragraph_1_c'));
        $this->bot->typesAndWaits('2');
        $this->say(sprintf(config('janbot.goals.paragraph_2'),
            $this->bot->userStorage()->get()->get('company'),
            $this->emojiHelper->display(['winking face'])
        ));
        $this->bot->typesAndWaits('2');
        $this->say(sprintf(config('janbot.goals.paragraph_3'),
            $this->emojiHelper->display(['heavy check mark']),
            $this->bot->userStorage()->get()->get('name')
        ));

    }

    public function run()
    {
        $this->tellAboutGoals();
    }
}
