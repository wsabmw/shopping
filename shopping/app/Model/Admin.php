<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model {
    // 获取管理员列表
    public function getAdminlist() {
        $stmt = DB::select('SELECT * from admins 
            LEFT JOIN admin_role ON admins.id = admin_role.admin_id
            LEFT JOIN role on role.id = admin_role.role_id
            LEFT JOIN 
            (SELECT role_privilege.role_id,GROUP_CONCAT(privilege.pri_name) pri_list from role_privilege
            LEFT JOIN privilege on privilege.id = role_privilege.pri_id
            group by role_privilege.role_id) abc
            on abc.role_id = role.id
        ');
 
        return $stmt;
    }

    // 获取一个管理员的访问权限
    public function getUrl($adminId) {
        $data = DB::select("SELECT  admins.id id,GROUP_CONCAT(privilege.url_path) url_path from  admins 
        LEFT JOIN admin_role on admins.id = admin_role.admin_id
        LEFT JOIN role_privilege on admin_role.role_id = role_privilege.role_id
        LEFT JOIN privilege on role_privilege.pri_id = privilege.id
        WHERE admins.id = {$adminId}
        GROUP BY admins.id");
        $_ret = [];
        foreach($data as $v){
            if(FALSE === strpos($v->url_path, ',')) {
                $_ret[] = $v->url_path;
            }
            else {
                $_tt = explode(',', $v->url_path);
                $_ret = array_merge($_ret, $_tt);
            }
        }
        return $_ret;
    }

    // 获取角色列表
    public function getRolelist() {
        $stmt = DB::select('select * from role');
        return $stmt;
    }
    // 获取权限列表
    public function getPrivilegelist() {
        $stmt = DB::select('select * from privilege');
        return $stmt;
    }
    //获取文章列表
    public function getArticlelist() {
        $data =DB::select('select * from article');
        return $data;
    }

    // 文章发布
    public function dofb($title,$user_id,$user_name,$content) {
        $ws = DB::table('article')->insert([
            'title'=>$title,
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'content'=>$content
        ]);
        if($ws) {
            return 0;
        }else {
            return 1;
        }
    }
    // 修改文章
    public function ed_art($id) {
        $data = DB::select("select * from article where id = {$id}");
        return $data;
    }
    // 修改文章按钮
    public function do_ed_art($id,$title,$user_id,$user_name,$content) {
        $ws =  DB::table('article')->where('id',$id)->update([
            'title'=>$title,
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'content'=>$content
            ]);
        if($ws) {
            return 0;
        }else {
            return 1;
        }
    }
    // 删除文章
    public function del_art($id) {
        $ws = DB::delete("delete from article where id = {$id}");
    }


    public function getRegist() {
        
    }
    

}
