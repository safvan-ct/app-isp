<?php
namespace App\Providers;


use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithBookRepository;
use App\Repository\Hadith\HadithBookTranslationInterface;
use App\Repository\Hadith\HadithBookTranslationRepository;
use App\Repository\Hadith\HadithChapterInterface;
use App\Repository\Hadith\HadithChapterRepository;
use App\Repository\Hadith\HadithChapterTranslationInterface;
use App\Repository\Hadith\HadithChapterTranslationRepository;
use App\Repository\Hadith\HadithVerseInterface;
use App\Repository\Hadith\HadithVerseRepository;
use App\Repository\Hadith\HadithVerseTranslationInterface;
use App\Repository\Hadith\HadithVerseTranslationRepository;

use App\Repository\Quran\QuranChapterInterface;
use App\Repository\Quran\QuranChapterRepository;
use App\Repository\Quran\QuranChapterTranslationInterface;
use App\Repository\Quran\QuranChapterTranslationRepository;
use App\Repository\Quran\QuranVerseInterface;
use App\Repository\Quran\QuranVerseRepository;
use App\Repository\Quran\QuranVerseTranslationInterface;
use App\Repository\Quran\QuranVerseTranslationRepository;
use App\Repository\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use App\Repository\Settings\SettingsInterface;
use App\Repository\Settings\SettingsRepository;
use App\Repository\User\UserInterface;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SettingsInterface::class, SettingsRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);

        $this->app->bind(QuranChapterInterface::class, QuranChapterRepository::class);
        $this->app->bind(QuranChapterTranslationInterface::class, QuranChapterTranslationRepository::class);
        $this->app->bind(QuranVerseInterface::class, QuranVerseRepository::class);
        $this->app->bind(QuranVerseTranslationInterface::class, QuranVerseTranslationRepository::class);

        $this->app->bind(HadithBookInterface::class, HadithBookRepository::class);
        $this->app->bind(HadithBookTranslationInterface::class, HadithBookTranslationRepository::class);
        $this->app->bind(HadithChapterInterface::class, HadithChapterRepository::class);
        $this->app->bind(HadithChapterTranslationInterface::class, HadithChapterTranslationRepository::class);
        $this->app->bind(HadithVerseInterface::class, HadithVerseRepository::class);
        $this->app->bind(HadithVerseTranslationInterface::class, HadithVerseTranslationRepository::class);

        $this->app->bind(\App\Repository\Course\CourseInterface::class, \App\Repository\Course\CourseRepository::class);
        $this->app->bind(\App\Repository\Course\CourseTranslationInterface::class, \App\Repository\Course\CourseTranslationRepository::class);
        $this->app->bind(\App\Repository\Course\ChapterInterface::class, \App\Repository\Course\ChapterRepository::class);
        $this->app->bind(\App\Repository\Course\ChapterTranslationInterface::class, \App\Repository\Course\ChapterTranslationRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
