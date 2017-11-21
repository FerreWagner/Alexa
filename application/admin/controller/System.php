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
        return $this->view->fetch('sys-link');
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
