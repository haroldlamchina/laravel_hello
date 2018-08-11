<?php

namespace App\Http\Controllers;

use \App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    //列表
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->paginate(6);
        return view('post/index',compact("posts"));
    }
    //文章详情页
    public function show()
    {
        $title='hello word';
        return view("post/show",['title'=>'hool']);
    }
    //创建文章页
    public function create()
    {
        return view("post/add");
    }
    //创建文章保存操作
    public function store()
    {

    }
    //文章编辑页面
    public function edit()
    {
        return view("post/edit");
    }
    //文章编辑保存
    public function update()
    {

    }
    //文章删除操作
    public function delete()
    {

    }
}
