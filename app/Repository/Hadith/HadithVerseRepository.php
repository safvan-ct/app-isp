<?php
namespace App\Repository\Hadith;

use App\Models\BookmarkItem;
use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use App\Models\Like;

class HadithVerseRepository implements HadithVerseInterface
{
    public function getById($id)
    {
        return HadithVerse::find($id);
    }

    public function dataTable($bookId, $chapterId = null)
    {
        return HadithVerse::where('hadith_book_id', $bookId)
            ->when($chapterId, function ($q) use ($chapterId) {
                return $q->where('hadith_chapter_id', $chapterId);
            });
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

    public function update(array $data, HadithVerse $hadithVerse)
    {
        $hadithVerse->update($data);
        return $hadithVerse;
    }

    public function getByWhere($where = [])
    {
        return HadithVerse::where($where)->first();
    }

    public function getVersesByChapter($chapterId, $search = null)
    {
        return HadithVerse::select(['id', 'hadith_number', 'text'])
            ->when(! empty($search), function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    if (is_numeric($search)) {
                        $query->orWhere('hadith_number', $search);
                    }
                });
            })
            ->where('hadith_chapter_id', $chapterId)
            ->active()
            ->get();
    }

    public function getVerseById(array $id, $paginate = false)
    {
        $query = HadithVerse::select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'hadith_book_id', 'chapter_number', 'name')->with('translations'),
                'book'    => fn($q)    => $q->select('id', 'name', 'slug', 'writer', 'life_span', 'hadith_count', 'chapter_count')->with('translations'),
            ])
            ->whereIn('id', $id)
            ->active();

        return $paginate ? $query->paginate(5) : $query->get();
    }

    public function getLikedVerses($userId, $paginate = true)
    {
        $ids = Like::where('likeable_type', 'App\Models\HadithVerse')
            ->where('user_id', $userId)
            ->pluck('likeable_id')
            ->toArray();

        return $this->getVerseById($ids, $paginate);
    }

    public function getBookmarkedVerses($userId, $collectionId, $paginate = true)
    {
        $ids = BookmarkItem::where('bookmarkable_type', 'App\Models\HadithVerse')
            ->where('bookmark_collection_id', $collectionId)
            ->where('user_id', $userId)
            ->pluck('bookmarkable_id')
            ->toArray();

        return $this->getVerseById($ids, $paginate);
    }

    public function getPaginatedVersesWithFilters(HadithChapter $chapter, array $filters, int $perPage)
    {
        $query = HadithVerse::query()
            ->select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status', 'is_active')
            ->where('hadith_chapter_id', $chapter->id);

        // Filter by active status (defaults to true)
        $active = isset($filters['active']) ? filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN) : true;
        $query->where('is_active', $active);

        // Eager load translations (excluding created_at, updated_at, created_by)
        $query->with(['translations' => function ($q) use ($filters) {
            $q->select('id', 'hadith_verse_id', 'lang', 'narrator', 'heading', 'text', 'status_romanized', 'is_active');

            // If a specific language is filtered, only load that translation
            if (! empty($filters['translation'])) {
                $q->where('lang', $filters['translation']);
            }

            $q->where('is_active', true);
        }]);

        return $query->orderBy('hadith_number', 'asc')->cursorPaginate($perPage);
    }

    public function getByBookAndNumber(int $hadithNumber, HadithBook $book, ?string $lang = null)
    {
        return HadithVerse::where('hadith_book_id', $book->id)
            ->where('hadith_number', $hadithNumber)
            ->active()
            ->with([
                'translations' => function ($q) use ($lang) {
                    $q->select('id', 'hadith_verse_id', 'lang', 'narrator', 'heading', 'text', 'status_romanized', 'is_active')
                        ->when(! empty($lang), fn($query) => $query->where('lang', $lang))
                        ->where('is_active', true);
                },
                'chapter'      => function ($q) use ($lang) {
                    $q->select('id', 'hadith_book_id', 'chapter_number', 'slug', 'name', 'hadith_count', 'is_active')
                        ->active()
                        ->with([
                            'translations' => function ($tQ) use ($lang) {
                                $tQ->select('id', 'hadith_chapter_id', 'lang', 'name', 'description')
                                    ->when(! empty($lang), fn($query) => $query->where('lang', $lang))
                                    ->where('is_active', true);
                            },
                        ]);
                },
            ])
            ->firstOrFail();
    }
}
