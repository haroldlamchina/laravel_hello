<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view("login.index");
    }
    //登陆行为
    public function login()
    {
        //验证
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|min:5',
            'is_remember'=>'integer'
        ]);
        //逻辑
        $user=request(['email','password']);
        $is_remember=boolval(request('is_remember'));
        if(\Auth::attempt($user,$is_remember))
        {
            return redirect("/posts");
        }
        //渲染
        return \Redirect::back()->withErrors('邮箱密码不匹配，请重新输入！');


    }
    //用户登出
    public function logout()
    {
        \Auth::logout();
        return redirect("/login");
    }


}
