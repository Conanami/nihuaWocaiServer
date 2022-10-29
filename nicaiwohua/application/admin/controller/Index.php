<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
//声明控制器
class Index extends Lock
{
	//后台首页方法
    public function index()
    {
        return view();
    }

    public function welcome()
    {
    	return view();
    }
}
