<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Link;
use think\Request;

class System extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return $this->view->fetch('system_set');
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示友链
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function linkList()
    {
        $link_list = Link::all();
        $this->assign('link_list', $link_list);
        return $this->view->fetch('sys_link');
    }
    
    /**
     * 渲染友链编辑模板
     */
    public function linkEdit($id)
    {
        $link = Link::get($id);
        $this->assign('link', $link);
        return $this->view->fetch('link-edit');
    }
    
    /**
     * 友链更新操作
     */
    public function linkUpdate(Request $request)
    {
        if ($request->isPost()){
            $link_update = $request->param();
            
            $map = ['name' => $link_update['name'], ['id' => $link_update['id']]];
            $res = Link::update($link_update, $map);
            
            if (!is_null($res)){
                return redirect('system/linklist');
            }else {
                return $this->error('更新失败', 'system/linkupdate');
            }
        }else {
            return $this->error('false request');
        }
    }
    
    /**
     * 友链添加
     */
    public function linkAdd(Request $request)
    {
        if ($request->isAjax(true)){
            $res = Link::create($request->param());
            return ($res ? ['message' => '添加成功', 'status' => 1] : ['message' => '添加失败', 'status' => 0]);
        }else {
            return $this->error('error');
        }
    }
    
    /**
     * 友链删除
     */
    public function linkDelete()
    {
        
    }
    
}
