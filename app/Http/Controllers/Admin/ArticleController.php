<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
//    get.admin/article 全部文章列表
    public function index()
    {
        $data = Article::orderBy('id','desc')->paginate(10);

        return view('admin.article.index',compact('data'));
    }

//    get.admin/article/create 添加文章
    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add',compact('data'));
    }

    //    post.admin/article  添加分类提交方法
    public function store()
    {
        $input = Input::except('_token');
        $input['time'] = time();

        $rules = [
            'title'=>'required',
            'content'=>'required',
        ];

        $message = [
            'title.required'=>'文章标题不能为空',
            'content.required'=>'文章内容不能为空',
        ];

        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes()){
            $res = Article::create($input);
            if($res){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

//    get.admin/article/{article}/edit 编辑文章
    public function edit($id)
    {
        $data = (new Category)->tree();
        $field = Article::find($id);
        return view('admin.article.edit',compact('data','field'));
    }


//    put.admin/article/{article} 更新文章
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $res = Article::where('id',$id)->update($input);

        if ($res){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章修改失败，请稍后重试');
        }
    }

    //    delete.admin/article/{article} 删除文章
    public function destroy($id)
    {
        $res = Article::where('id',$id)->delete();

        if($res){
            $data = [
                'status' => 0,
                'msg'    => '文章删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '文章删除失败，请稍后重试'
            ];
        }
        return $data;
    }

}
