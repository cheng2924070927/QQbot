<?php
if(!defined('IN_CRONLITE'))exit();
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
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/appui/css/main.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/appui/css/themes.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
  <link rel="stylesheet" href="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<!--隐藏<div id="page-wrapper" class="page-loading">
            <div class="preloader">
                <div class="inner">
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>加载-->
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

	<div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
		<div id="sidebar">
			<div id="sidebar-brand" class="themed-background">
				<a href="index.php" class="sidebar-title"> <i class="fa fa-qq"></i>
					<span class="sidebar-nav-mini-hide"><?php echo $conf['sitename']?></span>
				</a>
			</div>
			<div id="sidebar-scroll">
				<div class="sidebar-content">
					<ul class="sidebar-nav">
						<li><a href="/" class=" active"><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">网站首页</span></a></li>
						<?php if($conf['fenzhan_buy']==1){?>
						<li><a href="./user/regsite.php"><i class="fa fa-star sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">开通分站</span></a></li>
						<?php }?>
						<li><a href="./user/"><i class="fa fa-lock sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">后台登入</span></a></li>
						<?php if(!empty($conf['invite_tid'])){?>
						<li><a target="_blank" href="./?mod=invite"><i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">推广中心</span></a></li>
						<?php }?>
						<?php if(!empty($conf['appurl'])){?>
						<li><a target="_blank" href="<?php echo $conf['appurl']; ?>"><i class="fa fa-android sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">APP下载</span></a></li>
						<?php }?>
						<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['kfqq']?>&amp;site=qq&amp;menu=yes"><i class="fa fa-qq sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">客服QQ</span></a></li>		
					</ul>
				</div>
			</div>
			<div id="sidebar-extra-info"
				class="sidebar-content sidebar-nav-mini-hide">
				<div class="text-center">
					<small>2019 <i class="fa fa-heart text-danger"></i> <a href="./"> <?php echo $conf['sitename']?></a></small><br>
					
				</div>
			</div>
		</div>
		<div id="main-container">
			<header class="navbar navbar-inverse navbar-fixed-top">
				<ul class="nav navbar-nav-custom">
					<li><a href="javascript:void(0)"
						onclick="App.sidebar('toggle-sidebar');this.blur();"> <i
							class="fa fa-ellipsis-v fa-fw animation-fadeInRight"
							id="sidebar-toggle-mini"></i> <i
							class="fa fa-bars fa-fw animation-fadeInRight"
							id="sidebar-toggle-full"></i> 菜单
					</a></li>
				</ul>
				<ul class="nav navbar-nav-custom pull-right">
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo ($islogin2==1)?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>" alt="avatar">
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
						<?php if($islogin2==1){?>
							<li class="dropdown-header text-center">
								<strong><?php echo $userrow['user']?></strong>
							</li>
							<li>
								<a href="./user/">
								<i class="fa fa-user fa-fw pull-right"></i>
								用户中心
								</a>
							</li>
							<li>
								<a href="./user/uset.php?mod=user">
								<i class="fa fa-pencil-square fa-fw pull-right"></i>
								密码修改
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="./user/login.php?logout">
								<i class="fa fa-power-off fa-fw pull-right"></i>
								退出登录
								</a>
							</li>
						<?php }else{?>
							<li class="dropdown-header text-center">
								<strong>未登录</strong>
							</li>
							<li>
								<a href="./user/login.php">
								<i class="fa fa-user fa-fw pull-right"></i>
								登录
								</a>
							</li>
							<li>
								<a href="./user/reg.php">
								<i class="fa fa-plus-circle fa-fw pull-right"></i>
								注册
								</a>
							</li>
						<?php }?>
						</ul>
					</li>
				</ul>
			</header>

			<div id="page-content">
				<div class="row">
					<div class="col-sm-6">
						<div class="block">
							<div class="block-title">
								<h4>
									<i class="fa fa-bullhorn"></i>&nbsp;站点公告
								</h4>
							</div>
							<?php echo $conf['anounce']?>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="block">
							<div class="block-title">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#onlinebuy" data-toggle="tab"><i class="fa fa-check-square-o"></i>&nbsp;在线下单</a></li>
									<li <?php if($conf['iskami']==0){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab"><i class="fa fa-money"></i>&nbsp;卡密下单</a></li>
									<li><a href="#query" data-toggle="tab" id="tab-query"><i class="fa fa-search"></i>&nbsp;查询订单</a></li>
									<li <?php if(empty($conf['lqqapi'])){?>class="hide"<?php }?>><a href="#lqq" data-toggle="tab"><i class="fa fa-dot-circle-o"></i>&nbsp;圈圈赞</a></li>
									<li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><i class="fa fa-gift"></i> 抽奖</a></li>
									<li <?php if(empty($conf['chatframe'])){?>class="hide"<?php }?>><a href="#chat" data-toggle="tab"><i class="fa fa-comments"></i>&nbsp;聊天</a></li>
								</ul>
							</div>
		<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="onlinebuy">
<?php include TEMPLATE_ROOT.'default/shop.inc.php'; ?>
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
			<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密"><br />
			<div id="km_show_frame" style="display:none;">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品名称</div>
				<input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买"><br />
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
			</div>
		</div>
		<div class="tab-pane fade in" id="query">
			<div class="alert alert-info" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-btn">
					<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px"><option value="0">下单账号</option><option value="1">订单号</option></select>
				</div>
				<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
				<span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
			</div></div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询"><br />
			<div id="result2" class="form-group" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane fade in" id="lqq">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
			</div></div>
			<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交"><br />
			<div id="result3" class="form-group text-center" style="display:none;"></div>
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
		<div class="tab-pane fade in" id="chat">
			<?php echo $conf['chatframe']?>
		</div>
		</div>
	</div>
</div>
</div>

				<div class="row" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
					<div class="col-sm-6 col-lg-3">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background">
									<i class="fa fa-calendar text-light-op"></i>
								</div>
								<h2 class="widget-heading h3">
									<strong><span data-toggle="counter" data-to="" id="count_yxts"></span>天</strong>
								</h2>
								<span class="text-muted">平台运营</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-success">
									<i class="fa fa-cart-plus text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-success">
									<strong><span data-toggle="counter" id="count_orders"></span>条</strong>
								</h2>
								<span class="text-muted">订单总数</span>
							</div>
						</a>
					</div>
					
					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-success">
									<i class="fa fa-cart-plus text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-success">
									<strong><span data-toggle="counter" id="count_orders1">3</span>条</strong>
								</h2>
								<span class="text-muted">处理订单</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-warning">
									<i class="fa fa-money text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-warning">
									<strong><span data-toggle="counter" id="count_money1"></span>元</strong>
								</h2>
								<span class="text-muted">今日交易</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-3">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-danger">
									<i class="fa fa-clock-o text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-danger">
									<strong><span><label id="timeShow"></lable></span></strong>
								</h2>
								<span class="text-muted">当前时间</span>
							</div>
						</a>
					</div>
				</div>

				<div class="block full">
					<div class="block-title">
						<h2>
							<i class="fa fa-chain"></i>&nbsp;友情链接
						</h2>
					</div>
					<div class="row headings-container">
					<?php echo $conf['bottom']?>
					</div>
				</div>
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
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
<!-- DT Time -->
<script language="javascript">
	var t = null;
	t = setTimeout(time,1000);
	function time()
	{
	   clearTimeout(t);
	   dt = new Date();
	   var h=dt.getHours();
	   var m=dt.getMinutes();
	   var s=dt.getSeconds();
	   document.getElementById("timeShow").innerHTML = h+":"+m+":"+s;
	   t = setTimeout(time,1000);             
	} 
</script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
});
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>