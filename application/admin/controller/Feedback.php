<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Loader;
use think\Request;
use app\admin\model\Feedback as FeedbackModel;

class Feedback extends Base
{
    public function index(Request $request)
    {
        if ($request->isPost()){
            $data         = input('post.');
            $data['ip']   = $_SERVER['REMOTE_ADDR'];
            $data['time'] = time();
            $validate     = Loader::validate('Feedback');
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }

            $feed_model = new FeedbackModel();
            if ($feed_model->allowField(true)->save($data)){
                return $this->success('Your feedback has been successfully sent');
            }else{
                return $this->error('Insert error.');
            }

        }

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
