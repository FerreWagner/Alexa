<?php
namespace app\index\controller;

use app\index\common\Base;

class Index extends Base
{
    public function index()
    {
        return $this->view->fetch('index');
    }
    
    public function callback()
    {
        $this->success('登陆成功！', 'index/index/index');
    }
}
