<?php

use App\Http\Controllers\Api\HadithBookController;
use App\Http\Controllers\Api\HadithChapterController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->prefix('v1')->group(function () {
    Route::get('/hadith-books', [HadithBookController::class, 'index']);
    Route::get('/{book_slug}/chapters', [HadithChapterController::class, 'index']);
});
