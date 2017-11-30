<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    //
    public function catetree(){      //model层的数据处理
        $_cateres = $this->order('sort desc')->select();    //按照sort值降序排列
        return $this->sort($_cateres);
    }
    
    public function sort($_data,$_pid = 0,$_level = 0){ //数据的排序;pid即上级栏目的id;level即栏目级别，一级栏目级别为0，二级栏目级别为1...为了输出而设置的level
        static $_arr = array();
        foreach ($_data as $_key => $_value){
            //数据的重新排序
            if($_value['pid']    == $_pid){        //为了找出数据表中第一个顶级栏目,按照顺序排列出来
                $_value['level'] = $_level;        //给value数组添加一个临时数据level为了显示,第一次分给$_value['level']的肯定为默认值0,以此类推...
                $_arr[]          = $_value;
                $this->sort($_data,$_value['id'],$_level + 1);  //即谁的$_pid=我的id，那么就是我的分类，且level要+1;我的分类继续执行这个方法,直到执行到没有该子分类，那么继续执行
            }
        }
        return $_arr;
    }
    
    public function getchildrenid($_cateid){       //为了得到删除栏目的子id的方法
        $_cateres = $this->select();
        return $this->_getchildrenid($_cateres,$_cateid);
    }
    public function _getchildrenid($_cateres,$_cateid){ //为了得到删除栏目的子id的方法
        static $_arr = array();
        foreach ($_cateres as $_key => $_value){
            if($_value['pid']       == $_cateid){       //有存在pid等于我的id,即是我的子栏目
                $_arr[]             = $_value['id'];    //找到子栏目的id
                $this->_getchildrenid($_cateres, $_value['id']);
            }
        }
        return $_arr;   //返回所有找到的子栏目及孙子栏目...的id
    }
}
