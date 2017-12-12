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
        return $this->view->fetch('feedback-list');
    }
}
