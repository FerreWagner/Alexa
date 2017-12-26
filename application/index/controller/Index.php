<?php
namespace app\index\controller;

use app\index\common\Base;
use kuange\qqconnect\QC;
use think\Cookie;

class Index extends Base
{
    public function index()
    {
        if (input('keywords')){
            $map['catename'] = ['like','%'.input('keywords').'%'];
            $article = db('article')->field('a.*,b.catename')->alias('a')->join('alexa_category b','a.cate=b.id')->order('a.order desc')->where($map)->cache(1296000)->paginate(6);
        }else {
            $article   = db('article')->field('a.*,b.catename')->alias('a')->join('alexa_category b','a.cate=b.id')->order('a.order desc')->cache(1296000)->paginate(6);
        }
        
        $art_count = db('article')->cache(1296000)->count('id');
        $system    = db('system')->cache(1296000)->select();
        $this->assign([
            'article'   => $article,
            'system'    => $system,
            'art_count' => $art_count,
        ]);
        
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
        $openid       =  $qc->get_openid();    // openid
        
        
        //cookie时长一定要比accesstoken过期时长更短
        // 待处理用户逻辑,最优加密+盐
        Cookie::init(['prefix'=>'alexa_','expire'=>864000,'path'=>'/']);
        Cookie::set('allow', password_hash($access_token, PASSWORD_DEFAULT, ['alexa']), 864000);
        Cookie::set('status', strtoupper(md5($access_token)).$openid, 864000);
        
        
        if (Cookie::has('allow', 'alexa_')){
            //用户记录入库
            $user_log = [
                'openid'         => $openid,
                'ip'             => $_SERVER['REMOTE_ADDR'],
                'time'           => time(),
            ];
            $res = db('ulog')->insert($user_log);
            @$openid_find = db('member')->where('figureurl_qq_3', $openid)->find();
            if (!$openid_find){
                //第一次注册即入库
                
                $qc = new QC($access_token, $openid);
                $qq_user_info = $qc->get_user_info();
                
                //detail qq data
                array_splice($qq_user_info, 0, 3);
                unset($qq_user_info['figureurl']);
                unset($qq_user_info['figureurl_2']);
                unset($qq_user_info['figureurl_qq_2']);
                
                $qq_user_info += [
                    'figureurl_qq_3' => $openid,
                    'time'           => time(), 
                    'ip'             => $_SERVER['REMOTE_ADDR'], 
                    'openid'         => password_hash($openid, PASSWORD_DEFAULT, ['alexa'])
                ];
                $member_insert = db('member')->insert($qq_user_info);
                $member_insert ? $this->redirect('index/index/index') : $this->error('Register Error.');
            }else {
                //已注册过
                $res ? $this->redirect('index/index/index') : $this->error('Log Error,Pls Connect Ferre.');
            }
            
        }else {
            die('Cookie Not Exists.');
        }

    }
    
    public function login()
    {
        $qc = new QC();
        return redirect($qc->qq_login());   //访问qq登录页面
    }
    

    
}
