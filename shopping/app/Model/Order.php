<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public function getSetInfo($name,$sex,$riqi,$dizhi,$job,$zhanghao) {
        $stmt = DB::table('user_information')->insert([
            'name'=>$name,
            'sex'=>$sex,
            'birthday'=>$riqi,
            'home'=>$dizhi,
            'job'=>$job,
            'user_name'=>$zhanghao
        ]);
        if($stmt) {
            return 1;
        }else {
            return 2;
        }
    }

    // 判断是否添加过基本信息
    public function judge($username) {
        $stmt = DB::select("select users.username from users left join user_information 
        on users.username = user_information.user_name 
        where users.username = user_information.user_name and users.username = '{$username}'");
        if($stmt) {
            return 0;
        }else {
            return 1;
        }
    }

    public function getinfo($username) {
        $stmt = DB::select("select b.name,b.sex,b.birthday,b.home,b.job,b.user_name from users a left join user_information b
                            on a.username = b.user_name 
                            where a.username = b.user_name and a.username = '{$username}'");
        return $stmt;
    }

    // 确认新增地址
    public function doinaddress($sh_name,$sh_address,$phone,$email,$fjxx) {
        $name = session('name');
        $id = DB::select("select id from users where username = '{$name}'");
        $id = $id[0]->id;

        $ws = DB::table('address')->insert([
            'sh_name'=>$sh_name,
            'sh_address'=>$sh_address,
            'phone'=>$phone,
            'email'=>$email,
            'fjxx'=>$fjxx,
            'user_id'=>$id
        ]);
        if($ws) {
            return 0;
        }else {
            return 1;
        }
    }
    //获取地址列表
    public function getAddresslist() {
        // dd(session('name'));
        $name = session('name');
        $id = DB::select("select id from users where username = '{$name}'");
        $id = $id[0]->id;
        $ws = DB::select("select * from address where user_id = {$id}");
        return $ws;
    }
    //删除地址
    public function delAddress($id) {
        $ws = DB::delete("delete from address where id = {$id}");
    }
    // 修改地址
    public function editAddress($id) {
        $ws = DB::select("select * from address where id = {$id}");
        return $ws;
    }
    public function doeditAddress($id,$sh_name,$sh_address,$phone,$email,$fjxx) {
        $ws =  DB::table('address')->where('id',$id)->update([
            'sh_name'=>$sh_name,
            'sh_address'=>$sh_address,
            'phone'=>$phone,
            'email'=>$email,
            'fjxx'=>$fjxx,
            ]);
        if($ws) {
            return 0;
        }else {
            return 1;
        }
    }
    
    // 修改密码
    public function doeditpwd($username,$pwd,$newpwd) {
        $stmt  = DB::select("select * from users where username = '{$username}' and password = '{$pwd}'");
        if($stmt) {
            // DB::table('users')->where('username','$username')->update([
            //     'password'=>$newpwd
            // ]);
            DB::update("update `users` set `password` ='{$newpwd}'  where `username` = '{$username}'");
            echo "<script>alert('密码修改成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";            
        }else {
            echo "<script>alert('账号或者密码错误！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
    }
}
