<?php
if(!defined('IN_CRONLITE'))exit();
$values=rand(1,19);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnserver?>assets/css/nifty.min.css" rel="stylesheet">
  <link href="<?php echo $cdnserver?>assets/css/magic-check.min.css" rel="stylesheet">
  <link href="<?php echo $cdnserver?>assets/css/pace.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style type="text/css">
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
</style>
</head>
<body>
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
	  <?php echo $conf['modal']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
      </div>
      	<li class="list-group-item"><font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
      	<li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
      	<li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
      	<li class="list-group-item">例如您购买的是快手商品，需要输入作品链接里“userid=”后面的数字，输入快手号是一般是查询不到的</li>
      	<li class="list-group-item">例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的</li>
      	<li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明结束-->
<br/>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">


<!--这里是网站的logo部分-->
<div class="panel panel-success">
<div class="panel-body" style="text-align: center;"><img src="<?php echo $logo;?>" style="max-width: 100%;"></div></div>
<!--logo部分结束-->

<div class="panel panel-danger">
	<div class="panel-heading"><h3 class="panel-title" ><font color="#FFFFFF"><i class=""></i><b> <script type="text/javascript">
var now=(new Date()).getHours();
if(now>0&&now<=6){
document.write("❤熬夜对身体不好哦 快睡觉！");
}else if(now>6&&now<=11){
document.write("❤早上好 心情好来下一单吧~");
}else if(now>11&&now<=14){
document.write("❤停下手中的工作 去吃饭~");
}else if(now>14&&now<=18){
document.write("❤累了一上午了 休息会吧~");
}else{
document.write("❤晚上好 下一单醒来有惊喜哟~");
}
</script></font> </b></h3></div>

 <table class="table table-bordered">
							<tbody>
								</tbody></table>
   <?php echo $conf['anounce']?>

