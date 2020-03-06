<?php
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if($_GET['mod']=='faka'){
	exit("<script language='javascript'>window.location.href='../?mod=faka&&id={$_GET['id']}&skey={$_GET['skey']}';</script>");
}
$title = '平台首页';
include 'head.php';

if($conf['ui_bing']==1){
	$background_image='//cdn.qqzzz.net/assets/img/background/'.rand(1,19).'.jpg';
	$conf['ui_background']=3;
}elseif($conf['ui_bing']==2){
	if(date("Ymd")==$conf['ui_bing_date']){
		$background_image=$conf['ui_backgroundurl'];
		if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
	}else{
		$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
		$bing_data = get_curl($url);
		$bing_arr=json_decode($bing_data,true);
		if (!empty($bing_arr['images'][0]['url'])) {
			$background_image='//cn.bing.com'.$bing_arr['images'][0]['url'];
			saveSetting('ui_backgroundurl', $background_image);
			saveSetting('ui_bing_date', date("Ymd"));
			$CACHE->clear();
			if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
		}
	}
	$conf['ui_background']=3;
}else{
	$background_image='../assets/img/bj.png';
}
if($conf['ui_background']==0)
$repeat='background-repeat:repeat;';
elseif($conf['ui_background']==1)
$repeat='background-repeat:repeat-x;
background-size:auto 100%;';
elseif($conf['ui_background']==2)
$repeat='background-repeat:repeat-y;
background-size:100% auto;';
elseif($conf['ui_background']==3)
$repeat='background-repeat:no-repeat;
background-size:100% 100%;';

