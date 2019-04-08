<footer class="blog-footer">
    <span>地瓜会武术，谁都挡不住 : <a href="https://github.com/EricGSX/spider">@Eric.Guo</a> </span>
    {{--<p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a><a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://github.com/EricGSX/spider">@Eric.Guo</a>.</p>--}}
    {{--<span class='btn btn-info'>TOP</span>--}}
    <span> Follow me :  <a href="https://gitee.com/EricGuosx/spider"><img src="{{asset('image/gitee.gif')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:21px;height: 21px;'/></a><a href="https://github.com/EricGSX/spider"><img src="{{asset('image/github.jpg')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:34px;height: 25px;'/></a></span>
    <span style="padding-left: 50px;">&copy;2018 guosx.com All rights reserved. &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn"> 豫ICP备16038585号-1</a></span>
</footer>
<footer class="blog-footer">
    <span>Friendly Link :
        @foreach($friend_links as $friend_link)
        <a href="{{$friend_link->link_url}}" target="_blank">{{$friend_link->nick}}</a> |
        @endforeach
    </span>
</footer>
<div id='scroll-to-top' style="position: fixed;right:1%;bottom:1%;"><a href='#'><img src="{{asset('image/scroll-to-top2.jpg')}}" style="width:50px;height:50px;"></a></div>
<script>
    $('#scroll-to-top').hide()
    $(window).scroll(function(){
        if($(window).scrollTop()>=100){
            $('#scroll-to-top').show()
        }
        if($(window).scrollTop()<100){
            $('#scroll-to-top').hide()
        }
    });
    console.log('不是别人不好，是自己不够优秀。')
    console.log('%cMake a little progress every day ', 'background-image:-webkit-gradient( linear, left top, right top, color-stop(0, #f22), color-stop(0.15, #f2f), color-stop(0.3, #22f), color-stop(0.45, #2ff), color-stop(0.6, #2f2),color-stop(0.75, #2f2), color-stop(0.9, #ff2), color-stop(1, #f22) );color:transparent;-webkit-background-clip: text;font-size:5em;');
</script>
