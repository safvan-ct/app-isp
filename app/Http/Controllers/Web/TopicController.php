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
            "meelad" => [
                "slug"     => "meelad",
                "title"    => "നബിദിനം (റ. അ. 12)",
                "desc"     => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                "chapters" => [
                    "റബീഉൽ അവ്വൽ മാസവും നബിദിനവും - അടിസ്ഥാനം",
                    "നബിദിന ആഘോഷങ്ങളുടെ ചരിത്രം",
                    "മൗലിദ് കൃതികൾ - ചരിത്രം",
                ],
            ],
            2        => [
                "ചരിത്രം",
            ],
            3        => [
                "Mawlid",
            ],
            "namaz"  => [
                "slug"     => "namaz",
                "title"    => "സ്വലാത് (നമസ്കാരം)",
                "desc"     => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                "chapters" => [
                    "5 നിർബന്ധിത നമസ്കാരങ്ങൾ",
                    "അദാൻ & ഇഖാമത്ത്",
                    "നമസ്‌കാരത്തിന്റെ ശര്‍ത്തുകള്‍",
                    "നമസ്കാരത്തിന്റെ ഫർളുകൾ",
                    "ജമാഅത് (സംഘം) ചേർന്ന് നമസ്കരിക്കൽ",
                    // "ജുമുഅ നമസ്കാരം",
                    // "തറാവീഹ് നമസ്കാരം",
                    // "വിത്ർ നമസ്കാരം",
                    // "തഹജ്ജുദ് നമസ്കാരം",
                    // "ളുഹാ നമസ്കാരം",
                ],
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
        $questions = $this->questions[$moduleSlug];

        return view("app.{$moduleSlug}.{$key}", compact("question", "module", "menuSlug", "moduleSlug", "questionSlug", "questions"));
    }
}
