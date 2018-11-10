<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>申请广告</h1>
    <hr>
 <form action="" method="get">
     {{ csrf_field() }}
        广告标题 : <input type="text" name="title"><br><hr>
    广告类型:   <select name="" id="">
                    <option value="">首页广告 </option>
                    <option value="">商铺页展示 </option>
                    <option value="">首页轮播 </option>
                    <option value="">首页左侧 </option>
               </select> <br><hr>
    广告图片:  <input type="file" name="image"><br><hr>
    公司名称: <input type="text" name="company" id=""><br><hr>
    跳转地址 : <input type="text" name="url_path" > <br><hr>
    <input type="submit">
 </form>
</body>
</html>