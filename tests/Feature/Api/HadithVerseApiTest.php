<?php

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use App\Models\HadithVerse;
use App\Models\HadithVerseTranslation;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    // Clear rate limits before each test
    RateLimiter::clear('api:' . request()->ip());
});

it('can fetch paginated active verses of a chapter with translations by default', function () {
    $user = User::factory()->create();

    // Create active book
    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang'           => 'en',
        'name'           => 'English Sahih Al-Bukhari',
        'created_by'     => $user->id,
        'is_active'      => true,
    ]);

    // Create active chapter
    $chapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Book of Revelation',
        'is_active'      => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter->id,
        'lang'              => 'en',
        'name'              => 'The Book of Revelation Translation',
        'created_by'        => $user->id,
        'is_active'         => true,
    ]);

    // Create active verse
    $verse1 = HadithVerse::create([
        'hadith_book_id'    => $book->id,
        'hadith_chapter_id' => $chapter->id,
        'chapter_number'    => 1,
        'hadith_number'     => 1,
        'heading'           => 'Action by intentions',
        'text'              => 'Actions are but by intentions...',
        'is_active'         => true,
    ]);

    HadithVerseTranslation::create([
        'hadith_verse_id' => $verse1->id,
        'lang'            => 'en',
        'narrator'        => 'Umar bin Al-Khattab',
        'heading'         => 'Intentions',
        'text'            => 'I heard Allah Messenger saying...',
        'created_by'      => $user->id,
        'is_active'       => true,
    ]);

    // Create inactive verse
    $verse2 = HadithVerse::create([
        'hadith_book_id'    => $book->id,
        'hadith_chapter_id' => $chapter->id,
        'chapter_number'    => 1,
        'hadith_number'     => 2,
        'heading'           => 'Inactive Verse Heading',
        'text'              => 'Inactive Verse Text...',
        'is_active'         => false,
    ]);

    HadithVerseTranslation::create([
        'hadith_verse_id' => $verse2->id,
        'lang'            => 'en',
        'narrator'        => 'Narrator',
        'heading'         => 'Heading',
        'text'            => 'Translation',
        'created_by'      => $user->id,
        'is_active'       => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths");

    $response->assertStatus(200);

    // Assert custom nested structure with parent book, parent chapter, and verses
    $response->assertJsonStructure([
        'book'    => [
            'id',
            'name',
            'slug',
            'translations' => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'lang',
                    'name',
                    'description',
                ],
            ],
        ],
        'chapter' => [
            'id',
            'hadith_book_id',
            'chapter_number',
            'slug',
            'name',
            'translations' => [
                '*' => [
                    'id',
                    'hadith_chapter_id',
                    'lang',
                    'name',
                    'description',
                ],
            ],
        ],
        'verses'  => [
            'data'  => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'hadith_chapter_id',
                    'chapter_number',
                    'hadith_number',
                    'heading',
                    'text',
                    'volume',
                    'status',
                    'translations' => [
                        '*' => [
                            'id',
                            'hadith_verse_id',
                            'lang',
                            'narrator',
                            'heading',
                            'text',
                        ],
                    ],
                ],
            ],
            'links' => ['first', 'last', 'prev', 'next'],
            'meta'  => ['path', 'per_page', 'next_cursor', 'prev_cursor'],
        ],
    ]);

    // Assert that inactive verses are excluded by default
    $response->assertJsonCount(1, 'verses.data');
    $response->assertJsonPath('verses.data.0.hadith_number', 1);

    // Assert that date fields and creator info are NOT included in response
    $bookData = $response->json('book');
    expect($bookData)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($bookData['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);

    $chapterData = $response->json('chapter');
    expect($chapterData)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($chapterData['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);

    $verseData = $response->json('verses.data.0');
    expect($verseData)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($verseData['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
});

it('returns 404 for invalid or inactive slugs', function () {
    $response = $this->getJson('/api/v1/hadith/books/invalid-book/chapters/invalid-chapter/hadiths');
    $response->assertStatus(404);

    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/invalid-chapter/hadiths");
    $response->assertStatus(404);

    $inactiveChapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Revelation',
        'is_active'      => false,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$inactiveChapter->slug}/hadiths");
    $response->assertStatus(404);
});

it('can filter verses by translation language', function () {
    $user = User::factory()->create();

    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang'           => 'en',
        'name'           => 'Sahih Al-Bukhari English',
        'created_by'     => $user->id,
        'is_active'      => true,
    ]);

    $chapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Revelation',
        'is_active'      => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter->id,
        'lang'              => 'en',
        'name'              => 'Revelation Translation',
        'created_by'        => $user->id,
        'is_active'         => true,
    ]);

    $verse1 = HadithVerse::create([
        'hadith_book_id'    => $book->id,
        'hadith_chapter_id' => $chapter->id,
        'chapter_number'    => 1,
        'hadith_number'     => 1,
        'is_active'         => true,
    ]);

    HadithVerseTranslation::create([
        'hadith_verse_id' => $verse1->id,
        'lang'            => 'en',
        'narrator'        => 'Umar',
        'text'            => 'English Text',
        'created_by'      => $user->id,
        'is_active'       => true,
    ]);

    HadithVerseTranslation::create([
        'hadith_verse_id' => $verse1->id,
        'lang'            => 'bn',
        'narrator'        => 'Umar',
        'text'            => 'Bangla Text',
        'created_by'      => $user->id,
        'is_active'       => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths?translation=en");
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'verses.data');
    $response->assertJsonPath('verses.data.0.translations.0.lang', 'en');
    $response->assertJsonPath('book.translations.0.lang', 'en');
    $response->assertJsonPath('chapter.translations.0.lang', 'en');
});

