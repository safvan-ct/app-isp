<?php

return [
    'type_map'         => [
        'quran'  => App\Models\QuranVerse::class,
        'hadith' => App\Models\HadithVerse::class,
        'topic'  => App\Models\Topic::class,
    ],

    'topic_parent_map' => [
        'menu'     => null,
        'module'   => 'menu',
        'question' => 'module',
        'answer'   => 'question',
    ],
];
