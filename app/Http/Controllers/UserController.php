<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }
    //个人设置操作
    public function settingstore()
    {
        return null;
    }

    //个人中心
    public function show(User $user)
    {
        //当前用户的信息   包括关注数粉丝数以及文章数
        $user=User::withCount(['fans','stars','posts'])->find($user->id);
        //获取当前用户的文章列表
        $posts=$user->posts()->orderBy('created_at','desc')->take(10)->get();
        //当前用户的关注列表  包括关注列表里的用户关注数粉丝数以及文章数
        $stars=$user->stars;
        $susers=User::whereIn('id',$stars->pluck('star_id'))->withCount(['fans','stars','posts'])->get();
        //当前用户的粉丝列表用户  包括粉丝列表里的用户关注数粉丝数以及文章数
        $fans=$user->fans;
        $fusers=User::whereIn('id',$fans->pluck('fan_id'))->withCount(['fans','stars','posts'])->get();

        return view('user.show',compact('user','posts','fusers','susers'));
    }
    //关注
    public function fan(User $user)
    {
        $Nuser=\Auth::user();
        $Nuser->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];

    }
    //取消关注
    public function unfan(User $user)
    {
        $Nuser=\Auth::user();
        $Nuser->doUnFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }

}
