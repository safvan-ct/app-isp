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

it('can fetch all active chapters of Quran non-paginated', function () {
    $user = User::factory()->create();

    QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    QuranChapter::create([
        'slug'         => 'al-baqarah',
        'name'         => 'Al-Baqarah',
        'revelation'   => 'Medinan',
        'no_of_verses' => 286,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    $response = $this->getJson('/api/v1/quran/chapters?all=true');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('meccan_count', 1)
        ->assertJsonPath('medinan_count', 1)
        ->assertJsonMissingPath('meta')
        ->assertJsonMissingPath('links');
});

it('can fetch minimal fields for Quran chapters', function () {
    $user = User::factory()->create();

    $chapter = QuranChapter::create([
        'id'           => 1,
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

    $response = $this->getJson('/api/v1/quran/chapters?minimal=true');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'slug',
                    'title',
                    'translation',
                    'name',
                ],
            ],
        ]);

    $data = $response->json('data.0');
    expect($data)->not->toHaveKey('revelation')
        ->and($data)->not->toHaveKey('no_of_verses')
        ->and($data)->not->toHaveKey('translations')
        ->and($data['id'])->toBe(1)
        ->and($data['slug'])->toBe('al-fatihah')
        ->and($data['title'])->toBe('Al-Fatihah')
        ->and($data['translation'])->toBe('The Opening')
        ->and($data['name'])->toBe('Al-Fatihah');
});

it('returns filtered counts for Meccan and Medinan chapters', function () {
    $user = User::factory()->create();

    QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    QuranChapter::create([
        'slug'         => 'al-baqarah',
        'name'         => 'Al-Baqarah',
        'revelation'   => 'Medinan',
        'no_of_verses' => 286,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    // Filter by name matching Fatihah (should return only 1 Meccan chapter)
    $response = $this->getJson('/api/v1/quran/chapters?chapter_name=Fatihah');

    $response->assertStatus(200)
        ->assertJsonPath('meccan_count', 1)
        ->assertJsonPath('medinan_count', 0);
});

it('can filter chapters by revelation type', function () {
    $user = User::factory()->create();

    QuranChapter::create([
        'slug'         => 'al-fatihah',
        'name'         => 'Al-Fatihah',
        'revelation'   => 'Meccan',
        'no_of_verses' => 7,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    QuranChapter::create([
        'slug'         => 'al-baqarah',
        'name'         => 'Al-Baqarah',
        'revelation'   => 'Medinan',
        'no_of_verses' => 286,
        'juz'          => '1',
        'is_active'    => true,
    ]);

    // Test filtering by mecca
    $response = $this->getJson('/api/v1/quran/chapters?revelation=mecca&all=true');
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.slug', 'al-fatihah')
        ->assertJsonPath('meccan_count', 1)
        ->assertJsonPath('medinan_count', 0);

    // Test filtering by median
    $response = $this->getJson('/api/v1/quran/chapters?revelation=median&all=true');
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.slug', 'al-baqarah')
        ->assertJsonPath('meccan_count', 0)
        ->assertJsonPath('medinan_count', 1);

    // Test filtering by all
    $response = $this->getJson('/api/v1/quran/chapters?revelation=all&all=true');
    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});
