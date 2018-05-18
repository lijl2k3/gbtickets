<?php
namespace app\index\controller;

use app\common\controller\Base;
use think\Validate;
use think\facade\Request;
use app\common\model\Dinnerdance;

class Index extends Base
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function create(){
        if(!Request::isAjax()){
            $this->error('illegal visit');
        }
        if(!Request::post('fapiao_need')){
            Request::except(['address_fapiao','title_fapiao','taxnumber']);
        }
       $data=Request::post();
        if(!Request::post('fapiao_need')){
            $data['fapiao_type']=null;
        }
        $validate=new \app\common\validate\Info;
        if(!$validate->check($data)){
            return json(['status'=>0, 'message'=>$validate->getError()]);
        }
        $user=new Dinnerdance();
        if($user->create($data)){
            return json(['status'=>1, 'message'=>'Registration succeed!']);
        }else{
            return json(['status'=>-1, 'message'=>'Fail to register']);
        }


    }
}
