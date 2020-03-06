<?php
if(!defined('IN_CRONLITE'))exit();

$thtime=date("Y-m-d").' 00:00:00';
$count1=$DB->count("SELECT count(*) from shua_site");
$count2=$DB->count("SELECT count(*) from shua_site where addtime>='$thtime'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - 分站介绍</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnserver?>assets/beautify/css/other-style.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<header style="padding-right:12px;">
    分站介绍<a style="left:0" href="#" onclick="javascript:history.back(-1);"><i class="fa fa-reply-all" aria-hidden="true"></i></a>
</header>

<div class="body-box" style="max-width: 800px;">

<div class="header-img-box">
	<img src="http://wx1.sinaimg.cn/mw690/0060lm7Tly1fxnm4wme9cj30jg063wfu.jpg" style="width:100%;border-bottom:#ddd solid 1px;">
	<div class="tw2 text">
		穷人不学穷根不断，富人不学富不长久
	</div>
</div>

	<div class="title-kuang" style="padding-top:20px;">
		<span></span><font class="tw2" style="font-size:16px;"><b>轻松赚钱-选择我们</b></font>
	</div>
	<div class="sjx"></div>
	<div class="text-kuang" style="line-height:20px;">
		<div style="font-size:13px;text-indent:2em;">
			分站就是与本站一样的网站！可代刷各种业务的网站！拥有独立后台、自主管理。轻松赚钱的网站！<font color="#f00">如需搭建请点击下方按钮，有疑问联系客服即可↓</font>
		</div>
		<hr class="xu" style="margin:9px 0 12px 0">
		<center>
		<a class="btn btn-info btn-sm tw1" style="margin-right:30%" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank">咨询客服</a><a class="btn btn-info btn-sm tw1" href="./user/regsite.php">搭建分站</a>
		</center>
		<hr>
		<font class="text-title">分站是如何赚钱的？如何得到？</font>
		<div style="font-size:13px;">
			<div style="text-indent:2em;">
分站赚的是提成！只要有客户通过你的网站下单就会获得提成！提成可自己通过修改商品售价调整
			</div>
			<center>
			<font class="rdu-5x" style="border:#ff8000 solid 1px;padding:5px 30px;display:inline-block;margin:5px 0;color:#f00;">提成 = 售价 - 成本价</font>
			</center>
			<div style="text-indent:2em;">
当然！分站版本越高_成本价就越低，赚取得提成就越多哦！赚钱就越快！
			</div>
		</div>
		<hr>
		<font class="text-title">需要我自己供货吗？</font>
		<div style="font-size:13px;text-indent:2em;">
所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，可谓是0投入！如果网站没有您想要的商品可联系主站客服添加即可！
		</div>
		<hr>
		<font class="text-title">可以自己修改价格及上、下架商品吗？</font>
		<div style="font-size:13px;text-indent:2em;">
所有分站目前都支持上、下架主站商品！级修改商品价格！但不支持上架主站没有的商品！如果需要什么商品可联系客服哦
		</div>
		<hr>
		<font class="text-title">分站版本分好几种！如何选择？</font>
		<div style="font-size:13px;text-indent:2em;">
所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，如果网站没有您想要的商品可联系主站客服添加即可！可谓是0成本！
		</div>
		<hr>
		<font class="text-title">为何要选择我们？</font>
		<div style="font-size:13px;text-indent:2em;">
我们全网最专业的代刷系统，商品齐全、货源稳定、价格低廉、售后保障。拥有丰富的人脉和资源，我们关注优质商品，实时掌握代刷市场的动态，加入我们，只要你坚持，你不用担心不赚钱，我们即使不敢保证你月入上万！但是在网上赚个零花钱绝对没问题！
		</div>
	</div>

<footer class="tw2 cnt">版权所有@[<?php echo $conf['sitename']?>]-有你更精彩</footer>
</div>
</body>
</html>