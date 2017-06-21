<?php

namespace App\Common;

class EmojiHelper
{
    protected $emojis = [
        'smiling face with open mouth' => '&#x1F603;',
        'thumbs up sign' => '&#x1f44d;',
        'winking face' => '&#x1F609;',
        'smiling face with smiling eyes' => '&#x1F60A;',
        'robot face' => '&#x1F916;',
        'weary cat face' => '&#x1F640;',
        'heavy check mark' => '&#x2714;',
        'face with stuck out tongue' => '&#x1F61C;',
        'computer' => '&#x1F4BB;',
        'man' => '&#x1F646;',
        'worker' => '&#x1F477;',
        'target' => '&#x1F3AF;',
        'clapping hands' => '&#x1F44F;',
        'ok hand' => '&#x1F44C;',
        'office building' => '&#x1F3E2;',
        'chart' => '&#x1F4C8;',
        'dog face' => '&#x1F436;',
        'runner' => '&#x1F3C3;',
        'joker' => '&#x1F0CF;',
        'woman shrugging' => '&#x1FE0F;',
        'man shrugging' => '&#x1F937;',
        'money bag' => '&#x1F4B0;',
        'balance scale' => '&#x2696;',
        'calculator' => '&#x1F4DF;',
    ];

    public function display(array $emojis)
    {
        $emojisDecoded = '';
        foreach ($emojis as $emoji) {
            $emojisDecoded .= html_entity_decode($this->emojis[$emoji], 0, 'UTF-8');
        }

        return $emojisDecoded;
    }
}
