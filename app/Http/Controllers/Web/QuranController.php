<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Quran\QuranChapterInterface;

class QuranController extends Controller
{
    public function __construct(
        protected QuranChapterInterface $quranChapterRepository,
    ) {}

    public function quran()
    {
        $chapters = $this->quranChapterRepository->getWithTranslations();
        return view("app.quran-chapters", compact("chapters"));
    }

    public function quranChapter($id)
    {
        $chapter = $this->quranChapterRepository->getWithVerses($id);
        if (! $chapter) {
            abort(404);
        }

        return view("app.quran-verses", compact("chapter"));
    }
}
