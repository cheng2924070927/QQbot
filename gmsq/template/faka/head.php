<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
	<meta name="keywords" content="<?php echo $conf['keywords']?>">
	<meta name="description" content="<?php echo $conf['description']?>">
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/faka/css/css5.css"/>
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/faka/css/zzss.css" />
	<link rel="stylesheet" href="<?php echo $cdnpublic?>Buttons/2.0.0/css/buttons.min.css" />
<style type="text/css">
.info.denglu {
	line-height: 55px;
}
#head .top .logo_img {
	float: left;
	height: 80px;
	width: 400px;
	margin-top: 10px;
}
td.stitle{overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width:580px;text-align:left;}
</style>
</head>
<body>
    <div id="head">

   	  <div class="top">

       	<!--<div class="logo" onClick="location.href=''"></div>-->
        <div class="logo_img"><a href="./"><img src="<?php echo $logo?>" height="80"></a></div>

        			
              
		  <?php if($islogin2==1){?>
			<div class="info">
				<span class="welcome">亲爱的：<span class="lv"><b><?php echo $userrow['user']?> </b></span>欢迎您！&nbsp;<span></span><br>
            <a href="./user/" class="button button-primary button-rounded button-small">会员中心</a>  
			<a href="./user/login.php?logout" class="button button-giant button-rounded button-small" onclick="return confirm('确定要退出吗？')">安全退出</a>
			</div>
			<?php }else{?>
			<div class="info denglu">
				<a class="button button-3d button-primary button-small" href="./user/login.php">登录</a>    <a class="button button-3d button-caution button-small" href="./user/reg.php"><i class="fa fa-tag"></i>注册</a>&nbsp;&nbsp;
			</div>
			<?php }?>
		</div>
      

      <div class="dh">

        <ul id="nav"> 

            <li><a <?php echo $mod=='index'?'class="a2"':null;?> href="./">商品首页</a></li>
	<li><a <?php echo $mod=='query'?'class="a2"':null;?> href="./?mod=query">订单查询</a></li>
             <li><a <?php echo $mod=='about'?'class="a2"':null;?> href="./?mod=about">关于我们</a></li>	
           
              <li><a <?php echo $mod=='help'?'class="a2"':null;?> href="./?mod=help">帮助中心</a></li>			

        </ul> 

        </div>

  
    </div>
