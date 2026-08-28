<?php

use App\Http\Controllers\Api\HadithBookController;
use App\Http\Controllers\Api\HadithChapterController;
use App\Http\Controllers\Api\HadithVerseController;
use App\Http\Controllers\Api\QuranChapterController;
use App\Http\Controllers\Api\QuranVerseController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->prefix('v1')->group(function () {
    // Quran API Routes
    Route::get('/quran/chapters', [QuranChapterController::class, 'index']);
    Route::get('/quran/chapters/{chapter_slug}/verses', [QuranVerseController::class, 'index']);
    Route::get('/quran/chapters/{chapter_slug}/verses/{verse_number}', [QuranVerseController::class, 'show'])->whereNumber('verse_number');

    // Hadith API Routes
    Route::get('/hadith/books', [HadithBookController::class, 'index']);
    Route::get('/hadith/books/{book_slug}/chapters', [HadithChapterController::class, 'index']);
    Route::get('/hadith/books/{book_slug}/chapters/{chapter_slug}/hadiths', [HadithVerseController::class, 'index']);
    Route::get('/hadith/books/{book_slug}/hadiths/{hadees_number}', [HadithVerseController::class, 'show'])->whereNumber('hadees_number');
});
