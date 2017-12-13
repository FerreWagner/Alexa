<?php
namespace app\index\model;

use think\Model;

class Ulog extends Model
{
    protected $type       = [
        // 设置birthday为时间戳类型（整型）
        'time' => 'timestamp:Y-m-d H:i:s',
    ];
    
}
