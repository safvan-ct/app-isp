<?php

use App\Http\Controllers\Api\HadithBookController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {
    Route::get('/hadith-books', [HadithBookController::class, 'index']);
});
