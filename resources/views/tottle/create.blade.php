@extends('layout.main')
@section('content')
    <div class="col-sm-8 blog-main">
            <form action="/tottles" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control">
                </div>
                <div class="form-group" id='content-div'>
                    <label>内容</label>
                    <textarea id="content" rows='13' name="content" class="form-control"></textarea>
                </div>
                @include('layout.error')
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->
@endsection


