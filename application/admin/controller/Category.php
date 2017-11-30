<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Category as CateGoryModel;
use think\Loader;

class Category extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //cate data
        $catemodel = new CateGoryModel();
        $cate      = $catemodel->catetree();
        //count cate data
        $cate_count = CateGoryModel::count();
        
        //cate add
        if($request->isPost()){
            $_data = input('post.');
            $validate = Loader::validate('Category');
            if(!$validate->scene('add')->check($_data)){
                $this->error($validate->getError());
            }
            
//             $catemodel->data($_data);
//             $_add = $catemodel->save();
            $_add = $catemodel->create($_data);
            if($_add){
                $this->redirect('admin/category/index');
            }else{
                $this->error('Add Cate Error.Dear');
            }
        }
        
        $this->view->assign(['cate' => $cate, 'cate_count' => $cate_count]);
        return $this->view->fetch('category_list');
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
        $_cate = new CateGoryModel();

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
