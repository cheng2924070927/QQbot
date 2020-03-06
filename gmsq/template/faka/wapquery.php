<?php
if(!defined('IN_CRONLITE'))exit();

if($islogin2==1){
	$cookiesid = $userrow['zid'];
}

$data=trim(daddslashes($_GET['data']));
$rs=$DB->query("SELECT tid,name FROM shua_tools WHERE 1 order by sort asc");
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
}
if(!empty($data)){
	if(strlen($qq)==17 && is_numeric($qq))$sql=" tradeno='{$data}'";
	else $sql=" input='{$data}'";
}
else $sql=" userid='{$cookiesid}'";
$limit = 10;
$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $limit");
$record=array();
$count = 0;
while($res = $DB->fetch($rs)){
	$count++;
	$record[]=array('id'=>$res['id'],'tid'=>$res['tid'],'input'=>$res['input'],'money'=>$res['money'],'name'=>$shua_func[$res['tid']],'value'=>$res['value'],'addtime'=>$res['addtime'],'endtime'=>$res['endtime'],'result'=>$res['result'],'status'=>$res['status'],'skey'=>md5($res['id'].SYS_KEY.$res['id']));
}

$cssadd = '<link rel="stylesheet" href="'.$cdnserver.'assets/faka/css/user.css" />';
include_once TEMPLATE_ROOT.'faka/head2.php';
?>
<div class="search w">
<form action="?" method="get"><input type="hidden" name="mod" value="query"/>
	<input name="data" type="text" class="search_input" placeholder="请输入订单号或填写的联系方式查询"><input name="submit" type="submit" class="search_submit" value="查询">
</form>
</div>
<div class="menux"><div align="center">订单管理</div></div>

<?php
foreach($record as $row){
	echo '<div class="msg w"><div class="msg_title">&nbsp;<font class="bl_type" style="background-color:#019bbc">自动发货</font> ID:'.$row['id'].' <font size="2" color="#cbcbcb">'.$row['addtime'].'</font></div><div class="msg_title2"><h1>商品：<a href="./?mod=buy&tid='.$row['tid'].'">'.$row['name'].'</a></h1><span></span></div><div class="msg_content">总价'.$row['money'].'元 数量'.$row['value'].'个 '.($row['status']==1?'<font color="green">已发货</font>':'<font color="blue">待发货</font>').' <a href="./?mod=faka&id='.$row['id'].'&skey='.$row['skey'].'" title="点击查看卡密"><span class="bl_type" style="background-color:#c500e8;">提取卡密</span></a></div></div>';
}
?>
<div class="bl_more"> <div  class='text-right'><ul class='pagination'>       <li><span class="rows">共<?php echo $count?>条</span> </li></ul></div></div>

<div class="m_user w">
<a href="#">返回顶部</a>
</div>

<div class="copyright">Copyright &copy; 2019 <?php echo $conf['sitename']?></div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
})
</script>
</body>
</html>
