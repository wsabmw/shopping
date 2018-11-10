<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 运营商后台
Route::get('/login','MerchantController@login')->name('login');  //登陆
Route::get('/home','MerchantController@home')->name('home');//首页右方区域
Route::post('/yy_admin','MerchantController@index')->name('yy_admin'); //显示运营商后台主页
Route::get('/logout','MerchantController@logout')->name('logout');  //退出按钮
Route::get('/sy_admin','MerchantController@indexc')->name('sy_admin'); //左侧首页按钮


// ===============================管理员管理===============================
Route::get('/admin_list','AdminController@admin_list')->name('admin_list'); //管理员列表
Route::get('/role_list','AdminController@role_list')->name('role_list'); //角色管理
Route::get('/privilege_list','AdminController@privilege_list')->name('privilege_list'); //权限管理

// ===============================文章===============================
Route::get('/article_list','AdminController@article_list')->name('article_list');//文章列表
Route::get('/article_fb','AdminController@article_fb')->name('article_fb');//显示发表文章页面
Route::get('/ed_art','AdminController@ed_art')->name('ed_art');//修改文章
Route::post('/doedit','AdminController@doedit')->name('doedit');//修改文章按钮
Route::get('/del_art','AdminController@del_art')->name('del_art');//删除文章
Route::post('/dofb','AdminController@dofb')->name('dofb');//发表按钮

// ===============================广告===============================
Route::get('/advertising','AdvertisingController@advertising')->name('advertising'); //广告管理->广告管理
Route::get('/guanggll_admin','AdvertisingController@guanggll')->name('guanggll_admin');//广告管理->广告管理
Route::get('/insertAdv','AdvertisingController@insertAdv')->name('insertAdv'); //添加广告
Route::get('/advertising_sql','AdvertisingController@advertising_sql')->name('advertising_sql');//申请列表

// ===============================用户管理===============================
Route::get('/yy_yhgl','MerchantController@yhgl')->name('yy_yhgl'); //用户列表
// ===============================商品===============================
Route::get('/spgl_admin','MerchantController@spgl')->name('spgl_admin');  // 商品管理->商品管理
Route::get('/insertGood','MerchantController@insertGood')->name('insertGood'); //跳转添加商品页面
Route::get('/delGood','MerchantController@delGood')->name('delGood');  //删除商品
Route::get('/getcat','MerchantController@getcat')->name('getcat'); //获取子级分类
Route::get('/getBand_name','MerchantController@getBand_name')->name('getBand_name'); //获取这类商品的所有品牌
Route::get('/doInsertGood','MerchantController@doInsertGood')->name('doInsertGood'); //确认提交商品
Route::get('/editGood','MerchantController@editGood')->name('editGood'); //修改商品
Route::get('/doeditGood','MerchantController@doeditGood')->name('doeditGood'); //确认修改商品
Route::get('/shuxingInsert','MerchantController@shuxingInsert')->name('shuxingInsert'); //商品规格
Route::get('/nameInsert','MerchantController@nameInsert')->name('nameInsert'); //商品属性名添加
Route::get('/donameInsert','MerchantController@donameInsert')->name('donameInsert'); //执行商品属性名添加
// Route::get('/valueInsert/{id}','MerchantController@valueInsert')->name('valueInsert'); // 商品属性值添加
Route::get('/valueInsert','MerchantController@valueInsert')->name('valueInsert'); // 商品属性值添加
Route::get('/dovalueInsert','MerchantController@dovalueInsert')->name('dovalueInsert');  //执行商品属性值的添加
Route::get('/attrInsert/{id}','MerchantController@attrInsert')->name('attrInsert');  
Route::get('/doAttrInsert','MerchantController@doAttrInsert')->name('doAttrInsert');

// ===============================品牌===============================
Route::get('/ppgl_admin','MerchantController@ppgl')->name('ppgl_admin');  // 商品管理->品牌管理
Route::get('/insertBrand','MerchantController@insertBrand')->name('insertBrand'); //品牌添加
Route::get('/doinsertBrand','MerchantController@doinsertBrand')->name('doinsertBrand');//执行添加
Route::get('/delBrand','MerchantController@delBrand')->name('delBrand'); //删除品牌
Route::get('/editBrand','MerchantController@editBrand')->name('editBrand'); //修改品牌

