<?php
if(!defined('IN_CRONLITE'))exit();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
	<meta name="keywords" content="<?php echo $conf['keywords']?>">
	<meta name="description" content="<?php echo $conf['description']?>">
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/faka/css/frozen.css"/>
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/faka/css/public.css" />
	<?php echo $cssadd?>
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/faka/css/baoliao.css" />
</head>
<body>
  <div id="preloader">
    <div id="status">
      <p class="center-text"><span>正在加载中···</span></p>
    </div>
  </div>
<div class="header1">
    <header>
    <div class="header"> <a class="new-a-back" href="javascript:history.back();"> <span><img src="assets/faka/images/iconfont-fanhui.png"></span> </a>
      <div class="m_logo"><a href="#"><img src="assets/faka/images/m-index_02.png"></a></div>
<div class="header_right"><a class="" href="./"><img src="assets/faka/images/iconfont-shouye.png"></a></div>
      </div>
  </header>
  </div>
  
<?php if($islogin2==1){?>
    <div class="m_user w"><a><b>你好,<?php echo $userrow['user']?></b></a>&nbsp;<a>余额: <?php echo $userrow['rmb']?>元</a><a href="./user/login.php?logout" onclick="return confirm('确定要退出吗？')">【安全退出】</a></div>
<?php }else{?>
	<div class="m_user w">【<a href="./">在线购买</a>】&nbsp;【<a href="./?mod=wapquery">订单查询</a>】&nbsp;【<a href="./user/login.php">登录</a>】&nbsp;【<a href="./user/reg.php">注册</a>】</div>
<?php }?>

