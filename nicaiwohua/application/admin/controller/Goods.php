<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Goods extends Lock
{
	//商品管理页面
    public function index()
    {
    	$search=input("get.search","");
    	//var_dump($search);
    	
    	
    	$where=[
    		"goods_name"=>["like","%$search%"]
    	];
    	
    	$type=input("get.type");

    	switch ($type) {
    		case '1':
    			$order="price desc";
    			break;
    		case '2':
    			$order="stock desc";
    			break;
    		case '3':
    			$order="pageView desc";
    			break;
    		case '4':
    			$order="saleView desc";
    			break;
    		default:
    			$order="id desc";
    			break;
    	}
    	
    	$data=Db::table("goods")
    		->where($where)
    		->order($order)
    		->paginate(5,false,['query'=>request()->param()]);
        //把数据分配给页面
        $this->assign("data",$data);
        $this->assign("search",$search);
        $this->assign("type",$type);
       	//var_dump($data);
        return view();
    }

    //进入商品添加页面
    public function add()
    {
    	return view();
    }

    //添加商品
    public function insert()
    {
    	$data = input("post.");
    	$data['create_time']=time();

    	//封面图片上传
    	$file=request()->file("img");
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	if($file)
    	{
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'upload/goods');
        	if($info)
        	{
            	// 成功上传后 获取上传信息
            	// 输出 jpg
            	
            	$fmImgUrl= $info->getSaveName();
            	$data['img']=str_replace("\\", "/", $fmImgUrl);
            	
        	}
        	else
        	{
            	// 上传失败获取错误信息
            	echo $file->getError();
        	}
        
    	
    	}

    	//多文件上传
    	$files = request()->file("imgs");
    	$imgArr=[];
    	foreach($files as $key => $value ){
        // 移动到框架应用根目录/public/uploads/ 目录下
        	$info = $value->move(ROOT_PATH . 'public' . DS . 'upload/goods/');
       		if($info){
            	$tmpUrl= $info->getSaveName();
            	$imgArr[]=str_replace("\\", "/", $tmpUrl);
        	}else{
            	// 上传失败获取错误信息
            	echo $file->getError();
        	}
        	 
    	}
    	$data["imgs"]=join(',',$imgArr);   
    	if(Db::table("goods")->insert($data))
    	{
    		$this->success("添加成功",url("goods/index"));
    	}else{
    		$this->error("添加商品失败！");
    	}
   
    }
    //删除操作
    public function del()
    {
    	$id=input("id");
    	$data=Db::table("goods")->find($id);
    	if(Db::table("goods")->delete($id))
    	{
    		try{
	    		unlink('upload/goods/'.$data['img']);
	    		$imgArr=explode(',', $data['imgs']);
	    		foreach ($imgArr as $key => $value) {
	    			unlink('upload/goods/'.$value);
	    		}
    		}catch(\Exception $e){
    			$this->success('删除成功',url("goods/index"));
			}

    		$this->success("删除成功",url("goods/index"));

    	}
    	else
    	{
    		$this->error("删除失败");
    	}
    }

    public function edit()
    {
    	$id=input('id');
    	
    	$data=Db::table("goods")->find($id);

    	$data['imgArr']=explode(',', $data['imgs']);
    	//var_dump($data['imgArr']);
    	$this->assign("data",$data);
    	return view();
    }

    public function save()
    {
    	//获取提交过来所有数据
    	$data=input("post.");
    	
    	//得到老的封面图
    	$oldImg=$data['img'];
    	//得到要保留的多图
    	$oldDuo=$data['oldDuo'];
    	//得到要删除的多图
    	$delDuo=$data['delDuo'];

    	//$data是要插入数据库的，这两个字段数据库里没有，硬插是插不进去的。
    	//所以要先剪掉
    	unset($data['oldDuo']);
    	unset($data['delDuo']);



    	$file = request()->file('img');
    	//判断是否新上传了img
    	if($file)
    	{
    		$info = $file->move(ROOT_PATH . 'public' . DS . 'upload/goods');
        	if($info)
        	{
            	// 成功上传后 获取上传信息
            	// 输出 jpg
            	$fmImgUrl= $info->getSaveName();
            	$data['img']=str_replace("\\", "/", $fmImgUrl);
            	
        	}
        	else
        	{
            	// 上传失败获取错误信息
            	echo $file->getError();
        	}
        
    	}


    	//上传多图
    	//多文件上传
    	$files = request()->file("imgs");
    	
    	if($oldDuo!="")
    	{
    		$imgArr= explode(",", $oldDuo);
    	}
    	else
    	{
    		$imgArr=[];
    	}

    	foreach($files as $key => $value ){
        // 移动到框架应用根目录/public/uploads/ 目录下
        	$info = $value->move(ROOT_PATH . 'public' . DS . 'upload/goods/');
       		if($info){
            	$tmpUrl= $info->getSaveName();
            	$imgArr[]=str_replace("\\", "/", $tmpUrl);
        	}else{
            	// 上传失败获取错误信息
            	echo $file->getError();
        	}
        	 
    	}
    	//新的多图列表更新到数据库
    	$data['imgs']=join(",",$imgArr);


    	if(Db::table("goods")->update($data))
    	{
    		//删除原来的封面图
    		try{
	    		if($data['img']!=$oldImg && $oldImg!="")
	    		{
	    			unlink("./upload/goods/".$oldImg);
	    		}
	    		//删除多图
	    		if($delDuo)
	    		{
	    			//把需要删除的图片，从字符串变成数组
	    			$delArr=explode(",", $delDuo);
	    			//然后一个个删掉
	    			foreach ($delArr as $key => $value) {
	    				unlink("./upload/goods/".$value);
	    			}
	    		}
    		}catch(\Exception $e){
    			$this->success('修改成功',url("goods/index"));
			}

    		$this->success("修改成功",url("goods/index"));
    	}
    	else
    	{
    		$this->error("没有改变，失败");
    	}
    }
}
