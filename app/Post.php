<?php

namespace App;

use \App\Model;

class Post extends Model
{
    //
    //protected $guarded=[];
    //protected $fillable=['title','content'];
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //关联评论
    public function comment()
    {
        return $this->hasMany('App\Comment','post_id','id')->orderBy('created_at','desc');
    }
    //和用户关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //赞总数
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
}
