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
                "title"    => "നബിദിനം (റ. അവ്വൽ 12)",
                "desc"     => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                "chapters" => [
                    "റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത, റ.അ. 12 ന്റെ അടിസ്ഥാനം",
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
                "title"    => "സ്വലാത് (നിസ്കാരം)",
                "desc"     => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                "chapters" => [
                    "നിസ്കാര സമയങ്ങൾ",
                    "അദാൻ (ബാങ്ക്) & ഇഖാമത്ത്",
                    "നിസ്‌കാരത്തിന്റെ ശര്‍ത്തുകള്‍(നിബന്ധനകള്‍)",
                    "നിസ്കാരത്തിന്റെ ഫർളുകൾ & രൂപം",
                    // "5 ഫർള്(നിർബന്ധിത) നിസ്കാരങ്ങൾ & റക്അത്തുകളുടെ എണ്ണം",
                    // "സുന്നത് നിസ്കാരങ്ങൾ",
                    // "വിത്ർ നമസ്കാരം",
                    // "തറാവീഹ് നമസ്കാരം",
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
