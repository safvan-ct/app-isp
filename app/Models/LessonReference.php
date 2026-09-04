<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
