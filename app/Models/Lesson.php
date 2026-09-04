<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
}
