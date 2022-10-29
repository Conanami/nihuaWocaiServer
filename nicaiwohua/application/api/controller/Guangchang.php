<?php
namespace app\api\controller;
use think\Db;
class Guangchang
{
    public function index()
    {
    	$type = input("type");
    	$page = input("page",1);
    	//var_dump($type);
    	$order="";
    	$where="";
    	switch ($type) {
    		//推荐的
    		case '0':
    			$where="tuijian=1";
    			break;
    		case '1':
    			//最热作品
    			$order="pageView desc";
    			break;
    		case '2':
    			//最新作品
    			$order="create_time desc";
    			break;
    		default:
    			# code...
    			break;
    	}
        $data = Db::table("works")
    				->field("works.*,user.nickName,user.headImg")
    				->join("user","works.user_id=user.id")
    				->where($where)
    				->order($order)
    				->page("{$page},6")
    				->select();

        return json_encode($data);
    }

    //取得单个作品的数据
    public function works()
    {
    	$id=input("id");
    	//分别获得数据的方法，用于不太会写JOIN的


    	$workData=Db::table("works")->find($id);
    	//每次浏览增加一次浏览量
    	$arr=[
    		"id"=>$id,
    		"pageView"=>$workData["pageView"]+1
    	];
    	Db::table("works")->update($arr);

    	$projectData=Db::table("project")->find($workData['project_id']);
    	$userData=Db::table("user")->find($workData['user_id']);
    	

    	$data=[
    		"workData"=>$workData,
    		"projectData"=>$projectData,
    		"userData"=>$userData,

    	];

    	return json_encode($data);
    }

    //这种逻辑的东西都用接口实现，不要写在小程序里
    //检测用户是否可以查看答案
    public function checklook()
    {
    	$user_id=input("uid");
    	$work_id=input("workid");

    	$workData=Db::table("works")->where("user_id=$user_id and id=$work_id")
    		->find();
    	if($workData)
    	{
    		//是作者就可以查看
    		return 1;
    	}else
    	{	
    		//回答过这个问题也可以查看
    		$answerData=Db::table("answers")
    			->where("user_id=$user_id and work_id=$work_id")
    			->find();
    		if($answerData)
    		{
    			//回答过了就可以查看
    			return 1;
    		}
    		else
    		{
    			//否则不能查看
    			return 0;
    		}
    	}

    }

    //回答问题
    public function answer()
    {
    	$data=input("post.");
    	//var_dump($data);
    	//先根据workid拿一个答案
    	$work_id=$data['work_id'];
    	$right=Db::table("project")
    		->field("project.*")
    		->join("works","works.project_id=project.id")
    		->where("works.id=$work_id")
    		->find();

    	//然后判断答案对不对
    	$data['isOk'] = $data['text']==$right['name']?1:0;
    	
  	
    	//然后插入数据
    	$data['time']=time();
    	//返回结果数据
    	if ($id=Db::table("answers")->insertGetId($data))
    	{
    		$message=[
    			"code"=>200,
    			"info"=>"提交成功"
    		];
    	}
    	else
    	{
    		$message=[
    			"code"=>400,
    			"info"=>"提交失败"
    		];
    	}

    	return json_encode($message);
    }

    public function answerlist()
    {
    	$workid=input("workid");
    	$data=Db::table("answers")
    			->field("answers.*,user.nickName,user.headImg")
    			->join("user","answers.user_id=user.id")
    			->where("work_id=$workid")
    			->order("time desc")
    			->select();

    	//改写时间的标准套路，我还不是很明白
    	foreach ($data as $key => &$value) {
    		$value['time']=date("Y-m-d H:i:s",$value['time']);
    	}
    	
    	return json_encode($data);
    }

}