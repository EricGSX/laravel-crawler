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
                   <style type="text/css">
            #scrollBox{height:100px;overflow:hidden;}

        </style>
            <div class="panel panel-default">
              <div class="panel-heading">公告 & 推荐</div>
              <div  id="scrollBox">
                       <div id="roll_one">
                            <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;近期将开通本站SSL证书免费申请入口</li>
                            <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;发布鼠标点击特效</li>
                            <li class="list-group-item"><label class="label label-danger"><i class="glyphicon glyphicon-flag"></i></label> &nbsp;&nbsp;&nbsp;发布鼠标点击特效</li>
                        </div>
                        <div id="roll_two"></div>
              </div>
            </div>
    <script type="text/javascript">
                var roll_area =document.getElementById('scrollBox');
                var roll_one = document.getElementById('roll_one');
                var roll_two = document.getElementById('roll_two');
                roll_two.innerHTML=roll_one.innerHTML;
                function scrollUp(){
                    if(roll_area.scrollTop>=roll_one.offsetHeight){
                        roll_area.scrollTop=0;
                    }else{
                        roll_area.scrollTop++
                    }
                }
                var time = 50;
                var mytimer=setInterval(scrollUp,time);
                roll_area.onmouseover=function(){
                    clearInterval(mytimer);
                }
                roll_area.onmouseout=function(){
                    mytimer=setInterval(scrollUp,time);
                }
        </script>
            {{--滚动通知--}}
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