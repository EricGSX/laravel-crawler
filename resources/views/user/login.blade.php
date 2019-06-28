<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>会武术的地瓜(郭世鑫Eric.Guo的个人博客)</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="https://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="/users/login">
        {{csrf_field()}}
            <p style='text-align: center;'>
                <a href="https://ding.guosx.com" title="机智郭&暴力丁"><img src="{{asset('image/adminlogo.png')}}" alt="机智郭&暴力丁"  style="width: 60%;"></a>
            </p>
        <label for="inputEmail" class="sr-only">邮箱</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="is_remember"> 记住我
            </label>
        </div>
        @include('layout.error')
        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        <a href="/users/register" class="btn btn-danger btn-block" type="submit">Create an account.</a>
        <!-- 第三方登陆 -->
        <div style="text-align: center;line-height: 40px;color: #5a7079;"> -------- 其他方式登陆 -------- </div>
        <div class="col-md-12">
            <div class="col-sm-2" style="text-align: center;">
                <a href="" title="QQ登陆"><img src="{{asset('/image/qq.png')}}" style="width:30px;height:30px;"></a>
            </div>
            <div class="col-sm-2" style="text-align: center;">
                <a href="" title="Wechat登陆"><img src="{{asset('/image/wx.png')}}" style="width:30px;height:30px;"></a>
            </div>
            <div class="col-sm-2" style="text-align: center;">
                <a href="" title="微博登陆"><img src="{{asset('/image/weibo.png')}}" style="width:30px;height:30px;"></a>
            </div>
            <div class="col-sm-2" style="text-align: center;">
                <a href="/oauth/baidu" title="百度登陆"><img src="{{asset('/image/baidu.png')}}" style="width:30px;height:30px;"></a>
            </div>
            <div class="col-sm-2" style="text-align: center;">
                <a href="" title="码云登录"><img src="{{asset('/image/gitee.png')}}" style="width:30px;height:30px;"></a>
            </div>
            <div class="col-sm-2" style="text-align: center;">
                <a href="/oauth/github" title="Github登录"><img src="{{asset('/image/github.png')}}" style="width:30px;height:30px;"></a>
            </div>
        </div>
        <!--  -->
    </form>

</div> <!-- /container -->

</body>
</html>
