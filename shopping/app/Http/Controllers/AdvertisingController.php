<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Advertising;

class AdvertisingController extends Controller
{
    //显示广告列表列表          
    public function advertising() {
        $model = new Advertising;
        $data = $model->getAdvlist();
        return view('admin.advertising',['data'=>$data]);
    }

    public function getAdvertising() {
        return view('admin.gglxgl');
    }
    public function insertAdv() {
        return view('admin.advertising_sql');
    }
}
