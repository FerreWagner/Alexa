<?php
namespace app\index\controller;

use app\index\common\Base;

class Article extends Base
{
    public function index()
    {
        db('article')->where('id', input('id'))->setInc('see'); //article view
        
        $article = db('article')->field('a.*,b.catename')->alias('a')->join('alexa_category b','a.cate=b.id')->find(input('id'));
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
