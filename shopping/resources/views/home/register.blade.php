<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>


    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-register.css" />
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>注册新用户<span class="go">我有账号，去<a href="/h_login">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal" action="/doh_register" method="post">
					{{ csrf_field() }}
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" name="username" id='username' placeholder="请输入你的用户名" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" name='password' id='password' placeholder="设置登录密码" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" name="password1" id='password1' placeholder="再次确认密码" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" name="phone" id="phone" placeholder="请输入你的手机号" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" id='num' name='yzm'  placeholder="短信验证码" class="input-xfat input-xlarge">  
							 <input type="button" value="获取短信验证码" id='flc'>
						</div>
					</div>
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							{{-- <a class="sui-btn btn-block btn-xlarge btn-danger" href="home.html" target="_blank">完成注册</a> --}}
							<input type="submit" value="完成注册">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/pages/register.js"></script>
</body>
<script>
	$("#username").blur(function(){
    var name = $(this).val()
        $.ajax({
            type:"GET",
            url:"/ajax_getname?name="+name,
            // dataType:"json",
            success:function(data) {
               if(data == 0) {
				   alert('该用户已经存在');
			   }else {
				   alert('改用户名可用');
			   }
            }
      });
});
	$("#password").blur(function () {
		var password = $(this).val();
        if (/^[0-9a-zA-Z_]{6,15}$/.test(password)) {
			alert('密码格式正确');
        }else {
			alert('密码格式错误');
		}
	})

	$('#password1').blur(function() {
		var password = $("#password").val();
		var password1 = $(this).val();
		console.log(password);
		console.log(password1);
		if(password == password1) {
			alert('两次相同');
		}else {
			alert('两次密码不一致');
		}
	})

	$('#phone').blur(function() {
		var num = $(this).val();
		if( !( /^1[34578]\d{9}$/.test(num) ) ){ 
        alert("手机号码有误，请重填");  
    } 
	})

	$('#flc').click(function() {
		console.log(123);
		var num = $("#phone").val();
		$.ajax({
			type:"GET",
			url:"/flc?num="+num,
			success:function(data) {
				alert(data);
			}
		})
	})
	
	

</script>

</html