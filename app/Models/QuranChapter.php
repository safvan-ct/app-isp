<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class QuranChapter extends Model
{
    use LogsActivity;

    protected $fillable = [
        'slug',
        'name',
        'revelation',
        'no_of_verses',
        'juz',
        'is_active',
    ];

    protected static $recordEvents = ['updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'revelation', 'no_of_verses', 'juz', 'is_active'])
            ->useLogName('quran_chapters')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

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
            ->select('id', 'quran_chapter_id', 'name', 'translation')
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
