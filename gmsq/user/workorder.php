<?php
/**
 * 我的工单
**/
include("../includes/common.php");
$title='我的工单';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<style>
.gdan_gout{width:100%;height:auto;background-color:#fff;padding-bottom:1em}
.gdan_txt{height:3em;line-height:3em;text-indent:1em;font-family:"微软雅黑";font-weight:800;}
.gdan_txt>span{position:absolute;right:3em;}
.gdan_zhugan{width:96%;height:auto;padding-top:1em;margin-left:2%;padding-left:.5em;padding-right:1em;margin-bottom:1em;border-top:dashed 1px #a9a9a9}
.gdan_kjia1{width:auto;margin-left:4em;margin-top:-3em}
.gdan_xiaozhi{width:100%;height:1em;color:#a9a9a9;margin-bottom:1em}
.gdan_xiaozhi>span{position:absolute;right:3em;}
.gdan_huifu{width:100%;height:auto;margin-top:1em;border-top:solid #ccc 1px}
.gdan_srk{width:98%;height:8em;margin-left:1%;margin-top:1em;border-color:#6495ed}
.gdan_huifu1{width:6em;height:2.5em;border:none;background-color:#1e90ff;color:#fff;margin:.5em 0 .5em 1%}
.gdan_jied{width:100%;height:3em;line-height:3em;text-align:center;color:#129DDE}
</style>
  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php

function display_type($type){
	if($type==1)
		return '业务补单';
	elseif($type==2)
		return '卡密错误';
	elseif($type==3)
		return '充值没到账';
	elseif($type==4)
		return '中途改了密码';
	else
		return '其它问题';
}

function display_status($status){
	if($status==1)
		return '<font color="red">待补充</font>';
	elseif($status==2)
		return '<font color="green">已结单</font>';
	else
		return '<font color="blue">待处理</font>';
}

$count1=$DB->count("SELECT count(*) FROM shua_workorder WHERE zid='{$userrow['zid']}' AND status=1");
$count2=$DB->count("SELECT count(*) FROM shua_workorder WHERE zid='{$userrow['zid']}' AND status=0");
$count3=$DB->count("SELECT count(*) FROM shua_workorder WHERE zid='{$userrow['zid']}'");

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
?>
<div class="panel panel-default">
<div class="panel-heading"><div class="pull-right"><a href="./workorder.php"><i class="fa fa-times"></i></a></div><h3 class="panel-title"><i class="fa fa-plus"></i>&nbsp;&nbsp;<b>提交工单</b></h3></div>
<div class="panel-body">
<form action="./workorder.php?my=add_submit" method="POST">
<div class="form-group">
<div class="input-group"><div class="input-group-addon">订单编号</div>
<?php
if(isset($_GET['orderid']) && $_GET['orderid'] && md5($_GET['orderid'].SYS_KEY.$_GET['orderid'])===$_GET['skey']){
	$orderid = intval($_GET['orderid']);
	$res=$DB->get_row("select id,tid,input from shua_orders where id='{$orderid}' limit 1");
	$toolname=$DB->get_column("select name from shua_tools where tid='{$res['tid']}' limit 1");
	echo '<input type="text" name="orderid" value="'.$orderid.'_'.$toolname.'_'.$res['input'].'" class="form-control" disabled/><input type="hidden" name="orderid" value="'.$orderid.'"/>';
}else{
	echo '<select name="orderid" class="form-control"><option value="0">选择异常的订单（非订单问题不用选）</option>';
	$rs=$DB->query("SELECT id,tid,input FROM shua_orders WHERE zid='{$userrow['zid']}' or userid='{$userrow['zid']}' order by id desc limit 20");
	while($res = $DB->fetch($rs)){
		$toolname=$DB->get_column("select name from shua_tools where tid='{$res['tid']}' limit 1");
		echo '<option value="'.$res['id'].'">'.$res['id'].'_'.$toolname.'_'.$res['input'].'</option>';
	}
	echo '</select>';
}
?>
</div>
</div>
<div class="form-group">
<div class="input-group"><div class="input-group-addon">问题类型</div>
	<select name="type" class="form-control">
		<option value="1">业务补单</option>
		<option value="2">卡密错误</option>
		<option value="3">充值没到账</option>
		<option value="4">订单中途改了密码</option>
		<option value="0">其它问题</option>
	</select>
</div>
</div>
<div class="form-group">
<textarea class="form-control" name="content" rows="5" placeholder="填写描述信息" required></textarea>
</div>
<input type="submit" class="btn btn-primary btn-block" value="提交"></form>
<br/><a href="./workorder.php">>>返回工单列表</a>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
找不到要提交的订单？<a href="../?chadan=1">点击进入查询订单</a>，在订单详情页面点击【投诉订单】可以直接提交工单。
</div>
</div>
<?php
}
elseif($my=='view')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from shua_workorder where id='$id' and zid='{$userrow['zid']}' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$contents = explode('*',$rows['content']);
$myimg = '//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC';
$kfimg = 'https://imgcache.qq.com/open_proj/proj_qcloud_v2/mc_2014/work-order/css/img/custom-service-avatar.svg';
?>
<div class="panel panel-default">
<div class="panel-heading"><div class="pull-right"><a href="./workorder.php"><i class="fa fa-times"></i></a></div><h3 class="panel-title"><i class="fa fa-sticky-note-o"></i>&nbsp;&nbsp;<b>工单详情</b></h3></div>

<div class="gdan_gout">
	<div class="gdan_txt">沟通记录 - <?php echo count($contents)?><span>状态：<?php echo display_status($rows['status'])?></span></div>
	<!------------------开始沟通------------------------>
	<div class="gdan_zhugan" style="border: none;">
		<img src="<?php echo $myimg?>" class="img-circle" width="40"/>
		<div class="gdan_kjia1">
			<div class="gdan_xiaozhi">问题描述<span><?php echo $rows['addtime']?></span></div>
			<p><?php echo $contents[0]?></p><br/>
			<p>订单编号：<?php echo $rows['orderid']?$rows['orderid']:'无订单号';?></p>
			<p>问题类型：<?php echo display_type($rows['type'])?></p>
		</div>
	</div>
<?php
for($i=1;$i<count($contents);$i++){
	$content = explode('^',$contents[$i]);
	if(count($content)==3){
		echo '<div class="gdan_zhugan">
	<img src="'.($content[0]==1?$kfimg:$myimg).'" class="img-circle" width="40"/>
	<div class="gdan_kjia1">
	<div class="gdan_xiaozhi">'.($content[0]==1?'官方客服':$userrow['user']).'<span>'.$content[1].'</span></div>
	'.$content[2].'
	</div>
</div>';
	}
}
if($rows['status']==0){
?>
<div class="gdan_jied">请耐心等待客服处理</div>
<?php
}elseif($rows['status']==2){
?>
<div class="gdan_jied">此工单已经结单</div>
<?php
}elseif($rows['status']==1){
?>
<div class="gdan_huifu">
<form action="./workorder.php?my=reply&id=<?php echo $id?>" method="POST">
	<textarea class="gdan_srk" name="content" placeholder="可输入需要补充的内容，回复后官方客服将会收到你的消息！" required></textarea>
	<input type="submit" name="submit" value="提交回复" class="gdan_huifu1" />
	<input type="button" name="submit" value="完结工单" class="gdan_huifu1" style="background-color: mediumseagreen;" onclick="window.location.href='./workorder.php?my=complete&id=<?php echo $id?>'"/>
</form>
</div>
<?php
}
?>
</div>
<div class="gdan_txt"><a href="./workorder.php">>>返回工单列表</a></div>
</div>
<?php
}
elseif($my=='add_submit')
{
$orderid=intval($_POST['orderid']);
$type=intval($_POST['type']);
$content=str_replace(array('*','^','|'),'',trim(strip_tags(daddslashes($_POST['content']))));
if (empty($content)) {
	showmsg('描述信息不能为空！');
} elseif ($DB->get_row("select id from shua_workorder where orderid='$orderid' and status<2 order by id desc limit 1")) {
	showmsg('请勿重复提交工单！');
} else {
	/*$res=$DB->get_row("select id,tid,addtime from shua_orders where id='{$orderid}' limit 1");
	$toolname=$DB->get_column("select name from shua_tools where tid='{$res['tid']}' limit 1");
	if(strpos($toolname,'钻')!==false && time()-strtotime($res['addtime'])<48*3600){
		showmsg('当前商品处理需要一定的时间，请耐心等待！如果48小时以后还未到账请再提交工单！');
	}elseif(time()-strtotime($res['addtime'])<24*3600){
		showmsg('当前商品处理需要一定的时间，请耐心等待！如果24小时以后还未到账请再提交工单！');
	}*/
$sql="insert into `shua_workorder` (`zid`,`type`,`orderid`,`content`,`addtime`,`status`) values ('".$userrow['zid']."','".$type."','".$orderid."','".$content."','".$date."','0')";
if($DB->query($sql)){
	if($conf['workorder_mail']==1){
		$content=mb_substr($content, 0, 16, 'utf-8');
		$sub = '用户提交工单提醒';
		$msg = '<b>'.$userrow['user'].'</b>（UID:'.$userrow['zid'].'）于 '.$date.' 提交工单，请及时进入网站后台工单列表处理。<br/><b>问题类型：</b>'.display_type($type).'<br/><b>工单标题：</b>'.$content.'<br/>----------<br/>'.$_SERVER['HTTP_HOST'].'<br/>'.$date;
		$mail_name = $conf['mail_recv']?$conf['mail_recv']:$conf['mail_name'];
		send_mail($mail_name,$sub,$msg);
	}
	showmsg('提交工单成功！请等待管理员处理。<br/><br/><a href="./workorder.php">>>返回工单列表</a>',1);
}else{
	showmsg('提交工单失败！'.$DB->error(),4);
}
}
}
elseif($my=='reply')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from shua_workorder where id='$id' and zid='{$userrow['zid']}' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
elseif($rows['status']==2)
	showmsg('此工单已经结单',3);
elseif($rows['status']==0)
	showmsg('请耐心等待客服处理',3);
$content=str_replace(array('*','^','|'),'',trim(strip_tags(daddslashes($_POST['content']))));
if (empty($content)) {
	showmsg('补充信息不能为空！');
} else {
$content = addslashes($rows['content']).'*0^'.$date.'^'.$content;
if($DB->query("update shua_workorder set content='$content',status=0 where id='{$id}'"))
	showmsg('回复工单成功！请等待管理员处理。<br/><br/><a href="./workorder.php">>>返回工单列表</a>',1);
else
	showmsg('回复工单失败！'.$DB->error(),4);
}
}
elseif($my=='complete')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from shua_workorder where id='$id' and zid='{$userrow['zid']}' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
elseif($rows['status']==2)
	showmsg('此工单已经结单',3);
if($DB->query("update shua_workorder set status=2 where id='{$id}'"))
	exit("<script language='javascript'>alert('完结工单成功！');history.go(-1);</script>");
else
	showmsg('完结工单失败！'.$DB->error(),4);
}
elseif($my=='delete')
{
$id=intval($_GET['id']);
$sql="DELETE FROM shua_workorder WHERE id='$id' AND zid='{$userrow['zid']}'";
if($DB->query($sql))
	exit("<script language='javascript'>alert('删除成功！');history.go(-1);</script>");
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{
?>
<table class="table table-bordered">
<tbody>
<tr height="25">
<td align="center"><font color="#808080"><b><i class="fa fa-exclamation-circle"></i>待我处理</b></br><b><?php echo $count1?></b></font></td>
<td align="center"><font color="#808080"><b><i class="fa fa-clock-o"></i>处理中</b></br></span><b><?php echo $count2?></b></font></td>
<td align="center"><font color="#808080"><b><i class="fa fa-check-circle"></i>全部工单</b></br><b><?php echo $count3?></b></font></td>
</tr>
</tbody>
</table>

<div class="panel panel-info" id="workorder_list">
     <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i>&nbsp;&nbsp;<b>我的工单</b></h3></div>
	 <div class="panel-body"><a href="./workorder.php?my=add" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;提交工单</a></div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>类型</th><th>订单号</th><th>问题描述</th><th>状态</th><th>提交时间</th><th>操作</th></tr></thead>
          <tbody>
<?php
$numrows=$DB->count("SELECT count(*) from shua_workorder WHERE zid='{$userrow['zid']}'");

$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_workorder WHERE zid='{$userrow['zid']}' order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
$content=explode('*',$res['content']);
$content=mb_substr($content[0], 0, 16, 'utf-8');
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.display_type($res['type']).'</td><td><a href="javascript:showOrder('.$res['orderid'].',\''.md5($res['orderid'].SYS_KEY.$res['orderid']).'\')" title="查询订单详情">'.$res['orderid'].'</a></td><td><a href="./workorder.php?my=view&id='.$res['id'].'">'.$content.'</a></td><td>'.display_status($res['status']).'</td><td>'.$res['addtime'].'</td><td><a href="./workorder.php?my=view&id='.$res['id'].'" class="btn btn-info btn-xs">查看</a>&nbsp;<a href="./workorder.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此工单吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<div class="text-center"><ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="workorder.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="workorder.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="workorder.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$s=10;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="workorder.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="workorder.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="workorder.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul></div>';
#分页
}
?>
    </div>
  </div>
</div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
function showOrder(id,skey){
	if(id==0)return false;
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	var status = ['<span class="label label-primary">待处理</span>','<span class="label label-success">已完成</span>','<span class="label label-warning">处理中</span>','<span class="label label-danger">异常</span>','<font color=red>已退款</font>'];
	$.ajax({
		type : "POST",
		url : "../ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table table-condensed table-hover">';
				item += '<tr><td colspan="6" style="text-align:center"><b>订单基本信息</b></td></tr><tr><td class="info">订单编号</td><td colspan="5">'+id+'</td></tr><tr><td class="info">商品名称</td><td colspan="5">'+data.name+'</td></tr><tr><td class="info">订单金额</td><td colspan="5">'+data.money+'元</td></tr><tr><td class="info">购买时间</td><td colspan="5">'+data.date+'</td></tr><tr><td class="info">下单信息</td><td colspan="5">'+data.inputs+'</td></tr><tr><td class="info">订单状态</td><td colspan="5">'+status[data.status]+'</td></tr>';
				if(data.list && data.list.order_state){
					item += '<tr><td colspan="6" style="text-align:center"><b>订单实时状态</b></td><tr><td class="warning">下单数量</td><td>'+data.list.num+'</td><td class="warning">下单时间</td><td colspan="3">'+data.list.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+data.list.start_num+'</td><td class="warning">当前数量</td><td>'+data.list.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+data.list.order_state+'</font></td></tr>';
				}else if(data.kminfo){
					item += '<tr><td colspan="6" style="text-align:center"><b>以下是你的卡密信息</b></td><tr><td colspan="6">'+data.kminfo+'</td></tr>';
				}else if(data.result){
					item += '<tr><td colspan="6" style="text-align:center"><b>处理结果</b></td><tr><td colspan="6">'+data.result+'</td></tr>';
				}
				if(data.alert){
					item += '<tr><td colspan="6" style="text-align:center"><b>商品简介</b></td><tr><td colspan="6">'+data.desc+'</td></tr>';
				}
				item += '</table>';
				layer.open({
				  type: 1,
				  title: '订单详细信息',
				  skin: 'layui-layer-rim',
				  content: item
				});
			}else{
				layer.alert(data.msg);
			}
		}
	});
}
</script>