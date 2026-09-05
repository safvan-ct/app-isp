<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuranVerse extends Model
{
    protected $fillable = [
        'quran_chapter_id',
        'number_in_chapter',
        'text',
        'juz',
        'manzil',
        'ruku',
        'hizb_quarter',
        'sajda',
        'is_active',
    ];

    

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // --------------------
    // Translations
    // --------------------
    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations()
    {
        return $this->hasMany(QuranVerseTranslation::class)
            ->select('id', 'quran_chapter_id', 'quran_verse_id', 'number_in_chapter', 'lang', 'text', 'text_romanized', 'direction', 'is_active')
            ->active();
    }

    // --------------------
    // Chapter
    // --------------------
    public function chapter()
    {
        return $this->belongsTo(QuranChapter::class, 'quran_chapter_id');
    }

}
