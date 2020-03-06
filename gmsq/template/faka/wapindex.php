<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1){include_once TEMPLATE_ROOT.'faka/wapquery.php';exit;}

$cssadd = '<link rel="stylesheet" href="'.$cdnserver.'assets/faka/css/index.css" />';
include_once TEMPLATE_ROOT.'faka/head2.php';

if($islogin2==1){
	$price_obj = new Price($userrow['zid'],$userrow);
}elseif($is_fenzhan == true){
	$price_obj = new Price($siterow['zid'],$siterow);
}else{
	$price_obj = new Price(1);
}
$classhide = explode(',',$siterow['class']);
$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$shua_class=array();
while($res = $DB->fetch($rs)){
	if($is_fenzhan && in_array($res['cid'], $classhide))continue;
	$shua_class[$res['cid']]=$res['name'];
}

?>
<?php if($islogin2==1){?>
<div class="top w">
<div class="m_nav">
   <a href="./user/"><img src="assets/faka/images/m-index_27.png"><span>会员中心</span></a>
   <a href="./user/#chongzhi"><img src="assets/faka/images/m-index_24.png"><span>充值余额</span></a>
	<a href="./?mod=wapquery"><img src="assets/faka/images/m-index_26.png"><span>订单查询</span></a>
	<a href="./user/record.php"><img src="assets/faka/images/m-index_16.png"><span>消费记录</span></a>
</div></div>
<?php }?>
<div class="top w">
<div class="m_banner" >
<p><?php echo $conf['anounce']?></p>
</div>
</div>

<div class="search w">
<form action="?" method="get"><input type="hidden" name="mod" value="wapquery"/>
	<input name="k" type="text" class="search_input" placeholder="请输入订单号或填写的联系方式查询"><input name="submit" type="submit" class="search_submit" value="查询">
</form>
</div>

<div class="baoliao w">
    <div class="ui-tab-content">

<?php foreach($shua_class as $cid=>$classname){?>
<a><div class="menux"><div align="center"><?php echo $classname?></div></div></a>
<?php
$rs=$DB->query("SELECT * FROM shua_tools WHERE cid='$cid' and active=1 order by sort asc");
while($res = $DB->fetch($rs)){
	$num++;
	if(isset($price_obj)){
		$price_obj->setToolInfo($res['tid'],$res);
		if($price_obj->getToolDel($res['tid'])==1)continue;
		$price=$price_obj->getToolPrice($res['tid']);
	}else $price=$res['price'];
	$count = $DB->count("SELECT count(*) FROM shua_faka WHERE tid='{$res['tid']}' and orderid=0");
	echo '<a href="./?mod=buy&cid='.$cid.'&tid='.$res['tid'].'"><div class="baoliao_content"><div class="bl_img" style="position:relative"><img data-original="'.($res['shopimg']?$res['shopimg']:'assets/faka/images/default.jpg').'" alt="'.$res['name'].'" class="lazy"><div style="width:100px;position:absolute;z-indent:2;left:2;top:55"><span class="bl_type" style="opacity:.7">自动发货</span></div></div><div class="bl_right"><div class="bl_title">'.$res['name'].'</div><div class="bl_tag"><div class="bl_price">'.($count>0?'<span class="bl_type" style="background-color:#0086ee">充足</span>':'<span class="bl_type" style="background-color:#6E6E6E;">缺货</span>').' 售价￥'.$price.'</div></div></div></div></a>';
}
}?>
<div class="m_user w">
<a href="#">返回顶部</a>
</div>

<div class="copyright">Copyright &copy; 2019 <?php echo $conf['sitename']?></div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
})
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
});
</script>
</body>
</html>