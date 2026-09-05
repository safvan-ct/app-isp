<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithBookTranslation extends Model
{
    protected $fillable = [
        'hadith_book_id',
        'lang',
        'name',
        'name_romanized',
        'writer',
        'writer_romanized',
        'status_romanized',
        'group_romanized',
        'life_span_romanized',
        'chapter_count_romanized',
        'hadith_count_romanized',
        'description',
        'created_by',
        'is_active',
    ];

    

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
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
