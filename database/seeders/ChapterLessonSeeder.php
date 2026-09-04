<?php
namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\ChapterTranslation;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonTranslation;
use Illuminate\Database\Seeder;

class ChapterLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('courses/chapters_and_lessons.json');
        if (! file_exists($jsonPath)) {
            return;
        }

        $coursesData = json_decode(file_get_contents($jsonPath), true);
        if (! $coursesData) {
            return;
        }

        foreach ($coursesData as $courseSlug => $chapters) {
            $course = Course::where('slug', $courseSlug)->first();
            if (! $course) {
                continue;
            }

            foreach ($chapters as $chapterIndex => $chapterData) {
                $chapter = Chapter::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'slug'      => $chapterData['slug'],
                    ],
                    [
                        'sort'   => $chapterData['sort'] ?? ($chapterIndex + 1),
                        'status' => true,
                    ]
                );

                ChapterTranslation::updateOrCreate(
                    [
                        'chapter_id' => $chapter->id,
                        'lang'       => 'en',
                    ],
                    [
                        'title'  => $chapterData['title'],
                        'status' => true,
                    ]
                );

                if (! empty($chapterData['lessons']) && is_array($chapterData['lessons'])) {
                    foreach ($chapterData['lessons'] as $lessonIndex => $lessonData) {
                        $lesson = Lesson::updateOrCreate(
                            [
                                'chapter_id' => $chapter->id,
                                'slug'       => $lessonData['slug'],
                            ],
                            [
                                'sort'   => $lessonData['sort'] ?? ($lessonIndex + 1),
                                'status' => true,
                            ]
                        );

                        LessonTranslation::updateOrCreate(
                            [
                                'lesson_id' => $lesson->id,
                                'lang'      => 'en',
                            ],
                            [
                                'title'  => $lessonData['title'],
                                'desc'   => $lessonData['desc'] ?? null,
                                'status' => true,
                            ]
                        );
                    }
                }
            }
        }
    }
}
