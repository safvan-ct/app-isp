<?php
namespace App\Repository\Hadith;

use App\Models\HadithBook;
use App\Models\HadithChapter;

class HadithChapterRepository implements HadithChapterInterface
{
    public function getById($id)
    {
        return HadithChapter::find($id);
    }

    public function dataTable($bookId)
    {
        return HadithChapter::where('hadith_book_id', $bookId);
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

    public function update(array $data, HadithChapter $hadithChapter)
    {
        $hadithChapter->update($data);
        return $hadithChapter;
    }

    public function getWithAll($id = null, $hadithNumber = null)
    {
        $query = HadithChapter::select('id', 'hadith_book_id', 'name', 'chapter_number')
            ->with([
                'translations',
                'verses' => fn($q) => $q
                    ->select('id', 'hadith_chapter_id', 'heading', 'text', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
                    ->with('translations')
                    ->when($hadithNumber, fn($q) => $q->where('hadith_number', $hadithNumber))
                    ->active(),

                'book'   => fn($q)   => $q
                    ->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')
                    ->with('translations')
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active()->when($hadithNumber, fn($q) => $q->where('hadith_number', $hadithNumber)))
            ->active();

        return $id ? $query->find($id) : $query->get();
    }

    public function getChpaters($bookId, $name = null)
    {
        return HadithChapter::select(['id', 'chapter_number', 'name'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_chapter_id', 'name'])
                    ->when(! empty($name) && ! is_numeric($name), fn($q) => $q->where('name', 'like', '%' . $name . '%'))
                    ->active()
                    ->lang('en'),
            ])
            ->when(! empty($name), function ($q) use ($name) {
                $q->where(function ($query) use ($name) {
                    $query->whereHas('translations', fn($q) => $q->where('name', 'like', '%' . $name . '%'));

                    if (is_numeric($name)) {
                        $query->orWhere('chapter_number', $name);
                    }
                });
            })
            ->where('hadith_book_id', $bookId)
            ->active()
            ->get();
    }

    public function getPaginatedChaptersWithFilters(\App\Models\HadithBook $book, array $filters, int $perPage)
    {
        $query = HadithChapter::query()
            ->select('id', 'hadith_book_id', 'chapter_number', 'slug', 'name', 'hadith_count', 'sort', 'is_active')
            ->where('hadith_book_id', $book->id);

        // Filter by active status (defaults to true)
        $active = isset($filters['active']) ? filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN) : true;
        $query->where('is_active', $active);

        // Filter by chapter name
        if (! empty($filters['chapter_name'])) {
            $query->where('name', 'like', '%' . $filters['chapter_name'] . '%');
        }

        // Filter by translation language
        if (! empty($filters['translation'])) {
            $lang = $filters['translation'];
            $query->whereHas('translations', function ($q) use ($lang) {
                $q->where('lang', $lang)->where('is_active', true);
            });
        }

        // Filter by name in translation (name search by translation)
        if (! empty($filters['chapter_name'])) {
            $transName = $filters['chapter_name'];
            $query->whereHas('translations', function ($q) use ($transName) {
                $q->where('name', 'like', '%' . $transName . '%')->where('is_active', true);
            });
        }

        // Eager load translations (excluding created_at, updated_at, created_by)
        $query->with(['translations' => function ($q) use ($filters) {
            $q->select('id', 'hadith_chapter_id', 'lang', 'name', 'name_romanized', 'description', 'hadith_count_romanized', 'is_active');

            // If a specific language is filtered, only load that translation
            if (! empty($filters['translation'])) {
                $q->where('lang', $filters['translation']);
            }

            $q->where('is_active', true);
        }]);

        return $query->orderBy('chapter_number', 'asc')->cursorPaginate($perPage);
    }

    public function getBySlugAndBook(string $slug, HadithBook $book, ?string $lang = null)
    {
        return HadithChapter::where('hadith_book_id', $book->id)
            ->where('slug', $slug)
            ->active()
            ->with([
                'translations' => function ($q) use ($lang) {
                    $q->select('id', 'hadith_chapter_id', 'lang', 'name', 'name_romanized', 'description', 'hadith_count_romanized', 'is_active')
                        ->when($lang, fn($q) => $q->where('lang', $lang))
                        ->where('is_active', true);
                },
            ])
            ->firstOrFail();
    }
}
