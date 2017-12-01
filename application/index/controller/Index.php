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
        $this->success('登陆成功！', 'index/index/index');
    }
    
    public function login()
    {
        $qc = new QC();
        return redirect($qc->qq_login());
    }
}
