<?php

namespace App\Common;

class EmojiHelper
{
    protected $emojis = [
        'smiling face with open mouth' => '&#x1F603;',
        'thumbsUp' => '&#x1f44d;',
        'winking face' => '&#x1F609',
        'smiling face with smiling eyes' => '&#x1F60A',

    ];

    public function display($emoji)
    {
        return html_entity_decode($this->emojis[$emoji], 0, 'UTF-8');
    }
}
