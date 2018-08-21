@extends('layout.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
{{--                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="标题。。。">
                </div>
                <div class="form-group">
                    <label>摘要</label>
                    <textarea id="description"  name="description" class="form-control" placeholder="摘要。。。"></textarea>
                </div>
                <div class="form-group">
                    <div><label>编码方式</label></div>
                    <button class='btn btn-primary eric-coding-type' type='button' name='ueditor'>富文本</button> <button class='btn btn-default eric-coding-type' type='button' name='markdown'>MarkDown</button>
                    <input name="encoding_type" type="hidden" id='encoding_type'>
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="内容。。。"></textarea>
                </div>
@include('layout.error')
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->
        <script type="text/javascript" src="{{asset('js/eric.js')}}"></script>
    <script>
        $('.eric-coding-type').on('click',function(){
            $('.eric-coding-type').removeClass('btn-primary');
            $('.eric-coding-type').addClass('btn-default');
            $(this).addClass('btn-primary');
            $('#encoding_type').val($(this)[0].textContent)
        });
    </script>
@endsection


