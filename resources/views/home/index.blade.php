@extends('layout.main')

@section('content')
        <div class="col-sm-8 blog-main">
        <div>
@include('layout.slider')
</div>        <div style="height: 20px;">
        </div>
        <div>
            {{--内容面板--}}
            {{--滚动通知--}}
                   <style type="text/css">a{cursor: pointer;text-decoration: none!important;}</style>
            <div class="panel panel-default">
              <div  id="scrollBox">
                       <div id="roll_one">
                           <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i>Hot</label> &nbsp;&nbsp;&nbsp;<a>近期将开通本站SSL证书免费申请入口</a></li>
                            <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i>Hot</label> &nbsp;&nbsp;&nbsp;发布鼠标点击特效</li>
                            <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i>Hot</label> &nbsp;&nbsp;&nbsp;123123</li>
                        </div>
              </div>
            </div>
            {{--滚动通知--}}
            <div class="panel panel-default">
              <div class="panel-body">
                            @foreach($posts as $post)
                      <div class="blog-post">{{count($post->topics)}}
                          <span class="blog-post-title"><a href="/posts/{{$post->id}}" >{{$post->title}}</a></span>
                            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} <a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></p>
                          {!! str_limit($post->description,100,'...') !!}
                          @if(count($post->topics) == 0)
                              <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}} | 阅读 {{$post->view_count}} | <i class="label label-warning">Other</i> </p>
                          @else
                              <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}} | 阅读 {{$post->view_count}} | <i class="label label-info">{{$post->topics[0]->name}}</i> </p>
                          @endif
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