@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加友链</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="/admin/flinks" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1">用户名</label>
                                    <input type="text" class="form-control" name="author">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1">别名</label>
                                    <input type="text" class="form-control" name="nick">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="exampleInputPassword1">链接</label>
                                    <input type="text" class="form-control" placeholder="Password" name="link_url">
                                     <span class="glyphicon glyphicon-random form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            @include('admin.layout.error')
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection