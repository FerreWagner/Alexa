<?php

namespace app\admin\controller;


use app\admin\common\Base;


class Admin extends Base
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
