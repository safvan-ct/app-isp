<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    protected $fillable = [
        'chapter_id',
        'slug',
        'sort',
        'status',
    ];

    protected $casts = [
        'sort'   => 'integer',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations(): HasMany
    {
        return $this->hasMany(LessonTranslation::class)->active()->lang();
    }

    public function allTranslations(): HasMany
    {
        return $this->hasMany(LessonTranslation::class);
    }

    public function currentTranslation(): HasOne
    {
        return $this->hasOne(LessonTranslation::class)->active();
    }

    public function contents(): HasMany
    {
        return $this->hasMany(LessonContent::class)->active()->lang();
    }

    public function allContents(): HasMany
    {
        return $this->hasMany(LessonContent::class);
    }

    public function currentContent(): HasOne
    {
        return $this->hasOne(LessonContent::class)->active();
    }

    public function references(): HasMany
    {
        return $this->hasMany(LessonReference::class)->active();
    }

    public function allReferences(): HasMany
    {
        return $this->hasMany(LessonReference::class);
    }

    public function quranReferences(): HasManyThrough
    {
        return $this->hasManyThrough(
            LessonReferenceQuran::class,
            LessonReference::class,
            'lesson_id',
            'lesson_reference_id'
        );
    }

    public function hadithReferences(): HasManyThrough
    {
        return $this->hasManyThrough(
            LessonReferenceHadith::class,
            LessonReference::class,
            'lesson_id',
            'lesson_reference_id'
        );
    }
}


