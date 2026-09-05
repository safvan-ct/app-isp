<?php


use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\QuranController;

use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

// ------------------------------
// General Pages
// ------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('calendar', [HomeController::class, 'calendar'])->name('calendar');
Route::get('change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

Route::get('/contact', [HomeController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [HomeController::class, 'sendMail'])->name('contact.send');

// ------------------------------
// Fetch (AJAX / API-like Endpoints)
// ------------------------------
Route::prefix('fetch')->name('fetch.')->group(function () {
    // Quran
    Route::controller(QuranFetchController::class)->group(function () {
        Route::get('quran-chapters', 'fetchChapters')->name('quran.chapters');
        Route::get('quran-ayahs', 'fetchVerses')->name('quran.ayahs');
        Route::get('quran-verse/{id}', 'fetchVerseById')->name('quran.verse');
        Route::get('quran-reference/{slug}/{number}', 'fetchReference')->name('quran.reference');
    });

    // Hadith
    Route::controller(HadithFetchController::class)->group(function () {
        Route::get('hadith-books', 'fetchBooks')->name('hadith.books');
        Route::get('hadith-chapters', 'fetchChapters')->name('hadith.chapters');
        Route::get('hadith-verses', 'fetchVerses')->name('hadith.verses');
        Route::get('hadith-verse/{id}', 'fetchVerse')->name('hadith.verse');
        Route::get('hadith-reference/{slug}/{number}', 'fetchReference')->name('hadith.reference');
    });

});



// ------------------------------
// Quran Routes
// ------------------------------
Route::controller(QuranController::class)->prefix('quran')->name('quran.')->group(function () {
    Route::get('/', 'quran')->name('index');
    Route::get('{id}', 'quranChapter')->name('chapter');
});

// ------------------------------
// Hadith Routes
// ------------------------------
Route::controller(HadithController::class)->prefix('hadith')->name('hadith.')->group(function () {
    Route::get('/', 'hadith')->name('index');
    Route::get('{book}/chapters/{chapter?}', 'hadithChapters')->name('chapters');
    Route::get('{book}/chapter/{chapter}', 'hadithChapterVerses')->name('chapter.verses');
    Route::get('{book}/verse/{verse}', 'hadithVerseByNumber')->name('book.verse');
});
