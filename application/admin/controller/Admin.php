<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $ferre = db('admin')->find(1);
        $this->view->assign('ferre', $ferre);
        return $this->view->fetch('admin_list');
        
    }
    
}
