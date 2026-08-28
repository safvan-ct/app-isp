<?php
namespace App\Repository\Quran;

use App\Models\BookmarkItem;
use App\Models\Like;
use App\Models\QuranChapter;
use App\Models\QuranVerse;
use App\Services\ApiService;

class QuranVerseRepository implements QuranVerseInterface
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getById($id)
    {
        return QuranVerse::find($id);
    }

    public function dataTable($chapterId)
    {
        return QuranVerse::where('quran_chapter_id', $chapterId);
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

    public function update(array $data, QuranVerse $quranVerse)
    {
        $quranVerse->update($data);
        return $quranVerse;
    }

    public function getVerseById(array $id, $paginate = false)
    {
        $query = QuranVerse::select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'name')->with('translations'),
            ])
            ->whereIn('id', $id)
            ->active();

        return $paginate ? $query->paginate(5) : $query->get();
    }

    public function getVerses(int $chapterId, ?int $ayahNumber = null)
    {
        return QuranVerse::select(['id', 'number_in_chapter', 'text'])
            ->where('quran_chapter_id', $chapterId)
            ->when($ayahNumber, fn($q) => $q->where('number_in_chapter', $ayahNumber))
            ->active()
            ->get();
    }

    public function getLikedVerses($userId, $paginate = true)
    {
        $ids = Like::where('likeable_type', 'App\Models\QuranVerse')
            ->where('user_id', $userId)
            ->pluck('likeable_id')
            ->toArray();

        return $this->getVerseById($ids, $paginate);
    }

    public function getBookmarkedVerses($userId, $collectionId, $paginate = true)
    {
        $ids = BookmarkItem::where('bookmarkable_type', 'App\Models\QuranVerse')
            ->where('bookmark_collection_id', $collectionId)
            ->where('user_id', $userId)
            ->pluck('bookmarkable_id')
            ->toArray();

        return $this->getVerseById($ids, $paginate);
    }

    public function getPaginatedVersesWithFilters(QuranChapter $chapter, array $filters, int $perPage)
    {
        $query = QuranVerse::query()
            ->select('id', 'quran_chapter_id', 'number_in_chapter', 'text', 'juz', 'manzil', 'ruku', 'hizb_quarter', 'sajda', 'is_active')
            ->where('quran_chapter_id', $chapter->id);

        $active = isset($filters['active']) ? filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN) : true;
        $query->where('is_active', $active);

        // Eager load translations
        $query->with(['translations' => function ($q) use ($filters) {
            $q->select('id', 'quran_chapter_id', 'quran_verse_id', 'number_in_chapter', 'lang', 'text', 'text_romanized', 'direction', 'is_active');

            if (! empty($filters['translation'])) {
                $q->where('lang', $filters['translation']);
            }

            $q->where('is_active', true);
        }]);

        return $query->orderBy('number_in_chapter', 'asc')->cursorPaginate($perPage);
    }

    public function getByChapterAndNumber(int $verseNumber, QuranChapter $chapter, ?string $lang = null)
    {
        return QuranVerse::where('quran_chapter_id', $chapter->id)
            ->where('number_in_chapter', $verseNumber)
            ->active()
            ->with([
                'translations' => function ($q) use ($lang) {
                    $q->select('id', 'quran_chapter_id', 'quran_verse_id', 'number_in_chapter', 'lang', 'text', 'text_romanized', 'direction', 'is_active')
                        ->when($lang, fn($q) => $q->where('lang', $lang))
                        ->where('is_active', true);
                },
                // 'chapter' => function ($q) use ($lang) {
                //     $q->select('id', 'slug', 'name', 'revelation', 'no_of_verses', 'juz', 'is_active')
                //         ->active()
                //         ->with([
                //             'translations' => function ($tQ) use ($lang) {
                //                 $tQ->select('id', 'quran_chapter_id', 'lang', 'name', 'name_tr', 'revelation_romanized', 'no_of_verses_romanized', 'juz_romanized', 'direction', 'is_active')
                //                     ->when($lang, fn($q) => $q->where('lang', $lang))
                //                     ->where('is_active', true);
                //             }
                //         ]);
                // }
            ])
            ->firstOrFail();
    }
}
