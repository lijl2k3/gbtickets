<?php


namespace app\index\controller;
use app\common\controller\Base;


class Test extends Base
{
    public function testvalidate(){
        $data=[
            'member'=>'xyz665',
            'f_name'=>'aaa',
            'l_name'=>'bbb',
            'company'=>'上海Gic',
            'email'=>'test@test.com',
            'mobile'=>'13917808348',
            'amount'=>2,
            'fapiao_need'=>0,
            'address_tickets'=>'tst'
        ];
        $rule='app\common\validate\Info';
        $res=$this->validate($data,$rule);
        if( $res!=1)
        return $res;
    }
}