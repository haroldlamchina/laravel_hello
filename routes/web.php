<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//用户登陆页面
Route::get('/login','\App\Http\Controllers\LoginController@index');
//用户登陆行为
Route::post('/login','\App\Http\Controllers\LoginController@login');
//用户注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');
//个人中心设置页面
Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
//个人中心设置操作行为
Route::post('/user/me/setting','\App\Http\Controllers\UserController@settingstore');

//文章列表页
Route::get('/posts','\App\Http\Controllers\PostController@index');
//创建文章页
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');
//文章详情页
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');

//修改文章页
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');
//删除文章页
Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');
//图片上传
Route::post('/posts/img/upload','\App\Http\Controllers\PostController@imgUpload');



