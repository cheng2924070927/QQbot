<?php
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if(!$conf['qiandao_reward']){
	showmsg('当前站点未开启签到功能',3);
}
$_SESSION['isqiandao']=$userrow['zid'];

$day = date("Y-m-d");
$lastday = date("Y-m-d",strtotime("-1 day"));
if ($row = $DB->get_row("SELECT * FROM shua_qiandao WHERE zid='{$userrow['zid']}' and date='$day' order by id desc limit 1")) {
	$isqiandao = true;
	$continue = $row['continue'];
}else{
	if ($row = $DB->get_row("SELECT * FROM shua_qiandao WHERE zid='{$userrow['zid']}' and date='$lastday' order by id desc limit 1")) {
		$continue = $row['continue'];
	}else{
		$continue = 0;
	}
	$isqiandao = false;
}

$rs=$DB->query("SELECT * FROM shua_qiandao order by id desc limit 10");
$qqrow=array();
$qdrow=array();
while($res = $DB->fetch($rs)){
	if(count($qqrow)<5){
		$qqrow[]=$res['qq'];
	}
	$qdrow[]=$res;
}

$title = '每日签到';
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

$count1=$DB->count("SELECT count(*) from shua_orders where zid={$userrow['zid']}");
?>
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.img-circle{width: 15%!important;}
</style>
<div class="container" style="padding-top:70px;">
	<div class="row">
		<div class="col-sm-12 col-md-6 center-block" style="float: none;">
			<div class="panel panel-primary">
			<div class="list-group-item reed text-center" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<b>每日签到</b></font></h3></div>
			<div class="card" style="position: relative;">
				<img class="" style="width: 100%;height: 175px;" src="../assets/img/qiandao.jpg">
				<div style="top: 0;left: 0;padding: 15px;position: absolute;">
					<iframe width="300" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="//i.tianqi.com/index.php?c=code&id=12&icon=1&num=2&site=12"></iframe>
				</div>
				<div style="bottom: 0;right: 0;padding: 15px;position: absolute;">
					<h5 class="widget-heading">
						<font color="#fff" style="text-shadow: black 3px 3px 3px;font-size: 22px;">
							<strong>总奖励：<span id="rewardcount">0.00</span>元</strong>
						</font>
					</h5>
					<h5 class="widget-heading block-right">
						<font color="#fff" style="text-shadow: black 3px 3px 3px;font-size: 22px;">
							<strong><i class="fa fa-calendar-check-o"></i> 连续签到<?php echo $continue?>天</strong>
						</font>
					</h5>
				</div>
			</div>
			<div class="panel-footer">
				<button type="button" class="btn btn-success btn-block" id="qiandao" style="text-shadow: MidnightBlue 2px 2px 2px;"><span style="font-size:16px" ><b><i class="fa fa-check-square"></i> <?php echo $isqiandao==true?'今天已签到':'立即签到';?></b></span></button>
			</div>
			</div>
			<div class="panel panel-default text-center">
			<div class="panel-heading"><h3 class="panel-title">最新签到榜</h3></div>
				<div class="panel-body">
					<div class="avatar-group">
<?php
foreach($qqrow as $row){
	echo '						<img src="http://q4.qlogo.cn/headimg_dl?dst_uin='.$row.'&spec=100" class="img-rounded img-circle img-thumbnail">';
}
?>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="font-size: 13px;" class="text-center">
								<i class="fa fa-user-circle-o"></i> 今日签到<br><span id="count1"></span>人
							</th>
							<th style="font-size: 13px;" class="text-center">
								<i class="fa fa-user-circle"></i> 昨日签到<br><span id="count2"></span>人
							</th>
							<th style="font-size: 13px;" class="text-center">
								<i class="fa fa-pie-chart"></i> 累计签到<br><span id="count3"></span>人
							</th>
						</tr>
					</thead>
					<tbody>
<?php
foreach($qdrow as $row){
	echo '						<tr>
							<th colspan="3" style="font-size: 13px;">
								<span class="pull-right label label-info"><small>连续'.$row['continue'].'天</small></span>
								<i class="fa fa-user"></i> ZID:'.$row['zid'].' 在'.date("H:i",strtotime($row['time'])).'签到获得奖励'.$row['reward'].'元!
							</th>
						</tr>';
}
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
$(document).ready(function(){
	$("#qiandao").click(function(){
		$.ajax({
		 type: "get",
		 url: "ajax.php?act=qiandao",
		 dataType: "json",
		 success: function(data){
			if(data.code == 0){
				layer.alert(data.msg,{icon:6},function(){
					window.location.reload();
				})
			}else{
				layer.alert(data.msg,{icon:5})
			}
		 },
		 error: function(){
			layer.alert('签到失败，请稍后刷新重试！'); 
		 }
	   });
	});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=qdcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#count3').html(data.count3);
			$('#rewardcount').html(data.rewardcount);
		}
	});
})
</script>