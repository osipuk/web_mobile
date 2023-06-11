<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Lang;

use App;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        $var=App::setLocale($locale);
        $locale = Lang::getLocale();
        //storing the locale in session to get it back in the middleware
        $var=session()->put('locale', $locale);
        Cookie::queue('locale',  $locale, 120);
        return redirect()->back();
    }
}
