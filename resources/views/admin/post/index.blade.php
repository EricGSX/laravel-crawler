    @extends('admin.layout.main')
    @section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="glyphicon glyphicon-list-alt"></span>  文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>文章标题</th>
                                <th>标记</th>
                                <th>操作</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}.</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    @if($post->mark_status ==1)
                                        <span class=""><span class="glyphicon glyphicon-star bg-yellow"></span></span>
                                    @else
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                    @endif
                                    </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning post-audit" post-id="{{$post->id}}" e-post-action='star' post-action-status="1" >标记</button>
                                    <button type="button" class="btn btn-sm btn-danger post-audit" post-id="{{$post->id}}" e-post-action='del' post-action-status="-1" >删除</button>
                                </td>
                            </tr>
                            @endforeach
                                                        </tbody></table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @endsection