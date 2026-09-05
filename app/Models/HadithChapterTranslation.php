<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithChapterTranslation extends Model
{
    protected $fillable = [
        'hadith_chapter_id',
        'lang',
        'name',
        'name_romanized',
        'description',
        'hadith_count_romanized',
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
