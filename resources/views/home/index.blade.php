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
                <ul class="list-group">
                    <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;近期将开通本站SSL证书免费申请入口</li>
                    <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;发布鼠标点击特效</li>
                    <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;发布鼠标点击特效</li>
                </ul>
            </div>
            <div class="panel panel-default">
              <div class="panel-body">
                            @foreach($posts as $post)
                      <div class="blog-post">
                          <span class="blog-post-title"><a href="/posts/{{$post->id}}" >{{$post->title}}</a></span>
                            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} <a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></p>

                          {!! str_limit($post->description,100,'...') !!}
                          @auth
                              <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}} | <i class="glyphicon glyphicon-tag"></i> php</p>
                          @endauth
                        </div>
                  @endforeach
                  {{$posts->links()}}
              </div>
            </div>
            {{--内容面板--}}
        </div><!-- /.blog-main  -->
    </div>
        <script type="text/javascript">
            function AutoScroll(obj) {
                $(obj).find("ul:first").animate({
                    marginTop: "-40px"
                }, 500, function() {
                    $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
                });
            }
        $(document).ready(function() {
            setInterval('AutoScroll("#demo")', 1000)
        });
    </script>
@endsection