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
        
        if (Cookie::has('allow', 'alexa_') && Cookie::has('status', 'alexa_')){
            $user_data = db('member')->where('figureurl_qq_3', substr(Cookie::get('status','alexa_'), 32))->find();
            if (!$user_data) $this->error('Your Data Have Not In DataBase.');
            if (!password_verify(substr(Cookie::get('status','alexa_'), 32), $user_data['openid'])) $this->error('Pls Do Not Attack,Your IP Already Rrecorded.');
            $this->view->assign('alexau', $user_data);
        }
        
        $this->headNav();
        $this->bottomNav();
        $this->view->assign([
            'config' => $config,
        ]);
        
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
    

    /**
     * index head data
     */
    public function headNav()
    {
        $post = db('article')->field(['id', 'title'])->order('time', 'desc')->limit(4)->select();
        $cate = db('category')->select();
    
        $this->assign([
            'post' => $post,
            'cate' => $cate,
        ]);
    }
    
    /**
     * index bottom data
     */
    public function bottomNav()
    {
        $art_count  = db('article')->count('id');
        $tour_count = db('tourist')->count('id');
        $view_count = db('article')->sum('see');
        $this->view->assign([
            'art_count'  => $art_count,
            'view_count' => $view_count,
            'tour_count' => $tour_count,
        ]);
    }
    
}
