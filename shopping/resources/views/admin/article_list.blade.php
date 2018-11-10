<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商家管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/style.css">
	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    
</head>

<body class="hold-transition skin-red sidebar-mini"  >
  <!-- .box-body -->
    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章管理</h3>
                    </div>

        <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">
                            <!--工具栏-->
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
									文章名称： <input  >
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->
			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              {{-- <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th>  --}}
										  <th class="sorting_asc">ID</th>
									      <th class="sorting">发表人</th>
									      <th class="sorting">标题</th>
									      <th class="sorting">发表时间</th>
									      <th class="sorting">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
                                    @foreach($data as $v)
                                    <tr>
                                     <td>{{ $v->id }}</td>
									<td>{{ $v->user_name }}</td>
									<td>{{ $v->title }}</td>
									<td>{{ $v->created_at }}</td>
									{{-- <td> <a href="{{ route('et_art') }}">修改</a> <a href="del_art">删除</a> </td> --}}
									<td> <a href="/ed_art?id={{ $v->id }}">修改</a> <a href="/del_art?id={{ $v->id }}">删除</a> </td>
                                   </tr>
                                   @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
                        </div>
                        <!-- 数据表格 /-->
         </div>
					<!-- /.box-body -->
	</div>
		
	

</body>

</html>