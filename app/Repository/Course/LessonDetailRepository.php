<?php
namespace App\Repository\Course;

use App\Models\HadithBook;
use App\Models\HadithVerse;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\LessonReference;
use App\Models\LessonReferenceHadith;
use App\Models\LessonReferenceQuran;
use App\Models\QuranChapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class LessonDetailRepository implements LessonDetailInterface
{
    public function getLesson(int | string $lessonId): Lesson
    {
        return Lesson::with([
            'chapter.course.translations',
            'chapter.translations',
            'translations',
            'allContents',
            'allReferences.allQuranReferences.surah',
            'allReferences.allHadithReferences.hadithVerse.book',
        ])->findOrFail($lessonId);
    }

    public function getLessonReferences(int | string $lessonId): Collection
    {
        return LessonReference::where('lesson_id', $lessonId)->orderBy('id')->get();
    }

    public function getSurahs(): Collection
    {
        $locale = app()->getLocale();

        return QuranChapter::with(['translations' => function ($query) use ($locale) {
            $query->where('lang', $locale);
        }])->orderBy('id')->get();
    }

    public function getHadithBooks(): Collection
    {
        $locale = app()->getLocale();

        return HadithBook::with(['translations' => function ($query) use ($locale) {
            $query->where('lang', $locale);
        }])->orderBy('id')->get();
    }

    public function searchHadithVerses(?string $query = null, ?int $bookId = null): Collection
    {
        return HadithVerse::query()
            ->with(['book.translations', 'chapter.translations'])
            ->when($bookId, fn($q) => $q->where('hadith_book_id', $bookId))
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('hadith_number', 'like', "%{$query}%")
                        ->orWhere('heading', 'like', "%{$query}%")
                        ->orWhere('text', 'like', "%{$query}%");
                });
            })
            ->limit(50)
            ->get();
    }

    // ==========================================
    // Lesson Contents
    // ==========================================
    public function contentDataTable(int | string $lessonId): Builder
    {
        return LessonContent::query()
            ->where('lesson_id', $lessonId)
            ->select(['id', 'lesson_id', 'lang', 'notes', 'key_notes', 'status', 'created_at']);
    }

    public function findContent(int | string $id): ?LessonContent
    {
        return LessonContent::find($id);
    }

    public function storeContent(array $data): LessonContent
    {
        $data['status'] = $data['status'] ?? true;
        return LessonContent::create($data);
    }

    public function updateContent(array $data, LessonContent $content): bool
    {
        return $content->update($data);
    }

    public function statusContent(LessonContent | int | string $content): bool
    {
        if (! $content instanceof LessonContent) {
            $content = LessonContent::findOrFail($content);
        }

        return $content->update(['status' => ! $content->status]);
    }

    public function deleteContent(LessonContent | int | string $content): bool
    {
        if (! $content instanceof LessonContent) {
            $content = LessonContent::findOrFail($content);
        }

        return $content->delete();
    }

    // ==========================================
    // General References
    // ==========================================
    public function referenceDataTable(int | string $lessonId): Builder
    {
        return LessonReference::query()
            ->select('lesson_references.*')
            ->where('lesson_references.lesson_id', $lessonId)
            ->withCount(['allQuranReferences', 'allHadithReferences']);
    }


    public function findReference(int | string $id): ?LessonReference
    {
        return LessonReference::find($id);
    }

    public function storeReference(array $data): LessonReference
    {
        $data['status'] = $data['status'] ?? true;
        return LessonReference::create($data);
    }

    public function updateReference(array $data, LessonReference $reference): bool
    {
        return $reference->update($data);
    }

    public function statusReference(LessonReference | int | string $reference): bool
    {
        if (! $reference instanceof LessonReference) {
            $reference = LessonReference::findOrFail($reference);
        }

        return $reference->update(['status' => ! $reference->status]);
    }

    public function deleteReference(LessonReference | int | string $reference): bool
    {
        if (! $reference instanceof LessonReference) {
            $reference = LessonReference::findOrFail($reference);
        }

        return $reference->delete();
    }

    // ==========================================
    // Quran References (Belongs to LessonReference)
    // ==========================================
    public function quranReferenceDataTable(int | string $lessonId): Builder
    {
        $locale = app()->getLocale();

        return LessonReferenceQuran::query()
            ->whereHas('reference', function ($q) use ($lessonId) {
                $q->where('lesson_id', $lessonId);
            })
            ->with([
                'reference' => function ($q) {
                    $q->select(['id', 'lesson_id', 'title']);
                },
                'surah.translations' => function ($query) use ($locale) {
                    $query->where('lang', $locale);
                },
            ])
            ->select(['id', 'lesson_reference_id', 'surah_id', 'verse_no', 'status', 'created_at']);
    }

    public function findQuranReference(int | string $id): ?LessonReferenceQuran
    {
        return LessonReferenceQuran::find($id);
    }

    public function storeQuranReference(array $data): LessonReferenceQuran
    {
        $data['status'] = $data['status'] ?? true;
        return LessonReferenceQuran::create($data);
    }

    public function updateQuranReference(array $data, LessonReferenceQuran $reference): bool
    {
        return $reference->update($data);
    }

    public function statusQuranReference(LessonReferenceQuran | int | string $reference): bool
    {
        if (! $reference instanceof LessonReferenceQuran) {
            $reference = LessonReferenceQuran::findOrFail($reference);
        }

        return $reference->update(['status' => ! $reference->status]);
    }

    public function deleteQuranReference(LessonReferenceQuran | int | string $reference): bool
    {
        if (! $reference instanceof LessonReferenceQuran) {
            $reference = LessonReferenceQuran::findOrFail($reference);
        }

        return $reference->delete();
    }

    // ==========================================
    // Hadith References (Belongs to LessonReference)
    // ==========================================
    public function hadithReferenceDataTable(int | string $lessonId): Builder
    {
        $locale = app()->getLocale();

        return LessonReferenceHadith::query()
            ->whereHas('reference', function ($q) use ($lessonId) {
                $q->where('lesson_id', $lessonId);
            })
            ->with([
                'reference' => function ($q) {
                    $q->select(['id', 'lesson_id', 'title']);
                },
                'hadithVerse.book.translations' => function ($query) use ($locale) {
                    $query->where('lang', $locale);
                },
                'hadithVerse.chapter.translations' => function ($query) use ($locale) {
                    $query->where('lang', $locale);
                },
            ])
            ->select(['id', 'lesson_reference_id', 'hadith_verse_id', 'verse_no', 'status', 'created_at']);
    }


    public function findHadithReference(int | string $id): ?LessonReferenceHadith
    {
        return LessonReferenceHadith::find($id);
    }

    public function storeHadithReference(array $data): LessonReferenceHadith
    {
        $data['status'] = $data['status'] ?? true;
        return LessonReferenceHadith::create($data);
    }

    public function updateHadithReference(array $data, LessonReferenceHadith $reference): bool
    {
        return $reference->update($data);
    }

    public function statusHadithReference(LessonReferenceHadith | int | string $reference): bool
    {
        if (! $reference instanceof LessonReferenceHadith) {
            $reference = LessonReferenceHadith::findOrFail($reference);
        }

        return $reference->update(['status' => ! $reference->status]);
    }

    public function deleteHadithReference(LessonReferenceHadith | int | string $reference): bool
    {
        if (! $reference instanceof LessonReferenceHadith) {
            $reference = LessonReferenceHadith::findOrFail($reference);
        }

        return $reference->delete();
    }
}