?>
<link rel="stylesheet" href="<?php echo $cdnpublic?>toastr.js/latest/css/toastr.min.css">
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.span_position{display:inline;background:red;border-radius:50%;width:10px;height:10px;position:absolute}
</style>
<div class="container" style="padding-top:70px;">
	<div class="row">
		<div class="col-sm-12 col-md-6 center-block" style="float: none;">

		  <div class="panel panel-primary" id="recharge">
			<div class="panel-heading" style="background: linear-gradient(to right,#14b7ff,#b221ff);padding: 15px;">				
			  <div class="widget-content text-right clearfix">
				<a href="uset.php?mod=user"><img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?$userrow['qq']:'10000';?>&spec=100" alt="Avatar" width="66" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left"></a>
				<h3 class="widget-heading h4"><strong>余额：<?php echo $userrow['rmb']?>元</strong></h3>
				<span class="text-muted"><a href="#userjs" data-toggle="modal" class="btn btn-primary btn-xs" style="overflow: hidden; position: relative;"><span class="btn-ripple animate" style="height: 100px; width: 100px; top: -29px; left: -3px;"></span>充值</a>&nbsp;<?php if($conf['fenzhan_tixian']==1 && $userrow['power']>0){?><a href="tixian.php" class="btn btn-warning btn-xs">提现</a>&nbsp;<?php }?><a href="record.php" class="btn btn-success btn-xs">账单</a></span>
			  </div>
			</div>
	<table class="table">
	<tbody>
		<tr>
			<th class="text-center">
				<font color="#a9a9a9">用户名</font><br><font size="4"><?php echo $userrow['user']?></font>
			</th>
			<th class="text-center">
				<font color="#a9a9a9">UID</font><br><font size="4"><?php echo $userrow['zid']?></font>
			</th>
			<th class="text-center">
				<font color="#a9a9a9">今日收益</font><br><font size="4" id="income_today">0元</font>
			</th>
		</tr>
		<tr>
			<td><a href="../" class="btn btn-primary btn-block"><i class="fa fa-shopping-cart"></i><br/><b><?php echo $userrow['power']>0?'低价下单':'自助下单';?></b></a></td>
			<?php if($conf['qiandao_reward']){?>
			<td><a href="./qiandao.php" class="btn btn-success btn-block"><i class="fa fa-check-square"></i><br/><b>每日签到</b></a></td>
			<?php }else{?>
			<td><a href="#userjs" data-toggle="modal" class="btn btn-success btn-block"><i class="fa fa-money"></i><br/><b>充值余额</b></a></td>
			<?php }?>
			<td><a href="message.php" class="btn btn-primary btn-block"><i class="fa fa-bullhorn"></i><br/><b>站内通知</b><span id="message_count"></span></a></td>
		</tr>
		<tr>
			<td><a href="../?chadan=1" class="btn btn-info btn-block"><i class="fa fa-search"></i><br/><b>自助查单</b></a></td>
			<td><a href="./workorder.php" class="btn btn-warning btn-block"><i class="fa fa-check-square-o"></i><br/><b>我的工单</b><span id="work_count"></span></a></td>
			<td><a href="record.php" class="btn btn-info btn-block"><i class="fa fa-hashtag"></i><br/><b>收支明细</b></a></td>
		</tr>
		<?php if($userrow['power']>0){?>
		<tr>
			<td><a href="shoplist.php" class="btn btn-primary btn-block"><i class="fa fa-list-alt"></i><br/><b>商品管理</b></a></td>
			<td><a href="list.php" class="btn btn-info btn-block"><i class="fa fa-list"></i><br/><b>订单记录</b></a></td>
			<?php if($userrow['power']==2){?>
			<td><a href="sitelist.php" class="btn btn-primary btn-block"><i class="fa fa-sitemap"></i><br/><b>分站管理</b></a></td>
			<?php }else{?>
			<td><a href="login.php?logout" class="btn btn-danger btn-block"><i class="fa fa-sign-out"></i><br/><b>安全退出</b></a></td>
			<?php }?>
		</tr>
		<?php }?>
	</tbody>
	</table>
		</div>
	<div class="panel panel-default">
		<div class="list-group-item reed text-center" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff"><i class="fa fa-globe"></i>&nbsp;&nbsp;<b>我的站点信息</b></font></h3></div>
		<?php if($userrow['power']>0){?>
			<li style="font-weight:bold" class="list-group-item">我的域名：<a href="http://<?php echo $userrow['domain']?>/" target="_blank" rel="noreferrer"><?php echo $userrow['domain']?></a>（<a href="uset.php?mod=site"target="_blank"><font color="#000000"><span class="glyphicon glyphicon-cog"></span><u>编辑信息</u> </font> </a>）</li>
			<?php if($conf['fanghong_api']){?>
			<li style="font-weight:bold" class="list-group-item">防红链接：<a href="javascript:;" id="copy-btn" data-clipboard-text="">Loading...</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-warning btn-xs" id="recreate_url">重新生成</button>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="layer.alert('防红链接：该链接可以在QQ直接打开的您的网站，方便推广！<br />Tips：点击短网址即可复制哦~',{icon: 3,title: '小提示',skin: 'layui-layer-molv layui-layer-wxd'});" class="btn btn-info btn-xs">说明</a></li>
			<?php }?>
			<li style="font-weight:bold" class="list-group-item">网站名称：<font color="blue"><?php echo $userrow['sitename']?></font></li>
			<li style="font-weight:bold" class="list-group-item">站点类型：<?php echo ($userrow['power']==2?'<font color=red>专业版</font>':'<font color=red>普及版</font>')?>&nbsp;<?php if($conf['fenzhan_upgrade']>0 && $userrow['power']==1){echo '[<a href="upsite.php">升级站点</a>]';}?></li>
			<?php if($conf['fenzhan_expiry']>0){?>
			<li style="font-weight:bold" class="list-group-item">到期时间：<font color="orange"><?php echo $userrow['endtime']?></font> [<a href="renew.php">续期</a>]</li>
			<?php }?>
			<li style="font-weight:bold" class="list-group-item">当前状态：<?php echo ($conf['fenzhan_expiry']>0 && $userrow['endtime']<$date?'<font color="red">已到期</font>':'<font color="green">正常运行</font>');?></li>
	<table class="table table-bordered">
	<tbody>
		
	</tbody>
	</table>
	<?php }else{?>
	<li style="font-weight:bold" class="list-group-item">你还未开通分站<br/><a href="regsite.php" class="btn btn-primary btn-sm btn-block">点此开通分站</a></li>
	<?php }?>
	</div>
	<?php if($userrow['power']>0 && !empty($conf['gg_panel'])){?>
	<div class="panel panel-default text-center">
		<div class="list-group-item reed" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>站点公告</b></font></h3></div>
		<div class="panel-body">
			<?php echo $conf['gg_panel']?>
		</div>
	</div>
	<?php }?>
	</div>
