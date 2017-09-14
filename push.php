<?php /** { "aps":{ "alert":"此处有两个服务器需要选择，如果是开发测试用，选择第二名sandbox的服务器并使用Dev的pem证书，如果是正是发布，使用Product的pem并选用正式的服务器", //消息首页展示内容 "badge":10, //icon上未读消息标示个数 "sound":"default", //推送听到的铃声 "data":{ //推送消息主体，供程序启动时做相应处理 "tid":1000001, //通知Id 做设备打开通知上报数据使用 "id":101, //跳转id [可为课程id/计划id/文章id/ 是web页面默认为0] "type":0, // 0 系统通知[默认] 1 好友新消息 2 新用户注册 3好友请求 4课程更新 "systype":1, //1 课程 2计划 3文章 4活动 5web页面跳转 "url":"http://www.imooc.com/abc.html" //为4web页面跳转使用 |非4web页面清除url字段 }, "category"=>"CATEGORY_ID" //用来快捷处理消息唯一标示 } } */
 	$deviceToken= '944a39dada1f6daf10b62fe7d135063a959ad568d1c5879656e043943.....'; //没有空格 
	$body = []; 
	$type = 5; //1 课程 2计划 3文章 4活动 5web页面跳转 控制推送内容 
///拼接推送字符串 
switch ($type) { 
	case 1: 
		$content = '从搭建Golang开发环境开始， 一步步介绍Golang系统库之输入输出的功能及特性。结合行数统计及图片读取，在实战中扎扎实实的学习Golang'; 
		$body = array("aps" => array("alert" => $content,"badge" => 10,"sound"=>'default','data'=>array('tid'=>10000,'id'=>492,'type'=>0,'systype'=>$type))); 
		break; 
	case 2: 
		$content = '随着互联网的发展速度迅猛，前端工程师职业越来越火热，想学习Web前端技能吗 ? 该路径从基础知识到实战案例演练，一步步带您快速掌握如何搭建网站静态页面、开发网站交互特效，为您打开WEB前端工程师大门。还在等什么？快来学习吧!'; 
		$body = array("aps" => array("alert" => $content,"badge" => 11,"sound"=>'default','data'=>array('tid'=>10001,'id'=>32,'type'=>0,'systype'=>$type))); 
		break;
	case 3: 
		$content = 'CodeStriker CodeStriker是一个免费&开源的Web应用程序，可以帮助开发人员基于Web的代码审查。它不但允许开发人员将问题、意见和决定记录在数据库中，还为实际执行代码审查提供了一个舒适的工作区域。 官方网站：http://codestriker.sourceforge.net/index.html 2）RhodeCode Rhode'; 
		$body = array("aps" => array("alert" => $content,"badge" => 12,"sound"=>'default','data'=>array('tid'=>10002,'id'=>2493,'type'=>0,'systype'=>$type))); break;
	case 4: 
		$content = '高薪捉拿程序大拿'; 
		$body = array("aps" => array("alert" => $content,"badge" => 12,"sound"=>'default','data'=>array('tid'=>27820,'id'=>2493,'type'=>0,'systype'=>$type,'url'=>'http://t.imooc.com')));
		break;
	case 5: 
		$content = '如何从零开始开发一款AppleWatch App?'; 
		$body = array("aps" => array("alert" => $content,"badge" => 13,"sound"=>'default','data'=>array('tid'=>10003,'id'=>0,'type'=>0,'systype'=>$type,'url'=>'http://t.imooc.com'),"category"=>"CATEGORY_ID")); 
		break;
	default:
		break;
							 
	}
	 $ctx = stream_context_create(); 
	//如果在Windows的服务器上，寻找pem路径会有问题，路径修改成这样的方法：
	//$pem = dirname(__FILE__) . '/' . 'apns-dev.pem'; 
	//linux 的服务器直接写pem的路径即可 
	stream_context_set_option($ctx,"ssl","local_cert","ck.pem"); 
	$pass = "1234"; 
	stream_context_set_option($ctx, 'ssl', 'passphrase', $pass); 
	//此处有两个服务器需要选择，如果是开发测试用，选择第二名sandbox的服务器并使用Dev的pem证书，如果是正是发布，使用Product的pem并选用正式的服务器 
	// $fp = stream_socket_client("ssl://gateway.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx); 
	$fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
	if (!$fp) { 
		echo "Failed to connect $err $errstrn"; 
		return; 
	} 
	print "Connection OK\\n"; 
	$payload = json_encode($body); 
	$msg = chr(0) . pack("n",32) . pack("H*", str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload; 
	echo "sending message :" . $payload ."\\n"; 
	fwrite($fp, $msg); 
	fclose($fp);
 ?>

