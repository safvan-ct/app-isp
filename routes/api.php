<?php

use App\Http\Controllers\Api\HadithBookController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->prefix('v1')->group(function () {
    Route::get('/hadith-books', [HadithBookController::class, 'index']);
});
