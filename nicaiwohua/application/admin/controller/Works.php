<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Works extends Controller
{
	//后台首页方法
    public function index()
    {
    	$search=input("get.search","");
    	//var_dump($search);
    	
    	
    	$where=[
    		"name"=>["like","%$search%"]
    	];
    	

    	
    	$data=Db::table("works")
    		->where($where)
    		->whereOr('nickName','like','%$search%')
        	->field("works.*,user.nickName,project.name")
        	->join("user","user.id=works.user_id","left")
        	->join("project","works.project_id=project.id","left")
        	->order("works.id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        //$this->assign("status",$status);
        //$this->assign("uid",$uid);
        $this->assign("search",$search);
        
        return view();
    }

    //改变推荐状态的操作
    public function save_status()
    {
    	$data=input("");
    	var_dump($data);
    	Db::table("works")->update($data);
    	$preurl=$_SERVER['HTTP_REFERER'];
    	$this->redirect($preurl);
    }
    
    //展示该题目下所有作品
    public function projectlist()
    {
    	$search=input("get.search","");
    	//var_dump($search);
    	
    	
    	$where=[
    		"nickName"=>["like","%$search%"]
    	];

    	$project_id=input("p_id");
    	
    	
    	if($project_id)
    	{
    		$where['project_id']=$project_id;
    	}
    	

    	$data=Db::table("works")
    		->where($where)
        	->field("works.*,user.nickName,project.name")
        	->join("user","user.id=works.user_id","left")
        	->join("project","works.project_id=project.id","left")
        	->order("works.id desc")->paginate(5,false,['query'=>request()->param()]);
        
        $project=Db::table("project")->find($project_id);


        //把数据分配给页面
        $this->assign("data",$data);
        $this->assign("project",$project);
        $this->assign("search",$search);
        return view();
    }

    //展示该用户的所有作品
    public function userlist()
    {
    	
    	$search=input("get.search","");
    	//var_dump($search);
    	
    	
    	$where=[
    		"name"=>["like","%$search%"]
    	];

    	$user_id=input("u_id");
    	if($user_id)
    	{
    		$where['user_id']=$user_id;
    	}
    	

    	$data=Db::table("works")
    		->where($where)
        	->field("works.*,user.nickName,project.name")
        	->join("user","user.id=works.user_id","left")
        	->join("project","works.project_id=project.id","left")
        	->order("works.id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        $user=Db::table("user")->find($user_id);
        $this->assign("user",$user);
        $this->assign("search",$search);
        
        return view();
    }
}
