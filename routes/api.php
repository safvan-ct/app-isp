<?php

use App\Http\Controllers\Api\HadithBookController;
use App\Http\Controllers\Api\HadithChapterController;
use App\Http\Controllers\Api\HadithVerseController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->prefix('v1')->group(function () {
    Route::get('/hadith-books', [HadithBookController::class, 'index']);
    Route::get('/{book_slug}/chapters', [HadithChapterController::class, 'index']);
    Route::get('/{book_slug}/{hadees_number}', [HadithVerseController::class, 'show'])->where('hadees_number', '[0-9]+');
    Route::get('/{book_slug}/{chapter_slug}', [HadithVerseController::class, 'index']);
});
