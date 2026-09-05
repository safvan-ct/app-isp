<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonReference extends Model
{
    protected $fillable = [
        'lesson_id',
        'title',
        'simplified',
        'translations',
        'status',
    ];

    protected $casts = [
        'translations' => 'array',
        'status'       => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function quranReferences(): HasMany
    {
        return $this->hasMany(LessonReferenceQuran::class, 'lesson_reference_id')->active();
    }

    public function allQuranReferences(): HasMany
    {
        return $this->hasMany(LessonReferenceQuran::class, 'lesson_reference_id');
    }

    public function hadithReferences(): HasMany
    {
        return $this->hasMany(LessonReferenceHadith::class, 'lesson_reference_id')->active();
    }

    public function allHadithReferences(): HasMany
    {
        return $this->hasMany(LessonReferenceHadith::class, 'lesson_reference_id');
    }
}

