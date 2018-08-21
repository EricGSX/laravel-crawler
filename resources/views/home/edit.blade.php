@extends('layout.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <form action="/posts/{{$id->id}}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$id->title}}">
                </div>
                <div class="form-group">
                    <label>摘要</label>
                    <textarea id="description"  name="description" class="form-control">{{$id->description}}</textarea>
                </div>
                <div class="form-group">
                    <div><label>编码方式</label></div>
                    @if($id->encoding_type == 1)
                    <button class='btn btn-primary eric-coding-type' type='button'>富文本</button>
                    @elseif($id->encoding_type == 2)
                    <button class='btn btn-primary eric-coding-type' type='button'>MarkDown</button>
                    @endif
                    <input name="encoding_type" type="hidden" id='encoding_type' value="{{$id->encoding_type}}">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    @if($id->encoding_type == 1)
                    <textarea id="content-2" name="content" class="form-control" rows='13'>{{$id->content}}</textarea>
                        <script type="text/javascript" src="{{asset('js/eric.guo.editor.min.js')}}"></script>
                        <script type="text/javascript" src="{{asset('js/eric.js')}}"></script>
                    @elseif($id->encoding_type == 2)
                    <textarea id="content-1"  name="content" class="form-control" rows="13">{{$id->content}}</textarea>
                    @endif
                </div>
@include('layout.error')
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            <br>
        </div><!-- /.blog-main -->
@endsection