<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>添加商品</h1>
    <hr>
    <table>
        <form action="/doInsertGood" method="get">
            {{ csrf_field() }}
            <tr>
                <td>商品分类 :</td>
                <td>
                    <select name="cat1" id="">
                        <option value="">请选择分类</option>
                        @foreach($data as $v)
                    <option value="{{ $v->id }}">{{$v->cft_name}}</option>
                        @endforeach
                    </select>

                    <select name="cat2" id="">
                        <option value="">请选择分类</option>
                    </select>

                    <select name="cat3" id="">
                        <option value="">请选择分类</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品品牌:</td>
                <td>
                    <select name="cat4" id="">
                        <option value="">请选择分类</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品名称:</td>
                <td><input type="text" name='name'></td>
            </tr>
            <tr>
                <td>商品副标题 :</td>
                <td><input type="text" name='little_name'></td>
            </tr>
            <tr>
                <td>商品价格 :</td>
                <td><input type="text" name='price'></td>
            </tr>
            <tr>
                <td>商品封面图 :</td>
                <td>
                    <div class='img'>
                       
                    </div>
                </td>
                {{-- <td><input type="file" name='image' id='image'></td> --}}
                <td><input type="text" name='image' id='image'></td>
            </tr>
            <tr>
                <td>商品库存数量:</td>
                <td> <input type="text" name='good_num'> </td>
            </tr>
           
            <tr>
                <td><input type="submit" value='确认提交'></td>
            </tr>
            
        </form>
    </table>
</body>
</html>
<script src="/js/plugins/jquery/jquery.min.js"></script>
<script>
// 把图片转成一个字符串
function getObjectUrl(file) {
    var url = null;
    if (window.createObjectURL != undefined) {
        url = window.createObjectURL(file)
    } else if (window.URL != undefined) {
        url = window.URL.createObjectURL(file)
    } else if (window.webkitURL != undefined) {
        url = window.webkitURL.createObjectURL(file)
    }
    return url
}
// 当选择图片时触发
$("#image").change(function(){
    // 获取选择的图片
    var file = this.files[0];
    // 转成字符串
    var str = getObjectUrl(file);
    // 先删除上一个
    $(this).prev('.img').remove();
    // 在框的前面放一个图片
    $(this).before("<div id='img'><img src='"+str+"' width='120' height='120'></div>");
});

// 三级联动
$("select[name=cat1]").change(function(){
    var id = $(this).val()
    if(id!=""){
        $.ajax({
            type:"GET",
            url:"/getcat?id="+id,
            dataType:"json",
            success:function(data)
            {
                var str = "";
                for(var i=0;i<data.length;i++)
                {
                    str += '<option value="'+data[i].id+'">'+data[i].cft_name+'</option>';
                }
                $("select[name=cat2]").html(str)
                $("select[name=cat2]").trigger('change');
                $("select[name=cat4]").trigger('change');
            }
        });
    }
});

$("select[name=cat2]").change(function(){
    var id = $(this).val()
    if(id!="")
    {
        $.ajax({
            type:"GET",
            url:"/getcat?id="+id,
            dataType:"json",
            success:function(data)
            {
                console.log(data);
                var str = "";
                for(var i=0;i<data.length;i++)
                {
                    str += '<option value="'+data[i].id+'">'+data[i].cft_name+'</option>';
                }
                $("select[name=cat3]").html(str)
            }
        });
    }
});

$('select[name=cat4]').change(function() {
    var id = $('select[name=cat1]').val()
    if(id!="") {
        $.ajax({
            type:'GET',
            url:"/getBand_name?id="+id,
            dataType:'json',
            success:function(data)
            {
                // console.log(data);
                var str = "";
                for(var i=0;i<data.length;i++)
                {
                    str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    // console.log(data[i].name);
                }
                $('select[name=cat4]').html(str);
            }
        })
    }
})


</script>