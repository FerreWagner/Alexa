<?php
namespace app\index\controller;

use app\index\common\Base;
use think\Cookie;

class Ulog extends Base
{
    public function index()
    {
        if (Cookie::has('status', 'alexa_') && Cookie::has('allow', 'alexa_')){
            $cookie    = substr(cookie('alexa_status'), 32);
            $user_data = db('member')->field(['nickname', 'figureurl_qq_1', 'time', 'ip'])->where('figureurl_qq_3', $cookie)->find();
            $user_log  = db('ulog')->field(['ip', 'time'])->where('openid', $cookie)->order('time', 'desc')->find(); //最后登录的数据
            
            $this->view->assign([
                'data' => $user_data,
                'log'  => $user_log,
            ]);
            
            return $this->view->fetch('ulog');
        }else {
            $this->error('You have no access to this authority.');
        }
        
    }
    
}
