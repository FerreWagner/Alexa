<?php
namespace app\index\common;

use app\admin\model\System;
use think\Controller;
use think\Request;
use think\Cookie;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        $request  = Request::instance();
        //get website switch
        $config   = $this->getSystem();
        $this->getStatus($request, $config);

        //tourist data detail,find next time to detail
        $tour_res = db('tourist')->where('ip', $_SERVER['REMOTE_ADDR'])->order('time', 'desc')->find();
        if ($tour_res['time'] + 120 < time()){
            db('tourist')->insert([
                'ip'   => $_SERVER['REMOTE_ADDR'],
                'time' => time(),
            ]);
        }
        
        if (Cookie::has('qq_accesstoken', 'alexa_') && Cookie::has('qq_openid', 'alexa_')){
                $user_data = db('member')->where('openid', Cookie::get('qq_openid','alexa_'))->find();
                if (!$user_data) $this->error('Your Data Have Not In DaaBase.');
                $this->view->assign('alexau', $user_data);
        }

    }




    //get config info
    public function getSystem()
    {
        return System::get(1);
    }

    /**
     * @param $request
     * @param $config
     */
    public function getStatus($request, $config)
    {
        //close index module
        if ($request->module() == 'index'){
            //0 open;1 close
            if ($config->is_close == 1) die('<h1 style="font-family: Arial, Helvetica, sans-serif;margin-top: 100px;text-align:center;">Alexa Maintenance,Dear</h1>');
        }
    }
}
