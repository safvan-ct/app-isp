<?php
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseTranslationController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HadithBookController;
use App\Http\Controllers\Admin\HadithBookTranslationController;
use App\Http\Controllers\Admin\HadithChapterController;
use App\Http\Controllers\Admin\HadithChapterTranslationController;
use App\Http\Controllers\Admin\HadithVerseController;
use App\Http\Controllers\Admin\HadithVerseTranslationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\QuranChapterController;
use App\Http\Controllers\Admin\QuranChapterTranslationController;
use App\Http\Controllers\Admin\QuranVerseController;
use App\Http\Controllers\Admin\QuranVerseTranslationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StaffController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['redirect.authenticated', 'guest'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'not.customer'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('password.confirm')->group(function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');

    // Quran
    Route::get('quran-chapters/dataTable', [QuranChapterController::class, 'dataTable'])->name('quran-chapters.dataTable');
    Route::patch('quran-chapters/status/{id}', [QuranChapterController::class, 'status'])->name('quran-chapters.status');
    Route::resource('quran-chapters', QuranChapterController::class)->only('index', 'update');

    Route::get('quran-chapter-translations/dataTable', [QuranChapterTranslationController::class, 'dataTable'])->name('quran-chapter-translations.dataTable');
    Route::get('quran-chapter-translations/{chapter}/{translation?}', [QuranChapterTranslationController::class, 'index'])->name('quran-chapter-translations.index');
    Route::patch('quran-chapter-translations/status/{id}', [QuranChapterTranslationController::class, 'status'])->name('quran-chapter-translations.status');
    Route::resource('quran-chapter-translations', QuranChapterTranslationController::class)->only('store', 'update');

    Route::get('quran-verses/dataTable', [QuranVerseController::class, 'dataTable'])->name('quran-verses.dataTable');
    Route::patch('quran-verses/status/{id}', [QuranVerseController::class, 'status'])->name('quran-verses.status');
    Route::resource('quran-verses', QuranVerseController::class)->only('index', 'update');

    Route::patch('quran-verse-translations/{id}/status', [QuranVerseTranslationController::class, 'status'])->name('quran-verse-translations.status');
    Route::put('quran-verse-translations/update/{quran_verse_translation}', [QuranVerseTranslationController::class, 'update'])->name('quran-verse-translations.update');
    // End Quran

    // Hadith
    Route::get('hadith-books/dataTable', [HadithBookController::class, 'dataTable'])->name('hadith-books.dataTable');
    Route::post('hadith-books/import', [HadithBookController::class, 'import'])->name('hadith-books.import');
    Route::post('hadith-books/reset-counts', [HadithBookController::class, 'resetCounts'])->name('hadith-books.reset-counts');
    Route::patch('hadith-books/status/{id}', [HadithBookController::class, 'status'])->name('hadith-books.status');
    Route::resource('hadith-books', HadithBookController::class)->only('index', 'update');

    Route::get('hadith-book-translations/dataTable', [HadithBookTranslationController::class, 'dataTable'])->name('hadith-book-translations.dataTable');
    Route::get('hadith-book-translations/{chapter}/{translation?}', [HadithBookTranslationController::class, 'index'])->name('hadith-book-translations.index');
    Route::patch('hadith-book-translations/status/{id}', [HadithBookTranslationController::class, 'status'])->name('hadith-book-translations.status');
    Route::resource('hadith-book-translations', HadithBookTranslationController::class)->only('store', 'update');

    Route::get('hadith-chapters/dataTable', [HadithChapterController::class, 'dataTable'])->name('hadith-chapters.dataTable');
    Route::post('hadith-chapters/import', [HadithChapterController::class, 'import'])->name('hadith-chapters.import');
    Route::post('hadith-chapters/reset-counts', [HadithChapterController::class, 'resetCounts'])->name('hadith-chapters.reset-counts');
    Route::patch('hadith-chapters/status/{id}', [HadithChapterController::class, 'status'])->name('hadith-chapters.status');
    Route::resource('hadith-chapters', HadithChapterController::class)->only('index', 'update');

    Route::get('hadith-chapter-translations/dataTable', [HadithChapterTranslationController::class, 'dataTable'])->name('hadith-chapter-translations.dataTable');
    Route::get('hadith-chapter-translations/{chapter}/{translation?}', [HadithChapterTranslationController::class, 'index'])->name('hadith-chapter-translations.index');
    Route::patch('hadith-chapter-translations/status/{id}', [HadithChapterTranslationController::class, 'status'])->name('hadith-chapter-translations.status');
    Route::resource('hadith-chapter-translations', HadithChapterTranslationController::class)->only('store', 'update');

    Route::get('hadith-verses/dataTable', [HadithVerseController::class, 'dataTable'])->name('hadith-verses.dataTable');
    Route::post('hadith-verses/import', [HadithVerseController::class, 'import'])->name('hadith-verses.import');
    Route::post('hadith-verses/import-json', [HadithVerseController::class, 'importJson'])->name('hadith-verses.import-json');
    Route::get('hadith-verses/import-log', [HadithVerseController::class, 'importLog'])->name('hadith-verses.import-log');
    Route::get('hadith-verses/chapter/{book}', [HadithVerseController::class, 'chapter'])->name('hadith-verses.chapter');
    Route::patch('hadith-verses/status/{id}', [HadithVerseController::class, 'status'])->name('hadith-verses.status');
    Route::resource('hadith-verses', HadithVerseController::class)->only('index', 'update');

    Route::get('hadith-verse-translations/dataTable', [HadithVerseTranslationController::class, 'dataTable'])->name('hadith-verse-translations.dataTable');
    Route::get('hadith-verse-translations/{chapter}/{translation?}', [HadithVerseTranslationController::class, 'index'])->name('hadith-verse-translations.index');
    Route::patch('hadith-verse-translations/status/{id}', [HadithVerseTranslationController::class, 'status'])->name('hadith-verse-translations.status');
    Route::resource('hadith-verse-translations', HadithVerseTranslationController::class)->only('store', 'update');
    // End Hadith


    // Courses
    Route::get('courses/dataTable', [CourseController::class, 'dataTable'])->name('courses.dataTable');
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::patch('courses/status/{course}', [CourseController::class, 'status'])->name('courses.status');
    Route::post('courses/sort', [CourseController::class, 'sort'])->name('courses.sort');
    Route::post('courses/store', [CourseController::class, 'store'])->name('courses.store');
    Route::put('courses/update/{course}', [CourseController::class, 'update'])->name('courses.update');

    // Course Translations
    Route::get('course-translations/dataTable', [CourseTranslationController::class, 'dataTable'])->name('course-translations.dataTable');
    Route::get('course-translations/{course_id}/{translation?}', [CourseTranslationController::class, 'index'])->name('course-translations.index');
    Route::patch('course-translations/status/{id}', [CourseTranslationController::class, 'status'])->name('course-translations.status');
    Route::resource('course-translations', CourseTranslationController::class)->only('store', 'update');

    Route::get('users/datatable', [UserController::class, 'dataTable'])->name('users.datatable');
    Route::patch('users/{user}/active', [UserController::class, 'active'])->name('users.active');
    Route::resource('users', UserController::class)->except('show', 'create', 'edit');

    Route::get('staffs/datatable', [StaffController::class, 'dataTable'])->name('staffs.datatable');
    Route::patch('staffs/{staff}/active', [StaffController::class, 'active'])->name('staffs.active');
    Route::resource('staffs', StaffController::class)->except('show', 'create', 'edit');

    Route::get('settings/datatable', [SettingsController::class, 'dataTable'])->name('settings.datatable');
    Route::resource('settings', SettingsController::class)->except('show', 'create', 'edit');

    Route::get('roles/datatable', [RoleController::class, 'dataTable'])->name('roles.datatable');
    Route::resource('roles', RoleController::class)->except('show', 'create', 'edit');

    Route::middleware('role:Developer')->group(function () {
        Route::get('permissions/datatable', [PermissionController::class, 'dataTable'])->name('permissions.datatable');
        Route::resource('permissions', PermissionController::class)->except('show', 'create', 'edit');
    });

    Route::get('activity-log/{logName?}/{eventName?}/{causerId?}/{subjectId?}', [DashboardController::class, 'activityLog'])->name('activity-log');
});
