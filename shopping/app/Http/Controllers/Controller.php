<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
    // 判断登录
    $id = session()->get('id'); 
    $url_path = session()->get('url_path'); 
    if(!isset($id)){
        return view('admin.login');
    }

    // 获取将要访问的路径 
    $path = isset($_SERVER['PATH_INFO'])? trim($_SERVER['PATH_INFO'], '/') : 'yy_admin';
    // 设置一个白名单
    $whiteList = ['yy_admin'];
    // 判断是否有权访问
    if(!in_array($path,array_merge($whiteList,$url_path)))
    {
        die('无权访问！');
    }
}
}


