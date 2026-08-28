<?php
namespace App\Repository\Quran;

use App\Models\QuranChapter;

class QuranChapterRepository implements QuranChapterInterface
{
    public function getById($id)
    {
        return QuranChapter::find($id);
    }

    public function dataTable()
    {
        return QuranChapter::select('id', 'name', 'revelation_place', 'no_of_verses', 'is_active');
    }

    public function status($id)
    {
        $query = $this->getById($id);
        if (! $query) {
            throw new \Exception('Item not found');
        }

        $query->update(['is_active' => ! $query->is_active]);
        return $query;
    }

    public function update(array $data, QuranChapter $quranChapter): QuranChapter
    {
        return QuranChapter::updateOrCreate(['id' => $quranChapter->id], $data);
    }

    public function getAll()
    {
        return QuranChapter::select('id', 'name')
            ->active()
            ->get();
    }

    public function getWithTranslations()
    {
        return QuranChapter::select('id', 'name', 'no_of_verses', 'revelation_place')
            ->with('translations')
            ->active()
            ->get();
    }

    public function getWithVerses($id = null)
    {
        $query = QuranChapter::select('id', 'name', 'no_of_verses', 'revelation_place')
            ->with([
                'translations',
                'verses' => fn($q) => $q
                    ->select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
                    ->with('translations')
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active())
            ->active();

        return $id ? $query->find($id) : $query->get();
    }

    public function getPaginatedChaptersWithFilters(array $filters, int $perPage)
    {
        $query = QuranChapter::query()
            ->select('id', 'slug', 'name', 'revelation', 'no_of_verses', 'juz', 'is_active');

        // Filter by active status (defaults to true)
        $active = isset($filters['active']) ? filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN) : true;
        $query->where('is_active', $active);

        // Filter by chapter name (matches name, name_tr, or translation name)
        if (! empty($filters['chapter_name'])) {
            $name = $filters['chapter_name'];
            $query->where(function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%')
                    ->orWhereHas('translations', function ($tq) use ($name) {
                        $tq->where('name', 'like', '%' . $name . '%')
                            ->orWhere('name_tr', 'like', '%' . $name . '%');
                    });
            });
        }

        // Filter by translation language
        if (! empty($filters['translation'])) {
            $lang = $filters['translation'];
            $query->whereHas('translations', function ($q) use ($lang) {
                $q->where('lang', $lang)->where('is_active', true);
            });
        }

        // Eager load translations
        $query->with(['translations' => function ($q) use ($filters) {
            $q->select('id', 'quran_chapter_id', 'lang', 'name', 'name_tr', 'revelation_romanized', 'no_of_verses_romanized', 'juz_romanized', 'direction', 'is_active');

            if (! empty($filters['translation'])) {
                $q->where('lang', $filters['translation']);
            }

            $q->where('is_active', true);
        }]);

        return $query->orderBy('id', 'asc')->cursorPaginate($perPage);
    }

    public function getBySlug(string $slug, ?string $lang = null)
    {
        return QuranChapter::where('slug', $slug)
            ->active()
            ->with([
                'translations' => function ($q) use ($lang) {
                    $q->select('id', 'quran_chapter_id', 'lang', 'name', 'name_tr', 'revelation_romanized', 'no_of_verses_romanized', 'juz_romanized', 'direction', 'is_active')
                        ->when($lang, fn($q) => $q->where('lang', $lang))
                        ->where('is_active', true);
                },
            ])
            ->firstOrFail();
    }
}
