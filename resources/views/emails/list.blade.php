@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="glyphicon glyphicon-list-alt"></span>  反馈建议</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Ip</th>
                                <th>UA</th>
                                <th>Commit</th>
                                <th>Create Date</th>
                                <th>操作</th>
                            </tr>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                <td>{{$feedback->id}}</td>
                                <td>{{$feedback->username}}</td>
                                <td>{{$feedback->email}}</td>
                                <td>{{$feedback->ip}}</td>
                                <td>{{$feedback->ua}}</td>
                                <td>{{$feedback->commits}}</td>
                                <td>{{$feedback->created_at}}</td>
                                <td>
                                   <button type="button" class="btn btn-sm btn-danger feedback-email" feedback-id="{{$feedback->id}}">删除</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
                        {{$feedbacks->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection