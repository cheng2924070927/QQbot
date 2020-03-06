<?php
/**
 * 站长后台管理中心
**/
include("../includes/common.php");
$title='签到萌宠机器人销售后台';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$count=$DB->count("SELECT count(*) from shua_orders");
$count1=$DB->count("select count(*) from shua_orders where status=1");
$count2=$DB->count("select count(*) from shua_orders where status=3");

$count_site=$DB->count("SELECT count(*) from shua_site");

$count_shequ=$DB->count("SELECT count(*) from shua_shequ");

$count_tools=$DB->count("SELECT count(*) from shua_tools");

$count_class=$DB->count("SELECT count(*) from shua_class");

$data=get_curl($payapi.'api.php?act=query&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&url='.$_SERVER['HTTP_HOST']);

$arr=json_decode($data,true);
?>

<div class="col-sm-6 col-lg-3">
	<a href="javascript:void(0)" class="widget">
	<div class="widget-content widget-content-mini text-right clearfix">
		<div class="widget-icon pull-left themed-background">
			<i class="fa fa-list-ol text-light-op"></i>
		</div>
		<h2 class="widget-heading h3">
		<strong><span id="count1"></span></strong>
		</h2>
		<span class="text-muted">订单总数</span>
	</div>
	</a>
</div>
<div class="col-sm-6 col-lg-3">
	<a href="javascript:void(0)" class="widget">
	<div class="widget-content widget-content-mini text-right clearfix">
		<div class="widget-icon pull-left themed-background-success">
			<i class="fa fa-first-order text-light-op"></i>
		</div>
		<h2 class="widget-heading h3 text-success">
		<strong><span id="count3"></span></strong>
		</h2>
		<span class="text-muted">待处理订单</span>
	</div>
	</a>
</div>
<div class="col-sm-6 col-lg-3">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-success">
									<i class="fa fa-cart-plus text-light-op"></i>
								</div>
	<h2 class="widget-heading h3 text-warning">
		<strong>+ <span id="count4"></span></strong>
		</h2>
		<span class="text-muted">今日订单数</span>
	</div>
	</a>
  			</div>
  <div class="col-sm-6 col-lg-3">
	<a href="javascript:void(0)" class="widget">
	<div class="widget-content widget-content-mini text-right clearfix">
		<div class="widget-icon pull-left themed-background-danger">
			<i class="fa fa-rmb text-light-op"></i>
		</div>
		<h2 class="widget-heading h3 text-danger">
		<strong>$ <span id="count5"></span></strong>
		</h2>
		<span class="text-muted">今日交易额</span>
	</div>
	</a>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-lg-8">
	<div class="widget">
		<div class="widget-content border-bottom">
一周交易与订单统计
		</div>
		<div class="widget-content border-bottom themed-background-muted">
			<div id="chart-classic-dash" style="height: 393px;">
			</div>
		</div>
		<div class="widget-content widget-content-full">
			<div class="row text-center">
				<div class="col-xs-4 push-inner-top-bottom border-right">
<p>Lovely God温馨提醒您：</p>
<hr />
					<h4 class="widget-heading"><i class="fa fa-qq text-dark push-bit"></i>&nbsp;QQ钱包交易额<br>
					<center><span id="count12"></span>元</center></h4><hr /><a href="/sqz" target="_blank">前往授权站</a><hr /><a href="/sqz/admin" target="_blank">安全登录授权站后台</a>
				</div>
				<div class="col-xs-4 push-inner-top-bottom">
<p>咱们不赚非法钱财</p>
<hr />
					<h4 class="widget-heading"><i class="fa fa-wechat text-dark push-bit"></i>&nbsp;微信交易额<br>
					<center><span id="count13"></span>元</center></h4><hr /><a href="/" target="_blank">前往签到萌宠机器人官网</a><hr /><a href="https://lovek.me/donate/" target="_blank">不做白嫖党，给作者买根棒棒糖~</a>
				</div>
				<div class="col-xs-4 push-inner-top-bottom border-left">
<p>正正当当做人</p>
<hr />
					<h4 class="widget-heading"><i class="fa fa-credit-card text-dark push-bit"></i>&nbsp;支付宝交易额<br>
					<center><span id="count14"></span>元</center></h4><hr /><a href="/gmsq" target="_blank">前往销售站</a><hr /><a href="login.php?logout" target="_blank">安全退出销售后台</a><br /><br />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="widget">
		<div class="widget-content border-bottom">
			<span class="pull-right text-muted"><i class="fa fa-circle"></i></span>
