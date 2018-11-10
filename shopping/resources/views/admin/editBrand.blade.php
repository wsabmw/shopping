<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/doinsertBrand" method="get">
        {{ csrf_field() }}
    品牌名称:<input type="text" name='name' value='{{ $data[0]->name }}'>
        <br>
        品牌图片: <input type="file" name='img'> 
        <br>
        <input type="submit">
    </form>
</body>
</html>