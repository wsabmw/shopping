<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;


class PayController extends Controller
{
    protected $config = [
        'app_id' => 'wx426b3015555a46be',
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        'notify_url' => 'http://a84aee86.ngrok.io',
        ];
    public function pay()
    {
        $order = [
            'out_trade_no' => time(),
            'total_fee' => '1', 
            'body' => 'test body - 测试',
            // 'openid' => 'onkVf1FjWS5SBIixxxxxxx',
        ];

        $pay = Pay::wechat($this->config)->scan($order);

        // echo $pay->return_code , '<hr>';
        // echo $pay->return_msg , '<hr>';
        // echo $pay->appid , '<hr>';
        // echo $pay->result_code , '<hr>';
        // echo $pay->code_url, '<hr>';
        return $pay->code_url;
    }

    public function notify()
    {
        $pay = Pay::wechat($this->config);

        try{
            $data = $pay->verify(); // 是的，验签就这么简单！

            if($data->result_code == 'SUCCESS' && $data->return_code == 'SUCCESS')
            {
                echo '共支付了：'.$data->total_fee.'分';
                echo '订单ID：'.$data->out_trade_no;
            }

        } catch (Exception $e) {
            var_dump( $e->getMessage() );
        }
        
        $pay->success()->send();
    }
}

