<?php
namespace app\admin\model;
use think\Model;

class Article extends Model
{
    protected static function init(){
        Article::event('before_insert', function($_data){
            if(@$_FILES['pic']['tmp_name']){
                $_file = request()->file('pic');
                $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($_info){    //如果上传成功
                    //原图
//                    $real_pic   = $_SERVER['SERVER_NAME'] . DS .'uploads'.'/'.$_info->getSaveName();
                    $real_pic   = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $_info->getSaveName();

                    $detail_pic = 'uploads'.'/'.$_info->getSaveName();
                    //图片压缩
                    $ferreImg   = new \ferreImgDetail();
                    $ferrePic   = $ferreImg->cutImg($detail_pic, 390, 490, 'alexa', 20, 'uploads/thumb');
//                    $_data['pic']   = $real_pic;

                    $_data['thumb'] = $_SERVER['SERVER_NAME'] . DS .'uploads/thumb/'.$ferrePic;
                    @unlink($real_pic);
                }
            }
        });
        
        Article::event('before_update', function($_data){
        if($_FILES['thumb']['tmp_name']){
                $_arts = Article::find($_data->id); //按照id找到待修改图片的id值，为了进一步的修改图片位置
                $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                if(file_exists($_thumbpath)){
                    @unlink($_thumbpath);
                }
                
                $_file = request()->file('thumb');
                $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($_info){    //如果上传成功
                    $_thumb = '/ZEND/Company/public/uploads'.'/'.$_info->getSaveName();
                    $_data['thumb'] = $_thumb;
                }
            }
        });
        
        Article::event('before_delete', function($_data){
                
                $_arts = Article::find($_data->id); //按照id找到待修改图片的id值，为了进一步的修改图片位置
                $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                if(file_exists($_thumbpath)){
                    @unlink($_thumbpath);
                }
                
        });
        
    }
}
