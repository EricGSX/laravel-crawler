<div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

    @auth
    <aside id="widget-header" class="widget panel panel-primary">
        <div>
            <img src="{{asset('image/user.jpeg')}}" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
            {{\Auth::user()->name}}
        </div>
    </aside>
    @endauth

    <aside id="widget-welcome" class="widget panel panel-primary">
        <div class="panel-heading">
            Welcome
        </div>
        <div class="panel-body">
            <p>
                欢迎来到我的博客
            </p>
            <p>
                <strong><a href="/">博客</a></strong> Laravel+BootStrop
            </p>
            <div class="bdsharebuttonbox bdshare-button-style0-24" data-bd-bind="1494580268777"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"120473611"},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        </div>
    </aside>
    <aside id="widget-categories" class="widget panel panel-primary">
        <div class="panel-heading">
            公告
        </div>

        <ul class="category-root list-group">
            <li class="list-group-item">
                <a href="/topic/1">近期将开通本站SSL证书免费申请入口
                </a>
            </li>
        </ul>
    </aside>
    <aside id="widget-fature" class="widget panel panel-primary">
        <div class="panel-heading">
            特色功能
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
                <a tabindex="0"  role="button" data-toggle="popover" data-trigger="hover" data-html="true" data-content="<p style='color:red;'>Test</p>">Contact US</a>
            </li>
        </ul>
    </aside>

</div>
    <script>
	$(function () {
        $('[data-toggle="popover"]').popover()
    })
	</script>