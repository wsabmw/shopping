<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Home;
use App\Model\Cate;
use Endroid\QrCode\QrCode;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use App\Http\Controllers\PayController;

class HomeController extends Controller
{
    //显示注册表单
    public function h_register() {
        return view('home.register');
    }

    public function ajax_getname() {
        $name = $_GET['name'];
        $model = new Home;
        $data = $model->ajax_getname($name);
        return $data;
    }

    public function flc() {
        $num = $_GET['num'];
        $code = rand(1000,9999);
        // session('code',$code);
        session()->put('code',$code);
        $config = [ 
            'accessKeyId' => 'LTAIeGaMvNDNUgRO', 
            'accessKeySecret' => 'GThDNwn7372SKxx6nYufdkYyPwfXFM', 
        ]; 
        
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($num);
        $sendSms->setSignName('许若尘');
        $sendSms->setTemplateCode('SMS_135445053');
        $sendSms->setTemplateParam(['code' => $code]);
        $sendSms->setOutId('demo');
    
        print_r($client->execute($sendSms));
        return session()->get('code');
             
    }
    // 处理注册表单
    public function doh_register(Request $req) {
        $username = $req->username;
        $password = $req->password;
        $phone = $req->phone;
        $yzm = $req->yzm;
        $model = new Home;
        $data = $model->do_register($username,$password,$phone,$yzm);
        if($data == 1) {
            echo "<script>alert('注册成功');</script>";
            // return view('home.login');
        }else {
            echo "<script>alert('验证码错误');</script>";
            // return view('home.register');
        }

        
    }

    // 前台登陆
    public function h_login() {
         return view('home.login');            
    }
    // 执行登陆按钮
    public function doh_login(Request $req) {
        // dd($req->all());
        $username = $req->username;
        $password = $req->password;
        $model = new Home;
        $ws = $model->getDl($username,$password);
        if($ws == 0) {
            // dd($username);
            // session('name',$username);
            session()->put('name',$username);
            // session()->put('user_id',$username);
            $ws = session('name');
            // return view('home.index');
            return redirect()->route('h_index');
        }else {
            echo "<script>alert('账号或者密码错误！！！'); history.go(-1);</script>";
            // return view('home.login');
        }
    }
    // 前台首页
    public function h_index(){
        $model = new Cate;
        $data = $model->getCategoryMenu();
        // dd($data);
        return view('home.index',['data'=>$data]);
    }
    // 跳转搜索页面
    public function searchList() {
        $id = $_GET['id'];
        $model = new Home;
        $data = $model->getSearchList($id);
        $goods = $model->getGoods();
        // dd($goods);
        return view('home.search',[
            'data'=>$data,
            'goods'=>$goods
            ]); 
    }
    
    // 跳转商品详情页面
    public function item() {
        $id = $_GET['id'];
        $model = new Home;
        $goods = $model->getGoodval($id);
        // dd($goods);
        $attr = $model->getAttr($id);
        // dd($attr);
        return view('home.item',[
        'goods'=>$goods,
        'attr'=>$attr
        ]);
    }

    //加入购物车
    public function order_gg(Request $req) {
        //  dd($req->all());
        $data = $req->all();
        $model = new Home;
        $stmt = $model->insertOrder($data);
    }
  
    // 顶部->我的品优购
    public function h_mypyg() {
        $model = new Home;
        $data = $model->getOrder();
        // dd($data);
        return view('home.my_home',['data'=>$data]);
    }
    
    public function delOrder() {
        $id = $_GET['id'];
        $model = new Home;
        $stmt = $model->delOrder($id);
    }
    
    //跳转支付页面
    public function goPay() {
        $id = $_GET['id'];
        $model = new Home;
        $data = $model->getAddress();
        $shop = $model->getShop($id);
        // dd($data);
        return view('home.getOrderInfo',[
            'data'=>$data,
            'shop'=>$shop
            ]);
    }

    public function jia_num(Request $req) {
        $good_id = $req->id;
        $good_num = $req->number;
        $z_price = $req->z_price;
        $model = new Home;
        $data = $model->jia_num($good_id,$good_num,$z_price);
    }

    public function jian_num(Request $req) {
        $good_id = $req->id;
        $good_num = $req->number;
        $z_price = $req->z_price;
        $model = new Home;
        $data = $model->jian_num($good_id,$good_num,$z_price);
    }


        //购物车->结算->提交订单
        public function pay(Request $req) {
            $col = new PayController;
            $pay = $col->pay();

            $order_id = $req->order_id;
            $address_id = $req->address_id;
            $order_num = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            $model = new Home;
            $data = $model->newOrder($order_id,$address_id,$order_num);
            $z_price = $model->z_price($order_id);
           
            return view('home.pay',[
                'data'=>$data,
                'z_price'=>$z_price,
                'pay'=>$pay,
            ]);
        }

        public function qrcode() {
            $qrCode = new QrCode($_GET['url']);
            header('Content-Type: '.$qrCode->getContentType());
            return  $qrCode->writeString(); 
        }









    //顶部->客户服务->合作招商
    public function h_hzzs() {
        return view('home.cooperation');
    }



}
