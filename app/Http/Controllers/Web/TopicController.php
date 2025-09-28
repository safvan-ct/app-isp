<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Topic\TopicInterface;

class TopicController extends Controller
{
    public function __construct(protected TopicInterface $topicRepository)
    {}

    public function modules($menuSlug)
    {
        $topic = $this->topicRepository->getMenuWithAll($menuSlug);
        if (! $topic) {
            //abort(404);
        }

        return view("app.topics", compact("topic", "menuSlug"));
    }

    public function questions($menuSlug, $moduleSlug)
    {
        $module = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $module) {
            //abort(404);
        }

        $questions = getTopicChapters($moduleSlug);

        return view("app.topic-chapters", compact("module", "menuSlug", "questions"));
    }

    public function answers($menuSlug, $moduleSlug, $questionSlug)
    {
        $question = $this->topicRepository->getQuestionWithAll($questionSlug);
        $module   = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $question) {
            //abort(404);
        }

        $key       = $questionSlug + 1;
        $questions = getTopicChapters($moduleSlug);
        $answer    = getChapterNotes($moduleSlug, $questionSlug + 1);
        $question  = getTopicChapters($moduleSlug);

        return view("app.topic-answers", compact("answer", "questions", "question", "questionSlug"));
        return view("app.{$moduleSlug}.{$key}", compact("question", "module", "menuSlug", "moduleSlug", "questionSlug", "questions"));
    }
}
