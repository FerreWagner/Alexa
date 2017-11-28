<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;

class Login extends Base
{
    /**
     * 显示资源列表 && 登录
     *
     * @return \think\Response
     */
    public function index()
    {
        
        return $this->view->fetch('login');
    }


    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function login(Request $request)
    {
        //
        if ($request->isPost()){
            $admin_data = input('post.');
            $res = db('admin')->where('username', $admin_data['username'])->select();
            if (!$res || 'ferre' != $admin_data['username']){
                $this->error('Error,Dear');
            }elseif ($res[0]['password'] == sha1(md5($admin_data['password']).'alexa')){
                echo 'right';
            }else {
                $this->error('Error,Dear');
            }
        }
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
