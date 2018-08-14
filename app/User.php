<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as authenticatable;

class User extends authenticatable
{
    //允许注入的字段
    protected $fillable=['name','email','password'];
}
