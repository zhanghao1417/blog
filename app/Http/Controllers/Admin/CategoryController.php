<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
//    get.admin/category 全部分类列表
    public function index()
    {
        $categorys = (new Category)->tree();
        return view('admin.category.index')->with('data',$categorys);
    }

//    改变排序的ajax
    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['id']);
        $cate -> orders = $input['order'];
        $res = $cate -> update();

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

//    get.admin/category/create 添加分类
    public function create()
    {
        $data = Category::where('pid',0)->get();
        return view('admin/category/add',compact('data'));
    }

//    post.admin/category  添加分类提交方法
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'name'=>'required',
        ];

        $message = [
            'name.required'=>'分类名称不能为空',
        ];

        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes()){
            $res = Category::create($input);
            if($res){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

//    get.admin/category/{category}/edit 编辑分类
    public function edit($id)
    {
        $field = Category::find($id);
        $data = Category::where('pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }


//    put.admin/category/{category} 更新分类
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $res = Category::where('id',$id)->update($input);

        if ($res){
            return redirect('admin/category');
        }else{
            return back()->with('errors','数据修改失败，请稍后重试');
        }

    }

//    get.admin/category/{category} 显示单个分类信息
    public function show()
    {

    }

//    delete.admin/category/{category} 删除单个分类
    public function destroy($id)
    {
        $res = Category::where('id',$id)->delete();
        Category::where('pid',$id)->update(['pid' => 0]);
        if($res){
            $data = [
                'status' => 0,
                'msg'    => '分类删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '分类删除失败，请稍后重试'
            ];
        }
        return $data;
    }

}
