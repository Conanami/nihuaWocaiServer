<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;

//声明控制器
class Admin extends Lock
{
	//管理员首页方法
    public function index()
    {
        //form 提交也调用这个方法
        //搜索数据
        $search=input("get.search","");

        //var_dump($search);
        //查询数据,最后一句是保证分页时候查询条件继续有效。
        $data=Db::table("admin")->where("username like '%$search%'")
            ->order("id desc")->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);

        return view();
    }

    //管理员添加方法
    public function add()
    {
    	return view();
    }
    
    //管理员修改方法
    public function edit()
    {
        $id=input("id");
        $data=Db::table("admin")->find($id);
        $this->assign("data",$data);
    	return view();
    }

    //管理员添加的处理页面操作
    public function insert()
    {
        $data=input("post.");
        //var_dump($data);
        $username=$data['mname'];
        $password=$data['newpass'];
        $repassword=$data['renewpass'];
        //检测用户名是否存在
        if($username)
        {
            //检测密码是否存在
            if($password)
            {
                //检测用户名长度
                if(strlen($username)>=6 && strlen($username)<=12)
                {
                    //检测密码是否一致
                    if($password==$repassword)
                    {
                        //检测用户名是否重复
                        $user = Db::table("admin")
                            ->where("username='$username'")
                            ->find();
                        if(!$user)
                        {
                            //格式化数据
                            $userData=[
                                "username"=>$username,
                                "password"=>md5($password),
                                "time"=>time(),
                                "status"=>0
                            ];
                            //插入数据
                            if(Db::table("admin")->insert($userData))
                            {
                                $this->success("管理员'$username'创建成功",url("Admin/index"));
                            }
                            else
                            {
                                $this->error("数据库插入失败");
                            }
                        }
                        else
                        {
                            $this->error("该用户名已经存在");
                        }
                    }
                    else
                    {
                        $this->error("密码前后不一致");
                    }
                }
                else
                {
                    $this->error("用户名长度6-12位之间");
                }
            }
            else
            {
                $this->error("请输入密码");
            }
        }
        else
        {
            $this->error('请输入账户名');
        }
    }

    //管理员修改的处理页面操作
    public function save()
    {
        $data=input("post.");
        
        $id=$data["id"];
        $password=$data["newpass"];
        $repassword=$data["renewpass"];

        if(strlen($password)>=5)
        {
            if($password==$repassword)
            {
                $userData=[ "id"=>$id,
                            "password"=>md5($password)  ];
                if(Db::table("admin")->update($userData))
                {
                    $this->success("修改密码成功！",url("Admin/index"));
                }
                else
                {
                    $this->error("修改失败...");
                }
            }
            else
            {
                $this->error("密码前后不一致");
            }
        }
        else
        {
            $this->error("密码太短");
        }
    }

    //管理员删除方法
    public function del()
    {
        $id=input("get.id");
        if(Db::table("admin")->delete($id))
        {
            $this->success("删除成功");
        }
        else
        {
            $this->error("删除失败");
        }
    }

    //修改用户状态的方法
    public function save_status()
    {
        $data=input("");
        $preurl=$_SERVER['HTTP_REFERER'];
        //var_dump($data);
        Db::table("admin")->update($data);
        $this->redirect($preurl);
        
    }
 
}
