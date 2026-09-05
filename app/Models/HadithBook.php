<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithBook extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'abbreviation',
        'writer',
        'status',
        'group',
        'life_span',
        'chapter_count',
        'hadith_count',
        'priority',
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
        return $this->hasMany(HadithBookTranslation::class)
            ->select('id', 'hadith_book_id', 'name', 'writer')
            ->active();
    }

    // --------------------
    // Chapters
    // --------------------
    public function chapters()
    {
        return $this->hasMany(HadithChapter::class);
    }

    // --------------------
    // Verses
    // --------------------
    public function verses()
    {
        return $this->hasMany(HadithVerse::class);
    }
}
