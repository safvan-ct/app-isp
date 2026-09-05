<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithChapter extends Model
{
    protected $fillable = [
        'hadith_book_id',
        'chapter_number',
        'slug',
        'name',
        'hadith_count',
        'sort',
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
        return $this->hasMany(HadithChapterTranslation::class)
            ->select('id', 'hadith_chapter_id', 'name')
            ->active();
    }

    // --------------------
    // Book
    // --------------------
    public function book()
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

    // --------------------
    // Verses
    // --------------------
    public function verses()
    {
        return $this->hasMany(HadithVerse::class);
    }
}
