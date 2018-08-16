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
}
