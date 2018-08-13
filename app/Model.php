<?php

namespace App;

use Illuminate\Database\Eloquent\Model as baseModel;

class Model extends baseModel
{
    //
    protected $guarded=[];   //不允许注入的字段
    //protected $fillable=['title','content'];  //允许注入的字段
}
