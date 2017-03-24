<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
//    get.admin/navs 全部导航列表
    public function index()
    {
        $data = Navs::orderBy('orders','asc')->get();

        return view('admin.navs.index',compact('data'));
    }

//    改变排序的ajax
    public function changeOrder()
    {
        $input = Input::all();
        $navs = Navs::find($input['id']);
        $navs -> orders = $input['order'];
        $res = $navs -> update();

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

//    get.admin/navs/create 添加导航
    public function create()
    {
        return view('admin/navs/add');
    }

//    post.admin/navs  添加导航提交方法
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'name'=>'required',
            'url'=>'required',
        ];

        $message = [
            'name.required'=>'导航名称不能为空',
            'url.required'=>'导航地址不能为空',
        ];

        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes()){
            $res = Navs::create($input);
            if($res){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','导航添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }


//    get.admin/navs/{navs}/edit 编辑分类
    public function edit($id)
    {
        $field = Navs::find($id);

        return view('admin.navs.edit',compact('field'));
    }


//    put.admin/navs/{navs} 更新导航
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $res = Navs::where('id',$id)->update($input);

        if ($res){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','数据修改失败，请稍后重试');
        }

    }


//    delete.admin/navs/{navs} 删除单个导航
    public function destroy($id)
    {
        $res = Navs::where('id',$id)->delete();

        if($res){
            $data = [
                'status' => 0,
                'msg'    => '导航删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '导航删除失败，请稍后重试'
            ];
        }
        return $data;
    }

}
