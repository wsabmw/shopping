<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>修改商品</h1>
    <hr>

    <table>
        <form action="/doeditGood?id={{ $data[0]->id }}" method="get">
            {{ csrf_field() }}
            <tr>
            <td>商品分类 :</td>
                <td>
                    <select name="cat1" id="">

                        @foreach($cat as $v)
                        {{-- <option value="">{{$data[0]->cft_name}}</option> --}}
                    <option value="{{ $v->id }}">{{ $v->cft_name }}</option>
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
                    <option value="">{{ $data[0]->brand_name }}</option>
                    @foreach($brand as $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品名称:</td>
            <td><input type="text" name='name' value="{{ $data[0]->name }}"></td>
            </tr>
            <tr>
                <td>商品副标题 :</td>
            <td><input type="text" name='little_name' value="{{ $data[0]->little_name }}"></td>
            </tr>
            <tr>
                <td>商品价格 :</td>
            <td><input type="text" name='price' value="{{ $data[0]->price }}"></td>
            </tr>
            <tr>
                <td>商品封面图 :</td>
                <td>
                    <div class='img'>
                       
                    </div>
                </td>
                {{-- <td><input type="file" name='image' id='image'></td> --}}
            <td><input type="text" name='image' id='image' value="{{$data[0]->gimg }}"></td>
            </tr>
            <tr>
                <td>商品库存数量:</td>
                <td> <input type="text" name='good_num' value="{{ $data[0]->good_num }}"> </td>
            </tr>

            <div id="attr-container">
                <table width="100%">
                    <tr>
                        <td><h3>商品属性 <input id="btn-attr" type="button" value="添加一个属性"></h3></td>
                    </tr>
                    <tr>
                        <td class="label">属性名称:</td>
                        <td>
                            {{-- <input type='text' size="80" name='attr_name[]'> --}}
                        <input type='text' size="80" name='attr_name' value="{{ $data[0]->sku_name }}">
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">属性值:</td>
                        <td>
                            {{-- <input type='text' size="80" name='attr_value[]'> --}}
                        <input type='text' size="80" name='attr_value' value="{{ $data[0]->sku_value }}">
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td>
                            <input onclick="del_attr(this)" type="button" value="删除">
                        </td>
                    </tr>
                </table>
            </div>

           
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
    // console.log(123);
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
                // $("select[name=cat4]").trigger('change');
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
$("select[name=cat1]").trigger('change');


// $('select[name=cat4]').change(function() {
//     var id = $('select[name=cat1]').val()
//     if(id!="") {
//         $.ajax({
//             type:'GET',
//             url:"/getBand_name?id="+id,
//             dataType:'json',
//             success:function(data)
//             {
//                 // console.log(data);
//                 var str = "";
//                 for(var i=0;i<data.length;i++)
//                 {
//                     str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
//                     // console.log(data[i].name);
//                 }
//                 $('select[name=cat4]').html(str);
//             }
//         })
//     }
// })

var attrStr = `<hr><table width="100%"><tbody>
                <tr>
                    <td class="label">属性名称:</td>
                    <td>
                        <input type='text' size="80" name='attr_name[]'>
                        <font color="red">*</font>
                    </td>
                </tr>
                <tr>
                    <td class="label">属性值:</td>
                    <td>
                        <input type='text' size="80" name='attr_value[]'>
                        <font color="red">*</font>
                    </td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <input onclick="del_attr(this)" type="button" value="删除">
                    </td>
                </tr>
            </tbody></table>`;

// 为按钮绑定事件
$("#btn-attr").click(function(){
    // 将字符串追回到页面中
    $("#attr-container").append(attrStr)
});
function del_attr(o)
{
    if(confirm("确定要删除吗？"))
    {
        var table = $(o).parent().parent().parent().parent()
        table.prev('hr').remove()
        table.remove()
    }
    
}

</script>