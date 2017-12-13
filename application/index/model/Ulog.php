<?php
namespace app\index\model;

use think\Model;
use think\Cookie;

class Ulog extends Model
{
    protected $type       = [
        // 设置birthday为时间戳类型（整型）
        'time' => 'timestamp:Y-m-d H:i:s',
    ];
    
    public function logdata()
    {
        if (Cookie::has('status', 'alexa_')){
            echo substr(cookie('status'), 32);die;
        }else {
            $this->error('Have Not Data.');
        }
    }
    
}
