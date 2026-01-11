<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Topic\TopicInterface;

class TopicController extends Controller
{
    public function __construct(protected TopicInterface $topicRepository)
    {}

    public function topics()
    {
        return view("app.topics");
    }

    public function modules($menuSlug)
    {
        $topic = getTopicChapters($menuSlug);

        return view("app.modules", compact("topic"));
    }

    public function lessons($topicSlug, $moduleSlug, $lessonSlug = null)
    {
        $topic  = getTopicChapters($topicSlug);
        $module = getModuleLesson($topicSlug, $moduleSlug);

        return view("app.module-{$module['page']}", compact("topic", "module", "moduleSlug", "lessonSlug"));
    }
}
