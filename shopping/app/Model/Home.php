<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class Home extends Model
{  
    protected $table = 'users';
    //    处理注册表单
    public function do_register($username,$password,$phone,$yzm) {
        if($yzm == session('code')) {
            $ws = DB::table('users')->insert([
                'username'=>$username,
                'password'=>$password,
                'phone'=>$phone,
            ]);
            return 1;
        }else {
            return 0;
        }
        
    }
    // 执行登陆
    public function getDl($username,$password) {
        $data = DB::select("select * from users where username = '{$username}' and password = '{$password}'");
        if($data) {
            return 0;
        }else {
            return 1;
        }
    }


    public function ajax_getname($name) {
         $ws = DB::select("select * from users where username = '{$name}'");
         if($ws) {
             return 0;
         }else {
             return 1;
         }
    }
    // 获取主页左侧列表
    public function getTlist() {
        $ws = DB::select("select * from sort");
        
        return $ws;
    }
    
    // 获取search页面的查询条件
    public function getSearchList($id) {
        $ws = DB::select("SELECT b.name,GROUP_CONCAT(c.name) v_name FROM cates a
                          LEFT JOIN attribute_key b on a.id = b.cate_id
                          LEFT JOIN attribute_value c on b.id = c.key_id 
                          where a.id = {$id}
                          GROUP BY b.id,b.name");
        // unset($ws[0]);
        array_values($ws);
        return $ws;
    }

    // 获取商品列表
    public function getGoods() {
        $goods = DB::select('select * from goods');
        return $goods;
    }

    // 跳转商品详情页面
    public function getGoodval($id) {
        $goods = DB::select("SELECT a.*,GROUP_CONCAT(b.img) s_img FROM goods a
                            LEFT JOIN goods_img b on a.id = b.good_id
                            where a.id = {$id}
                            GROUP BY a.id");
                            // dd($goods);
        return $goods;
    }
    //商品详情页面的规格名称和value
    public function getAttr($id) {
        $attr = DB::select("SELECT a.attr_name,GROUP_CONCAT(b.id) val_id,GROUP_CONCAT(b.attr_val) attr_val from g_attr_name a 
                            left join g_attr_value b on b.attr_name_id = a.id WHERE
                            a.good_id = {$id} GROUP BY a.id"); 
                            // dd($attr);
        return $attr;
    }

    // 加入购物车
    public function insertOrder($data) {
        // dd($data);
        $name = session('name');
        $user_id = DB::select("select id  from users where username='{$name}'");
        // dd($user_id[0]->id);
        $attr = DB::table('orders')->insert([
            'good_img'=>$data['fm_img'],
            'good_id'=>$data['good_id'],
            'user_id'=>$user_id[0]->id,
            'good_name'=>$data['name'],
            // 'good_attr'=>$data['attr'],
            'price'=>$data['price'],
            'good_num'=>$data['good_num'],
            // 'order_no'=>$data['order_no']
        ]);
        if($attr) {
           echo "<script>alert('添加购物车成功');history.back(-1);</script>";
        }else {
           echo "<script>alert('添加购物车失败');history.back(-1);</script>";
        }
    }

    public function getOrder() {
        $name = session('name');
        $user_id = DB::select("select id  from users where username='{$name}'");
        $id = $user_id[0]->id;
        // dd($user_id);
        // dd($id);
        $data = DB::select("select * from orders where user_id = '{$id}'");
        return $data;
    }

    public function delOrder($id) {
        $ws = DB::delete("delete from orders where id = {$id}");
        if($ws){
            echo "<script>alert('取消订单成功!');self.location=document.referrer;</script>";
        }
    }


    public function getAddress() {
        $name = session('name');
        $id = DB::select("select id from users where username = '{$name}'");
        $id = $id[0]->id;
        $data = DB::select("select * from address where user_id = {$id}");
        return $data;
    }

    public function getshop($id) {
        $shop = DB::select("select * from orders where id = {$id}");
        return $shop;
    }

    public function jia_num($good_id,$good_num,$z_price) {
        DB::update("update orders set good_num = '{$good_num}',z_price = {$z_price} where id = {$good_id}");
    }

    public function jian_num($good_id,$good_num,$z_price) {
        DB::update("update orders set good_num = '{$good_num}',z_price = {$z_price} where id = {$good_id}");
    }

    public function newOrder($order_id,$address_id,$order_num) {
       $data = DB::table('order_submit')->insert([
            'order_num'=>$order_num,
            'order_id'=>$order_id,
            'address_id'=>$address_id
        ]);
        return $order_num;
        
    }
    public function z_price($order_id) {
        $z_price = DB::select("select z_price from orders where id={$order_id}");
        return $z_price;
    }

    

}