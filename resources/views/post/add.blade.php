@extends("layout.main")
@section("content")
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
                {{--<input name="_token" value="{{csrf_token()}}" type="hidden"/>--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题">
                </div>
                {{--<div class="form-group">--}}
                    {{--<label>内容</label>--}}
                    {{--<textarea id="editor"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>--}}
                {{--</div>--}}
                <div id="editor">
                </div>
                <textarea id="content" style="width:100%; height:200px;display: none" name="content" ></textarea>
                @include("layout.error")

                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->

@endsection