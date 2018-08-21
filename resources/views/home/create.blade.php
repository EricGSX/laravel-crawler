@extends('layout.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
{{--                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>摘要</label>
                    <textarea id="description"  name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div><label>编码方式</label></div>
                    <button class='btn btn-primary eric-coding-type' type='button'>富文本</button> <button class='btn btn-default eric-coding-type' type='button'>MarkDown</button>
                    <input name="encoding_type" type="hidden" id='encoding_type' value='1'>
                </div>
                <div class="form-group" id='content-div'>
                    <label>内容</label>
                    <textarea id="content-2"  style="height:400px;max-height:500px;" name="content" class="form-control"></textarea>
                </div>
@include('layout.error')
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->
        <script type="text/javascript" src="{{asset('js/eric.js')}}"></script>
    <script>
        $('.eric-coding-type').on('click',function(){
            $('.eric-coding-type').removeClass('btn-primary');
            $('.eric-coding-type').addClass('btn-default');
            $(this).addClass('btn-primary');
            var encoding_type = $(this)[0].textContent
            if(encoding_type == 'MarkDown'){
                $('#encoding_type').val(2)
            }else if(encoding_type == '富文本'){
                $('#encoding_type').val(1)
            }else{
                $('#encoding_type').val(3)
            }
            var check_type = $('#encoding_type').val()
            if(check_type == 1){
                //富文本
                var html_content = ' <label>内容</label><textarea id="content-2"  style="height:400px;max-height:500px;" name="content" class="form-control"></textarea>'
                $('#content-div').empty()
                $('#content-div').append(html_content)
                var editor = new wangEditor('content-2');
            }else{
                //markdown
                var html_content = ' <label>内容</label><textarea id="content-1"  name="content" class="form-control" rows="13"></textarea>'
                $('#content-div').empty()
                $('#content-div').append(html_content)
            }
        });
    </script>
@endsection