it('validates request parameters', function () {
    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $chapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Revelation',
        'is_active'      => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths?per_page=invalid");
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['per_page']);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths?active=not-bool");
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['active']);
});

it('limits request rate', function () {
    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $chapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Revelation',
        'is_active'      => true,
    ]);

    // 60 requests allowed
    for ($i = 0; $i < 60; $i++) {
        $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths");
    }

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/chapters/{$chapter->slug}/hadiths");
    $response->assertStatus(429);
});

it('can fetch a single Hadith verse by hadith number', function () {
    $user = User::factory()->create();

    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book->id,
        'lang'           => 'en',
        'name'           => 'English Sahih Al-Bukhari',
        'created_by'     => $user->id,
        'is_active'      => true,
    ]);

    $chapter = HadithChapter::create([
        'hadith_book_id' => $book->id,
        'chapter_number' => 1,
        'slug'           => 'revelation',
        'name'           => 'Book of Revelation',
        'is_active'      => true,
    ]);

    HadithChapterTranslation::create([
        'hadith_chapter_id' => $chapter->id,
        'lang'              => 'en',
        'name'              => 'The Book of Revelation Translation',
        'created_by'        => $user->id,
        'is_active'         => true,
    ]);

    $verse = HadithVerse::create([
        'hadith_book_id'    => $book->id,
        'hadith_chapter_id' => $chapter->id,
        'chapter_number'    => 1,
        'hadith_number'     => 5,
        'heading'           => 'Verse Heading',
        'text'              => 'Verse Text',
        'is_active'         => true,
    ]);

    HadithVerseTranslation::create([
        'hadith_verse_id' => $verse->id,
        'lang'            => 'en',
        'narrator'        => 'Umar',
        'heading'         => 'Intentions',
        'text'            => 'I heard...',
        'created_by'      => $user->id,
        'is_active'       => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/hadiths/5");

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'book'    => [
            'id',
            'name',
            'slug',
            'translations' => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'lang',
                    'name',
                ],
            ],
        ],
        'chapter' => [
            'id',
            'hadith_book_id',
            'chapter_number',
            'slug',
            'name',
            'translations' => [
                '*' => [
                    'id',
                    'hadith_chapter_id',
                    'lang',
                    'name',
                ],
            ],
        ],
        'verses'  => [
            'data' => [
                '*' => [
                    'id',
                    'hadith_book_id',
                    'hadith_chapter_id',
                    'chapter_number',
                    'hadith_number',
                    'heading',
                    'text',
                    'volume',
                    'status',
                    'translations' => [
                        '*' => [
                            'id',
                            'hadith_verse_id',
                            'lang',
                            'narrator',
                            'heading',
                            'text',
                        ],
                    ],
                ],
            ],
        ],
    ]);

    $response->assertJsonPath('verses.data.0.hadith_number', 5);

    // Assert dates are removed
    expect($response->json('verses.data.0'))->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
});

it('returns 404 for invalid hadith number or inactive verse', function () {
    $book = HadithBook::create([
        'name'      => 'Sahih Al-Bukhari',
        'slug'      => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $response = $this->getJson("/api/v1/hadith/books/{$book->slug}/hadiths/999");
    $response->assertStatus(404);
});
