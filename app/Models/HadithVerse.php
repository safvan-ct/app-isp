<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HadithVerse extends Model
{
    protected $fillable = [
        'hadith_book_id',
        'hadith_chapter_id',
        'chapter_number',
        'hadith_number',
        'heading',
        'text',
        'volume',
        'status',
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
        return $this->hasMany(HadithVerseTranslation::class)
            ->select('id', 'hadith_verse_id', 'narrator', 'heading', 'text')
            ->active();
    }

    // --------------------
    // Chapter
    // --------------------
    public function chapter()
    {
        return $this->belongsTo(HadithChapter::class, 'hadith_chapter_id');
    }

    // --------------------
    // Book
    // --------------------
    public function book()
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

}
