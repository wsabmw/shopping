<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Advertising extends Model
{
    // 广告列表
    public function getAdvlist() {
        $data = DB::select('select * from advertising');
        return $data;
    }

    // // 获取申请广告内容
    // public function getAdv() {
        
    // }
}
