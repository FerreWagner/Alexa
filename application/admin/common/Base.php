<?php
namespace app\admin\common;

use think\Controller;
use think\Request;
use app\admin\model\System;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        //detail login
        $request = Request::instance();
        if ($request->module() == 'admin' && $request->controller() != 'Login'){    //except Login action,all admin function need validate
            $this->isLogin();
        }
        //查询网站的开关状态
        $config = $this->getSystem();
        $this->getStatus($request, $config);
    }

    protected function isLogin()
    {
        //use helper function to validate
        if (empty(\session('user_name'))){
            $this->error('Pls Login First.Dear.', 'admin/login/index');
        }
    }

    protected function alreadyLogin()
    {
        if (!empty(\session('user_name'))){
            $this->error('You Already Login.Dear', 'admin/index/index');
        }
    }
    
    
    
    //获取配置信息
    public function getSystem()
    {
        return System::get(1);
    }
    
    //判断当前网站的开启状态($request请求对象,$config当前配置信息)
    public function getStatus($request, $config)
    {
        //关闭前台，即不是admin模块
        if ($request->module() != 'admin'){
    
            //根据配置表中的is_close进行判断，0开启1关闭
            if ($config->is_close == 1){
                $this->error('网站已关闭');
                exit;
            }
        }
    }
}
