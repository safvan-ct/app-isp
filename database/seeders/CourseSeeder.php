<?php
namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseTranslation;
use App\Models\Instructor;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructor = Instructor::firstOrCreate(
            ['name' => 'Al-Athar Academy'],
            [
                'certification' => 'Islamic Studies Scholar',
                'desc'          => 'Al-Athar Academy is an online platform that provides Islamic education to students from all over the world.',
                'status'        => true,
            ]
        );

        $courses = [
            [
                'slug'           => 'fundamentals-of-islam',
                'title'          => 'Fundamentals of Islam',
                'description'    => 'Learn the foundations of Islam, including Islam, Iman, Tawheed, the five pillars, prophets, and the essential beliefs and principles every Muslim should know.',
                'duration_weeks' => 12,
                'level'          => 'Beginner',
                'is_coming_soon' => false,
            ],
            [
                'slug'           => 'fiqh',
                'title'          => 'Fiqh',
                'description'    => 'Study the practical rulings of Islam, including purification, Salah, fasting, Zakah, Hajj, and other essential matters of Islamic jurisprudence.',
                'duration_weeks' => 16,
                'level'          => 'Beginner',
                'is_coming_soon' => false,
            ],
            [
                'slug'           => 'akhlaq',
                'title'          => 'Akhlaq',
                'description'    => 'Learn Islamic manners and character development, including sincerity, patience, truthfulness, respect for parents, social etiquette, and avoiding bad character.',
                'duration_weeks' => 10,
                'level'          => 'Beginner',
                'is_coming_soon' => false,
            ],
            [
                'slug'           => 'thareeq',
                'title'          => 'Thareeq',
                'description'    => 'Explore Islamic history and the Seerah of Prophet Muhammad ﷺ, from pre-Islamic Arabia through the Makkan and Madinan periods and the era of the Khulafa al-Rashidun.',
                'duration_weeks' => 14,
                'level'          => 'Intermediate',
                'is_coming_soon' => false,
            ],
            [
                'slug'           => 'thafseer',
                'title'          => 'Thafseer',
                'description'    => 'Study the meanings and explanations of selected Quranic passages while learning the fundamentals, sources, and principles of Tafsir.',
                'duration_weeks' => 16,
                'level'          => 'Intermediate',
                'is_coming_soon' => false,
            ],
            [
                'slug'           => 'judicial-laws',
                'title'          => 'Judicial Laws',
                'description'    => 'An advanced study of Islamic law covering Shariah, legal principles, family law, financial law, criminal law, evidence, and the Islamic judicial system.',
                'duration_weeks' => 20,
                'level'          => 'Advanced',
                'is_coming_soon' => true,
            ],
        ];

        foreach ($courses as $index => $item) {
            $course = Course::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'type'        => strtolower($item['level'] ?? 'beginner'),
                    'sort'        => $index + 1,
                    'status'      => true,
                    'coming_soon' => $item['is_coming_soon'] ?? false,
                ]
            );

            CourseTranslation::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'lang'      => 'en',
                ],
                [
                    'title'      => $item['title'],
                    'desc'       => $item['description'],
                    'key_points' => null,
                    'duration'   => $item['duration_weeks'] ?? null,
                    'author_id'  => $instructor->id,
                    'status'     => true,
                ]
            );
        }
    }
}
