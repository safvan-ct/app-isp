<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HadithJsonImportLog extends Model
{
    protected $fillable = [
        'source_file',
        'hadith_book_id',
        'total_steps',
        'success_steps',
        'failed_steps',
        'failed_items',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'success_steps' => 'array',
        'failed_steps'  => 'array',
        'failed_items'  => 'array',
        'started_at'    => 'datetime',
        'completed_at'  => 'datetime',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function successCount(): int
    {
        return count($this->success_steps ?? []);
    }

    public function failedCount(): int
    {
        return count($this->failed_steps ?? []);
    }

    public function progressPercent(): int
    {
        return $this->total_steps > 0
            ? (int) round(($this->successCount() / $this->total_steps) * 100)
            : 0;
    }
}
