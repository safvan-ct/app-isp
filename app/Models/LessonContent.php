<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonContent extends Model
{
    protected $fillable = [
        'lesson_id',
        'lang',
        'notes',
        'key_notes',
        'status',
    ];

    protected $casts = [
        'key_notes' => 'array',
        'status'    => 'boolean',
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

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
