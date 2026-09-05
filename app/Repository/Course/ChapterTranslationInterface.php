<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\ChapterTranslation;
use Illuminate\Database\Eloquent\Builder;

interface ChapterTranslationInterface
{
    public function dataTable(int | string $chapterId): Builder;
    public function getChapter(int | string $chapterId): Chapter;
    public function find(int | string $id): ?ChapterTranslation;
    public function store(array $data): ChapterTranslation;
    public function update(array $data, ChapterTranslation $translation): bool;
    public function status(ChapterTranslation | string $translation): bool;
}