Route::get('/gggl_admin','MerchantController@gggl')->name('gggl_admin');  // 商品管理->规格管理
Route::get('/mbgl_admin','MerchantController@mbgl')->name('mbgl_admin');  // 商品管理->模版管理
Route::get('/flgl_admin','MerchantController@flgl')->name('flgl_admin');  // 商品管理->分类管理
Route::get('/spsh_admin','MerchantController@spsh')->name('spsh_admin');  // 商品管理->商品审核



// 前台模块
Route::get('/h_register','HomeController@h_register')->name('h_register'); //显示注册表单
Route::post('/doh_register','HomeController@doh_register')->name('doh_register'); //处理用户注册表单
Route::get('/ajax_getname','HomeController@ajax_getname')->name('ajax_getname'); //处理用户注册表单
Route::get('/flc','HomeController@flc')->name('flc'); //发送短信

Route::get('/h_login','HomeController@h_login')->name('h_login'); //前台登陆
Route::get('/h_index','HomeController@h_index')->name('h_index'); //前台首页
Route::post('/doh_login','HomeController@doh_login')->name('doh_login');  //执行 登陆

Route::get('/searchList','HomeController@searchList')->name('searchList'); //跳转搜索商品详情页面
Route::get('/item','HomeController@item')->name('item'); // 跳转商品详情页面
// $sendSms->setPhoneNumbers('19805296506');
Route::get('/order_gg','HomeController@order_gg')->name('order_gg'); //商品加入购物车
ROute::get('/delOrder','HomeController@delOrder')->name('delOrder');//删除订单
Route::get('/jia_num','HomeController@jia_num')->name('jia_num'); //加购买的数量
Route::get('/jian_num','HomeController@jian_num')->name('jian_num'); //加购买的数量
// 支付
Route::get('/goPay','HomeController@goPay')->name('goPay'); //订单信息
Route::get('/pay','HomeController@pay')->name('pay');//我的购物车->结算->提交订单


Route::get('/h_mypyg','HomeController@h_mypyg')->name('h_mypyg'); //顶部->我的品优购
Route::get('/h_hzzs','HomeController@h_hzzs')->name('h_hzzs'); //顶部->客户服务->合作招商
Route::get('/h_sjht','HomeController@h_sjht')->name('h_sjht'); //顶部->客户服务->商家后台

// 我的品优购里->订单
Route::get('/order_pay','OrderController@order_pay')->name('order_pay');//代付款
Route::get('/order_send','OrderController@order_send')->name('order_send');//待发货
Route::get('/order_receive','OrderController@order_receive')->name('order_receive');//待收货
Route::get('/order_evaluate','OrderController@order_evaluate')->name('order_evaluate');//待评价

Route::get('/person_collect','OrderController@person_collect')->name('person_collect');//我的收藏
Route::get('/person_footmark','OrderController@person_footmark')->name('person_footmark');//我的足迹

Route::get('/setting_info','OrderController@setting_info')->name('setting_info');//个人信息
Route::post('/getSetInfo','OrderController@getSetInfo')->name('getSetInfo'); //提交个人信息

// 地址
Route::get('/setting_address','OrderController@setting_address')->name('setting_address');//地址管理
Route::get('/inaddress','OrderController@inaddress')->name('inaddress'); //新增地址
Route::get('/doinaddress','OrderController@doinaddress')->name('doinaddress'); //确认新增地址
Route::get('/delAddress','OrderController@delAddress')->name('delAddress'); //删除地址
Route::get('/editAddress','OrderController@editAddress')->name('editAddress'); //修改地址
Route::get('/doeditAddress','OrderController@doeditAddress')->name('doeditAddress'); //修改地址
Route::get('/doeditpwd','OrderController@doeditpwd')->name('doeditpwd'); //修改密码

Route::get('/setting_safe','OrderController@setting_safe')->name('setting_safe');//安全管理

Route::get('/cart','OrderController@cart')->name('cart');//我的购物车
Route::get('/getOrderInfo','OrderController@getOrderInfo')->name('getOrderInfo');//我的购物车->结算
Route::get('/orderDetail','OrderController@orderDetail')->name('orderDetail');//订单详情


Route::get('/seckill','OrderController@seckill')->name('seckill');// 秒杀
Route::get('/seckill_item','OrderController@seckill_item')->name('seckill_item');//秒杀->立即抢购
Route::get('/jr_shop','OrderController@jr_shop')->name('jr_shop');//进入店铺

Route::get('/success_cart','OrderController@success_cart')->name('success_cart');//进入店铺->加入购物车



Route::get('/qrcode', 'HomeController@qrcode');
