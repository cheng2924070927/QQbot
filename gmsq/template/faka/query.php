<?php
if(!defined('IN_CRONLITE'))exit();
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'faka/wapquery.php';exit;}

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

include_once TEMPLATE_ROOT.'faka/head.php';
?>
<style type="text/css">
.query {
	padding: 25px;
	min-height: 300px;
}
.query .in {
	height: 45px;
	border: 1px solid #ff6600;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width: 65%;
	margin-right: auto;
	margin-left: auto;
	overflow: hidden;
}
.query .in .in_l {
	float: left;
	width: 80%;
	height: 100%;
}
.query .in .in_r {
	float: right;
	height: 100%;
	width: 20%;
	
}
.query .in input {
	margin: 0px;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	height: 100%;
	width: 100%;
	line-height: 45px;
	font-size: 18px;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 1%;
}
.query .in .in_r input {
	cursor: pointer;
	background-color: #F60;
	font-size: 20px;
	line-height: 45px;
	color: #FFF;
	font-weight: bold;
	padding: 0px;
	width: 100%;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
#kong .query .title {
	text-align: center;
	height: 50px;
	line-height: 50px;
	margin-bottom: 15px;
}
.title2 {
	text-align: center;
	height: 25px;
	line-height: 25px;
	margin-bottom: 15px;
	font-size: 14px;
	color: #ff253a;
}
td.stitle{max-width:380px;}
</style>
<div id="kong">
  <div class="query">
  <div class="title">请输入订单号，交易单号，手机号查询</div>
  	<form action="?" method="get"><input type="hidden" name="mod" value="query"/>
    <div class="in">
	  <div class="in_l"><input type="text" name="data" placeholder="请输入订单号或填写的联系方式查询"/></div>
      <div class="in_r"><input type="submit" value="订单查询" /></div>
    </div>
    </form><br/>
	  <div class="title2">注意：超过24小时的订单禁止查询，如果您想长期保留订单，请您注册成为我们的会员。</div>
 <br/><font size="4" color="#000000" title="这是您最近的购买记录">这是您最近的购买记录</font>
 <br/> <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <thead>
        <th style="text-align:center">订单ID</th>
        <th>名称</th>
        <th style="text-align:center">数量</th>
        <th style="text-align:center">金额</th>
        <th style="text-align:center">状态</th>
		<th style="text-align:center">日期</th>
        <th style="text-align:center">操作</th>
      </thead>
	  <tbody>
<?php
if($count>0){
	foreach($record as $row){
	  echo '<tr><td>'.$row['id'].'</td><td class="stitle"><a target="_blank" href="./?mod=buy&tid='.$row['tid'].'">'.$row['name'].'</a></td><td>'.$row['value'].'</td><td>'.$row['money'].'元</td><td>'.($row['status']==1?'<font color="green">已发货</font>':'<font color="blue">待发货</font>').'</td><td><a>'.$row['addtime'].'</a></td><td><a href="./?mod=faka&id='.$row['id'].'&skey='.$row['skey'].'" title="点击查看卡密" target="_blank" class="button button-highlight button-rounded button-tiny">提卡</a></td></tr>';
	}
}else{
	echo '<td scope="col" colspan="7"><span class="empty">无记录!</span></td>';
}
?>
    </tbody></table><br/> <div  class='text-right'><ul class='pagination'>       <li><span class="rows">共<?php echo $count?>条</span> </li></ul></div></div>

</div>
<div id="footer">
    		&copy; 2019 <?php echo $conf['sitename']?>
</div>
