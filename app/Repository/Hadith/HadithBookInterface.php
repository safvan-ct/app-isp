<?php
namespace App\Repository\Hadith;

use App\Models\HadithBook;

interface HadithBookInterface
{
    public function getById($id);

    public function dataTable();

    public function status($id);

    public function update(array $data, HadithBook $hadithBook);

    public function getAll();

    public function getWithTranslations();

    public function getWithChapters($id = null);

    public function getPaginatedWithFilters(array $filters, int $perPage);

    public function getBySlugWithActiveTranslation(string $slug, ?string $lang = null);
}
