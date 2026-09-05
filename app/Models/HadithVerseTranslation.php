<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithVerseTranslation extends Model
{
    protected $fillable = [
        'hadith_verse_id',
        'lang',
        'narrator',
        'heading',
        'text',
        'status_romanized',
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
