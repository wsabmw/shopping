<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;

class OrderController extends Controller
{
    // 待付款
    public function order_pay() {
        return view('home.home-order-pay');
    }
    // 待发货
    public function order_send() {
        return view('home.home-order-send');
    }
     // 待收货
     public function order_receive() {
        return view('home.home-order-receive');
    }
     // 待评价
     public function order_evaluate() {
        return view('home.home-order-evaluate');
    }
    //我的收藏
    public function person_collect() {
        return view('home.home-person-collect');
    }
    //我的收藏
    public function person_footmark() {
        return view('home.home-person-footmark');
    }

    // 个人信息
    public function setting_info() {
        $username = session('name');
        $model = new Order;
        $info = $model->getinfo($username);
        $birthday = explode('/',$info[0]->birthday);//生日
        $home = explode('/',$info[0]->home); //地址
        $data = $model->judge($username);
        return view('home.home-setting-info',[
            'data'=>$data,
            'birthday'=>$birthday,
            'home'=>$home,
            'info'=>$info
            ]);
    }

    public function getSetInfo(Request $req) {
        $zhanghao = session('name');
        $name = $req->name;
        $sex = $req->gender;
        $year = $req->select;
        $month = $req->select1;
        $day = $req->select2;
        $sheng = $req->sheng;
        $shi = $req->shi;
        $qu = $req->qu;
        $job = $req->job;
        $riqi = $year.'/'.$month.'/'.$day;
        $dizhi = $sheng.'/'.$shi.'/'.$qu;
        $model = new Order;
        $data = $model->getSetInfo($name,$sex,$riqi,$dizhi,$job,$zhanghao);
        if($data = 1){
            echo "<script>alert('成功');</script>";
        }else {
            echo "<script>alert('失败');</script>";
        }
    }

 

    // 地址管理
    public function setting_address() {
        $model = new Order;
        $data = $model->getAddresslist();
        return view('home.home-setting-address',['data'=>$data]);
    }
    // 新增地址
    public function inaddress() {
        return view('home.home-setting-inaddress');
    }
    //确认新增地址
    public function doinaddress(Request $req) {
        $sh_name = $req->sh_name;
        $sh_address = $req->sh_address;
        $phone = $req->phone;
        $email = $req->email;
        $fjxx = $req->fjxx;
        $model = new Order;
        $data = $model->doinaddress($sh_name,$sh_address,$phone,$email,$fjxx);
        if($data == 0) {
            echo "<script>添加地址成功！！！self.location=document.referrer;</script>";
            // return view('home.home-setting-address');
        }else {
            return view('home.home-setting-inaddress');
        }
    }
    // 删除地址
    public function delAddress() {
        $id = $_GET['id'];
        $model = new Order;
        $model->delAddress($id);
        echo "<script>alert('删除成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    // 修改地址
    public function editAddress() {
        $id = $_GET['id'];
        $model = new Order;
        $data = $model->editAddress($id);
        return view('home.editAddress',['data'=>$data]);
    }
    // 执行修改地址
    public function doeditAddress(Request $req) {
        $id = $req->id;
        $sh_name = $req->sh_name;
        $sh_address = $req->sh_address;
        $phone = $req->phone;
        $email = $req->email;
        $fjxx = $req->fjxx;
        $model = new Order;
        $data = $model->doeditAddress($id,$sh_name,$sh_address,$phone,$email,$fjxx);
        echo "<script>alert('修改成功');location.href='/setting_address';</script>";
       
    }
    // 安全管理
    public function setting_safe() {
        return view('home.home-setting-safe');
    }
    // 修改密码
    public function doeditpwd(Request $req) {
        $username = $req->username;
        $pwd = $req->password;
        $newpwd = $req->newpwd;
        $model = new Order;
        $model->doeditpwd($username,$pwd,$newpwd);

    }

    // 我的购物车
    public function cart() {
        return view('home.cart');
    }
    //购物车->结算
    public function getOrderInfo() {
        return view('home.getOrderInfo');
    }
    // //购物车->结算->提交订单
    // public function pay() {
    //     return view('home.pay');
    // }

    // 秒杀
    public function seckill() {
        return view('home.seckill-index');
    }
    // 秒杀->立即抢购
    public function seckill_item() {
        return view('home.seckill-item');
    }
    // 进入店铺
    public function jr_shop() {
        return view('home.shop');
    }
    // 加入购物车
    public function success_cart() {
        return view('home.success-cart');
    }   
}
        
      
      
