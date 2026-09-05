<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuranChapterTranslation extends Model
{
    protected $fillable = [
        'quran_chapter_id',
        'lang',
        'name',
        'name_tr',
        'revelation_romanized',
        'no_of_verses_romanized',
        'juz_romanized',
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
