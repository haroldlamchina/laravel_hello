var E = window.wangEditor
var editor = new E('#editor')
var $content = $('#content')
editor.customConfig.onchange = function (html) {
    // 监控变化，同步更新到 textarea
    $content.val(html)
}
//自定义上传header头部
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
// 下面两个配置，使用其中一个即可显示“上传图片”的tab。但是两者不要同时使用！！！
//  editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
 editor.customConfig.uploadImgServer = '/posts/img/upload'  // 上传图片到服务器
// 隐藏“网络图片”tab
//  editor.customConfig.showLinkImg = false;
// 限制一次最多上传 5 张图片
 editor.customConfig.uploadImgMaxLength = 1;
//自定义上传文件名
editor.customConfig.uploadFileName = 'imgbylam';

editor.create();
// 初始化 textarea 的值
// $content.val(editor.txt.html())