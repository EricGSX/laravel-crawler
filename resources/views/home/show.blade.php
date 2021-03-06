@extends('layout.main')
@section('content')
<style type="text/css">
    .blog-main > .blog-post > pre{color: white!important;background-color: #333!important;}
     pre>.hljs{color:white!important;background:initial!important;}
</style>
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h1 class="blog-post-title">{{$id->title}}</h1>
                    @can('update',$id)
                    <a style="margin: auto"  href="/posts/{{$id->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endcan
                    @can('delete',$id)
                    <a style="margin: auto"  href="/posts/{{$id->id}}/delete">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{{$id->created_at->toFormattedDateString()}}  <a href="/user/{{$id->user->id}}">{{$id->user->name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-eye-open">{{$id->view_count}}</i></p>
                <p><strong>摘要：</strong>{{$id->description}}</p>
                @if($type == 1)
                <p>{!! $id->content !!}</p>
                @elseif($type == 2)
                {!! $html !!}
                @endif
                <div>
                    @auth
                    @if($id->zan(\Auth::id())->exists())
                    <a href="/posts/{{$id->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                    @else
                    <a href="/posts/{{$id->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                    @endif
                    @endauth
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    {{--在页面中使用--}}
                    @foreach($id->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} by {{$comment->user->name}}</h5>
                        <div>
                            {{$comment->content}}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
@auth
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/posts/{{$id->id}}/comment" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="post_id" value="62"/>
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            @include('layout.error')
                            <br />
                            <button class="btn btn-primary" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>
@endauth
        </div><!-- /.blog-main -->
@endsection
