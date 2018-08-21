var editor = new wangEditor('content-2');
editor.config.uploadImgUrl='/posts/image/upload';
editor.config.uploadHeaders = {
  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
};
editor.create();
