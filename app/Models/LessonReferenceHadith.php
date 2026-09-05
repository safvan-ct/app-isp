<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonReferenceHadith extends Model
{
    protected $table = 'lesson_reference_hadith';

    protected $fillable = [
        'lesson_reference_id',
        'hadith_verse_id',
        'verse_no',
        'status',
    ];

    protected $casts = [
        'status'   => 'boolean',
        'verse_no' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function reference(): BelongsTo
    {
        return $this->belongsTo(LessonReference::class, 'lesson_reference_id');
    }

    public function hadithVerse(): BelongsTo
    {
        return $this->belongsTo(HadithVerse::class, 'hadith_verse_id');
    }
}

