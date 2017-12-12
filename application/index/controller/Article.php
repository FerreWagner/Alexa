<?php
namespace app\index\controller;

use app\index\common\Base;

class Article extends Base
{
    public function index()
    {
        $article = db('article')->find(input('id'));
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
    
}
