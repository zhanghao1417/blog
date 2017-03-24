<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
//        点击量最高的文章
        $hotA = Article::orderBy('view','desc')->take(6)->get();

//        图文列表带分页
        $data = Article::orderBy('time','desc')->paginate(5);

//        友情链接
        $links = Links::orderBy('orders','asc')->get();

        return view('home.index',compact('hotA','data','links'));
    }

    public function cate($id)
    {
//        图文列表带分页
        $data = Article::where('cate_id',$id)->orderBy('time','desc')->paginate(4);

        Category::where('id',$id)->increment('view');

//        当前分类的子分类
        $submenu = Category::where('pid',$id)->get();

        $field = Category::find($id);
        return view('home.list',compact('field','data','submenu'));
    }

    public function article($id)
    {
        $field['art'] = Article::where('id',$id)->first();
        $field['cate'] = Category::where('id',$field['art']->cate_id)->first();

        Article::where('id',$id)->increment('view');

        $article['pre'] = Article::where('id','<',$id)->orderBy('id','desc')->first();
        $article['next'] = Article::where('id','>',$id)->orderBy('id','asc')->first();

        $data = Article::where('cate_id',$field['art']->id)->orderBy('id','desc')->take(6)->get();

        return view('home.new',compact('field','article','data'));
    }

}
