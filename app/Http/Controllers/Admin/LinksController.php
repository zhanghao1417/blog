<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
//    get.admin/links 全部链接列表
    public function index()
    {
        $data = Links::orderBy('orders','asc')->get();

        return view('admin.links.index',compact('data'));
    }

//    改变排序的ajax
    public function changeOrder()
    {
        $input = Input::all();
        $links = Links::find($input['id']);
        $links -> orders = $input['order'];
        $res = $links -> update();

        if ($res){
            $data = [
                'status' => 0,
                'msg' => '排序更新成功!'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '排序更新失败!'
            ];
        }
        return $data;
    }

//    get.admin/links/create 添加链接
    public function create()
    {
        return view('admin/links/add');
    }

//    post.admin/links  添加链接提交方法
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'name'=>'required',
            'url'=>'required',
        ];

        $message = [
            'name.required'=>'链接名称不能为空',
            'url.required'=>'链接地址不能为空',
        ];

        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes()){
            $res = Links::create($input);
            if($res){
                return redirect('admin/links');
            }else{
                return back()->with('errors','链接添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }


//    get.admin/links/{links}/edit 编辑分类
    public function edit($id)
    {
        $field = Links::find($id);

        return view('admin.links.edit',compact('field'));
    }


//    put.admin/links/{links} 更新链接
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $res = Links::where('id',$id)->update($input);

        if ($res){
            return redirect('admin/links');
        }else{
            return back()->with('errors','数据修改失败，请稍后重试');
        }

    }


//    delete.admin/links/{links} 删除单个链接
    public function destroy($id)
    {
        $res = Links::where('id',$id)->delete();

        if($res){
            $data = [
                'status' => 0,
                'msg'    => '链接删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '链接删除失败，请稍后重试'
            ];
        }
        return $data;
    }

}
