<div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <aside id="widget-welcome" class="widget panel panel-default">
        <div class="panel-heading">
            <p style='text-align: center;'>
                <a href="https://ding.guosx.com" title="机智郭&暴力丁"><img src="{{asset('image/guoshixin.jpg')}}" alt="机智郭&暴力丁" class="img-circle" style="width:110px;height:122px;"></a>
            </p>
            <p>
                <strong><a href="javascript:void(0)" style="text-decoration: none;">咖啡泡柠檬</a></strong> Make a little progress every day
            </p>
            <p>@include('layout.web_sitetime')</p>
            @include('layout.share')
            <p>
                @include('layout.chat')
            </p>
        </div>
    </aside>
            {{--标签云--}}
    <aside id="tagscloud" class="widget panel panel-default">
        <div class="panel-heading">
            标签云
        </div>
        <ul>
            @if($labels)
                @if(count($labels) >0)
                    @foreach($labels as $label)
                    <a href="/posts/{{$label->id}}" class="tagc{{rand(1, 5)}}">{{$label->title}}</a>
                    @endforeach
                @endif
            @endif
        </ul>
    </aside>
        {{--标签云--}}
    <br />
    <aside id="widget-categories" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            邀请好友
        </div>
        <div class="row" style='margin-bottom: 8px;margin-top: 8px;'>
            <div class="col-sm-8">
                <input value="https://www.guosx.com" readonly='true' class="form-control" id='my_web_url'>
            </div>
            <div class="col-sm-4">
                 <button class="btn btn-primary" type='button' onclick="copy()" >复制链接</button>
            </div>
        </div>    
    </aside>
    @auth
    @if(\Auth::user()->id == 1)
    <aside id="widget-categories" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            专栏
        </div>

        <ul class="category-root list-group">
            @foreach($topics as $topic)
            <li class="list-group-item">
                <a href="/topics/{{$topic->id}}">{{$topic->name}}
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
    @endif
    @endauth
    <aside id="widget-fature" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            Web小工具
        </div>

        <ul class="category-root list-group">
            <li class="list-group-item">
                <a href="/posts/weather" target=_blank>天气查询
                </a>
            </li>
            <li class="list-group-item">
                <a href="https://doc.guosx.com/index.php" target="_blank">API文档工具
                </a>
            </li>
        </ul>
    </aside>
        <aside id="widget-fature" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            建议&反馈
        </div>
        <div class="row">
            <style>
                .eric-form{
                    border-top:0px solid #fff!important;border-left:0px solid #fff!important;border-right:0px solid #fff!important;border-radius:0px!important;border-bottom:1px solid #dcdcdc!important;box-shadow: none!important;
                }
            </style>
            <form action="/emails" method="POST" id="email_form">
                {{csrf_field()}}
                <div class="col-sm-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <input value="" class="form-control eric-form" name='email_user' placeholder="UserName"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <input value="" class="form-control eric-form" name='email_address' placeholder="Email"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <textarea class="form-control eric-form" name="email_commits"  placeholder="Commits"></textarea>
                    </div>
                </div>
                <div class="col-sm-12" style="margin:8px;">
                    <div class="col-sm-8">
                        @include('layout.error')
                        <button type="button" onclick="change_status(this)" class="btn btn-default col-sm-6 col-xs-12">Go<label class="glyphicon glyphicon-send"></label></button>
                    </div>
                </div>
            </form>
            <script>
                function change_status(obj){
                    $(obj).attr('disabled',true);
                    $('#email_form').submit();
                }
            </script>
        </div>
    </aside>
    <aside id="widget-fature" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            Recent Suggestions
        </div>
        <ul class="category-root list-group">
            @foreach($feedbacks as $feedback)
                <li class="list-group-item">
                <b>{{$feedback->username}}:</b>{{$feedback->commits}}
            </li>
            @endforeach
        </ul>
    </aside>

</div>
<style>
    #tagscloud{height:260px;position:relative;font-size:12px;color:#333;margin:20px auto 0;text-align:center;}
    #tagscloud a{position:absolute;top:0px;left:0px;color:#333;font-family:Arial;text-decoration:none;margin:0 10px 15px 0;line-height:18px;text-align:center;font-size:12px;padding:1px 5px;display:inline-block;border-radius:3px;}
    #tagscloud a.tagc1{background:#666;color:#fff;}
    #tagscloud a.tagc2{background:#F16E50;color:#fff;}
    #tagscloud a.tagc4{background:#f39c12;color:#fff;}
    #tagscloud a.tagc3{background:blue;color:#fff;}
    #tagscloud a.tagc5{background:#006633;color:#fff;}
    #tagscloud a:hover{color:#fff;background:#0099ff;}
</style>
<script type="text/javascript">
    function copy(){
    var Url2=document.getElementById("my_web_url");
    Url2.select();
 try{
      if(document.execCommand('copy', false, null)){
       document.execCommand("copy");
       alert("复制成功");
      } else{
       alert("当前浏览器不兼容，请手动复制");
      }
  } catch(err){
   alert("当前浏览器不兼容，请手动复制");
  }
}
</script>