<?php
namespace app\index\controller;

use app\index\common\Base;
use think\Cookie;

class Article extends Base
{
    public function index()
    {
        if (!password_verify($_SERVER['REMOTE_ADDR'], Cookie::get('token', 'alexa_'))) $this->error('Sry, You are not allowed to be allowed.');
        
        $article = db('article')->field('a.*,b.catename')->alias('a')->join('alexa_category b','a.cate=b.id')->find(input('id'));
        $next_time = db('artsee')->where("ip = '{$_SERVER["REMOTE_ADDR"]}' AND rid = '{$article['id']}'")->order('time', 'desc')->find(); //是否存在已经浏览的ip
        
        
        if (!$next_time){
            
            $data = [
                'rid'  => $article['id'],
                'type' => $this->getBrowser(),
                'ip'   => $_SERVER['REMOTE_ADDR'],
                'time' => time(),
            ];
            
            db('article')->where('id', input('id'))->setInc('see'); //article view
            db('artsee')->insert($data);
        }
        
        
        $prev    = db('article')->field('id')->order('order', 'desc')->where('order', '<', $article['order'])->limit(1)->find();
        $next    = db('article')->field('id')->order('order', 'asc')->where('order', '>', $article['order'])->limit(1)->find();
        
        $prev = @empty(implode($prev, '.')) ? $article['id'] : @implode($prev, '.');
        $next = @empty(implode($next, '.')) ? $article['id'] : @implode($next, '.');
        
        $this->view->assign([
            'article' => $article,
            'prev'    => $prev,
            'next'    => $next,
        ]);
        return $this->view->fetch('article');
    }
    
    
    
    public function getBrowser()
    {
        
        switch ($_SERVER['HTTP_USER_AGENT'])
        {
            case null:
                return 'machine';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0'):
                return 'ie9';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0'):
                return 'ie8';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0'):
                return 'ie7';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0'):
                return 'ie6';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Firefox'):
                return 'fox';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Chrome'):
                return 'chrome';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Safari'):
                return 'safari';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera'):
                return 'opera';
                break;
                
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'360SE'):
                return '360se';
                break;
                
            default:
                return 'notidentify';
                break;
                
        }
        
    }
    
    
    
}
