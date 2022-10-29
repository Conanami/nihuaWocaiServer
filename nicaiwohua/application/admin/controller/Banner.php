<?php
namespace app\admin\controller;

//导入系统类
use think\Controller;
use think\Db;
//声明控制器
class Banner extends Lock
{
	//轮播图管理BANNER
    public function index()
    {
    	$search=input("search",0);

    	$data=Db::table("banner")->
    			where(" type = $search ")->
    			order("sort desc")->
    			paginate(2,false,['query'=>request()->param()]);
    	$this->assign("data",$data);
    	$this->assign("search",$search);
    	//var_dump($data);
        return view();
    }

    //轮播添加页面
    public function add()
    {
    	return view();
    }

    //轮播图添加记录
    public function insert()
    {
    	$data=input("post.");

    	//封面图片上传
    	$file=request()->file("img");
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	if($file)
    	{
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'upload/banner');
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


    	if(Db::table("banner")->insert($data)){
    		$this->success("添加成功",url("banner/index"));
    	}else
    	{	$this->error("添加失败"); }


    }

    //banner图删除方法
    public function del()
    {
    	//获得ID
    	$id=input("id");
    	//获取整条数据
    	$data=Db::table("banner")->find($id);
    	//删除数据
    	if(Db::table("banner")->delete($id))
    	{
    		//同时删除图片
    		try{
    			unlink("./upload/banner/{$data['img']}");
    		}
    		catch(\Exception $e){
    			$this->success('删除成功',url("banner/index"));
			}
    		$this->success("删除成功",url("banner/index"));
    	}else
    	{
    		$this->error("删除失败");
    	}
    }

    //进入轮播图修改页面
    public function edit()
    {
    	$id=input("id");
    	$data=Db::table("banner")->find($id);
    	$this->assign("data",$data);
    	return view();
    }

    //轮播图修改方法,记得最重要是修改表名
    //这里是banner，表名不改都是报错
    //有上传的话，路径名也要随着改
    public function save()
    {
        //获取提交过来所有数据
        $data=input("post.");

        //得到老的封面图，页面上要用一个input type="hidden"保存起来
        $oldImg=$data['img'];
        
        $file = request()->file('img');
        //判断是否新上传了img
        if($file)
        {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/banner');
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

        if(Db::table("banner")->update($data))
        {
            //删除原来的封面图
            try{
                if($data['img']!=$oldImg && $oldImg!="")
                {
                    unlink("./upload/banner/".$oldImg);
                }
                
            }catch(\Exception $e){
                $this->success('修改成功',url("banner/index"));
            }

            $this->success("修改成功",url("banner/index"));
        }
        else
        {
            $this->error("没有改变，失败");
        }
    }
}
