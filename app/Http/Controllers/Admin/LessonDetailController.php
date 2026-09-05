<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonContent\StoreRequest as StoreContentRequest;
use App\Http\Requests\LessonReference\StoreRequest as StoreReferenceRequest;
use App\Http\Requests\LessonReferenceHadith\StoreRequest as StoreHadithRequest;
use App\Http\Requests\LessonReferenceQuran\StoreRequest as StoreQuranRequest;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\LessonReference;
use App\Models\LessonReferenceHadith;
use App\Models\LessonReferenceQuran;
use App\Repository\Course\LessonDetailInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class LessonDetailController extends Controller implements HasMiddleware
{
    public function __construct(
        protected LessonDetailInterface $lessonDetailRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view lessons'), only: [
                'manage',
                'referencesList',
                'hadithVerses',
                'contentDataTable',
                'referenceDataTable',
                'quranDataTable',
                'hadithDataTable',
            ]),
            new Middleware(PermissionMiddleware::using('store lessons'), only: [
                'storeContent',
                'storeReference',
                'storeQuran',
                'storeHadith',
            ]),
            new Middleware(PermissionMiddleware::using('update lessons'), only: [
                'updateContent',
                'updateReference',
                'updateQuran',
                'updateHadith',
            ]),
            new Middleware(PermissionMiddleware::using('active lessons'), only: [
                'statusContent',
                'statusReference',
                'statusQuran',
                'statusHadith',
            ]),
            new Middleware(PermissionMiddleware::using('delete lessons'), only: [
                'deleteContent',
                'deleteReference',
                'deleteQuran',
                'deleteHadith',
            ]),
        ];
    }

    public function manage(string | int $lesson_id): View
    {
        $lesson           = $this->lessonDetailRepository->getLesson($lesson_id);
        $lessonReferences = $this->lessonDetailRepository->getLessonReferences($lesson_id);
        $surahs           = $this->lessonDetailRepository->getSurahs();
        $hadithBooks      = $this->lessonDetailRepository->getHadithBooks();

        return view('admin.course.lesson.manage', compact('lesson', 'lessonReferences', 'surahs', 'hadithBooks'));
    }

    public function referencesList(Lesson $lesson): JsonResponse
    {
        $references = $this->lessonDetailRepository->getLessonReferences($lesson->id);

        return response()->json($references);
    }

    public function hadithVerses(Request $request): JsonResponse
    {
        $verses = $this->lessonDetailRepository->searchHadithVerses(
            $request->query('query'),
            $request->query('book_id') ? (int) $request->query('book_id') : null
        );

        return response()->json($verses);
    }

    // ==========================================
    // 1. Lesson Contents
    // ==========================================
    public function contentDataTable(Request $request, Lesson $lesson): JsonResponse
    {
        $query = $this->lessonDetailRepository->contentDataTable($lesson->id);

        return DataTables::of($query)->make(true);
    }

    public function storeContent(StoreContentRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $data              = $request->validated();
            $data['lesson_id'] = $lesson->id;
            $this->lessonDetailRepository->storeContent($data);

            return response()->json(['message' => 'Lesson notes & content created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateContent(StoreContentRequest $request, Lesson $lesson, LessonContent $content): JsonResponse
    {
        try {
            $data              = $request->validated();
            $data['lesson_id'] = $lesson->id;
            $this->lessonDetailRepository->updateContent($data, $content);

            return response()->json(['message' => 'Lesson notes & content updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function statusContent(Lesson $lesson, LessonContent $content): JsonResponse
    {
        try {
            $this->lessonDetailRepository->statusContent($content);

            return response()->json(['message' => 'Content status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteContent(Lesson $lesson, LessonContent $content): JsonResponse
    {
        try {
            $this->lessonDetailRepository->deleteContent($content);

            return response()->json(['message' => 'Content deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // ==========================================
    // 2. Lesson References (General)
    // ==========================================
    public function referenceDataTable(Request $request, Lesson $lesson): JsonResponse
    {
        $query = $this->lessonDetailRepository->referenceDataTable($lesson->id);

        return DataTables::of($query)->make(true);
    }

    public function storeReference(StoreReferenceRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $data              = $request->validated();
            $data['lesson_id'] = $lesson->id;
            $this->lessonDetailRepository->storeReference($data);

            return response()->json(['message' => 'Reference created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateReference(StoreReferenceRequest $request, Lesson $lesson, LessonReference $reference): JsonResponse
    {
        try {
            $data              = $request->validated();
            $data['lesson_id'] = $lesson->id;
            $this->lessonDetailRepository->updateReference($data, $reference);

            return response()->json(['message' => 'Reference updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function statusReference(Lesson $lesson, LessonReference $reference): JsonResponse
    {
        try {
            $this->lessonDetailRepository->statusReference($reference);

            return response()->json(['message' => 'Reference status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteReference(Lesson $lesson, LessonReference $reference): JsonResponse
    {
        try {
            $this->lessonDetailRepository->deleteReference($reference);

            return response()->json(['message' => 'Reference deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // ==========================================
    // 3. Quran References
    // ==========================================
    public function quranDataTable(Request $request, Lesson $lesson): JsonResponse
    {
        $query = $this->lessonDetailRepository->quranReferenceDataTable($lesson->id);

        return DataTables::of($query)->make(true);
    }

    public function storeQuran(StoreQuranRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->lessonDetailRepository->storeQuranReference($data);

            return response()->json(['message' => 'Quran reference added successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateQuran(StoreQuranRequest $request, Lesson $lesson, LessonReferenceQuran $quran): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->lessonDetailRepository->updateQuranReference($data, $quran);

            return response()->json(['message' => 'Quran reference updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function statusQuran(Lesson $lesson, LessonReferenceQuran $quran): JsonResponse
    {
        try {
            $this->lessonDetailRepository->statusQuranReference($quran);

            return response()->json(['message' => 'Quran reference status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteQuran(Lesson $lesson, LessonReferenceQuran $quran): JsonResponse
    {
        try {
            $this->lessonDetailRepository->deleteQuranReference($quran);

            return response()->json(['message' => 'Quran reference deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // ==========================================
    // 4. Hadith References
    // ==========================================
    public function hadithDataTable(Request $request, Lesson $lesson): JsonResponse
    {
        $query = $this->lessonDetailRepository->hadithReferenceDataTable($lesson->id);

        return DataTables::of($query)->make(true);
    }

    public function storeHadith(StoreHadithRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->lessonDetailRepository->storeHadithReference($data);

            return response()->json(['message' => 'Hadith reference added successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateHadith(StoreHadithRequest $request, Lesson $lesson, LessonReferenceHadith $hadith): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->lessonDetailRepository->updateHadithReference($data, $hadith);

            return response()->json(['message' => 'Hadith reference updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function statusHadith(Lesson $lesson, LessonReferenceHadith $hadith): JsonResponse
    {
        try {
            $this->lessonDetailRepository->statusHadithReference($hadith);

            return response()->json(['message' => 'Hadith reference status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteHadith(Lesson $lesson, LessonReferenceHadith $hadith): JsonResponse
    {
        try {
            $this->lessonDetailRepository->deleteHadithReference($hadith);

            return response()->json(['message' => 'Hadith reference deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
