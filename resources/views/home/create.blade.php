@extends('layout.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
{{--                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label>摘要</label>
                    <textarea id="description"  name="description" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <div><label>编码方式</label></div>
                    <button class='btn btn-primary eric-coding-type' type='button'>富文本</button> <button class='btn btn-default eric-coding-type' type='button'>MarkDown</button>
                    <input name="encoding_type" type="hidden" id='encoding_type' value='1'>
                </div>
                <div class="form-group" id='content-div'>
                    <label>内容</label>
                    <textarea id="content-2" rows='13' name="content" class="form-control">{{old('content')}}</textarea>
                </div>
@include('layout.error')
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->
        <script type="text/javascript" src="{{asset('js/eric.guo.editor.min.js')}}"></script>
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
                var html_content = ' <label>内容</label><textarea id="content-2"  rows="13" name="content" class="form-control">{{old("content")}}</textarea>'
                $('#content-div').empty()
                $('#content-div').append(html_content)
                wangEditor.config.printLog = false;
                var editor2 = new wangEditor('content-2')
                editor2.create()
            }else{
                //markdown
                var html_content = ' <label>内容</label><textarea id="content-1"  name="content" class="form-control" rows="13">{{old("content")}}</textarea>'
                $('#content-div').empty()
                $('#content-div').append(html_content)
            }
        });
    </script>
@endsection

<style>

</style>


