<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;

//声明控制器
class Login extends Controller
{
	//登录页面方法
    public function index()
    {
        return view();
    }

    //检查登录是否正确
    public function check()
    {
    	$data=input("post.");
    	if($data['username'])
    	{
    		if($data['password'])
    		{
    			if(captcha_check($data['code'])){
 					//验证成功
 					//包装数据
 					$user=[
 						'username'=>$data['username'],
 						'password'=>md5($data['password']),
 						'status'=>0
 					];
 					//var_dump($user);
 					//exit;
 					if($userData=Db::table("admin")->where($user)->find())
 					{
 						session("nicaiwohua_message_id",$userData['id']);
 						session("nicaiwohua_message_name",$userData['username']);

 						$userData['logintime']=time();
 						Db::table("admin")->update($userData);
 						$this->redirect(url("Index/index"));
 					}
 					else
 					{
 						$this->error("登录失败");
 					}
				}else
				{
					$this->error("验证码错误");
				}

    		}
    		else{ $this->error("请输入密码");}
    	}
    	else
    	{
    		$this->error("请输入用户名");
    	}

    }

    //退出登录
    public function logout()
    {
    	session(null);
    	$this->redirect("login/index");
    }


}