</div>
<div class="tab-content">
	<div id="demo-tabs-box-1" class="tab-pane fade active in">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title"><font color="#fff"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<b>自助下单</b></font><span class="pull-right"><a data-toggle="tab" href="#demo-tabs-box-2" aria-expanded="true" class="btn btn-danger btn-rounded"><i class="fa fa-warning"></i> 注意</a></span></h3>
			</div>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#onlinebuy" data-toggle="tab"><i class="fa fa-shopping-cart"></i> 下单</a></li>
		<li <?php if($conf['iskami']==0){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab"><i class="glyphicon glyphicon-th"></i> 卡密</a></li>
		<li><a href="#query" data-toggle="tab" id="tab-query"><i class="fa fa-search"></i> 查单</a></li>
		<li <?php if(empty($conf['lqqapi'])){?>class="hide"<?php }?>><a href="#lqq" data-toggle="tab"><i class="fa fa-circle-o-notch"></i> 拉圈</a></li>
		<li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><i class="fa fa-gift"></i> 抽奖</a></li>
		<li <?php if(empty($conf['chatframe'])){?>class="hide"<?php }?>><a href="#chat" data-toggle="tab"><i class="fa fa-comments"></i> 聊天</a></li>
		<li <?php if($conf['fenzhan_buy']==0){?>class="hide"<?php }?>><a href="#fenzhan" data-toggle="tab"><i class="fa fa-sitemap"></i> 分站</a></li>   
	</ul>
	<div class="modal-body">
		<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="onlinebuy">
<?php include TEMPLATE_ROOT.'default/shop2.inc.php'; ?>
		</div>
		<div class="tab-pane fade in" id="cardbuy">
			<?php if(!empty($conf['kaurl'])){?>
			<div class="form-group">
				<a href="<?php echo $conf['kaurl']?>" class="btn btn-default btn-block" target="_blank"/>点击进入购买卡密</a>
			</div>
			<?php }?>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">输入卡密</div>
				<input type="text" name="km" id="km" value="" class="form-control" onkeydown="if(event.keyCode==13){submit_checkkm.click()}" required/>
			</div></div>
			<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密">
			<div id="km_show_frame" style="display:none;">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品名称</div>
				<input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
			</div>
		</div>
		<div class="tab-pane fade in" id="query">
			<div class="alert alert-danger" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-btn">
					<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px"><option value="0">下单账号</option><option value="1">订单号</option></select>
				</div>
				<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
				<span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
			</div></div>
			<input type="submit" id="submit_query" class="btn btn-danger btn-block" value="立即查询">
			<div id="result2" class="form-group" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
			</div>
		</div>

		<div class="tab-pane fade in" id="fenzhan">
		  <div class="row"> 
   <div class="col-sm-12 col-md-6"> 
    <div class="panel panel-primary"> 
     <div class="panel-heading"> 
      <div class="panel-title">
        普及版分站 
      </div> 
     </div> 
     <li class="list-group-item"> 限时超级低价搭建代理分站<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可享受分站内部超低代理价格<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可以赚取每一个用户下单的提成<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可以自定义售卖的商品价格<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 赚取下级分站的每笔交易的提成<span class="badge badge-danger"><i class="fa fa-close"></i></span> </li> 
     <li class="list-group-item"> 无限免费搭建下级代理分站<span class="badge badge-danger"><i class="fa fa-close"></i></span> </li> 
     <li class="list-group-item"> 分站站长专属的内部售后交流群<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 分站满<?php echo $conf["tixian_min"]?>元即可申请提现<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <div class="list-group-item list-group-item-warning"> 
      <i class="fa fa-rmb fa-lg grey" style="width: 18px; text-align: center;"></i> 
      <span class="m-left-xs">开通价格</span> 
      <span class="badge badge-info"><b><?php echo $conf["fenzhan_price"]?></b>元</span> 
     </div> 
     <a data-toggle="modal" href="./user/regsite.php?kind=0" target="_blank" class="list-group-item list-group-item-info text-center"><strong>马上开通</strong></a> 
    </div> 
   </div> 
   <div class="col-sm-12 col-md-6"> 
    <div class="panel panel-primary"> 
     <div class="panel-heading"> 
      <div class="panel-title">
        专业版分站 
      </div> 
     </div> 
     <li class="list-group-item"> 限时超级低价搭建代理分站<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可享受分站内部超低代理价格<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可以赚取每一个用户下单的提成<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 可以自定义售卖的商品价格<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 赚取下级分站的每笔交易的提成<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 无限免费搭建下级代理分站<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 分站站长专属的内部售后交流群<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <li class="list-group-item"> 分站满<?php echo $conf["tixian_min"]?>元即可申请提现<span class="badge badge-success"><i class="fa fa-check"></i></span> </li> 
     <div class="list-group-item list-group-item-warning"> 
      <i class="fa fa-rmb fa-lg grey" style="width: 18px; text-align: center;"></i> 
      <span class="m-left-xs">开通价格</span> 
      <span class="badge badge-info"><b><?php echo $conf["fenzhan_price2"]?></b>元</span> 
     </div> 
     <a data-toggle="modal" href="./user/regsite.php?kind=1" target="_blank" class="list-group-item list-group-item-info text-center"><strong>马上开通</strong></a> 
    </div> 
   </div> 
  </div> 
</div>

<div class="tab-pane fade in" id="gift">
	<div class="panel-body text-center">
	<div id="roll">点击下方按钮开始抽奖</div>
	<hr>
	<p>
	<a class="btn btn-info" id="start" style="display:block;">开始抽奖</a>
	<a class="btn btn-danger" id="stop" style="display:none;">停止</a>
	</p> 
	<div id="result"></div><br/>
	<div class="giftlist" style="display:none;"><strong>最近中奖记录</strong><ul id="pst_1"></ul></div>
	</div>
</div>
<div class="tab-pane fade in" id="lqq">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
			</div></div>
			<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
			<div id="result3" class="form-group text-center" style="display:none;"></div>
		</div>

		<div class="tab-pane fade in" id="chat">
			<?php echo $conf['chatframe']?>
		</div>
		</div>
	</div>
</div>
</div>
	<div id="demo-tabs-box-2" class="tab-pane fade">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title"><font color="#fff"><i
						class="fa fa-warning"></i>&nbsp;&nbsp;<b>注意事项</b></font><span class="pull-right"><a
						data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="false"
						class="btn btn-danger btn-rounded"><i class="fa fa-shopping-cart"></i> 下单</a>
				</span></h3>
			</div>
			<div class="panel-body">
				<!--注意事项-->
				<div id="demo-acc-faq" class="panel-group accordion"><div class="panel panel-trans pad-top"><a href="#demo-acc-faq1" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">为什么下单很久了都没有开始刷呢？</a><div id="demo-acc-faq1" class="mar-ver collapse in">由于本站采用全自动订单处理，难免会出现漏单，部分单子处理时间可能会稍长一点，不过都会完成，最终解释权归本站所有。超过24小时没处理请联系客服！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq2" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">空间人气下单方法讲解</a><div id="demo-acc-faq2" class="mar-ver collapse">1.下单前：空间必须是所有人可访问,必须自带1~4条原创说说!<br>2.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq3" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">说说赞相关下单方法讲解</a><div id="demo-acc-faq3" class="mar-ver collapse">1.下单前：空间必须是所有人可访问,必须自带1条原创说说!转发的说说不能刷！<br>2.在“QQ号码”栏目输入QQ号码，点击下面的获取说说ID并选择你需要刷的说说的ID，下单即可。<br>3.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq4" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">全民Ｋ歌下单方法讲解</a><div id="demo-acc-faq4" class="mar-ver collapse">1.打开你的全名k歌<br>2.复制你全名k歌里面的需要刷的歌曲链接<br>3.例如：你歌曲链接是：<font color="#ff0000">https://kg.qq.com/node/play?s= <font color="green">881Zbk8aCfIwA8U3</font> &g_f=personal</font><br>4.然后把s=后面的 <font color="green">881Zbk8aCfIwA8U3</font> 链接填入到歌曲ID里面，然后提交购买。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq5" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">快手代刷下单方法讲解</a><div id="demo-acc-faq5" class="mar-ver collapse">1.需要填写用户ID和作品ID，比如<font color="#ff0000">http://www.kuaishou.com/i/photo/lwx?userId= <font color="green">294200023</font> &photoId= <font color="green">1071823418</font></font> (分享作品就可以看到“复制链接”了)<br>2.用户ID就是 <font color="green">294200023</font> 作品ID就是 <font color="green">1071823418</font> ，然后在分别把用户ID和作品ID填上，请勿把两个选项填反了，不给予补单！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq6" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">Q会员/钻下单方法讲解</a><div id="demo-acc-faq6" class="mar-ver collapse">1.下单之前，先确认输的信息是不是正确的，如果密码输错，那就刷不了了，没到账之前不要改密码<br>2.Q会员/钻因为需要人工处理，所以每天不定时开刷，24小时-48小时内到账！</div></div></div>                </div>
		</div>
	</div>
</div>

<div class="row" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
	<div class="col-lg-6">
	<div class="panel panel-success panel-colorful">
			<div class="pad-all media">
				<div class="media-left">
					<i class="demo-pli-coin icon-3x icon-fw"></i>
				</div>
				<div class="media-body">
					<p class="h3 text-light mar-no media-heading"><span id="count_money"></span>元</p>
					<span>累计交易金额</span>
				</div>
			</div>
			<div class="progress progress-xs progress-success mar-no">
				<div class="progress-bar progress-bar-light" style="width: 100%"></div>
			</div>
			<div class="pad-all text-sm">
				今天交易金额 <span class="text-semibold" id="count_money1"></span> 元
			</div>
		</div>
	</div>
	<div class="col-lg-6">
	<div class="panel panel-info panel-colorful">
			<div class="pad-all media">
				<div class="media-left">
					<i class="demo-pli-add-cart icon-3x icon-fw"></i>
				</div>
				<div class="media-body">
					<p class="h3 text-light mar-no media-heading"><span id="count_orders"></span>条</p>
					<span>累计订单总数</span>
				</div>
			</div>
			<div class="progress progress-xs progress-dark-base mar-no">
				<div class="progress-bar progress-bar-light" style="width: 100%"></div>
			</div>
			<div class="pad-all text-sm bg-trans-dark">
				今天订单总数 <span class="text-semibold" id="count_orders2"></span> 条
			</div>
		</div>
	</div>
</div>

<div class="panel panel-danger" <?php if($conf['bottom']==''){?>style="display:none;"<?php }?>>
<div class="panel-heading"><h3 class="panel-title"><font color="#fff"><i class="fa fa-skyatlas"></i>&nbsp;&nbsp;<b>站点助手</b></font></h3></div>
<?php echo $conf['bottom']?>
</div>
</div>

</div>
<!--音乐代码-->
<div id="audio-play" <?php if(empty($conf['musicurl'])){?>style="display:none;"<?php }?>>
  <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
    <audio loop="loop" src="<?php echo $conf['musicurl']?>" id="media" preload="preload"></audio>
  </div>
</div>
<!--音乐代码-->

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
});
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<script src="assets/js/snow.js"></script>
</body>
</html>