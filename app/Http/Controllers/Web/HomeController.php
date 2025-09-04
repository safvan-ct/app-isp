<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Topic\TopicInterface;

class HomeController extends Controller
{
    public function __construct(protected TopicInterface $topicRepository)
    {}

    public function changeLanguage($lang)
    {
        if (in_array($lang, array_keys(config('app.languages')))) {
            session()->put('lang', $lang);
            app()->setLocale(session('lang', 'en'));
        }

        return redirect()->back();
    }

    public function index()
    {
        $modules = $this->topicRepository->getModulesHasMenu();
        return view("app.index", compact("modules"));
    }

    public function calendar()
    {
        return view("app.calendar");
    }

    public function likes()
    {
        return view("app.likes");
    }
}
