<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuranVerseTranslation extends Model
{
    protected $fillable = [
        'quran_chapter_id',
        'quran_verse_id',
        'number_in_chapter',
        'lang',
        'text',
        'text_romanized',
        'direction',
        'created_by',
        'is_active',
    ];

    

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLang($query, $lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $query->where('lang', $lang);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
