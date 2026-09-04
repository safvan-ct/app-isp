<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonReferenceQuran extends Model
{
    protected $table = 'lesson_reference_quran';

    protected $fillable = [
        'lesson_id',
        'surah_id',
        'verse_no',
        'status',
    ];

    protected $casts = [
        'verse_no' => 'integer',
        'status'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function surah(): BelongsTo
    {
        return $this->belongsTo(QuranChapter::class, 'surah_id');
    }
}
