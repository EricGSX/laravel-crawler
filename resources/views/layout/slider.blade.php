<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item" style="background:url(http://three.com/image/banner1.jpg); background-size:cover;height: 200px;">
            {{--<img src="">--}}
            <div class="carousel-caption">Make a little progress every day.</div>
        </div>
        <div class="item" style="background:url(http://three.com/image/banner2.jpg); background-size:cover;height: 200px;">
            <div class="carousel-caption">Stay Hungry. Stay Foolish.</div>
        </div>
        <div class="item active" style="background:url(http://three.com/image/banner3.jpg); background-size:cover;height: 200px;">
            <div class="carousel-caption">Nobody asked you must is remarkable, but yourself. No one can reach excellent step, just a little bit of progress every day.</div>
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>