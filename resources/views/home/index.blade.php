@extends('layout.main')

@section('content')
        <div class="col-sm-8 blog-main">
        <div>
@include('layout.slider')
</div>        <div style="height: 20px;">
        </div>
        <div>
            {{--内容面板--}}
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Cras justo odio
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>
            <div class="panel panel-default">
              <div class="panel-body">
                            @foreach($posts as $post)
                      <div class="blog-post">
                          <span class="blog-post-title"><a href="/posts/{{$post->id}}" >{{$post->title}}</a></span>
                            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} <a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></p>

                          {!! str_limit($post->description,100,'...') !!}
                          @auth
                              <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}} | <i class="glyphicon glyphicon-tags"></i> php</p>
                          @endauth
                        </div>
                  @endforeach
                  {{$posts->links()}}
              </div>
            </div>
            {{--内容面板--}}
        </div><!-- /.blog-main  -->
    </div>
@endsection