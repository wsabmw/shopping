<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>value编辑</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
  
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/style.css">
	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- 富文本编辑器 -->
	<link rel="stylesheet" href="/plugins/kindeditor/themes/default/default.css" />
	<script charset="utf-8" src="/plugins/kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="/plugins/kindeditor/lang/zh_CN.js"></script>
    
    
      
    
    
</head>

<body class="hold-transition skin-red sidebar-mini" >

            <!-- 正文区域 -->
            <section class="content">

                <div class="box-body">

                    <!--tab页-->
                    <div class="nav-tabs-custom">

                        <!--tab头-->
                        <ul class="nav nav-tabs">                       		
                            <li >
                                <a href="#customAttribute" data-toggle="tab">扩展属性</a>                                                        
                            </li>     
                            <li >
                                <a href="#spec" data-toggle="tab" >SKU 请添加完商品之后生成 </a>                                                        
                            </li>
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                 <form action="/dovalueInsert" method="get" enctype="multipart/form-data">
                        <div class="tab-content">
                            {{csrf_field()}}
                           <input type="hidden" name="id" value="{{$id[0]}}">

                            <!--扩展属性-->
                            <div class="tab-pane" id="customAttribute" >
                            <select name="attr_name_id" id="">
                                @foreach($data as $v)
                                <option value="{{$v->id}}">{{$v->attr_name}}</option>
                                {{-- <option value="">123</option> --}}
                                @endforeach
                            </select>
                                <input type="button" id="btn-add" value="添加属性值">								
                                <div class="row data-type" >                                										
		                                <div class="col-md-2 title">属性值</div>
				                        <div class="col-md-2 data">
                                              <input class="form-control" name="attr_val[]" placeholder="扩展属性值">
										</div>
                                </div>
                            </div>
                      
                            
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
							 
                    </div>
                 	
                 	
                 	
                 	
                   </div>
                  <div class="btn-toolbar list-toolbar">
				      <input type="submit" class="btn btn-primary" value="保存" ><i class="fa fa-save"></i>
				      <button class="btn btn-default" >返回列表</button>
				  </div>
			
            </section>
            


          </form>  
            <!-- 正文区域 /-->
<script type="text/javascript">

	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});
	});

    var attr_str = `    <hr>     <div class="row data-type" >                                
	                                <div>
                                                 <div class="col-md-2 title">扩展属性值</div>
				                        <div class="col-md-2 data">
                                              <input class="form-control" name="attr_val[]" placeholder="扩展属性">
                                        </div>
												 <td><button type="button" onclick="btn_del(this)" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button></td> 
	                                </div>       									
                                </div> `;
    $("#btn-add").click(function(){
		$("#customAttribute").append(attr_str);
		
    });


    function btn_del(t){
        if(confirm("确定删除吗？")){
            var a = $(t).parent().parent();
            console.log(a);
            a.prev("hr").remove();
            a.remove();
        }
    }
</script>
       
</body>

</html>