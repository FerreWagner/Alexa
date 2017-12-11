<?php
namespace app\index\controller;

use app\index\common\Base;

class Article extends Base
{
    public function index()
    {
        return $this->view->fetch('article');
    }
    
}
