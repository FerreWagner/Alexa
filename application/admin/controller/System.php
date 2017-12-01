<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Link;
use think\Loader;
use think\Request;
use app\admin\model\System as SystemModel;
class System extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $this->view->assign('system', SystemModel::get(1));
        
        return $this->view->fetch('system-set');
        
    }
    
    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function update(Request $request)
    {
        if ($request->isAjax(true)){
    
            $data = $request->param();
            //设置更新条件
            $map = ['is_update' => $data['is_update']];
            $res = SystemModel::update($data, $map);
    
            //返回信息
            if (is_null($res)){
                $status = 0;
                $message = '更新失败，请检查';
            }else {
                $status = 1;
                $message = '更新成功啦';
            }
    
            return ['status' => $status, 'message' => $message];
    
        }
    
    }
    /**
     * 显示 && 添加友链
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function linkList(Request $request)
    {
        if ($request->isPost()){
            //验证表单
            $validate = Loader::validate('Syetem');
            if (!$validate->scene('add')->check($request->param())){
                $this->error($validate->getError());
            }
            $res = Link::create($request->param());
            return ($res ? redirect('system/linkList') : $this->error('未添加成功'));
        }
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
            //验证表单
            $validate = Loader::validate('Syetem');
            if (!$validate->scene('edit')->check($link_update)){
                $this->error($validate->getError());
            }
            
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
     * 友链删除
     */
    public function linkDelete()
    {
        $del = db('link')->delete(input('id'));
        $del ? $this->redirect('admin/system/linklist') : $this->error('Link Delete Error,Dear');
    }
    
}