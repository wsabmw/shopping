<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商品管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/style.css">
	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .img {
            width: 83px;
            height: 36px;
        }
    </style>
</head>

<body class="hold-transition skin-red sidebar-mini" >
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">品牌管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <a href="/insertBrand" class="btn btn-default">新建</a>
                                        <button type="button" class="btn btn-default" title="审核通过" ><i class="fa fa-check"></i> 审核通过</button>
                                        <button type="button" class="btn btn-default" title="驳回" ><i class="fa fa-ban"></i> 驳回</button>                                  
                                        <button type="button" class="btn btn-default" title="刷新" ><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    品牌名称：<input >
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th> 
										  <th class="sorting_asc">品牌ID</th>
									      <th class="sorting">品牌名称</th>
									      <th class="sorting">品牌图片</th>							     						
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
                                        @foreach($data as $v)
			                          <tr>
			                              <td><input type="checkbox"></td>			                              
                                      <td>{{ $v->id }}</td>
                                      <td>{{ $v->name }}</td>
		                                  <td><img src="{{$v->img}}" alt="" class='img'></td>		                                  
		                                  <td class="text-center"> 
                                              <a href="/delBrand?id={{ $v->id }}" class="btn bg-olive btn-xs">删除</a>        
                                              <a href="/editBrand?id={{ $v->id }}" class="btn bg-olive btn-xs">修改</a>                                 
		                                  </td>
                                      </tr>
                                      @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
							  
							 
                        </div>
                        <!-- 数据表格 /-->
                        
                        
                     </div>
                    <!-- /.box-body -->
        
</body>

</html>