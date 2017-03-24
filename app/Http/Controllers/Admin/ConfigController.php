<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
//    get.admin/config 全部配置项列表
    public function index()
    {
        $data = Config::orderBy('orders','asc')->get();

        foreach ($data as $k => $v){
            switch ($v -> type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name = "content+'.$v->id.'" value="'.$v->content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea name = "content+'.$v->id.'" >'.$v->content.'</textarea>';
                    break;
                case 'radio':
                    $arr = explode('，',$v->value);
                    $str = '';
                    foreach ($arr as $m => $n){
                        $r = explode('|',$n);
                        $c = $v->content == $r[0]?' checked ':'';
                        $str .= '<input type="radio" name="content+'.$v->id.'" value="'.$r[0].'" '.$c.'>'.$r[1].' ';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

//    改变排序的ajax
    public function changeOrder()
    {
        $input = Input::all();
        $config = Config::find($input['id']);
        $config -> orders = $input['order'];
        $res = $config -> update();

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
    
//    更改配置内容
    public function changeContent()
    {
        $input = Input::except('_token');

        foreach ($input as $k => $v){
            $key = explode('+',$k);
            Config::where('id',$key[1])->update(['content'=>$v]);
        }
        $this->putFile();
        return back()->with('errors','配置更新成功');

    }
    
//    
    public function putFile()
    {
        $config = Config::pluck('content','name')->all();

        $path = base_path().'\config\web.php';

        $str = '<?php return '. var_export($config,true).';';

        file_put_contents($path,$str);

    }

//    get.admin/config/create 添加配置项
    public function create()
    {
        return view('admin/config/add');
    }

//    post.admin/config  添加配置项提交方法
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'name'=>'required',
            'title'=>'required',
        ];

        $message = [
            'name.required'=>'配置项名称不能为空',
            'title.required'=>'配置项标题不能为空',
        ];

        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes()){
            $res = Config::create($input);
            if($res){
                return redirect('admin/config');
            }else{
                return back()->with('errors','配置项添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

//    get.admin/config/{config}/edit 编辑配置项
    public function edit($id)
    {
        $field = Config::find($id);

        return view('admin.config.edit',compact('field'));
    }

//    put.admin/config/{config} 更新配置项
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $res = Config::where('id',$id)->update($input);

        if ($res){
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','数据修改失败，请稍后重试');
        }

    }

//    delete.admin/config/{config} 删除单个配置项
    public function destroy($id)
    {
        $res = Config::where('id',$id)->delete();

        if($res){
            $this->putFile();
            $data = [
                'status' => 0,
                'msg'    => '配置项删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '配置项删除失败，请稍后重试'
            ];
        }
        return $data;
    }

}
