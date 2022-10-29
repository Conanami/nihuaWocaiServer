<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Project extends Controller
{
	//题目管理列表页
    public function index()
    {
    	$search=input("get.search","");
    	$uid=input("get.uid",'-1');
    	$status=input("get.status",'-1');
    	
    	$where=[
    		"name"=>["like","%$search%"]
    	];
    	
    	switch ($uid) {
    		case '0':
    			$where['uid']=0;
    			break;
    		case '1':
    			$where['uid']=['neq',0];
    			break;
    		default:
    			break;
    	}

    	switch ($status) {
    		case '0':
    			$where['project.status']=0;
    			break;
    		case '1':
    			$where['project.status']=1;
    			break;
    		default:
    			break;
    	}




        //var_dump($search);
        //查询数据,最后一句是保证分页时候查询条件继续有效。
        $data=Db::table("project")
        	->field("project.*,user.nickName")
        	->join("user","user.id=project.uid","left")
        	->where($where)
        	->order("project.id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        $this->assign("status",$status);
        $this->assign("uid",$uid);
        $this->assign("search",$search);
        return view();
    }
    //显示添加题目页面
    public function add()
    {
    	return view();
    }
    //添加题目的操作
    
    public function insert()
    {
    	$data=input("post.");
    	if($data['name'])
    	{
    		if($data['notice'])
    		{
    			if(Db::table("project")
    				->where("name = '$data[name]' ")
    				->find())
    			{
    				$this->error("该题目已存在");
    			}
    			else
    			{
    				$data['add_time']=time();
    				//表示是后台添加
    				$data['uid']=0;
    				if(Db::table("project")->insert($data))
    				{
    					$this->redirect('project/index');
    				}
    				else
    				{
    					$this->error("添加失败");
    				}
    			}
    		}
    		else
    		{
    			$this->error("提示不能为空");
    		}
    	}
    	else
    	{	$this->error("题目不能为空");
    	}
    }

    //改变审核状态的操作
    public function save_status()
    {
    	$data=input("");
    	//var_dump($data);
    	Db::table("project")->update($data);
    	$preurl=$_SERVER['HTTP_REFERER'];
    	$this->redirect($preurl);
    }

    //显示修改页面
    public function edit()
    {
    	$id=input("id");
        $data=Db::table("project")->find($id);
        $this->assign("data",$data);
       	return view();
    }

    //题目修改的处理页面操作
    public function save()
    {
        $data=input("post.");
        
        Db::table("project")->update($data);

		$this->redirect('project/index');
    }
}
