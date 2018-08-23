<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as authenticatable;

class User extends authenticatable
{
    //允许注入的字段
    protected $fillable=['name','email','password'];

    //用户的文章列表
    public function posts()
    {
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //获取关注我的粉丝列表
    public function fans()
    {
        return $this->hasMany(\App\Fan::class,'star_id','id');

    }
    //获取被我关注的 明星列表
    public function stars()
    {
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    //关注某人
    public function doFan($uid)
    {
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return $this->stars()->save($fan);
    }
    //取消关注某人
    public function doUnFan($uid)
    {
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return $this->stars()->delete($fan);
    }
    //当前用户是否被某人关注了
    public function hasFan($uid)
    {
       return $this->fans()->where('fan_id',$uid)->count();
    }
    //当前用户是否关注了某人
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

}
