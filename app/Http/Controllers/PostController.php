<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    //列表
    public function index()
    {
        return view('post/index');
    }
    //文章详情页
    public function show()
    {
        $title='hello word';
        return view("post/show",compact('title'));
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