</div>
</div>
<div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
			</button>
			<h4 class="modal-title">在线充值余额</h4>
		</div>
		<div class="modal-body text-center">
			<b>我当前的账户余额：<span style="font-size:16px; color:#FF6133;"><?php echo $userrow['rmb']?></span> 元</b>
			<hr>
			<input type="text" class="form-control" name="value" autocomplete="off" placeholder="输入要充值的余额"><br/>
<?php 
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="../assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="../assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="../assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModa4" id="alink" style="visibility: hidden;"></button>
<hr><small style="color:#999;">付款后自动充值，刷新此页面即可查看余额。</small>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="myModa4" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="clearInterval(interval1)"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">订单信息</h4>
			</div>
			<div class="modal-body" id="showInfo2">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal" onclick="clearInterval(interval1)">关闭</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="<?php echo $cdnpublic?>toastr.js/latest/toastr.min.js"></script>
<script>
function dopay(type){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){layer.alert('充值金额不能为空');return false;}
	$.get("ajax.php?act=recharge&type="+type+"&value="+value, function(data) {
		if(data.code == 0){
			window.location.href='../other/submit.php?type='+type+'&orderid='+data.trade_no;
		}else{
			layer.alert(data.msg);
		}
	}, 'json');
}
$(document).ready(function(){
var clipboard = new Clipboard('#copy-btn');
clipboard.on('success', function (e) {
	layer.msg('复制成功！');
});
clipboard.on('error', function (e) {
	layer.msg('复制失败，请长按链接后手动复制');
});
$("#buy_alipay").click(function(){
	dopay('alipay')
});
$("#buy_qqpay").click(function(){
	dopay('qqpay')
});
$("#buy_wxpay").click(function(){
	dopay('wxpay')
});
$("#recreate_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, '#fff']});
	$.get("ajax.php?act=create_url&force=1", function(data) {
		layer.close(ii);
		if(data.code == 0){
			layer.msg('生成链接成功');
			$("#copy-btn").html(data.url);
			$("#copy-btn").attr('data-clipboard-text',data.url);
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, 'json');
});
if(window.location.hash=='#chongzhi'){
	$("#userjs").modal('show');
}
	$.ajax({
		type : "GET",
		url : "ajax.php?act=msg",
		dataType : 'json',
		async: true,
		success : function(data) {
			if(data.code==0){
				if(data.count>0){
					$("#message_count").addClass('span_position');
					toastr.info('<a href="message.php">您有<b>'+data.count+'</b>条新消息，请注意查收！</a>', '消息提醒');
				}
				if(data.count2>0){
					$("#work_count").addClass('span_position');
					toastr.warning('<a href="workorder.php">您有<b>'+data.count2+'</b>个工单已被管理员回复！</a>', '工单提醒');
				}
				$("#income_today").html(data.income_today+'元');
			}
		}
	});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=create_url",
		dataType : 'json',
		async: true,
		success : function(data) {
			if(data.code == 0){
				$("#copy-btn").html(data.url);
				$("#copy-btn").attr('data-clipboard-text',data.url);
			}else{
				$("#copy-btn").html(data.msg);
			}
		}
	});
});
</script>