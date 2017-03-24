<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $hotB = Article::orderBy('view','desc')->take(5)->get();

        $new = Article::orderBy('time','desc')->take(8)->get();

        $navs = Navs::all();

        View::share('navs',$navs);
        View::share('hotB',$hotB);
        View::share('new',$new);
    }
}
