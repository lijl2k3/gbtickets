<?php
/**
 * Created by PhpStorm.
 * User: lijl
 * Date: 5/9/2018
 * Time: 5:46 PM
 */

namespace app\index\controller;
use think\Controller;
use think\Facade\Request;
use think\Validate;


class Verify extends Controller
{
    protected $rule=[
        'member'=>['rule'=>'require|alphaDash','alias'=>'Member Id'],
        'f_name'=>['rule'=>'require|max:20|chsAlpha','alias'=>'First Name'],
        'l_name'=>['rule'=>'require|max:20|chsAlpha','alias'=>'Last Name'],
        'company'=>['rule'=>'require|max:120','alias'=>'Company Name'],
        'email'=>['rule'=>'require|email|unique:dinnerdance','alias'=>'Email'],
        'mobile'=>['rule'=>'mobile','alias'=>'Mobile Phone Number'],
        'amount'=>['rule'=>'integer','alias'=>'Amount of Tickets'],
        'address_tickets'=>['rule'=>'require','alias'=>'Ticket Mailing Address'],
        'address_fapiao'=>['rule'=> 'require','alias'=>'Invoice Mailing Address'],
        'title_fapiao'=>['rule'=>'require|chsDash','alias'=>'Invoice Title'],
        'taxnumber'=> ['rule'=>'require|alphaNum','alias'=>'Tax Number']
    ];
    public function checkField(){
        if(!Request::isAjax()){
            $this->error('illegal visit');
        }
        $data=Request::post('data');
        $name=Request::post('name');
        $namestr=$name.'|'.$this->rule[$name]['alias'];
        $validate=Validate::make([$namestr=>$this->rule[$name]['rule']]);
        if(!$validate->check([$name=>$data])){
            return json(['status'=>0,'message'=>$validate->getError()]);
        }else{
            return json(['status'=>1, 'message'=>'succeed']);
        }

    }

    public function checkName(){
        if(!Request::isAjax()){
            $this->error('illegal visit');
        }
        $data1=Request::post('data1');
        $data2=Request::post('data2');
        $rule1=$this->rule['f_name']['rule'];
        $rule2=$this->rule['l_name']['rule'];
        $validate=Validate::make(['f_name|First Name'=>$rule1,'l_name|Last Name'=>$rule2]);
        if(!$validate->check(['f_name'=>$data1,'l_name'=>$data2])) {
            return json(['status' => 0, 'message' => $validate->getError()]);
        }else{
            return json(['status'=>1, 'message'=>'succeed']);
        }

    }

    public function testField(){
        $data='dfe@dd.com';
        $name='email';
        $namestr=$name.'|'.$this->rule[$name]['alias'];
        $validate=Validate::make([$namestr=>$this->rule[$name]['rule']]);
        //$validate=Validate::make(['member|Member Id'=>'require|alphaDash']);
        if(!$validate->check([$name=>$data])){
            echo $validate->getError();
        }
        else echo ('success');


    }

    public function test(){
        return json(['status'=>1]);
    }
}