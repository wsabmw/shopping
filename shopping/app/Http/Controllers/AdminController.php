<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin;

class AdminController extends Controller
{
    public function __construct()
{
    if(!isset($_SESSION['id']))
    {
        redirect('/login/login');
    }
}
    // 管理员列表
    public function admin_list() {
        $model = new Admin;
        $data = $model->getAdminlist();
        return view('admin.gl_list',['data'=>$data]);
    }

    // 角色管理
    public function role_list() {
        $model = new Admin;
        $data = $model->getRolelist();
        return view('admin.role_list',['data'=>$data]);
    }

    // 权限管理
    public function privilege_list() {
        $model = new Admin;
        $data = $model->getPrivilegelist();
        return view('admin.privilege_list',['data'=>$data]);
    } 
    // 显示文章列表
    public function article_list() {
        $model = new Admin;
        $data = $model->getArticlelist();
        return view('admin.article_list',['data'=>$data]);
    }
    // 显示发布文章界面
    public function article_fb() {
        return view('admin.article_fb');
    }
    // 发布文章
    public function dofb() {
        $title = $_POST['title'];
        $user_id = session('id');
        $user_name = session('username');
        $content = $_POST['content'];
        // dd($content);
        // die;
        $model = new Admin;
        $ws = $model->dofb($title,$user_id,$user_name,$content);   
        if($ws == 0) {
            echo "<script>alert('发表成功');</script>";
            return view('admin.article_fb');
        }else {
            echo "<script>alert('发表失败,请重发布');</script>";
            return view('admin.article_fb');

        }
        
    }

    // 修改文章
    public function ed_art() {
        $id = $_GET['id'];
        $model = new Admin;
        $data = $model->ed_art($id);
        return view('admin.article_edit',['data'=>$data]);
    }
    // 修改文章按钮
    public function doedit() {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $user_id = session('id');
        $user_name = session('username');
        $content = $_POST['content'];
        $model = new Admin;
        $ws = $model->do_ed_art($id,$title,$user_id,$user_name,$content);
        if($ws == 0) {
            echo "<script>alert('修改成功');</script>";
            $model = new Admin;
            $data = $model->getArticlelist();
            return view('admin.article_list',['data'=>$data]); 
        }else {
            echo "<script>alert('修改失败,请重发布'); history.go(-1); </script>";
        }
    }

    // 删除文章
    public function del_art() {
        $id = $_GET['id'];
        $model = new Admin;
        $model->del_art($id);
        echo "<script>alert('删除成功');</script>"; 
        $model = new Admin;
        $data = $model->getArticlelist();
        return view('admin.article_list',['data'=>$data]); 
    }


   

}
 