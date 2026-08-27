<?php

use App\Models\User;
use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    // Clear rate limits before each test
    RateLimiter::clear('api:' . request()->ip());
});

it('can fetch paginated active hadith books with translations by default', function () {
    $user = User::factory()->create();

    // Create active book
    $book1 = HadithBook::create([
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
        'hadith_book_id' => $book1->id,
        'lang' => 'en',
        'name' => 'English Sahih Al-Bukhari',
        'writer' => 'Translator Bukhari',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    // Create inactive book
    $book2 = HadithBook::create([
        'name' => 'Sahih Muslim Inactive',
        'slug' => 'sahih-muslim-inactive',
        'is_active' => false,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $book2->id,
        'lang' => 'en',
        'name' => 'English Sahih Muslim',
        'writer' => 'Translator Muslim',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $response = $this->getJson('/api/hadith-books');

    $response->assertStatus(200);
    
    // Assert pagination structure
    $response->assertJsonStructure([
        'data' => [
            '*' => [
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
                'priority',
                'is_active',
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
                        'is_active'
                    ]
                ]
            ]
        ],
        'links',
        'meta'
    ]);

    // Assert that inactive books are excluded by default
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.slug', 'sahih-al-bukhari');

    // Assert that date fields and creator info are NOT included in response
    $data = $response->json('data.0');
    expect($data)->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
    expect($data['translations'][0])->not->toHaveKeys(['created_at', 'updated_at', 'created_by']);
});

it('can filter books by book name', function () {
    $user = User::factory()->create();

    $bukhari = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    $muslim = HadithBook::create([
        'name' => 'Sahih Muslim',
        'slug' => 'sahih-muslim',
        'is_active' => true,
    ]);

    $response = $this->getJson('/api/hadith-books?book_name=Bukhari');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.slug', 'sahih-al-bukhari');
});

it('can filter books by translation language', function () {
    $user = User::factory()->create();

    $bukhari = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $bukhari->id,
        'lang' => 'en',
        'name' => 'English Bukhari',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $muslim = HadithBook::create([
        'name' => 'Sahih Muslim',
        'slug' => 'sahih-muslim',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $muslim->id,
        'lang' => 'bn',
        'name' => 'Bangla Muslim',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    // Request english translation
    $response = $this->getJson('/api/hadith-books?translation=en');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.slug', 'sahih-al-bukhari');
    $response->assertJsonPath('data.0.translations.0.lang', 'en');
});

it('can filter books by translation name', function () {
    $user = User::factory()->create();

    $bukhari = HadithBook::create([
        'name' => 'Sahih Al-Bukhari',
        'slug' => 'sahih-al-bukhari',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $bukhari->id,
        'lang' => 'en',
        'name' => 'The Book of Bukhari',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $muslim = HadithBook::create([
        'name' => 'Sahih Muslim',
        'slug' => 'sahih-muslim',
        'is_active' => true,
    ]);

    HadithBookTranslation::create([
        'hadith_book_id' => $muslim->id,
        'lang' => 'en',
        'name' => 'The Book of Muslim',
        'created_by' => $user->id,
        'is_active' => true,
    ]);

    $response = $this->getJson('/api/hadith-books?translation_name=Bukhari');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.slug', 'sahih-al-bukhari');
});

it('validates request parameters', function () {
    $response = $this->getJson('/api/hadith-books?per_page=invalid');
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['per_page']);

    $response = $this->getJson('/api/hadith-books?active=not-bool');
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['active']);
});

it('limits request rate', function () {
    // We can simulate hitting the limit. 60 requests are allowed.
    for ($i = 0; $i < 60; $i++) {
        $this->getJson('/api/hadith-books');
    }

    $response = $this->getJson('/api/hadith-books');
    $response->assertStatus(429);
});
