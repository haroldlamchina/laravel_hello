<?php

namespace App\Http\Controllers;

use App\Comment;
use \App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    //列表
    public function index()
    {
        //$app=app();
        //$log=$app->make("log");
//        \Log::info('testlog',['post'=>'list2']);

        $posts=Post::orderBy('created_at','desc')->withCount('comment')->paginate(6);
        return view('post/index',compact("posts"));
    }
    //文章详情页
    public function show(Post $post)
    {
        //预加载comment  使得view层不再抓取数据库
        $post->load('comment');
        return view("post/show",compact("post"));
    }
    //创建文章页
    public function create()
    {
        return view("post/add");
    }
    //创建文章保存操作
    public function store()
    {
//        \Request::all();
//      request()->all();
        /*$post=new Post();
        $post->title=request('title');
        $post->content=request('content');
        $post->save();*/

        //验证
        /*$this->validate(request(),[
            'title'=>"required|string|min:5|max:100",
            'content'=>"required|string|min:10",
        ],[
            "title.min"=>"文章标题最少不小于5个字符"
        ]);*/

        $this->validate(request(),[
            'title'=>"required|string|min:5|max:100",
            'content'=>"required|string|min:10",
        ]);
        //逻辑
        $user_id=\Auth::id();
        $parm=array_merge(request(['title','content']),compact('user_id'));
        $post=Post::create($parm);
        return redirect("/posts");


    }
    //文章编辑页面
    public function edit(Post $post)
    {
        return view("post/edit",compact("post"));
    }
    //文章编辑保存
    public function update(Post $post)
    {
        //验证
        $this->validate(request(),[
            'title'=>"required|string|min:5|max:100",
            'content'=>"required|string|min:10",
        ]);
        $this->authorize('update',$post);
        //逻辑
        $post->title=request("title");
        $post->content=request("content");
        $post->save();
        //渲染
        return redirect("/posts/{$post->id}");

    }
    //文章删除操作
    public function delete(Post $post)
    {
        // TODO 用户权限验证
        $this->authorize('delete',$post);

        $post->delete();
        return redirect("/posts");

    }

    //上传图片
    public function imgUpload(Request $request)
    {
        $path=$request->file("imgbylam")->storePublicly(md5(time()));
        //return asset('storage/'.$path);
//        {
//            // errno 即错误代码，0 表示没有错误。
//            //       如果有错误，errno != 0，可通过下文中的监听函数 fail 拿到该错误码进行自定义处理
//            "errno": 0,
//
//    // data 是一个数组，返回若干图片的线上地址
//    "data": [
//            "图片1地址",
//            "图片2地址",
//            "……"
//        ]
//        }
        $errnoCode=0;
        $errnoMsg='';
        if(file_exists('storage/'.$path))
        {
            $errnoCode=0;

        }else{
            $errnoCode=1;

        }
        return array(
            'errno'=>$errnoCode,
            'data'=>array(asset('storage/'.$path)),
        );

    }

    //文章评论
    public function comment(Post $post)
    {

        //验证
        $this->validate(request(),[
           'content'=>'required|min:5'
        ]);

        //逻辑
        $comment=new Comment();
        $comment->user_id=\Auth::id();
        $comment->content=request('content');
        $post->comment()->save($comment);
        //渲染
        return back();


    }

    //赞行为
    public function zan(Post $post)
    {
        //验证
        //逻辑
        $param=[
            'user_id'=>\Auth::id(),
            'post_id'=>$post->id,
        ];
        Zan::firstOrCreate($param);
        //渲染
        return back();


    }
    //取消赞行为
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

}
