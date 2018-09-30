@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-9">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Friend Link</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/flinks/create" >添加友链</a>
                    <!-- /.box-header -->
                    @if(count($links) > 0)
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>作者</th>
                                <th>别名</th>
                                <th>URL</th>
                                <th>操作</th>
                            </tr>
@foreach($links as $link)
                                <tr>
                                    <td>{{$link->id}}.</td>
                                    <td>{{$link->author}}</td>
                                    <td>{{$link->nick}}</td>
                                    <td>{{$link->link_url}}</td>
                                    <td>
                                        <a type="button" class="btn glyphicon glyphicon-remove" href="/admin/flinks/{{$link->id}}/delete" ></a>
                                        <a type="button" class="btn glyphicon glyphicon-pencil" href="/admin/flinks/{{$link->id}}/update" ></a>
                                    </td>
                                </tr>
@endforeach
                                                        </tbody></table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection