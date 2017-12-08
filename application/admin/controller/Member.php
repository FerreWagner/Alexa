<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Member as MemberModel;

class Member extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $data  = MemberModel::paginate(8);
        $count = count($data);
        $this->view->assign([
            'data'  => $data,
            'count' => $count,
        ]);
        return $this->view->fetch('member-list');
        
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
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    public function touristList()
    {
        $tour_data = db('tourist')->paginate(8);
        $this->view->assign('data', $tour_data);
        return $this->view->fetch('tourist-view');
    }

    public function touristDelete($id)
    {
        $res = db('tourist')->delete($id);
        $res ? $this->redirect('admin/member/touristlist') : $this->error('Delete False,Dear');
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
