<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1 && checkmobile()){include_once TEMPLATE_ROOT.'faka/wapquery.php';exit;}
elseif($_GET['buyok']==1||$_GET['chadan']==1){include_once TEMPLATE_ROOT.'faka/query.php';exit;}
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'faka/wapindex.php';exit;}

include_once TEMPLATE_ROOT.'faka/head.php';

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
<br/>
<div class="topliucheng"><img src="<?php echo $cdnserver?>assets/faka/images/goumaizn01.png" title="">
<?php echo $conf['anounce']?>
</div>
<div id="bd">

<div id="bar">
<div class="bar_top">商家信息</div>
<div class="from_wz_41">
<div class="kefu"><a target="blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['kfqq']?>&amp;Site=qq&amp;Menu=yes">QQ:<?php echo $conf['kfqq']?></a> </div>
<!--div class="kefu">
QQ群：168133539</div>
<div class="kefu">
微信：71007288</div-->
</div>

<div class="bar_top">手机扫码购买</div><div class="erweima">
<img src="http://www.liantu.com/api.php?w=150&m=10&text=<?php echo $siteurl?>"> </div>
</div>

<div id="bar_r">
<div id="body_xiao">
<table style="width:100%" border="0" cellpadding="10" cellspacing="0"  >
			<thead>
				<tr >
  				    <th class="indexlistlb">商品名称</th>
		
					
					 <th class="indexlistlb">售价</th>
					 
					 <th class="indexlistlb">库存</th>
					 <th class="indexlistlb">操作</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($shua_class as $cid=>$classname){?>
<tr><th colspan="4" align="center" class="greencoler" ><div align="center"><font size="3"><b><?php echo $classname?></b></font></div></th></tr>
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
	echo '<tr><td align="left" class="stitle"><a class="button button-action button-circle button-small" title="自动发货商品，购买后自动发货">自动</a> <font size="3" title="'.$res['name'].'">'.$res['name'].'</font></td><td><font color="#FF5400" size="2" title="商品售价">'.$price.'元</font></td><td>'.($count>0?'<font color="#000CF9" size="3" title="商品库存">充足</font>':'<font color="#CCCCCC">缺货</font>').'</td><td>'.($count>0?'<a class="button button-primary button-rounded button-small" href="./?mod=buy&cid='.$cid.'&tid='.$res['tid'].'">购买</a>':'<a class="button button-default button-rounded button-small" href="./?mod=buy&cid='.$cid.'&tid='.$res['tid'].'">缺货</a>').'</td></tr>';
}
}?>
			</tbody>
</table>

</div>
</div></div>

<div id="footer">
    		&copy; 2019 <?php echo $conf['sitename']?>
</div>
