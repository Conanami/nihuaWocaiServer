<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
//声明控制器
class Lock extends Controller
{
	//登录锁的初始化方法
    public function _initialize()
    {
        // //echo '111111111111<br/>';
        // if(session('nicaiwohua_message_id') && session('nicaiwohua_message_name'))
        // {

        // }
        // else
        // {
        // 	$this->error("请登录",url("login/index"));
        // 	exit;
        // }
    }
     
}
