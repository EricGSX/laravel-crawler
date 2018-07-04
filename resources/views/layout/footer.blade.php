<footer class="blog-footer">
    <p>Write Less Do More by <a href="https://github.com/EricGSX/spider">@Eric.Guo</a> </p>
    {{--<p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a><a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://github.com/EricGSX/spider">@Eric.Guo</a>.</p>--}}
    {{--<span class='btn btn-info'>TOP</span>--}}
    <p>地瓜会武术谁都挡不住  Follow me :  <a href="https://gitee.com/EricGuosx/spider"><img src="{{asset('image/gitee.gif')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:30px;height: 30px;'/></a><a href="https://github.com/EricGSX/spider"><img src="{{asset('image/github.jpg')}}" alt="开源是一种精神-GuoShiXin" title="开源是一种精神-GuoShiXin" style='width:34px;height: 25px;'/></a></p>
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
