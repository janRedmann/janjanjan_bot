<?php

namespace App\Conversations;

class WorkExperienceConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }
    public function tellAboutWorkExperience()
    {
        $this->bot->typesAndWaits(3);
        $this->say(sprintf(config('janbot.work_experience.introduction'),
            $this->bot->userStorage()->get()->get('name'),
            $this->emojiHelper->display(['worker'])
        ));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_1'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_1_a'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_1_b'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_2'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_3'));
        $this->bot->typesAndWaits(3);
        $this->say(config('janbot.work_experience.paragraph_3_a'));
        $this->bot->typesAndWaits(3);
        $this->say(sprintf(config('janbot.work_experience.question'),
            $this->emojiHelper->display(['heavy check mark']),
            $this->bot->userStorage()->get()->get('name')
        ));
    }

    public function run()
    {
        $this->tellAboutWorkExperience();
    }
}
