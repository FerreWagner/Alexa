<?php
namespace app\index\validate;
use think\Validate;
class Feedback extends Validate
{
    protected $rule = [     //错误规则
        'name'    => 'require|max:25|token',
        'email'   => 'email',
        'website' => 'url',
    ];
    
//    protected $message = [
//        'catename.require' => '栏目名称不得为空',
//        'catename.unique'  => '栏目名称不得重复',
//    ];
//
//    protected $scene = [    //场景有二,一个是添加,一个是编辑
//        'save' => ['catename'],
//        'edit' => ['catename'],
//    ];
}