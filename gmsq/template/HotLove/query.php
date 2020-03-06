<?php
if(!defined('IN_CRONLITE'))exit();
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

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
</head>

<body style="background:url(<?php echo $background_image?>) fixed">
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
<li class="" onclick="activeselect(this)"><a href="./"><i class="layui-icon layui-icon-cart"></i> 在线下单</a></li>
<li class="active" onclick="activeselect(this)"><a href="./?mod=query"><i class="layui-icon layui-icon-search"></i> 订单查询</a></li>
<li class="" onclick="activeselect(this)"><a href="./user/regsite.php" pjax="no"><i class="layui-icon layui-icon-website"></i> 网站搭建</a></li>
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

<div class="col-md-auto box">
<div class="panel layui-anim layui-anim-scaleSpring">
<div class="panel-heading text-center panel-headcolor-pink" id="panel-heading">
<font color="#fff">订单完成情况查询</font>
</div>
<div class="panel-body">
<div class="layui-row">
<div class="layui-col-md12">
<table class="table table-bordered">
<tbody>
<tr>
<td align="center">
<font color="blue"><b>客服: 订单客服</b></font>
<img src="//www.sogou.com/images/vr/service/auth.gif" title="正版认证">
<br>
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&amp;spec=100" alt="Avatar" width="50" height="50" class="qqimg"><br>
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" class="btn btn-info btn-xs">QQ：<?php echo $conf['kfqq']?></a><br>
</td>
</tr>
</tbody>
</table>
</div>
<div class="layui-col-md12">
<?php echo $conf['gg_search']?>
</div>
</div>
<hr class="layui-bg-blue">
<div class="layui-form layui-form-pane">
<div class="layui-form-item">
<div class="input-group">
<div class="input-group-btn" style="width:100px">
	<select class="layui-input" id="searchtype" style="padding: 6px 4px;"><option value="0">下单账号</option><option value="1">订单号</option></select>
</div>
<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="layui-input" placeholder="请输入下单账号（留空则根据浏览器缓存查询）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
<span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="layui-btn layui-btn-danger"><i class="layui-icon layui-icon-help"></i></a></span>
</div>
</div>
</div>
<button type="submit" id="submit_query" class="layui-btn layui-btn-primary btn-block">立即查询</button>
<hr>
<div id="result2" class="form-group" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
</div>
</div>
</div>
</div>

<script src="<?php echo $cdnserver?>assets/js/layui.all.js"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/HotLove.js?ver=<?php echo VERSION ?>"></script>
</div>
</div>
</div>
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