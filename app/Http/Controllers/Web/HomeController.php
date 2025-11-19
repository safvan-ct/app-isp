<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Repository\Topic\TopicInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function showForm()
    {
        return view('app.contact');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required|min:5',
        ]);

        Mail::to('islamicstudyportal@gmail.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent!');
    }

}
