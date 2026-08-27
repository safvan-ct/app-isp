<?php

use App\Models\User;
use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    // Clear rate limits before each test
    RateLimiter::clear('api:' . request()->ip());
});

it('can fetch paginated active chapters of a book with translations by default', function () {
    $user = User::factory()->create();

    // Create active book
    $book = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'abbreviation' => 'Bukhari',
        'writer' => 'Al-Bukhari',
        'status' => 'Sahih',
        'group' => 'Sihah al-Sittah',
        'life_span' => '194-256 AH',
        'chapter_count' => 97,
        'hadith_count' => 7563,
        'priority' => 1,
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang' => 'en',
        'name' => 'English Sahih Al-Bukhari',
        'writer' => 'Translator Bukhari',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    // Create active chapter
    $chapter1 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug' => 'revelation',
        'name' => 'Book of Revelation',
        'is_active' => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter1->id,
        'lang' => 'en',
        'name' => 'The Book of Revelation Translation',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    // Create inactive chapter
    $chapter2 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 2,
        'slug' => 'belief',
        'name' => 'Book of Belief Inactive',
        'is_active' => false,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter2->id,
        'lang' => 'en',
        'name' => 'The Book of Belief Inactive Translation',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/{$book->slug}/chapters");

    $response->assertStatus(200);

    // Assert custom nested structure with parent book and selected translation
    $response->assertJsonStructure([
        'book' => [
            'id',
            'name',
            'slug',
            'abbreviation',
            'writer',
            'status',
            'group',
            'life_span',
            'chapter_count',
            'hadith_count',
            'translations' => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'lang',
                    'name',
                    'name_romanized',
                    'writer',
                    'writer_romanized',
                    'status_romanized',
                    'life_span_romanized',
                    'chapter_count_romanized',
                    'hadith_count_romanized',
                    'description',
                ]
            ]
        ],
        'chapters' => [
            'data' => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'chapter_number',
                    'slug',
                    'name',
                    'hadith_count',
                    'translations' => [
                        '*' => [
                            'id',
                            'hadith_chapter_id',
                            'lang',
                            'name',
                            'name_romanized',
                            'description',
                            'hadith_count_romanized',
                        ]
                    ]
                ]
            ],
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['path', 'per_page', 'next_cursor', 'prev_cursor']
        ]
    ]);

    // Assert that inactive chapters are excluded by default
    $response->assertJsonCount(1, 'chapters.data');
    $response->assertJsonPath('chapters.data.0.slug', 'revelation');

    // Assert that date fields and creator info are NOT included in response
    $bookData = $response->json('book');
    expect($bookData)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($bookData['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);

    $chapterData = $response->json('chapters.data.0');
    expect($chapterData)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($chapterData['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
});

it('returns 404 for invalid or inactive book slug', function () {
    $response = $this->getJson('/api/v1/invalid-slug/chapters');
    $response->assertStatus(404);

    $inactiveBook = HadithBook::create([
        'name' => 'Inactive Book',
        'slug' => 'inactive-book',
        'is_active' => false,
    ]);

    $response = $this->getJson("/api/v1/{$inactiveBook->slug}/chapters");
    $response->assertStatus(404);
});

it('can filter chapters by chapter name', function () {
    $user = User::factory()->create();

    $book = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang' => 'en',
        'name' => 'Sahih Al-Bukhari English',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $chapter1 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug' => 'revelation',
        'name' => 'Revelation',
        'is_active' => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter1->id,
        'lang' => 'en',
        'name' => 'Revelation Translation',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $chapter2 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 2,
        'slug' => 'belief',
        'name' => 'Belief',
        'is_active' => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter2->id,
        'lang' => 'en',
        'name' => 'Belief Translation',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/{$book->slug}/chapters?chapter_name=Revelation");
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'chapters.data');
    $response->assertJsonPath('chapters.data.0.slug', 'revelation');
});

it('can filter chapters by translation language', function () {
    $user = User::factory()->create();

    $book = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang' => 'en',
        'name' => 'Sahih Al-Bukhari English',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $chapter1 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug' => 'revelation',
        'name' => 'Revelation',
        'is_active' => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter1->id,
        'lang' => 'en',
        'name' => 'English Revelation',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $chapter2 = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 2,
        'slug' => 'belief',
        'name' => 'Belief',
        'is_active' => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter2->id,
        'lang' => 'bn',
        'name' => 'Bangla Belief',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/{$book->slug}/chapters?translation=en");
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'chapters.data');
    $response->assertJsonPath('chapters.data.0.slug', 'revelation');
    $response->assertJsonPath('chapters.data.0.translations.0.lang', 'en');
    $response->assertJsonPath('book.translations.0.lang', 'en');
});

it('validates request parameters', function () {
    $book = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/{$book->slug}/chapters?per_page=invalid");
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['per_page']);

    $response = $this->getJson("/api/v1/{$book->slug}/chapters?active=not-bool");
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['active']);
});

it('limits request rate', function () {
    $book = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    // 60 requests allowed
    for ($i = 0; $i < 60; $i++) {
        $this->getJson("/api/v1/{$book->slug}/chapters");
    }

    $response = $this->getJson("/api/v1/{$book->slug}/chapters");
    $response->assertStatus(429);
});
