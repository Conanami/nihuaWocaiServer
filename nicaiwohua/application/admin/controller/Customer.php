<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Customer extends Lock
{
	//后台首页方法
    public function index()
    {
    	//搜索数据
        $search=input("get.search","");

        //var_dump($search);
        //查询数据,最后一句是保证分页时候查询条件继续有效。
        $data=Db::table("user")
        	->where("nickname like '%$search%'")
        	->whereOr("openid like '%$search%'")
            ->order("id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        return view();
    }

    //查看积分列表
    public function creditlist()
    {
    	$id=input("id");
    	$type=input("type",-1);
    	$where=[
    		"user_id"=>$id
    		];
    	switch ($type) {
    		case '0':
    			$where["type"]=0;
    			break;
    		case '1':
    			$where["type"]=1;
    			break;
    		default:
    			# code...
    			break;
    	}
    	$user=Db::table("user")->find($id);

    	$data=Db::table("credit")
    		->where($where)
    		->order("id desc")
    		->paginate(2,false,['query'=>request()->param()]);
    	$this->assign("data",$data);
    	$this->assign("type",$type);
    	$this->assign("nickname",$user['nickName']);
    	$this->assign("userid",$id);
    	return view();
    }

    
}
