<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chapter extends Model
{
    protected $fillable = [
        'course_id',
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

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('sort');
    }

    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ChapterTranslation::class)->active()->lang();
    }

    public function allTranslations(): HasMany
    {
        return $this->hasMany(ChapterTranslation::class);
    }

    public function currentTranslation(): HasOne
    {
        return $this->hasOne(ChapterTranslation::class)->active();
    }
}
