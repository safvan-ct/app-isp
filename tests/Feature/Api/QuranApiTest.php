<?php

use App\Models\QuranChapter;
use App\Models\QuranChapterTranslation;
use App\Models\QuranVerse;
use App\Models\QuranVerseTranslation;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    RateLimiter::clear('api:' . request()->ip());
});

it('can fetch paginated active chapters of Quran with translations', function () {
    $user = User::factory()->create();

    $chapter = QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    QuranChapterTranslation::create([
        'quran_chapter_id'       => $chapter->id,
        'lang'                   => 'en',
        'name'                   => 'The Opening',
        'name_tr'                => 'Al-Fatihah',
        'revelation_romanized'   => 'Meccan',
        'no_of_verses_romanized' => '7',
        'juz_romanized'          => '1',
        'created_by'             => $user->id,
        'is_active'              => true,
    ]);

    $response = $this->getJson('/api/v1/quran/chapters');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'slug',
                    'name',
                    'revelation',
                    'no_of_verses',
                    'juz',
                    'translations' => [
                        '*' => [
                            'id',
                            'quran_chapter_id',
                            'lang',
                            'name',
                            'name_tr',
                            'revelation_romanized',
                            'no_of_verses_romanized',
                            'juz_romanized',
                            'direction',
                        ],
                    ],
                ],
            ],
            'links',
            'meta',
        ]);
});

it('can fetch verses of a Quran chapter', function () {
    $user = User::factory()->create();

    $chapter = QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    $verse = QuranVerse::create([
        'quran_chapter_id'  => $chapter->id,
        'number_in_chapter' => 1,
        'text'              => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ',
        'juz'               => 1,
        'manzil'            => 1,
        'ruku'              => 1,
        'hizb_quarter'      => 1,
        'sajda'             => 0,
        'is_active'         => true,
    ]);

    QuranVerseTranslation::create([
        'quran_chapter_id'  => $chapter->id,
        'quran_verse_id'    => $verse->id,
        'number_in_chapter' => 1,
        'lang'              => 'en',
        'text'              => 'In the name of Allah, the Entirely Merciful, the Especially Merciful.',
        'text_romanized'    => 'Bismillaahir Rahmaanir Raheem',
        'created_by'        => $user->id,
        'is_active'         => true,
    ]);

    $response = $this->getJson("/api/v1/quran/chapters/{$chapter->slug}/verses");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'chapter' => [
                'id',
                'slug',
                'name',
                'revelation',
                'no_of_verses',
                'juz',
            ],
            'verses'  => [
                'data' => [
                    '*' => [
                        'id',
                        'quran_chapter_id',
                        'number_in_chapter',
                        'text',
                        'juz',
                        'manzil',
                        'ruku',
                        'hizb_quarter',
                        'sajda',
                        'translations' => [
                            '*' => [
                                'id',
                                'quran_chapter_id',
                                'quran_verse_id',
                                'number_in_chapter',
                                'lang',
                                'text',
                                'text_romanized',
                                'direction',
                            ],
                        ],
                    ],
                ],
                'links',
                'meta',
            ],
        ]);
});

it('can fetch a single Quran verse by number', function () {
    $user = User::factory()->create();

    $chapter = QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    $verse = QuranVerse::create([
        'quran_chapter_id'  => $chapter->id,
        'number_in_chapter' => 1,
        'text'              => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ',
        'juz'               => 1,
        'manzil'            => 1,
        'ruku'              => 1,
        'hizb_quarter'      => 1,
        'sajda'             => 0,
        'is_active'         => true,
    ]);

    QuranVerseTranslation::create([
        'quran_chapter_id'  => $chapter->id,
        'quran_verse_id'    => $verse->id,
        'number_in_chapter' => 1,
        'lang'              => 'en',
        'text'              => 'In the name of Allah, the Entirely Merciful, the Especially Merciful.',
        'text_romanized'    => 'Bismillaahir Rahmaanir Raheem',
        'created_by'        => $user->id,
        'is_active'         => true,
    ]);

    $response = $this->getJson("/api/v1/quran/chapters/{$chapter->slug}/verses/1");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'chapter' => [
                'id',
                'slug',
                'name',
                'revelation',
                'no_of_verses',
                'juz',
            ],
            'verses'  => [
                'data' => [
                    '*' => [
                        'id',
                        'quran_chapter_id',
                        'number_in_chapter',
                        'text',
                        'juz',
                        'manzil',
                        'ruku',
                        'hizb_quarter',
                        'sajda',
                        'translations' => [
                            '*' => [
                                'id',
                                'quran_chapter_id',
                                'quran_verse_id',
                                'number_in_chapter',
                                'lang',
                                'text',
                                'text_romanized',
                                'direction',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
});
