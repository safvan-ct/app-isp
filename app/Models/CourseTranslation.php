<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseTranslation extends Model
{
    protected $fillable = [
        'course_id',
        'lang',
        'title',
        'desc',
        'objectives',
        'key_points',
        'duration',
        'author_id',
        'status',
    ];

    protected $casts = [
        'key_points' => 'array',
        'status'     => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeLang($query, ?string $lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $query->where('lang', $lang);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'author_id');
    }
}
