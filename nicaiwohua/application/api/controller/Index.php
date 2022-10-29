<?php
namespace app\api\controller;
use think\Db;
class Index
{
    public function index()
    {
        $data = Db::table("banner")
        		->where(["type"=>"0","status"=>"1"])
        		->order("sort desc")
        		->select();
        //var_dump($data);
        return json_encode($data);
    }

    public function getproject()
    {
    	$count=Db::table("project")->count();

    	$data=Db::table("project")->limit(rand(0,$count-1),1)->select();

    	return json_encode($data[0]);
    }

    //从临时凭证得到openId
    public function getopenid()
    {
    	//得到临时凭证
    	$code=input("code");
    	//小程序的APPID和密钥
    	$appid="wx1aa352dc9257cb4e";
    	$appsecret="43ba656132a839e3b5c5eebec60cccfa";
    	//拼接URL地址
    	$url="https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$appsecret}&js_code={$code}&grant_type=authorization_code";
    	//发送请求
    	$arr = file_get_contents($url);
    	//var_dump($arr);
    
    	return $arr;
    }

    //通过openid，读取user表，得到用户ID
    public function getuserinfo()
    {
    	$openid=input("openid");
    	//在数据库里找到这个openid的记录
    	$data=Db::table("user")->where("openid='{$openid}'")->find();

    	if(!$data)
    	{
    		//如果没有找到
    		$userData=[
    			"openid"=>$openid,
    			"time"=>time(),
    			"status"=>0,
    			"credit"=>18
    		];

    		$id=Db::table("user")->insertGetId($userData);
    		$data=Db::table("user")->find($id);
    		return json_encode($data);
    	}else
    	{
    		//如果已经找到了
    		return json_encode($data);
    	}
    }

    //添加题目
    public function addproject()
    {
    	$data = input("post.");
    	$data['add_time']=time();
    	$data['status']=0;
    	if($id=Db::table("project")->insertGetId($data))
    	{
    		$data['id']=$id;
    		$message=[
    			"code"=>200,
    			"data"=>$data,
    			"info"=>"发表成功"
    		];
    	}
    	else
    	{
    		$message=[
    			"code"=>400,
    			"info"=>"发表失败"
    		];
    	}

    	return json_encode($message);

    }

    //更新用户数据
    public function saveuserinfo()
    {
    	$data=input("post.");
    	if(Db::table("user")->update($data))
    	{
    		return 1;
    	}
    	else
    		return 0;
    }

    //上传图片的接口
    public function uploadfile()
    {
    	$data=input("post.");

    	//封面图片上传
    	$file=request()->file("workimg");
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	if($file)
    	{
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'upload/works');
        	if($info)
        	{
            	// 成功上传后 获取上传信息
            	// 输出 jpg
            	$fmImgUrl= $info->getSaveName();
            	$img=str_replace("\\", "/", $fmImgUrl);
            	return $img;
            }
        	else
        	{
            	// 上传失败获取错误信息
            	echo $file->getError();
        	}
        
    	
    	}
    }

    //发布作品入库
    public function fabuworks()
    {
    	$data=input("post.");
    	$data['create_time']=time();
    	$data['pageView']=0;
    	$data['praiseNum']=0;
    	$data['tuijian']=0;
    	if ($id = Db::table("works")->insertGetId($data))
    	{
    		$data['id']=$id;
    		$message=[
    			"code"=>200,
    			"data"=>$data,
    			"info"=>"发布作品成功"
    		];
    	}
    	else
    	{
    		$message=[
    			"code"=>400,
    			"info"=>"发布作品失败"
    		];
    	}
    	return json_encode($message);
    }

    //从作品ID获取作品
    public function getworks()
    {
    	//得到ID
    	$id=input("id");
    	//查到作品
    	$work=Db::table("works")
    		->field("works.*,user.nickName,project.name")
    		->join("user","user.id=works.user_id","left")
        	->join("project","works.project_id=project.id","left")
        	->where("works.id={$id}")->find();
        //返回JSON格式
    	return json_encode($work);
    }

    //获取作品画册
   	public function getshareimg()
   	{
   		$workid=input("id");
   		//得到作品
   		$works=Db::table("works")->find($workid);
   		//得到底图
   		$image=imagecreatefrompng("./nazha1.png");
   		//随机得到两种颜色
   		$color1=imagecolorallocate($image, rand(120,255), rand(120,200), rand(0,200));
   		$color2=imagecolorallocate($image, rand(0,200), rand(0,200), rand(0,200));
   		//添加文字
   		imagettftext($image, 50, 0, 50, 100, $color1, "./stkaiti.ttf", "猜猜我画的是啥？");
   		imagettftext($image, 50, 0, 450, 1100, $color2, "./stkaiti.ttf", "涂鸦大王");
   		
   		//添加我们的作品
   		$workImage=imagecreatefrompng("./upload/works/{$works['img']}");
   		//imagecopy($image, $workImage, 30, 400, 0, 0, 400, 330);
   		//目标图片，被COPY的图片
   		//目标图片起始位置
   		//被COPY图片起始位置
   		//目标图片的结束位置
   		//被COPY图片结束位置
   		imagecopyresized($image, $workImage, 30, 200,0, 0,680,700, 400, 330);
   		//添加小程序二维码
   		//1，获取 access_token
   		$appid="wx1aa352dc9257cb4e";
    	$appsecret="43ba656132a839e3b5c5eebec60cccfa";
   		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
   		$access_token=$this->https_request($url,"get","json","");
   		

   		$token=$access_token['access_token'];
   		

   		
   		
   		
   		//2, 获取小程序码
   		$codeUrl= "https://api.weixin.qq.com/wxa/getwxacode?access_token={$token}";
   		
   		$arr=[
   			"path"=>"pages/index/index",
   			"width"=>300,
   			"is_hyaline"=>true	
 		];
 		
   		$acode = $this->https_request($codeUrl,"post","",json_encode($arr));
   		//3，处理
   		file_put_contents("./code.png", $acode);
   		$codeImage=imagecreatefrompng("./code.png");
   		imagecopy($image, $codeImage, 30, 860,0, 0,300, 300);
   		//显示图片，一定要加exit，否则显示不对
   		header("content-type:image/png");
   		imagepng($image);
   		exit;
   		//var_dump($image);
   	}

   	//模拟发GET,POST请求
   	public function https_request($url,$type,$res,$arr){
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    if($type == 'post'){    //type可以为“get”或“post”
	        curl_setopt($ch, CURLOPT_POST,1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
	    }
	    
	    $output = curl_exec($ch);
	    curl_close($ch);

	    if($res == 'json'){    //res可以是“json”或"xml"
	        return json_decode($output,true);
	    }
	    return $output;
	}
}

