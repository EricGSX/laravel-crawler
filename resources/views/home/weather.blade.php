<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="个人博客，发一些技术上遇到的问题及一些常用方法的总结，同时还会有些吐槽在里面。">
    <meta name="keywords" content="个人博客,会武术的地瓜,Linux,PHP,Mysql,前端,郭世鑫,PHP博客,Linux博客,Mysql博客,论坛,社区">
    <meta name="author" content="郭世鑫,guoshixin@guosx.com">
    <meta name="robots" content="index,follow" />
    <link rel="Shortcut Icon" href="/favicon.ico">
    <Meta name="Copyright" Content="本页版权归郭世鑫(Eric.Guo)所有。All Rights Reserved">
    <title>会武术的地瓜(郭世鑫的个人博客)</title>
<link rel="stylesheet" href="{{asset('/css/iconfont.css')}}" />
<style>
	*{margin:0;padding:0;}
    ul,li{list-style: none;}
    a{text-decoration: none;}
    html,body{width:100%;height:100%;background:#00BFFF;}
    input{border:none;outline:none;}
    .clearfix:after { content: "";height: 0;line-height: 0;display: block; clear: both;}
    .clearfix {zoom: 1;}
    .wrap{width:600px;min-height:300px;position:fixed;left:50%;top:50%;margin-left:-300px;margin-top:-150px;}
    .wrap .header{width:100%;height:40px;position:relative;line-height:40px;border:1px solid #fff;border-radius:4px;}
    .wrap .header .intCity{width:80%;height:40px;line-height:40px;font-size:16px;text-indent: 10px;}
    .wrap .header .seachBtn{width:19%;height:40px;line-height:40px;font-size:16px;color:#fff;text-align: center;background:#00BFFF;font-weight:600;cursor:pointer;}
    .wrap .left{width:200px;min-height:300px;float:left;text-align: left;padding-top:20px;}
    .wrap .left li{height:40px;line-height:40px;font-size:16px;color:#fff;}
    .wrap .left li i{font-size:22px;color:yellow;}
    .wrap .left li .span2{margin-left:20px;}
    .wrap .left li .cityName{font-size:20px;}

    .wrap .right{width:400px;text-align: center;float:right;}
    .wrap .right ul{margin-top:20px;color:#fff;font-size:16px;}
    .wrap .right .data1{width:50%;float:left;}
    .wrap .right .data2{width:50%;float:left;}
    .wrap .right .data3{width:100%;}
    input{outline:none;border:none;height:30px;}
</style>
</head>
<body>
<div class="wrap clearfix">
	<div class="header">
		<input class="intCity" type="text" placeholder="Please enter the city" value="上海">
		<input class="seachBtn" type="button" value="Seach">
	</div>
	<div class="left">
		<ul>
			<li><span><i class="icon iconfont icon-chengshi"></i></span><span class="cityName span2"></span></li>
			<li><span><i class="icon iconfont icon-riqi"></i></span><span class="left_data span2"></span></li>
			<li><span><i class="icon iconfont icon-weather2"></i></span><span class="left_weather span2"></span></li>
			<li><span><i class="icon iconfont icon-wendu"></i></span><span class="left_temp span2"></span></li>
			<li><span><i class="icon iconfont icon-fengxiang"></i></span><span class="left_wind1 span2"></span></li>
			<li><span><i class="icon iconfont icon-qixiang-fengli"></i></span><span class="left_wind2 span2"></span></li>
		</ul>
	</div>
	<div class="right">
		<ul class="data1"></ul>
		<ul class="data2"></ul>
		<ul class="dataOne"></ul>
	</div>
</div>

<script src="{{asset('js/eric.guo.jq3.0.js')}}"></script>

<script src="https://webapi.amap.com/subway?v=1.0&key=a6414d65323db9e2718b31e525a1337d&callback=cbk"></script>
<script>
	function getWeather(location,type,el){
        var url = "https://restapi.amap.com/v3/weather/weatherInfo";
        var postData = {
            key: "dfb9a576fbcb2c9a13a65ab736e47004",
            city: location,
            extensions: "all"
        };
        $.ajax({
            url:url,
            type:type,
            data:postData,
            success:function(status,data){
                console.log(status);
                var html1 = "";
                var html2 = "";
                var htmlOne = "";
                if(status.forecasts.length == 1){
                    $(".data1").css("display","none");
                    $(".data2").css("display","none");
                    $(".data3").css("display","block");

                    var weatherData = status.forecasts[0].casts;
                    console.log(status.forecasts[0].province+"省"+status.forecasts[0].city);
                    $(".cityName").html(status.forecasts[0].province+"省"+status.forecasts[0].city);
                    $(".left_data").html(status.forecasts[0].reporttime	);
                    $(".left_weather").html(weatherData[0].dayweather+" \ "+weatherData[0].nightweather);
                    $(".left_temp").html(weatherData[0].daytemp+" \ "+weatherData[0].nighttemp);
                    $(".left_wind1").html(weatherData[0].daywind+" \ "+weatherData[0].nightwind);
                    $(".left_wind2").html(weatherData[0].daypower+" \ "+weatherData[0].nightpower);


                    for(var i=1;i<weatherData.length;i++){
                        htmlOne += '<li>'+weatherData[i].date+'</li><li>星期'+weatherData[i].week+'</li><li>'+weatherData[i].dayweather+'"\"'+weatherData[i].nightweather+'</li><li>'+weatherData[i].daytemp+'"\"'+weatherData[i].nighttemp+'</li><li>'+weatherData[i].daywind+'"\"'+weatherData[i].nightwind+'</li><li>'+weatherData[i].daypower+'"\"'+weatherData[i].nightpower+'</li>'
                    }
                    $(".dataOne").html(htmlOne);


                }else{
                    $(".data1").css("display","block");
                    $(".data2").css("display","block");
                    $(".data3").css("display","none");
                }


            },
            error:function(status){
            }
        })
    }
    $(".seachBtn").click(function(){
        getWeather($(".intCity").val(),"post",".box1");
    })
    function addHtmlTwo(){

    }
    function addHtmlOne(){

    }


</script>


</div>
</body>
</html>

