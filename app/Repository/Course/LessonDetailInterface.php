<?php
namespace App\Repository\Course;

use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\LessonReference;
use App\Models\LessonReferenceHadith;
use App\Models\LessonReferenceQuran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface LessonDetailInterface
{
    public function getLesson(int | string $lessonId): Lesson;

    public function getLessonReferences(int | string $lessonId): Collection;

    public function getSurahs(): Collection;

    public function getHadithBooks(): Collection;

    public function searchHadithVerses(?string $query = null, ?int $bookId = null): Collection;

    // Lesson Contents
    public function contentDataTable(int | string $lessonId): Builder;

    public function findContent(int | string $id): ?LessonContent;

    public function storeContent(array $data): LessonContent;

    public function updateContent(array $data, LessonContent $content): bool;

    public function statusContent(LessonContent | int | string $content): bool;

    public function deleteContent(LessonContent | int | string $content): bool;

    // General References
    public function referenceDataTable(int | string $lessonId): Builder;

    public function findReference(int | string $id): ?LessonReference;

    public function storeReference(array $data): LessonReference;

    public function updateReference(array $data, LessonReference $reference): bool;

    public function statusReference(LessonReference | int | string $reference): bool;

    public function deleteReference(LessonReference | int | string $reference): bool;

    // Quran References
    public function quranReferenceDataTable(int | string $lessonId): Builder;

    public function findQuranReference(int | string $id): ?LessonReferenceQuran;

    public function storeQuranReference(array $data): LessonReferenceQuran;

    public function updateQuranReference(array $data, LessonReferenceQuran $reference): bool;

    public function statusQuranReference(LessonReferenceQuran | int | string $reference): bool;

    public function deleteQuranReference(LessonReferenceQuran | int | string $reference): bool;

    // Hadith References
    public function hadithReferenceDataTable(int | string $lessonId): Builder;

    public function findHadithReference(int | string $id): ?LessonReferenceHadith;

    public function storeHadithReference(array $data): LessonReferenceHadith;

    public function updateHadithReference(array $data, LessonReferenceHadith $reference): bool;

    public function statusHadithReference(LessonReferenceHadith | int | string $reference): bool;

    public function deleteHadithReference(LessonReferenceHadith | int | string $reference): bool;
}
