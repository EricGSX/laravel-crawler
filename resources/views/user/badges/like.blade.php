@if($target_user->id != \Auth::id())
<div>
    @if(\Auth::user()->hasStar($target_user->id))
    <button class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}"  type="button">取消关注</button>
    @else
        <button class="btn btn-primary like-button" like-value="0" like-user="{{$target_user->id}}"  type="button">关注</button>
    @endif
</div>
@endif
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    $('.like-button').click(function(event){
        var target = $(event.target)
        var current_like = target.attr('like-value')
        var user_id = target.attr('like-user')
        if(current_like ==1){
            //取消关注
            $.ajax({
                url:'/user/'+user_id+'/unfan',
                method:'POST',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        alert(data.msg)
                        return
                    }
                    target.attr('like-value',0)
                    target.text('关注')
                    target.removeClass('btn-default')
                    target.addClass('btn-primary')
                }
            })
        }else{
            //关注
            $.ajax({
                url:'/user/'+user_id+'/fan',
                method:'POST',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        alert(data.msg)
                        return
                    }
                    target.attr('like-value',1)
                    target.text('取消关注')
                    target.removeClass('btn-primary')
                    target.addClass('btn-default')
                }
            })
        }
    });
</script>