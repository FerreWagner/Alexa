<?php

namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Feedback as FeedbackModel;

class Feedback extends Base
{
    public function index()
    {
        $feed_lst = FeedbackModel::paginate(6);
        $this->view->assign('feed_lst', $feed_lst);
        return $this->view->fetch('feedback-list');
    }

    public function edit($id)
    {
        $feed = FeedbackModel::find($id);
        $this->view->assign('feed', $feed);
        return $this->view->fetch('feedback-edit');
    }

    public function delete($id)
    {
        $res = FeedbackModel::destroy($id);
        return $res ? $this->redirect('admin/feedback/index') : $this->error('Delete Feeback Error.');
    }

}
