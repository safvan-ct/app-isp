<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuranChapter extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'revelation',
        'no_of_verses',
        'juz',
        'is_active',
    ];

    

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
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
        return $this->hasMany(QuranChapterTranslation::class)
            ->select('id', 'quran_chapter_id', 'lang', 'name', 'name_tr', 'revelation_romanized', 'no_of_verses_romanized', 'juz_romanized', 'direction', 'is_active')
            ->active();
    }

    // --------------------
    // Verses
    // --------------------
    public function verses()
    {
        return $this->hasMany(QuranVerse::class);
    }
}
