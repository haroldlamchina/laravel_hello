<?php

namespace App;

use \App\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{

    use Searchable;
    //定义es里面的type
    public function searchableAs()
    {
        return "post";
    }
    //定义搜索字段
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }

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
