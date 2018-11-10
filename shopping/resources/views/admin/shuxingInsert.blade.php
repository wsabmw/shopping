<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    .box {
        width: 100px;
        height: 20px;
        /* background-color:green; */
        display: inline-block;
    }
</style>
<body>
    <h1>规格组合</h1>
    <hr>
    属性名:
    <br>

     <form action="/doAttrInsert">
         @foreach($data as $v)
            <div class="box">{{$v->attr_name}}</div>
            <br> 
                <div class="box1">
                        <select name="g_value[]" id="">
                            <option value="">请选择</option>
                                <?php $str =$v->gc; $str1 = $v->gb; $arr1 = explode(',',$str1); $arr = explode(',',$str); for($i=0;$i<count($arr);$i++){ echo "<option value='".$arr1[$i]."'>".$arr[$i]."</option>"; };?>
                        </select>
                    <input type="hidden" value="{{ $v->attr_name_id }}" name="n_id[]">
                    <input type="hidden" value="{{ $v->good_id }}" name="good_id">
                </div>
         @endforeach
            库存:<input type="text" name="inventory">
                    价格: <input type="text" name="price">
         <input type="submit" value="提交">
     </form>
</body>
</html>