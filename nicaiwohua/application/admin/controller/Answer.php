<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Answer extends Lock
{
	//答题管理首页方法
    public function index()
    {
    	$search=input("get.search","");
    	//var_dump($search);
    	
    	
    	$where=[
    		"text"=>["like","%$search%"]
    	];

    	$data=Db::table("answers")
    		->where($where)
    		->field("answers.*,user.nickName,works.img,project.name")
        	->join("user","user.id=answers.user_id","left")
        	->join("works","works.id=answers.work_id","left")
        	->join("project","works.project_id=project.id","left")
        	->order("answers.id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        //$this->assign("status",$status);
        //$this->assign("uid",$uid);
        $this->assign("search",$search);
    	//var_dump($data);
        return view();
    }

 
}
