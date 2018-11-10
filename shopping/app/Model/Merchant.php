<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin;
use DB;

class Merchant extends Model
{
      // 后台登陆
      public function login() {
        $model = new Admin;

        $name = $_POST['username'];
        $password = $_POST['password'];
        if($name == "" || $password == "")  {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }
        $ws = DB::select("select * from admins where username = '$name' and password = '$password'");
    
       if($ws) {
        $id = $ws[0]->id;
        $username = $ws[0]->username;
        session()->put('id',$id);
        session()->put('username',$username);
        session()->put('url_path',$model->getUrl(session()->get('id')));

        return 0;
       }else {
           return 1;
       }
      
   
    }
    // 退出
    public function logout() {
        $_SESSION = [];
        Session()->flush();
        return view('admin.login');
    }

    // 获取用户列表
    public function getUlist() {
        $stmt = DB::select('select * from users');
        return $stmt;
    }
    
    // 获取商品列表
    public function getGoodList() {
        $good = DB::select("select * from goods");
        return $good;
    }
    
    // 获取品牌列表
    public function getBrandList() {
        $brand = DB::select('select * from brands');
        return $brand;
    }
    // 执行添加品牌
    public function doinsertBrand($name,$img) {
        $ws = DB::table('brands')->insert([
            'name'=>$name,
            'img'=>$img
        ]);
        if($ws) {
            return 0;
        }else {
            return 1;
        }
    }
    // 删除品牌
    public function delBrand($id) {
        $ws = DB::delete("delete from brands where id = {$id}");
        if($ws){
            return 1;
        }else {
            return 2;
        }
    }

    // 品牌修改
    public function editBrand($id) {
        $data = DB::select("select * from brands where id = {$id}");
        return $data;
    }

    // 添加商品-1
    public function getFirst() {
        $data = DB::select('select * from cates where pid = 0 ');
        return $data;
    }
    // 获取子级分类
    public function getCat($id) {
        $data = DB::select("select * from cates where pid = {$id}"); 
        return $data;
    }
    // 获取品牌名称
    public function getBand_name($id) {
        $data = DB::select("SELECT b.name,b.id from cates a  LEFT JOIN brands b on a.id = b.cate_id where a.id = {$id}");
        return $data;
    }
    // 执行添加商品
    public function doInsertGood($cat) {
        //insertGetId 返回当前插入数据的 id  
        $stmt = DB::table('goods')->insertGetId([
            'name'=>$cat['name'],
            'little_name'=>$cat['little_name'],
            'price'=>$cat['price'],
            'img'=>$cat['image'],
            'cate_id'=>$cat['cat1'],
            'brand_id'=>$cat['cat4'],
            'good_num'=>$cat['good_num']
        ]);
        if($stmt) {
            // $stmt1 = DB::table('sku')->insert([
            //     'good_id'=>$stmt,
            //     'sku_name'=>$cat['attr_name'],
            //     'sku_value'=>$cat['attr_value']
            // ]);
            // if($stmt1) {
            //     $ws = DB::select("select id from sku where good_id = {$stmt}");
            //     // $ws = json_decode($ws, true);
            //     // dd($ws);
            //     foreach($ws as $v) {
            //         DB::table('sku_name')->insert([
            //             'good_id'=>$stmt,
            //             'value'=>$v->id,
            //         ]);
            //     }
                
                return 0;
            // }
        }else {
            return 1;
        }
    }

    // 修改商品
    public function editGood($id) {
        $data = DB::select("SELECT e.name brand_name,c.sku_name,c.sku_value,a.id,a.name,a.little_name,a.price,a.img as gimg,a.cate_id,a.brand_id,a.good_num,b.img FROM goods a
                            LEFT JOIN goods_img b on a.id = b.good_id
                            LEFT JOIN sku c on c.good_id = {$id}
                            LEFT JOIN cates d on a.cate_id = d.id
                            LEFT JOIN brands e on e.id = a.brand_id
                            WHERE a.id = {$id}");
        return $data;
    }




    // SELECT b.name from cates a  LEFT JOIN brands b on a.id = b.cate_id where a.id = 1

    // 删除商品
    public function delGood($id) {
        $ws = DB::delete("delete from goods where id = {$id}");
        if($ws ){ 
            return 0;
        }else {
            return 1;
        }
    }
    //执行 商品属性 name 添加
    public function donameInsert($id,$name) {
        for($i=0;$i<count($name);$i++) {
            DB::table('g_attr_name')->insert([
                'attr_name'=>$name[$i],
                'good_id'=>$id
            ]);
        }
    }
    //获取 name 像添加value页面输出
    public function get_g_name($id) {
        $data =DB::select("select * from g_attr_name where good_id = {$id}");
        return $data;
    }
    // 执行 value 添加
    public function dovalueInsert($id,$attr_name_id,$attr_value) {
        for($i=0;$i<count($attr_value);$i++) {
            DB::table('g_attr_value')->insert([
                'attr_name_id'=>$attr_name_id,
                'good_id'=>$id,
                'attr_val'=>$attr_value[$i]
            ]);
        }
    }

    public function getName_val($id) {
        $name = DB::select("SELECT * from g_attr_name a 
        LEFT JOIN (SELECT *,GROUP_CONCAT(attr_val) gc,GROUP_CONCAT(id) gb from g_attr_value GROUP BY attr_name_id) b on a.id = b.attr_name_id
				WHERE a.good_id = {$id} and b.good_id = {$id}
        ");
        // dd($name);
 
        
        return $name;
    }

    public function insertAttr($data) {
        $arr = '';
       foreach($data['n_id'] as $k=>$v){
           $arr .= $data['n_id'][$k].":".$data['g_value'][$k].",";
       }
    //    dd($arr);
        DB::table('g_attr')->insert([
            'attr'=>$arr,
            'good_id'=>$data['good_id'],
            'inventory'=>$data['inventory'],
            'price'=>$data['price']
        ]);
     
    }


    
}
