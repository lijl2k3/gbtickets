<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Validate;
use think\facade\Request;
use app\common\model\Dinnerdance;

class Index extends Base
{
    public function index()
    {
        $post=Request::except('page');
        foreach ($post as $k=>$v) {
           if(isset($v)&&(!empty($v))){
               $search[$k]=$v;
               $param[]=[$k,'like','%'.$v.'%'];
           }

        }
        if(isset($param)&&count($param)>0){
            $list=Dinnerdance::where($param)->paginate(3, false, ['query'=>request()->param()]);
            $this->assign('search',$search);
        }
        else {
            $list = Dinnerdance::paginate(3);
        }
            $page=$list->render();
            $this->assign('list',$list);
            $this->assign('page',$page);
            return $this->fetch('index');

    }

    public function view($id)
    {
        $user=Dinnerdance::get($id);
        if(!$user){
            $this->error('No user found.');
        }
        return $this->fetch('view', ['user'=>$user]);
    }

    public function edit($id)
    {
        $user=Dinnerdance::get($id);
        if(!$user){
            $this->error('No user found.');
        }
        return $this->fetch('edit', ['user'=>$user]);
    }

    public function update($id){
        $user=Dinnerdance::get($id);
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
        if($data['email']==$user->email){
            $result=$validate->scene('edit')->check($data);
        }
        else{
            $result=$validate->check($data);
        }

        if(!$result){
            return json(['status'=>0, 'message'=>$validate->getError()]);
        }
        if($user->save($data)){
            return json(['status'=>1, 'message'=>'Update succeed!']);
        }else{
            return json(['status'=>-1, 'message'=>'Fail to update']);
        }


    }

    public function brief($id)
    {
        if(!Request::isAjax()){
            $this->error('illegal visit');
        }
        $user=Dinnerdance::get($id);
        if(!$user){
            $this->error('No user found.');
        }
        return $this->fetch('brief', ['user'=>$user]);
    }

    public function remove(){
        if(!Request::isAjax()){
            $this->error('illegal visit');
        }
        $id=Request::post('id');
        $user=Dinnerdance::get($id);
        if($user->delete()){
            return json(['status'=>1, 'message'=>'Data removed!']);
        }
        else{
            return json(['status'=>0, 'message'=>'Failed to remove this data!']);
        }

    }


    public function test($id)
    {
        $user=Dinnerdance::get($id);
        dump($user);
    }

    public function login()
    {
        return $this->fetch();
    }

//    public function index(){
//        $post=Request::post();
//      foreach ($post as $k=>$v) {
//          if (isset($v) && (!empty($v))) {
//              $search[$k] = $v;
//              $param[] = [$k, 'like', '%' . $v . '%'];
//          }
//      }
//        if(isset($param)&&count($param)>0){
//            $list=Dinnerdance::where($param)->paginate(1, false, ['query'=>$param]);
//            echo(Dinnerdance::getLastSql());
//            $this->assign('search',$search);
//        }else
//
//        $list = Dinnerdance::paginate(1);
//        $page=$list->render();
//        $this->assign('list',$list);
//        $this->assign('page',$page);
//        return $this->fetch('index');
//    }


}
