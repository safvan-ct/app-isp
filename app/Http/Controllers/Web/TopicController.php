<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Topic\TopicInterface;

class TopicController extends Controller
{
    protected $questions;

    public function __construct(protected TopicInterface $topicRepository)
    {
        $this->questions = [
            1 => [
                "slug"     => "meelad",
                "title"    => "നബിദിനം (റ. അവ്വൽ 12)",
                "desc"     => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                "chapters" => [
                    "റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത, റ.അ. 12 ന്റെ അടിസ്ഥാനം",
                    "നബിദിന ആഘോഷങ്ങളുടെ ചരിത്രം",
                ],
            ],
            2 => [
                "ചരിത്രം",
            ],
            3 => [
                "Mawlid",
            ],
        ];
    }

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

        $questions = $this->questions[$moduleSlug];

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
        $questions = $this->questions[$key];

        return view("app.{$moduleSlug}.{$key}", compact("question", "module", "menuSlug", "moduleSlug", "questionSlug", "questions"));
    }
}
