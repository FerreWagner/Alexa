<?php
namespace app\index\common;

use app\admin\model\System;
use think\Controller;
use think\Request;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        $request = Request::instance();
        //get website switch
        $config  = $this->getSystem();
        $this->getStatus($request, $config);
    }




    //get config info
    public function getSystem()
    {
        return System::get(1);
    }

    /**
     * @param $request
     * @param $config
     */
    public function getStatus($request, $config)
    {
        //close index module
        if ($request->module() == 'index'){
            //0 open;1 close
            if ($config->is_close == 1) die('<h1 style="font-family: Arial, Helvetica, sans-serif;margin-top: 100px;text-align:center;">Alexa Maintenance,Dear</h1>');
        }
    }
}
