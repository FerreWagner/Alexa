<?php
namespace app\index\controller;

use app\index\common\Base;
use kuange\qqconnect\QC;
use think\Cookie;

class Index extends Base
{
    public function index()
    {
        return $this->view->fetch('index');
    }
    public function callback()
    {
        error_reporting(E_ERROR | E_PARSE);
        //API调用示例：index.php->qqlogin.php->callback.php
        $qc = new QC();
//        echo $_GET['code'];die;
        //以下为授权过程
        $access_token = $qc->qq_callback();    // access_token    //回调处理code,换取accesstoken和openID并保存到cookie中
        $openid =  $qc->get_openid();     // openid
        
        
        //cookie时长一定要比accesstoken过期时长更短
        // 待处理用户逻辑
        Cookie::init(['prefix'=>'alexa_','expire'=>86400,'path'=>'/']);
        Cookie::set('qq_accesstoken', $access_token, 86400);
        Cookie::set('qq_openid', $openid, 86400);
        
        if (Cookie::has('qq_accesstoken', 'alexa_') && Cookie::has('qq_openid', 'alexa_')){
            @$openid_find = db('member')->where('openid', $openid)->find();
            if (!$openid_find){
                //第一次注册即入库
                
                $qc = new QC($access_token, $openid);
                $qq_user_info = $qc->get_user_info();
                //detail qq data
                array_splice($qq_user_info, 0, 3);
                $qq_user_info += [
                    'time'   => time(), 
                    'ip'     => $_SERVER['REMOTE_ADDR'], 
                    'openid' => $openid
                ];
                $member_insert = db('member')->insert($qq_user_info);
                $member_insert ? $this->redirect('index/index/index') : $this->error('Register Error.');
            }else {
                //已注册过
                $this->redirect('index/index/index');
            }
            
        }else {
            die('Cookie Not Exists.');
        }


//        $this->success('登录成功', url('/'));
    }
    
    public function login()
    {
        $qc = new QC();
        return redirect($qc->qq_login());   //访问qq登录页面
    }
}
