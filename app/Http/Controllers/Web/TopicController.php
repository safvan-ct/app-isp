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
        $topic = $this->topicRepository->getMenuWithAll($menuSlug);
        if (! $topic) {
            //abort(404);
        }
        $topic = getTopicChapters($menuSlug);

        return view("app.modules-1", compact("topic"));
    }

    public function questions($menuSlug, $moduleSlug)
    {
        $module = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $module) {
            //abort(404);
        }

        $topic = getTopicChapters($moduleSlug);

        return view("app.modules", compact("module", "menuSlug", "topic"));
    }

    public function answers($menuSlug, $moduleSlug, $moduleId)
    {
        $question = $this->topicRepository->getQuestionWithAll($moduleId);
        $module   = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $question) {
            //abort(404);
        }

        $key    = $moduleId + 1;
        $topic  = getTopicChapters($moduleSlug);
        $module = getChapterNotes($moduleSlug, $key);

        return view("app.module-{$module['page']}", compact("topic", "module", "moduleId", "moduleSlug"));
    }

    public function lessons($topicSlug, $moduleSlug, $lessonSlug = null)
    {
        $topic  = getTopicChapters($topicSlug);
        $module = getModuleLesson($topicSlug, $moduleSlug);

        return view("app.module-{$module['page']}", compact("topic", "module", "moduleSlug", "lessonSlug"));
    }
}
