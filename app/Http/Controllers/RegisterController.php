<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view("register.index");
    }
    //注册行为
    public function register()
    {
        //验证
        $this->validate(request(),[
            'name'=>'required|string|min:5|max:14|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:5|max:14|confirmed',
        ]);
        //逻辑
        $name=request('name');
        $email=request('email');
        $password=bcrypt(request('password'));
        User::create(compact('name','email','password'));

        //渲染
        return redirect("/posts");
    }
}
