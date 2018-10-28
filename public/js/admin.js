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
			if(e_post_action == 'star'){
                //标记的只需要刷新页面
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
    var url = $(target).attr('delete-url');
    $.ajax({
        url : url,
        method:'POST',
        data:{"_method":"DELETE"},
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