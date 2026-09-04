<?php
namespace App\Models;

use App\Enums\CourseType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    protected $fillable = [
        'slug',
        'type',
        'sort',
        'status',
        'coming_soon',
    ];

    protected $casts = [
        'type'        => CourseType::class,
        'sort'        => 'integer',
        'status'      => 'boolean',
        'coming_soon' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CourseTranslation::class)->active()->lang();
    }

    public function allTranslations(): HasMany
    {
        return $this->hasMany(CourseTranslation::class);
    }

    public function currentTranslation(): HasOne
    {
        return $this->hasOne(CourseTranslation::class)->active();
    }
}
