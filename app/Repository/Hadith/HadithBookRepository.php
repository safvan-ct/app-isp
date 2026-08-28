<?php
namespace App\Repository\Hadith;

use App\Models\HadithBook;

class HadithBookRepository implements HadithBookInterface
{
    public function getById($id)
    {
        return HadithBook::find($id);
    }

    public function dataTable()
    {
        return HadithBook::select('id', 'name', 'slug', 'writer', 'life_span', 'chapter_count', 'hadith_count', 'is_active');
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

    public function update(array $data, HadithBook $hadithBook)
    {
        return HadithBook::updateOrCreate(['id' => $hadithBook->id], $data);
    }

    public function getAll()
    {
        return HadithBook::select('id', 'name', 'writer', 'life_span', 'hadith_count', 'chapter_count')
            ->active()
            ->get();
    }

    public function getWithTranslations()
    {
        return HadithBook::select('id', 'name', 'slug', 'writer', 'life_span', 'chapter_count', 'hadith_count')
            ->with('translations')
            ->active()
            ->get();
    }

    public function getWithChapters($id = null)
    {
        $query = HadithBook::select('id', 'name', 'slug', 'writer', 'life_span', 'chapter_count', 'hadith_count')
            ->with([
                'translations',
                'chapters' => fn($q) => $q
                    ->select('id', 'hadith_book_id', 'chapter_number', 'name')
                    ->with('translations')
                    ->active(),
            ])
            ->active();

        return $id ? $query->find($id) : $query->get();
    }

    public function getPaginatedWithFilters(array $filters, int $perPage)
    {
        $query = HadithBook::query()
            ->select('id', 'name', 'slug', 'abbreviation', 'writer', 'status', 'group', 'life_span', 'chapter_count', 'hadith_count', 'priority', 'is_active');

        // Filter by active status (defaults to true)
        $active = isset($filters['active']) ? filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN) : true;
        $query->where('is_active', $active);

        // Filter by book name (matches book name, translation name, or name_romanized)
        if (! empty($filters['book_name'])) {
            $name = $filters['book_name'];
            $query->where(function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%')
                    ->orWhereHas('translations', function ($tq) use ($name) {
                        $tq->where('name', 'like', '%' . $name . '%')
                            ->orWhere('name_romanized', 'like', '%' . $name . '%');
                    });
            });
        }

        // Filter by translation language
        if (! empty($filters['translation'])) {
            // $lang = $filters['translation'];
            // $query->whereHas('translations', function ($q) use ($lang) {
            //     $q->where('lang', $lang)->where('is_active', true);
            // });
        }

        // Eager load translations (excluding created_at, updated_at, created_by)
        $query->with(['translations' => function ($q) use ($filters) {
            $q->select('id', 'hadith_book_id', 'lang', 'name', 'name_romanized', 'writer', 'writer_romanized', 'status_romanized', 'life_span_romanized', 'chapter_count_romanized', 'hadith_count_romanized', 'description', 'is_active');

            // If a specific language is filtered, only load that translation
            if (! empty($filters['translation'])) {
                $q->where('lang', $filters['translation']);
            }

            $q->where('is_active', true);
        }]);

        return $query->orderBy('priority', 'asc')->cursorPaginate($perPage);
    }

    public function getBySlugWithActiveTranslation(string $slug, ?string $lang = null)
    {
        return HadithBook::where('slug', $slug)
            ->active()
            ->with(['translations' => function ($q) use ($lang) {
                $q->select('id', 'hadith_book_id', 'lang', 'name', 'name_romanized', 'writer', 'writer_romanized', 'status_romanized', 'life_span_romanized', 'chapter_count_romanized', 'hadith_count_romanized', 'description', 'is_active')
                    ->when($lang, function ($query) use ($lang) {
                        $query->where('lang', $lang);
                    })
                    ->where('is_active', true);
            }])
            ->firstOrFail();
    }
}
