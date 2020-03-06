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
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/plugins.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/main.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css"> 
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
  <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
*{ 
	cursor:url(https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.2/cursor.ico),auto;
}
.shuaibi-tip {
    background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    margin: 20px 0px;
    padding: 15px;
    border-radius: 5px;
    font-size: 14px;
    color: #555555;
}
</style>
</head>
<body>
<img style="background: linear-gradient(to right,#49BDAD,#f2b9ca);color:#000;" class="full-bg full-bg-bottom" ondragstart="return false;" oncontextmenu="return false;">
<br>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
  <!--弹出公告--> 
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header-tabs">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
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
<!--弹出公告-->

<!--平台公告开始-->
<div class="modal fade" align="left" id="anounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:linear-gradient(120deg, #31B404 0%, #D7DF01 100%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff"><?php echo $conf['sitename']?></font></b></h4></center>  
      </div><div class="widget flat radius-bordered"> 
        <div class="widget-header bordered-top bordered-themesecondary"> <div class="modal-body">
           <?php echo $conf['anounce']?></div></div></div>  
         <div class="modal-footer">  
        <button type="button" class="btn btn-default" data-dismiss="modal">我明白了</button>     
      </div>     
    </div>     
  </div>    
 </div>  
<!--公告-->
<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
      </div>
      	<li class="list-group-item"><font color="red">请在右侧的输入框内输入您购买时，在第一个输入框内填写的信息</font></li>
      	<li class="list-group-item">例如您购买的是签到萌宠机器人月卡，输入主人QQ号即可查询订单</li>
      	<li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
      	<li class="list-group-item">例如您购买的是服务器商品，需要输入您留下的QQ号</li>
      	<li class="list-group-item"><font color="red">如果您还是不知道如何填写，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我明白了</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明结束-->
<div class="widget">
<!--logo-->
    <div class="widget-content themed-background-flat text-center" style="background-image:url(assets/simple/img/head2.png);background-size: 100% 100%;">
        <a href="javascript:void(0)">
			<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="Avatar" width="80" style="height: auto filter: alpha(Opacity=80);-moz-opacity: 0.80;opacity: 0.80;" class="img-circle img-thumbnail img-thumbnail-avatar-1x animated zoomInDown">
        </a>
    </div>
<!--logo-->
   <center>
<h2>     <a href="javascript:void(alert('<?php echo $conf['sitename']?>，建议收藏到浏览器书签哦！'));"><b><?php echo $conf['sitename']?></b></a></h2>
</center>
<!--logo下面按钮-->
	<div class="widget-content text-center">
		<div class="text-center text-muted">
			<div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <a class="btn btn-default" data-toggle="modal" href="#anounce"><i class="fa fa-wifi"></i> <span style="font-weight:bold"> 平台公告</span></a>
                </div>
                <div class="btn-group">
                      <a class="btn btn-default" data-toggle="modal" href="/sqz"><font color="#ff0000"><i class="fa fa-bolt"></i> 授权正版查询</font></a>
                </div>
            </div>
		</div>
	</div>
	
<!--logo下面按钮-->
<!--免费拉圈-->
<div class="modal fade" align="left" id="circles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">免费拉圈圈99+</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required="">
			</div>
		</div>
		<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
		<div id="result3" class="form-group text-center" style="display:none;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--免费拉圈-->