分站统计
		</div>
		<div class="widget-content widget-content-full-top-bottom border-bottom">
			<div class="row text-center">
				<div class="col-xs-6 push-inner-top-bottom border-right">
					<h4 class="widget-heading"><i class="fa fa-sitemap text-dark push"></i>&nbsp;分站总数<br>
					<center><span id="count6"></span>个</font></center></h4>
				</div>
				<div class="col-xs-6 push-inner-top-bottom">
					<h4 class="widget-heading"><i class="fa fa-cloud text-dark push"></i>&nbsp;今日新开分站<br>
					<center><span id="count7"></span>个</center></h4>
				</div>
			</div>
		</div>
		<div class="widget-content widget-content-full">
			<div class="row text-center">
				<div class="col-xs-6 push-inner-top-bottom border-right">
					<h4 class="widget-heading"><i class="fa fa-rmb text-dark push"></i>&nbsp;今日分站提成<br>
					<center><span id="count8"></span>元</center></h4>
				</div>
				<div class="col-xs-6 push-inner-top-bottom">
					<h4 class="widget-heading"><i class="fa fa-money text-dark push"></i>&nbsp;待处理提现<br>
					<center><span id="count11"></span>元</center></h4>
				</div>
			</div>
		</div>	
</div>
  <div class="widget">
<div class="widget-content border-bottom">
<span class="pull-right text-muted"><i class="fa fa-check"></i></span>
辅助小功能
</div>
<div class="widget-content border-bottom">
  <a href="./set.php?mod=account" target="_blank">修改密码</a>丨
  <a href="https://lovek.me" target="_blank">作者博客</a>丨
  <a href="login.php?logout" target="_blank">安全退出销售后台</a>
	</ul>
  </div>
  </div>
<div class="widget">
<div class="widget-content border-bottom text-dark">
<span class="pull-right text-muted"><i class="fa fa-check-square"></i></span>
说明
</div>
  <div class="widget-content border-bottom">
    <font color="green">快来加本萌的群鸭！QQ群：<a href="https://jq.qq.com/?_wv=1027&k=53sXSlP"  target=_blank>826967547</a></font><br/>当前版本：JKJPro用户群内部版本<hr/>都是自己人未添加任何后门(包括官网、授权站、销售系统)<br />您不放心可以自己扫描一下，都是可以的<hr />我分享这套网站并没有获得任何收益，做为一个前端萌新的我只是想锻炼一下自己的能力，但人总是要恰饭的(暗示我穷啦嘻嘻~)，不要做白嫖党，欢迎来赞助我~<br />赞助地址:<a href="https://lovek.me/donate/" target="_blank">https://lovek.me/donate/</a><br />付款备注请留下你的QQ号，感谢！</div>
<div class="widget-content border-bottom">
</ul>
</div>
    </div>
  </div> 
<script>
$(document).ready(function(){
	$('#title').html('正在加载数据中...');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#title').html('后台管理首页');
			$('#yxts').html(data.yxts);
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#count3').html(data.count3);
			$('#count4').html(data.count4);
			$('#count5').html(data.count5);
			$('#count6').html(data.count6);
			$('#count7').html(data.count7);
			$('#count8').html(data.count8);
			$('#count9').html(data.count9);
			$('#count10').html(data.count10);
			$('#count11').html(data.count11);
			$('#count12').html(data.count12);
			$('#count13').html(data.count13);
			$('#count14').html(data.count14);

			var t=$("#chart-classic-dash");$.plot(t,[{label:"订单量",data:data.chart.orders,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.6},{opacity:.6}]}},points:{show:!0,radius:5}},{label:"交易量",data:data.chart.money,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.6},{opacity:.6}]}},points:{show:!0,radius:5}}],{colors:["#5ccdde","#454e59"],legend:{show:!0,position:"nw",backgroundOpacity:0},grid:{borderWidth:0,hoverable:!0,clickable:!0},yaxis:{show:!1,tickColor:"#f5f5f5",ticks:3},xaxis:{ticks:data.chart.date,tickColor:"#f9f9f9"}});var s=null,r=null;t.bind("plothover",function(o,t,i){if(i){if(s!==i.dataIndex){s=i.dataIndex,$("#chart-tooltip").remove();var l=(i.datapoint[0],i.datapoint[1]);r=1===i.seriesIndex?"$ <strong>"+l+"</strong>":0===i.seriesIndex?"<strong>"+l+"</strong> sales":"<strong>"+l+"</strong> tickets",$('<div id="chart-tooltip" class="chart-tooltip">'+r+"</div>").css({top:i.pageY-45,left:i.pageX+5}).appendTo("body").show()}}else $("#chart-tooltip").remove(),s=null});
		}
	});
})
</script>