<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head> 
<body>
    <form action="/doeditAddress">
        <h2>新增地址</h2>
    <input type="text" name='id' value="{{ $data[0]->id }}" hidden>
    收货人: <input type="text" name='sh_name' value="{{ $data[0]->sh_name }}"> <br>
        收货地址: <input type="text" name="sh_address" value="{{ $data[0]->sh_address }}"> <br>
        联系电话: <input type="text" name="phone" value="{{ $data[0]->phone }}"> <br>
        邮箱: <input type="text" name="email" value="{{ $data[0]->email }}"> <br>
    附加信息: <br> <textarea name="fjxx" id="" cols="30" rows="4">{{ $data[0]->fjxx }}</textarea> <br>
        <input type="submit">
    </form>
</body>
</html>