@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">用户列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/users/create" >增加用户</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>用户名称</th>
                                <th>操作</th>
                            </tr>
@foreach($users as $user)
                                                            <tr>
                                    <td>{{$user->id}}.</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/admin/users/{{$user->id}}/role" >角色管理</a>
                                        @if($user->name != \Auth::guard('admin')->user()->name)
                                        <a type="button" class="btn glyphicon glyphicon-remove" href="/admin/users/{{$user->id}}/delete" ></a>
                                        @else
                                            <a type="button" class="btn glyphicon glyphicon-user"></a>
                                        @endif
                                        <a type="button" class="btn glyphicon glyphicon-pencil" href="/admin/users/{{$user->id}}/update" ></a>
                                    </td>
                                </tr>
@endforeach
                                                        </tbody></table>
                                                        {{$users->links()}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection