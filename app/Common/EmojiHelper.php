<?php

namespace App\Common;

class EmojiHelper
{
    protected $emojis = [
        'smileyFace' => '&#x1F603;',
        'thumbsUp' => '&#x1f44d;'
    ];

    public function display($emoji)
    {
        return html_entity_decode($this->emojis[$emoji], 0, 'UTF-8');
    }
}
