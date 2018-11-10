<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Merchant;
class MerchantController extends Controller
{   
// =====================运营商后台======================
    // 后台登陆
    public function login() {
        return view('admin.login');
    }
    //后台登陆后的主页
    public function index() {
        $model = new Merchant;
        $data = $model->login();
        if($data == 0 ) {
             return view('admin.index');
        }else {
            echo "<script>alert('用户名或密码错误！'); history.go(-1);</script>";  
        }
        // dd($data);
    }
     // 退出
     public function logout() {
         $model = new Merchant;
         $model->logout();
        //  redirect('/login');
        return view('admin.login');
     }
    
    // 用户管理  列表
    public function yhgl() {
        $model = new Merchant;
        $data = $model->getUlist();
        // var_dump($data);
        return view('admin.yh_list',
        ['data'=>$data]
         );
    }

    //首页右方区域
    public function home() {
        return view('admin.home');
    }
    //左侧首页按钮
    public function indexc() {
        return view('admin.index');
    }

    //商家管理->商家审核
    public function sjsh() {
        return view('admin.sjsh');
    }


    // 商品管理->商品管理
    public function spgl() {
        $model = new Merchant;
        $data = $model->getGoodList();
        return view('admin.spgl',['data'=>$data]);
    }
    // 跳转添加商品页面
    public function insertGood() {
        // 取出顶级分类
        $model = new Merchant;
        $data = $model->getFirst();
        return view('admin.insertGood',['data'=>$data]);
    }
    // 添加商品->获取子级分类
    public function getcat() {
        $id = $_GET['id'];

        $model = new Merchant;
        $cat = $model->getCat($id);
        return $cat;
    }
    public function getBand_name() {
        $id = $_GET['id'];
        $model = new Merchant;
        $name = $model->getBand_name($id);
        return $name;
    }
    // 确认提交商品
    public function doInsertGood(Request $req) {
        $cat = $req->all();
        // dd($cat);
        $model = new Merchant; 
        $good = $model->doInsertGood($cat);
        if($good == 0) {
            echo "<script>alert('商品添加成功！！');</script>";
            return redirect()->route('spgl_admin');
        }else {
            echo "<script>alert('商品添加失败！！');</script>";
            return redirect()->route('insertGood');
        }
    }
    

    // 商品删除
    public function delGood() {
        $id = $_GET['id'];
        $model = new Merchant;
        $data = $model->delGood($id);
        if($data == 0) {
            echo "<script>alert('商品删除成功！！');</script>";
            return redirect()->route('spgl_admin');
        }else {
            echo "<script>alert('商品删除失败！！！');</script>";
            return redirect()->route('spgl_admin');
        }
    }

    // 修改商品
    public function editGood() {
        $id = $_GET['id'];
        $model = new Merchant;
        $cat = $model->getFirst();
        $data = $model->editGood($id);
        $brand = $model->getBrandList();
        // dd($data);
        return view('admin.editGood',[
            'cat'=>$cat,
            'data'=>$data,
            'brand'=>$brand
            ]);
    }
    // 确认修改
    public function doeditGood(Request $req) {
        // $id = $_GET['id'];
        echo "<pre>";
        var_dump($req);
    }


    //商品属性 name 添加
    public function nameInsert() {
        $id = $_GET['id'];
        return view('admin.nameInsert',['id'=>$id]);
    }

    public function donameInsert(Request $req) {
        $id = $req->id;
        $name = $req->attr_name;
        $model = new Merchant;
        $ws = $model->donameInsert($id,$name);
        // return redirect()->route('valueInsert',['id'=>$id]);
        return redirect()->route('spgl_admin');
    }
    
    // 商品属性 value 添加
    public function valueInsert(Request $req) {
        $id = $req->id;
        $model = new Merchant;
        $data = $model->get_g_name($id);
        return view('admin.valueInsert',[
            'id'=>$id,
            'data'=>$data
            ]);
    }

    public function dovalueInsert(Request $req) {
        $id = $req->id;
        $attr_name_id = $req->attr_name_id;
        $attr_value = $req->attr_val;
        // dd($attr_value);
        $model = new Merchant;
        $data = $model->dovalueInsert($id,$attr_name_id,$attr_value);
        return redirect()->route('attrInsert',['id'=>$id]);
    }


    public function attrInsert(Request $req) {
        $id = $req->id;
        $model = new Merchant;
        $data = $model->getName_val($id);

        // dd($data);
        return view('admin.shuxingInsert',['data'=>$data]);
    }

    public function doAttrInsert(Request $req) {
        $data = $req->all();
        // dd($data);
        $model = new Merchant;
        $model->insertAttr($data);
    }

    // 商品规格添加
    // public function shuxingInsert(Request $req) {
    //     $id = $_GET['id'];
    //     // $model = sxInsert($id);
    //     return view('admin.shuxingInsert');
    // }







    // 商品管理->品牌管理
    public function ppgl() {
        $model = new Merchant;
        $data = $model->getBrandList();
        return view('admin.ppgl',['data'=>$data]);
    }
    // 添加品牌
    public function insertBrand() {
        return view('admin.insertBrand');
    }


    // 执行添加品牌
    public function doinsertBrand(Request $req) {
        $name = $req->name;
        $img = $req->img;
        $model = new Merchant;
        $data = $model->doinsertBrand($name,$img);
        if($data == 0) {
            echo "<script>alert('添加成功!!!')</script>";
             return redirect()->route('ppgl_admin');
        }else {
            echo "<script>alert('添加失败！！！')</script>";
            return redirect()->route('insertBrand');
        }
    }

    // 删除品牌
    public function delBrand() {
        $id = $_GET['id'];
        $model = new Merchant;
        $data = $model->delBrand($id);
        if($data == 1) {
            echo "<script>alert('删除成功！！');</script>";
            return redirect()->route('ppgl_admin');
        }else {
            echo "<script>alert('删除失败！！！');</script>";
            return redirect()->route('ppgl_admin');
        }
    }
    // 修改品牌
    public function editBrand() {
        $id = $_GET['id'];
        $model = new Merchant;
        $data = $model->editBrand($id);
        // dd($data);
        return view('admin.editBrand',['data'=>$data]);
    }






    // 商品管理->规格管理
    public function gggl() {
        return view('admin.gggl');
    }
    // 商品管理->模版管理
    public function mbgl() {
        return view('admin.mbgl');
    }
    // 商品管理->分类管理
    public function flgl() {
        return view('admin.flgl');
    }
    // 商品管理->商品审核
    public function spsh() {
        return view('admin.spsh');
    }
    //广告管理->广告类型管理
    public function gglxgl() {
        return view('admin.gglxgl');
    }
    //广告管理->广告管理
    public function guanggll() {
        return view('admin.guanggll');
    } 
}
