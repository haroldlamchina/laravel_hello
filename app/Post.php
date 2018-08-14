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
}
