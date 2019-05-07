$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	}
});
$('.post-audit').click(function(event){
	target = $(event.target);
	var post_id = target.attr('post-id');
	var status = target.attr('post-action-status');
	var e_post_action = target.attr('e-post-action');
	$.ajax({
		url:"/admin/posts/" + post_id + "/status",
		method:'POST',
		data:{'status':status,'post_id':post_id,'e_post_action':e_post_action},
		dataType:'json',
		success:function(data){
			if(data.error != 0){
				alert(data.msg);
				return;
			}
			if((e_post_action == 'star') || (e_post_action == 'show_label') || (e_post_action == 'restart')){
                //标记\标签云展示 的只需要刷新页面
                location.reload();
            }else{
			    //其他的删除这个节点
                target.parent().parent().remove();
            }
		}
	});
});
$('.resource-delete').click(function(event){
    if(confirm('确定要删除该专题吗？') == false){
        return;
    }
    var target = $(event.target);
    event.preventDefault();
    var post_id = $(target).attr('delete-topic-id');
    $.ajax({
        url:"/admin/topics/"+post_id,
        method:'DELETE',
        // data:{"_method":"DELETE","id":post_id},
        dataType:'json',
        success:function (data) {
            if(data.error != 0){
                alert(data.msg);
                return;
            }
            window.location.reload();
        }
    });
});
$('.feedback-email').click(function(event){
    if(confirm('确定删除该意见吗？') == false){
        return;
    }
    var target = $(event.target);
    $(target).attr('disabled',true);
    var feedback_id = $(target).attr('feedback-id');
    $.ajax({
        url:"/admin/feedbacks/del",
        method:'POST',
        data:{"feedback_id":feedback_id},
        dataType:'json',
        success:function (data) {
            if(data.error != 0){
                alert(data.msg);
                return;
            }
            window.location.reload();
        }
    });
});