</div>
<div class="block full2">
<!--TAB标签开始-->
	<div class="block-title">
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li style="width: 25%;" align="center" class="active"><a href="#shop"><i class="fa fa-shopping-cart"></i> <b>购买</b></a></li>
            <li style="width: 25%;" align="center" class=""><a href="#search" id="tab-query"><i class="fa fa-search"></i> <b>查询</b></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['fenzhan_buy']==0){?>class="hide"<?php }?>><a href="#Substation"><font color="#FF4000"><i class="fa fa-location-arrow fa-spin"></i> <b>分站</b></font></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['gift_open']==0||$conf['fenzhan_buy']==1){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-gift fa-fw"></i> 抽奖</span></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['iskami']==0||$conf['fenzhan_buy']==1||$conf['gift_open']==1){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab"><span style="font-weight:bold"><i class="glyphicon glyphicon-th"></i> 卡密</span></a></li>
            <li style="width: 25%;" align="center" class=""><a href="#more"><i class="fa fa-list"></i> <b>更多</b></a></li>
					
</ul>
    </div>
<!--TAB标签结束-->
    <div class="tab-content">
<!--在线下单-->
    <div class="tab-pane active" id="shop">
       <center><div class="shuaibi-tip animated tada  text-center"><i class="fa fa-heart text-danger"></i> <b>［<?=date("m月d号")?>］最新业务通知&nbsp;<a href="#anounce" data-toggle="modal" class="label label-danger"><font color="#FFFFFF">点击查看</font></a></b></div></center> 
<?php include TEMPLATE_ROOT.'default/shop.inc.php'; ?>
	</div>
<!--在线下单-->
<!--查询订单-->
    <div class="tab-pane" id="search">
              <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
         <tbody>
            <tr class="shuaibi-tip animation-bigEntrance">
                <td class="text-center" style="width: 100px;">
                    <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
                </td>
                <td>
                    <h4><strong>签到萌宠机器人官网客服</strong></h4>
					<i class="fa fa-fw fa-qq text-primary"></i> <?php echo $conf['kfqq'] ?><br><i class="fa fa-fw fa-history text-danger"></i>售后订单问题请联系客服
                </td>
                <td class="text-right" style="width: 20%;">
                    <a href="#lxkf" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系</a>
                </td>
            </tr>
         </tbody>
        </table>
		<br>
		<div class="col-xs-12 well well-sm animation-pullUp" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>>
			<?php echo $conf['gg_search']?>
		</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-btn">
						<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px"><option value="0">购买账号</option><option value="1">订单号</option></select>
					</div>
					<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required="">
					<span class="input-group-btn"><a href="#cxsm" target="_blank" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
				</div>
			</div>		
			<input type="submit" id="submit_query" class="btn btn-primary btn-block btn-rounded" style="background: linear-gradient(to right,#87CEFA,#6495ED);color:#fff;" value="立即查询">		
            <br>
			<div id="result2" class="form-group" style="display:none;">
              <center><small><font color="#ff0000">手机用户可以左右滑动哦~</font></small></center>
				<div class="table-responsive">
					<table class="table table-vcenter table-condensed table-striped">
					<thead><tr><th>购买账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
					<tbody id="list">
					</tbody>
					</table>
				</div>
			</div>
   </div> 
<!--查询订单-->
<!--开通分站开始-->
<div class="tab-pane animation-fadeInQuick2" id="Substation">
<table class="table table-borderless table-pricing">
            <tbody>
                <tr class="active">
                    <td class="btn-effect-ripple" style="overflow: hidden; position: relative;width: 100%; height: 8em;display: block;color: white;margin: auto;background-color: lightskyblue;"><span class="btn-ripple animate" style="height: 546px; width: 546px; top: -212.8px; left: 56.4px;"></span>
                       <h3 style="width:100%;font-size: 1.6em;">
 </h3><h3 style="width:100%;font-size: 1.6em;">
                       <i class="fa fa-user-o fa-fw" style="margin-top: 0.7em;"></i><strong>入门级</strong> /<i class="fa fa-user-circle-o fa-fw"></i><strong>旗舰级</strong>
                       </h3>
                       <span style="width: 100%;text-align: center;margin-top: 0.8em;font-size: 1.1em;display: block;"><?php echo $conf['fenzhan_price']?>元 / <?php echo $conf['fenzhan_price2']?>元</span></td>
                </tr>
                <tr>
                    <td>一模一样的独立网站</td>
                </tr>
				<tr>
                    <td>站长后台和超低秘价</td>
                </tr>
              	<tr>
                    <td>余额提成满<?php echo $conf['tixian_min']; ?>元提现</td>
                </tr>
                <tr>
                    <td><strong>旗舰级可以吃下级分站提成</strong></td>
                </tr>
                <tr class="active">
                    <td>
						<a href="#userjs" data-toggle="modal" class="btn btn-effect-ripple  btn-info" style="overflow: hidden; position: relative;"><i class="fa fa-align-justify"></i><span class="btn-ripple animate" style="height: 100px; width: 100px; top: -24.8px; left: 11.05px;"></span> 版本介绍</a>
                        <a href="user/regsite.php" target="_blank" class="btn btn-effect-ripple  btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-arrow-right"></i> 马上开通</a>
                    </td>
                </tr>
            </tbody>
        </table>
    
	</div>
<!--开通分站结束-->
<!--抽奖-->
    <div class="tab-pane" id="gift">
		<div class="panel-body text-center">
		<div id="roll">点击下方按钮开始抽奖</div>
		<hr>
		<p>
		<a class="btn btn-info" id="start" style="display:block;">开始抽奖</a>
		<a class="btn btn-danger" id="stop" style="display:none;">停止</a>
		</p> 
		<div id="result"></div><br>
		<div class="giftlist" style="display:none;"><strong>最近中奖记录</strong><ul id="pst_1"></ul></div>
		</div>
	</div>
<!--抽奖-->
 <!--更多按钮开始-->
<div class="tab-pane" id="more">
    <div class="row">
		<div class="col-sm-6<?php if($conf['gift_open']==0){?> hide<?php }?>">
            <a href="#gift" data-toggle="tab" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-gift"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>抽奖</strong>
                    </h2>
                    <span>在线抽奖领取免费商品</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6<?php if(empty($conf['appurl']) || $conf['gift_open']==1){?> hide<?php }?>">
            <a href="<?php echo $conf['appurl']; ?>" target="_blank" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>APP下载</strong>
                    </h2>
                    <span>下载APP，下单更方便</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6<?php if(empty($conf['invite_tid'])){?> hide<?php }?>">
            <a  href="./?mod=invite" target="_blank" class="widget">
                <div class="widget-content themed-background-warning text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-paper-plane-o"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>免费领赞</strong>
                    </h2>
                    <span>推广本站免费领取名片赞</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6<?php if(empty($conf['lqqapi'])){?> hide<?php }?>">
            <a data-toggle="modal" href="#circles" class="widget">
                <div class="widget-content themed-background-success text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-circle-o"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>免费拉圈</strong>
                    </h2>
                    <span>免费拉圈圈99+</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6<?php if(empty($conf['chatframe'])){?> hide<?php }?>">
            <a href="#chat" data-toggle="tab" class="widget">
                <div class="widget-content themed-background-danger text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-comments"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>在线聊天</strong>
                    </h2>
                    <span>你我更亲近</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6<?php if($conf['iskami']==0){?> hide<?php }?>">
            <a href="#cardbuy" data-toggle="tab" class="widget">
                <div class="widget-content themed-background-warning text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>卡密下单</strong>
                    </h2>
                    <span>卡密下单方便快捷</span>
                </div>
            </a>
        </div>
<!--		<div class="col-sm-6">
            <a  href="./user/" target="_blank" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>分站后台</strong>
                    </h2>
                    <span>登录分站后台</span>
                </div>
            </a>
        </div>
-->

		<div class="col-sm-6">
            <a  href="/sqz" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>官方授权站</strong>
                    </h2>
                    <span>查询授权是否正版</span>
                </div>
            </a>
        </div>




		<div class="col-sm-6">
            <a  href="/" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>我们的官网</strong>
                    </h2>
                    <span>让您了解我们</span>
                </div>
            </a>
        </div>



		<div class="col-sm-6">
            <a  href="http://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes" target="_blank" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>联系我们</strong>
                    </h2>
                    <span>不要问在不在，直接问问题</span>
                </div>
            </a>
        </div>



	</div>
</div>
<!--更多按钮结束-->
<!--卡密下单-->
    <div class="tab-pane" id="cardbuy">
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
		<div id="km_alert_frame" class="alert alert-success animation-pullUp" style="display:none;font-weight: bold;"></div>
		<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
		<div id="result1" class="form-group text-center" style="display:none;">
		</div>
		</div>
		<br />
	</div>
<!--卡密下单-->
<!--聊天-->
    <div class="tab-pane" id="chat">
		<?php echo $conf['chatframe']?>
	</div>
<!--聊天-->
</div>
</div>

<div class="panel panel-primary" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
<div class="panel-heading"><h3 class="panel-title"><font color="#000000"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;<b>数据统计</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
<td align="center">
<font size="2"><span id="count_yxts"></span>天<br><font color="#65b1c9"><i class="fa fa-shield fa-2x"></i></font><br>安全运营</font></td>
<td align="center"><font size="2"><span id="count_money"></span>元<br><font color="#65b1c9"><i class="fa fa-shopping-cart fa-2x"></i></font><br>交易总数</font></td>
<td align="center"><font size="2"><span id="count_orders"></span>笔<br><font color="#65b1c9"><i class="fa fa-check-square-o fa-2x"></i></font><br>订单总数</font></td>
</tr>
<tr>
<td align="center"><font size="2"><span id="count_site"></span>个<br><font color="#65b1c9"><i class="fa fa-sitemap fa-2x"></i></font><br>代理分站</font></td>
<td align="center"><font size="2"><span id="count_money1"></span>元<br><font color="#65b1c9"><i class="fa fa-pie-chart fa-2x"></i></font><br>今日交易</font></td>
<td align="center"><font size="2"><span id="count_orders2"></span>笔<br><font color="#65b1c9"><i class="fa fa-check-square fa-2x"></i></font><br>今日订单</font></td>
</tr>
</tbody>
</table>
</div>

    <!--底部导航-->
    <div class="panel panel-default">
        <center>
            <div class="panel-body"><span style="font-weight:bold"><?php echo $conf['sitename'] ?> <i class="fa fa-heart text-danger"></i> 2019 | </span> </span><a href="./"><span style="font-weight:bold"><?php echo $_SERVER['HTTP_HOST']?></span></a>
            </div>
    </div>
    <!--底部导航-->
</div>

 <!--客服介绍开始-->
<div class="modal fade col-xs-12" align="left" id="lxkf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  <br>  <br>  
  <div class="modal-dialog panel panel-primary  animation-fadeInQuick2">
    <div class="modal-content">
         <div class="list-group-item reed" style="background:linear-gradient(120deg, #5ED1D7 10%, #71D7A2 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">常见问题</font></b></h4></center></div>
        <div class="modal-body">
 <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="false" class="collapsed">买了之后怎么发货？</a>
                            </h4>
                        </div>
                        <div id="collapseOne1" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
                            <div class="panel-body">
                               1.请您购买后联系客服QQ：2924070927<br>
                               2.购买后请在三天内联系!否则您的订单将作废处理！
                            </div>
                        </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" class="collapsed" aria-expanded="false">买了插件授权后怎么使用？</a>
                            </h4>
                        </div>
                        <div id="collapseTwo2" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
                            <div class="panel-body">
                                1.插件是需要运行在服务器里的，请您自备服务器或在本站购买服务器！<br>
                                2.插件无需安装，从我们的官方仓库下载机器人到您的服务器上解压后即可正常使用！
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree3" class="collapsed" aria-expanded="false">加客服好友一直没同意怎么办？</a>
                            </h4>
                        </div>
                        <div id="collapseThree3" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
                            <div class="panel-body">
                                1.可能客服在忙！我们看到了就会同意！如果超过三天还没同意您的申请请您加入我们的官方QQ群，每天大约有十个管理在线，会有人同意您的进群申请的！<br>
								2.加入官方QQ群：<a href="https://jq.qq.com/?_wv=1027&k=5PG66lp" target=_blank>826967547</a><br>
								3.之前加客服好友但一直没被通过，过了三天才联系到我们，订单还有效码？当然有！我们会看您的申请好友时间，然后核实您的下单时间，如果申请好友时间离下单时间不超过3天的话，您的订单就正常发货！
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix7" class="collapsed" aria-expanded="false">服务器不会用怎么办？</a>
                            </h4>
                        </div>
                        <div id="collapseSix7" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
                            <div class="panel-body">
                                1.可以联系我们的官方客服咨询<br>
								2.可以百度、Google自行搜索如何连接服务器！
                            </div>
                        </div>
                    </div>
</div>
	
	<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
         <tbody>
            <tr class="animation-fadeInQuick2">
               </tr></tbody>
        <tbody>
                    <tr class="shuaibi-tip animation-fadeInQuick2">
                        <td class="text-center" style="width: 100px;">
                            <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
                        </td>
                        <td>
                            <h5><strong>签到萌宠机器人官网客服</strong></h5>
                        </td>
                        <td class="text-right" style="width: 20%;">
                            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['kfqq']?>&amp;site=qq&amp;menu=yes" target="_blank" class="btn btn-sm btn-info">咨询</a>
                </td> 
            </tr>
         </tbody>
        </table>
        
</div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>			
</div>	
    </div>
  </div>
</div>
<!--联系客服结束-->
    <!--商品推荐开始-->
<div class="modal fade" align="left" id="recommend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
      <div class="modal-header" style="background:linear-gradient(120deg, #0174DF 30%, #DF01D7 70%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">商品推荐</font></b></h4></center>  
</div>
<br>
<?php
if($islogin2==1){
	$price_obj = new Price($userrow['zid'],$userrow);
}elseif($is_fenzhan == true){
	$price_obj = new Price($siterow['zid'],$siterow);
}else{
	$price_obj = new Price(1);
}

$rs=$DB->query("select * from shua_tools where cid=0 and active=1 order by sort asc");
while($row = $DB->fetch($rs)){
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
	if(isset($price_obj)){
		$price_obj->setToolInfo($row['tid'],$res);
		if($price_obj->getToolDel($row['tid'])==1)continue;
		$price=$price_obj->getToolPrice($row['tid']);
	}else $price=$row['price'];
?>
<div class="col-xs-6 col-sm-3 col-md-4 layui-anim layui-anim-scaleSpring" data-anim="layui-anim-upbit">
      <a href="javascript:void(0)" onclick="toTool(<?php echo $row["cid"]?>,<?php echo $row["tid"]?>)">
<div class="thumbnail" style="height:138px;">
        <center style="margin-top:5%;">
         <img src="<?php echo $productimg?>" width="30" height="30" style="border-radius: 10px">
         <hr class="layui-bg-blue" style="width:80%"><?php echo $row["name"]?>
<br>
         <font color="red">[￥<?php echo $price?>元 ]</font>
        </center>
</div>
</a>
</div>
<?php }?>
<table class="table table-bordered table-striped">
<tbody>
<tr>
</tr>
</tbody>
</table>
<div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
</div>
</div>
</div>
<!--商品推荐结束-->
     <!--球球大作战-->
<div class="modal fade" align="left" id="qqdzz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
    <div class="modal-content">
         <div class="list-group-item reed" style="background:linear-gradient(120deg, #5ED1D7 10%, #71D7A2 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">数量要求</font></b></h4></center>
      </div>	  
      <br> 
  <div class="modal-body"><center>
<p class="bg-primary" style="background-color:#424242;padding: 10px;">
球球粉丝<br>固定数量:100,200,400,800,<br>1000,2000,4000,8000,10000,20000 </p>
    <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
球球爱心<br>固定数量:1000,2000,4000,<br>8000,10000,20000,40000,80000</p></center>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
     </div>
    </div>
   </div>
  </div>
 </div>
<!--球球大作战-->

      <!--全民K歌-->
<div class="modal fade" align="left" id="qmkg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
    <div class="modal-content">
         <div class="list-group-item reed" style="background:linear-gradient(120deg, #DF01A5 10%, #FF0080 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">经验上限表</font></b></h4></center>
      </div>	  
  <div class="modal-body"><center>
<p class="bg-primary" style="background-color:#424242;padding: 10px;">
0-6级： 每天可获得1000点经验 </p>
    <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
7-9级： 每天可获得1500点经验</p>
    <p class="bg-primary" style="background-color:#0404B4;padding: 10px;">
10-12级：每天可获得3500点经验 </p>
<p class="bg-primary" style="background-color:#FF8000;padding: 10px;">
13-15级：每天可获得26000点经验</p>
<p class="bg-primary" style="background-color:#04B431;padding: 10px;">
16-18级：每天可获得45000点经验</p></center>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
     </div>
    </div>
   </div>
  </div>
 </div>
<!--全民K歌-->
      <!--面值-->
<div class="modal fade" align="left" id="spmz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
    <div class="modal-content">
         <div class="list-group-item reed" style="background:linear-gradient(120deg, #0000FF 10%, #FE2EF7 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">选择数量</font></b></h4></center>
      </div>	  
      <br> 
      <center>  
      <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
	  <font color="red"> 数量就是要买的多少份！</font></center>
	 <hr>  <div class="modal-body">
<p class="bg-primary" style="background-color:#424242;padding: 10px;">
例如：1000名片赞，选5份就是5000名片赞！</p>
    <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
技巧：数量可以直接输入，比如直接输100！</p>   </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
     </div>
    </div>
  </div>
 </div>
<!--面值-->
  <!--分站介绍开始-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
		         <div class="list-group-item reed" style="background:linear-gradient(120deg, #FE2EF7 10%, #71D7A2 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">版本介绍</font></b></h4></center>
		</div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>独立网站/专属后台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>低价拿货/调整价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>搭建分站/管理分站</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>超低密价/高额提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送官方APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--分站介绍结束-->
  
        <!--钻类-->
<div class="modal fade" align="left" id="zlsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
    <div class="modal-content">
         <div class="list-group-item reed" style="background:linear-gradient(120deg, #0000FF 10%, #FE2EF7 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">钻类介绍</font></b></h4></center>
      </div>	  
      <br> 
  <div class="modal-body">
<p class="bg-primary" style="background-color:#04B45F;padding: 10px;">
问题：什么是质保期，理论永久是什么？</p>
 <p class="bg-primary" style="background-color:#A8904B1;padding: 10px;">
质保：理论永久，每个人用的时间都不一样，质保期就像家电的保修期一样，有问题可以联系客服处理哦！</p>     </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
     </div>
   </div>
  </div>
 </div>
<!--面值-->
  
  <!--份数说明-->
<div class="modal fade" id="tisk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:#FFD700;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">下单时显示的“份数”是什么</font></b></h4></center>
     </div>  
            <br> 
      <center>
      <font color="red">下单东西的面值×份数=下单份数（份数默认为1）</font>
      <hr>
       例如您购买：100个快手粉丝<br>下单份数选5，就是总共会获得500个粉丝
      <hr>
       例如您购买：1000个QQ名片赞<br>下单份数选3，就是总共会获得3000个名片赞 
      <hr>
      例如您购买：1000个全民K歌粉丝<br>下单份数选10，就是总共会获得10000个粉丝
      <hr>
      <font color="red">以此类推 本站其他东西都是如此，希望给您最好的购物体验</font>
      <br> 
      </center>
         <div class="modal-footer" style="background-color: white;">
      <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
     </div>
        </div>
    </div>
</div>
<!--份数说明-->

<div class="modal fade" align="left" id="ptyetz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="list-group-item reed" style="background:linear-gradient(120deg, #FF8000 10%, #FF8000 90%);">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
    <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">最新业务状态</font></b></h4></center>
		</div>
              <div style="overflow:scroll; overflow-x:hidden;">
				 <div class="modal-body">
                     	<?php echo $conf['anounce']?>
                    </div>
				</div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
    </div>
  </div>
</div>
</div>
</center></div></div>
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