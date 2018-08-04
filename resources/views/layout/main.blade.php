@include('layout.header')

<body>

@include('layout.nav')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
@include('layout.sidebar')
@yield('content')

    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@include('layout.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('js/eric.guo.editor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/eric.js')}}"></script>

</body>
</html>
