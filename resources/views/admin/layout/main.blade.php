@include('admin.layout.theader')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  @include('admin.layout.header')
  <!-- Left side column. contains the logo and sidebar -->

  @include('admin.layout.sidebar')
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      @yield('content')
  </div>
      <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
