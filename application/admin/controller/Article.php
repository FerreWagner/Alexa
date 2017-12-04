<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Article as ArticleModel;

class Article extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //list
        $article = ArticleModel::field(['id', 'title', 'cate', 'author', 'time', 'see'])->paginate(6);
        $this->view->assign('article', $article);
        return $this->view->fetch('article-list');
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
    public function add()
    {
        //
        return $this->view->fetch('article-add');
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
