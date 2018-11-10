<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/simditor-2.3.6/styles/simditor.css" />
    <title>Document</title>
</head>
<body>
    <h1>发表文章</h1>
    <hr>
<form action="{{ route('dofb') }}" method="post">
        {{ csrf_field() }}
        文章标题: 
        <input type="text" name="title"><hr>
        文章发布人: 
        <input type="text" name="user_name" value="{{ session('username') }}"  disabled="disabled"><hr>
        发布内容:
        <div id="editor"></div>   
        
        <textarea name="content" id="content" cols="30" rows="10" hidden></textarea>

        <input type="submit" value="发布" id="btn1">
</form>
    
</body>
</html>
<script type="text/javascript" src="/wangEditor-master/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    editor.customConfig.debug = location.href.indexOf('wangeditor_debug_mode=1') > 0 //debug
    editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
    editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024  //设置图片大小
    editor.customConfig.uploadImgMaxLength = 5 //设置最大上传图片数量
  
    document.getElementById('btn1').addEventListener('click', function () {
        // 读取 html
        var content=editor.txt.html();
        document.getElementById('content').value = content;
    }, false);

    editor.create();
    // editor.txt.html()

  
</script>
