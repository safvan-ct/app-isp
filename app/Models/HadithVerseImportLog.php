<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HadithVerseImportLog extends Model
{
    protected $fillable = [
        'hadith_book_id',
        'hadith_chapter_id',
        'total_pages',
        'success_pages',
        'failed_pages',
        'failed_hadiths',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'success_pages'  => 'array',
        'failed_pages'   => 'array',
        'failed_hadiths' => 'array',
        'started_at'     => 'datetime',
        'completed_at'   => 'datetime',
    ];

    // ------------------------------------------------------------------
    // Relations
    // ------------------------------------------------------------------

    public function book(): BelongsTo
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(HadithChapter::class, 'hadith_chapter_id');
    }

    // ------------------------------------------------------------------
    // Helpers
    // ------------------------------------------------------------------

    /** True if every page has been successfully imported. */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /** Count of successfully imported pages. */
    public function successCount(): int
    {
        return count($this->success_pages ?? []);
    }

    /** Count of pages that still need importing. */
    public function failedCount(): int
    {
        return count($this->failed_pages ?? []);
    }

    /** Progress percentage (0-100). */
    public function progressPercent(): int
    {
        if ($this->total_pages === 0) {
            return 0;
        }

        return (int) round(($this->successCount() / $this->total_pages) * 100);
    }

    /**
     * Scope to find the log for a specific book+chapter combo.
     * Pass null for $chapterId to match a whole-book log.
     */
    public static function forScope(int $bookId, ?int $chapterId): ?self
    {
        return static::where('hadith_book_id', $bookId)
            ->where(function ($q) use ($chapterId) {
                if ($chapterId) {
                    $q->where('hadith_chapter_id', $chapterId);
                } else {
                    $q->whereNull('hadith_chapter_id');
                }
            })
            ->first();
    }
}
