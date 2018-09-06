<div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <aside id="widget-welcome" class="widget panel panel-default">
        <div class="panel-heading">
            <p style='text-align: center;'>
                 <img src="{{asset('image/guoshixin.jpg')}}" alt="" class="img-circle" style="width:110px;height:122px;">
            </p>
            <p>
                <strong><a href="/">咖啡泡柠檬</a></strong> Make a little progress every day
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
            <a href="#" class="tagc1">MarkDown</a>
            <a href="#" class="tagc2">Linux</a>
            <a href="#" class="tagc3">PHP</a>
            <a href="#" class="tagc1">Mysql批量插入</a>
            <a href="#" class="tagc5">鼠标点击特效</a>
            <a href="#" class="tagc5">鼠标UI</a>
            </ul>
    </aside>
        {{--标签云--}}
    <br />
    <aside id="widget-categories" class="widget panel panel-default">
        <div class="panel-heading" style='text-align: center;'>
            公告
        </div>

        <ul class="category-root list-group">
            <li class="list-group-item">
                <a href="/topic/1">近期将开通本站SSL证书免费申请入口
                </a>
            </li>
            <li class="list-group-item">
                <a href="javascript:void(0)">发布鼠标点击特效</a>
            </li>
            <li class="list-group-item">
                <a href="javascript:void(0)">开通Markdown编辑模式</a>
            </li>
        </ul>
    </aside>
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
    <aside id="widget-fature" class="widget panel panel-default">
        <div class="panel-heading" >
            Web小工具
        </div>

        <ul class="category-root list-group">
            <li class="list-group-item">
                <a href="/topic/1">CSR在线生成
                </a>
            </li>
            <li class="list-group-item">
                <a href="/topic/1">SSL证书申请
                </a>
            </li>
            <li class="list-group-item">
                <a href="/posts/weather">天气查询
                </a>
            </li>
        </ul>
    </aside>

</div>
<style>
    #tagscloud{height:260px;position:relative;font-size:12px;color:#333;margin:20px auto 0;text-align:center;}
    #tagscloud a{position:absolute;top:0px;left:0px;color:#333;font-family:Arial;text-decoration:none;margin:0 10px 15px 0;line-height:18px;text-align:center;font-size:12px;padding:1px 5px;display:inline-block;border-radius:3px;}
    #tagscloud a.tagc1{background:#666;color:#fff;}
    #tagscloud a.tagc2{background:#F16E50;color:#fff;}
    #tagscloud a.tagc3{background:blue;color:#fff;}
    #tagscloud a.tagc5{background:#006633;color:#fff;}
    #tagscloud a:hover{color:#fff;background:#0099ff;}
</style>
    <script>
	$(function () {
        $('[data-toggle="popover"]').popover()
    })
	</script>