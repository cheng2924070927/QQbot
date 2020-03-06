<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1){include_once TEMPLATE_ROOT.'HotLove/query.php';exit;}

$classhide = explode(',',$siterow['class']);
$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">请选择分类</option>';
while($res = $DB->fetch($rs)){
	if($is_fenzhan && in_array($res['cid'], $classhide))continue;
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
?>
<!DOCTYPE html>
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
<meta name="keywords" content="<?php echo $conf['keywords']?>">
<meta name="description" content="<?php echo $conf['description']?>">
<link href="<?php echo $cdnserver?>assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo $cdnserver?>assets/css/layui.css" rel="stylesheet"/>
<link href="<?php echo $cdnserver?>assets/css/global.css" rel="stylesheet"/>
<style>
#audio-play #audio-btn{width: 44px;height: 44px; background-size: 100% 100%;position:fixed;bottom:5%;right:6px;z-index:111;}
#audio-play .on{background: url('assets/img/music_on.png') no-repeat 0 0;-webkit-animation: rotating 1.2s linear infinite;animation: rotating 1.2s linear infinite;}
#audio-play .off{background:url('assets/img/music_off.png') no-repeat 0 0}
@-webkit-keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}
</style>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
</head>
<body style="background:url(<?php echo $background_image?>) fixed">
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary-dark">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
	  <?php echo $conf['modal']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="shoppost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel"><font color="#000000">下单须知</font></h4>
            </div>
            <div class="modal-body"><div id="shopad"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div class="page-loading" style="display: none;">
<div id="loader"></div>
<div class="loader-section section-left"></div>
<div class="loader-section section-right"></div>
</div>
<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="sr-only">切换导航</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#" id="sitename"><?php echo $conf['sitename']?></a>
</div>
<div class="collapse navbar-collapse" id="example-navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="active" onclick="activeselect(this)"><a href="./"><i class="layui-icon layui-icon-cart"></i> 在线下单</a></li>
<li class="" onclick="activeselect(this)"><a href="./?mod=query"><i class="layui-icon layui-icon-search"></i> 订单查询</a></li>
<li class="" onclick="activeselect(this)"><a href="./user/regsite.php" pjax="no"><i class="layui-icon layui-icon-website"></i> 网站搭建</a></li>
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="layui-icon layui-icon-rate-solid"></i> 平台福利</a>
    <ul class="dropdown-menu">
         <li <?php if($conf['iskami']==0){?>style="display:none;"<?php }?>><a data-toggle="modal" data-target="#kamibuy">卡密下单</a></li>
         <li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a data-toggle="modal" data-target="#choujiang">福利抽奖</a></li>
         <li <?php if(empty($conf['invite_tid'])){?>class="hide"<?php }?>><a href="./?mod=invite" pjax="no" target="_blank">免费领赞</a></li>
    </ul>
</li>
<li class="" onclick="activeselect(this)">
<?php if($islogin2==1){?>
<a href="./user/" pjax="no"><i class="layui-icon layui-icon-username"></i> 用户中心</a>
<?php }else{?>
<a href="./user/login.php" pjax="no"><i class="layui-icon layui-icon-username"></i> 用户登录</a>
<?php }?>
</li>

</ul>
</div>
</div>
</nav>
<div class="container"> 
<div class="col-sm-10 center-block" style="float: none;">
<div id="pjaxmain">
<style>
.icon {
    font-size: 18px;
}
</style>
<div class="col-md-auto box">
<div class="panel layui-anim layui-anim-scaleSpring">
<div class="panel-body text-center">
<img src="<?php echo $logo?>">
</div>
</div>
<div class="panel layui-anim layui-anim-scaleSpring">
<div class="panel-heading text-center panel-headcolor-qq">
<font color="#fff">公告栏</font>
</div>
<div class="panel-body">
<?php echo $conf['anounce']?> 
</div>
</div>
<div class="panel layui-anim layui-anim-scaleSpring" id="display_selectclass">
<div class="panel-heading text-center panel-headcolor-pink" id="panel-heading">
<font color="#fff">24小时自助下单</font>
</div>
<center class="list-group-item" style="padding-top:0px;">
<br><b><font color="blue">注册分站下单商品价格会变低哦！</font><br>如果有问题请联系客服QQ：<?php echo $conf['kfqq']?></b><br>
<br>
<div class="btn-group btn-group-justified">
<a class="layui-btn layui-btn-normal" href="./?mod=query"><i class="layui-icon layui-icon-search"></i> 订单查询</a>
<a class="layui-btn layui-btn-danger" href="./user/regsite.php"><i class="layui-icon layui-icon-website"></i> 注册分站/赚钱</a>
</div>
</center>
	<div class="panel-body list-group-item">
	<div class="layui-form-item layui-form layui-form-pane" id="form-cid">
	<div class="layui-form-item">
	<label class="layui-form-label">业务下单</label>
	<div class="layui-input-block">
	<select name="cid" id="cid" class=""><?php echo $select?></select>
	</div></div>
	</div>
	<div id="shoplist">
			
	</div>
	</div>
