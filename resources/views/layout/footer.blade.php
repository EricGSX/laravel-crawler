<footer class="blog-footer">
    <p>Write Less Do More by <a href="https://github.com/EricGSX/spider">@Eric.Guo</a> </p>
    {{--<p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a><a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://github.com/EricGSX/spider">@Eric.Guo</a>.</p>--}}
    {{--<span class='btn btn-info'>TOP</span>--}}
    <p>地瓜会武术谁都挡不住  Follow me :  <a href="https://gitee.com/EricGuosx/spider"><img src="{{asset('image/gitee.gif')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:21px;height: 21px;'/></a><a href="https://github.com/EricGSX/spider"><img src="{{asset('image/github.jpg')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:34px;height: 25px;'/></a></p>
    <p><a href="http://www.miitbeian.gov.cn"> 豫ICP备16038585号</a></p>
</footer>
<div id='scroll-to-top' style="position: fixed;right:1%;bottom:1%;"><a href='#'><img src="{{asset('image/scroll-to-top2.jpg')}}" style="width:50%;height:50%;"></a></div>
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
</script>
<div style="position: fixed;left:1%;top:20%;" tabindex="0"  role="button" data-toggle="popover" data-trigger="hover" data-html="true" data-content='    <aside id="widget-fature" class="widget panel panel-primary">
        <div class="panel-heading">
            特色功能
        </div>
        <img src="/image/contact-me.jpg">
    </ul>
    </aside>'>
    <div><img style="width:50px;height:50px;" src="{{asset('image/contact-me.jpg')}}" /></div>
    <div><span class="label label-primary" >Contact</span></div>
</div>
