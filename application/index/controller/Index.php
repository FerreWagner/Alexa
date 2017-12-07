<?php
namespace app\index\controller;

use app\index\common\Base;
use kuange\qqconnect\QC;

class Index extends Base
{
    public function index()
    {
        return $this->view->fetch('index');
    }
    public function callback()
    {
        //API调用示例：index.php->qqlogin.php->callback.php
        $qc = new QC();
//        echo $_GET['code'];die;
        //以下为授权过程
        $access_token = $qc->qq_callback();    // access_token    //回调处理code,换取accesstoken和openID并保存到cookie中
        $openid =  $qc->get_openid();     // openid
        //cookie时长一定要比accesstoken时长更短
        setcookie('qq_accesstoken', $access_token, time() + 86400);
        setcookie('qq_openid', $openid, time() + 86400);

//        if (!isset($_COOKIE['qq_accesstoken']) || !isset($_COOKIE['qq_openid'])){
//            return $this->error('Login Error,Dear');
//        }
        // 待处理用户逻辑
        $qc = new QC($access_token, $openid);
        $qq_user_info = $qc->get_user_info();
        dump($qq_user_info);die;


//        $this->success('登录成功', url('/'));
    }
    
    public function login()
    {
        $qc = new QC();
        return redirect($qc->qq_login());   //访问qq登录页面
    }
}