</div>
	<div class="form-group" id="shopinfo" style="display:none;">
			<div class="panel panel-info">
				<div class="panel-heading text-center panel-headcolor-pink" id="panel-heading">
					<font color="#fff"><div id="selected"></div></font>
				</div>
			<div class="panel-body">
			<div id="infoshop"></div>
			<hr class="layui-bg-green">
			<div class="layui-form layui-form-pane" id="display_num" style="display:none;">
				<div class="layui-form-item">
				<label class="layui-form-label">下单份数</label>
				<div class="layui-input-block">
				<div class="input-group">
				<div class="input-group-addon" id="num_min" style="background-color: #FBFBFB;border-radius: 2px 0 0 2px;cursor: pointer;">-</div>
				<input id="num" name="num" class="layui-input" type="number" min="1" value="1"/>
				<div class="input-group-addon" id="num_add" style="background-color: #FBFBFB;border-radius: 2px 0 0 2px;cursor: pointer;">+</div>
				</div>
				</div>
				</div>
			</div>
			<div class="layui-form layui-form-pane">
				<div class="layui-form-item">
				<label class="layui-form-label">所需金额</label>
				<div class="layui-input-block">
				<input type="text" name="need" id="need" class="layui-input" disabled/>
				</div>
				</div>
			</div>
			<div class="layui-form layui-form-pane" id="display_left" style="display:none;">
				<div class="layui-form-item">
				<label class="layui-form-label">库存数量</label>
				<div class="layui-input-block">
				<input type="text" name="leftcount" id="leftcount" class="layui-input" disabled/>
				</div>
				</div>
			</div>
			<div id="inputsname"></div>
			<input type="submit" id="submit_buy" class="layui-btn layui-btn-normal btn-block" value="立即购买">
			</div>
			</div>
		</div>
<!-- 卡密下单弹框开始 -->
<div class="modal fade" id="kamibuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">卡密兑换</h4>
            </div>
            <div class="modal-body"><?php if(!empty($conf['kaurl'])){?>
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
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="km_inputname">下单ＱＱ</div>
				<input type="text" name="inputvalue" id="km_inputvalue" value="<?php echo $qq?>" class="form-control" required/>
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
			</div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!-- 卡密下单结束 -->
<!-- 抽奖弹框开始 -->
<div class="modal fade" id="choujiang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">平台抽奖</h4>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!-- 抽奖结束 -->
<div class="panel layui-anim" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
<div class="panel-heading text-center panel-headcolor-qq"><h3 class="panel-title">本站运行数据</h3></div>
<table class="table table-bordered" style="background-color:#fff;border: 1px solid #ddd;">
<tbody>
<tr>
<td align="center"><font size="2"><span id="count_yxts"></span>天<br><font color="#65b1c9"><i class="layui-icon layui-icon-date" style="font-size: 22px; color: #1E9FFF;"></i></font><br>本站运营天数</font></td>
<td align="center"><font size="2"><span id="count_orders"></span>条<br><font color="#65b1c9"><i class="layui-icon layui-icon-upload" style="font-size: 22px; color: #1E9FFF;"></i></font><br>本站订单数量</font></td>
<td align="center"><font size="2"><span id="count_orders1"></span>条<br><font color="#65b1c9"><i class="layui-icon layui-icon-vercode" style="font-size: 22px; color: #1E9FFF;"></i></font><br>已处理订单数</font></td>
<td align="center"><font size="2"><span id="count_money"></span>元<br><font color="#65b1c9"><i class="layui-icon layui-icon-rmb" style="font-size: 22px; color: #1E9FFF;"></i></font><br>累计交易金额</font></td>
</tr>
</tbody>
</table>
</div>

<div class="panel layui-anim" <?php if($conf['bottom']==''){?>style="display:none;"<?php }?>>
<div class="panel-heading text-center panel-headcolor-qq"><h3 class="panel-title">站点助手</h3></div>
<div class="panel-body">
<?php echo $conf['bottom']?> 
</div>
</div>

</div>

<script src="<?php echo $cdnserver?>assets/js/layui.all.js"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
layui.use('element', function(){
	var element = layui.element;
});
function ResumeError() {
	return true;
}
</script>
<script src="assets/js/HotLove.js?ver=<?php echo VERSION ?>"></script>
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
<script src="<?php echo $cdnserver?>assets/js/pjax.js"></script>
<script>
$(document).pjax('a[target!=_blank][pjax!=no]', '#pjaxmain', {fragment:'#pjaxmain', timeout:5000});
$(document).on('pjax:send', function () {
	$(".page-loading").css('display','block');
});
$(document).on('pjax:complete', function () {
	$("#example-navbar-collapse").removeClass('in').attr('aria-expanded',false);
	$(".page-loading").css('display','none');
});
</script>
<script type="text/javascript">
layui.use('element', function(){
	var element = layui.element;
});
function ResumeError() {
	return true;
}
</script>
</body></html>