<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
//    admin登录
    public function login()
    {
        if ($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code){
                return back()->with('msg','验证码错误');
            }
            $user = User::first();
            if($user->name != $input['username'] || Crypt::decrypt($user->password) != $input['password']){
                return back()->with('msg','用户名或者密码错误');
            }
            session(['user'=>$user]);
            return redirect('admin/index');
        }else{
            session(['user'=>null]);
            return view('admin.login');
        }

    }

//    admin退出
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

//    生成验证码
    public function code()
    {
        $code = new \Code;
        $code -> make();
    }

}
