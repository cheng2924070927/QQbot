<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8" />
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>

  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $cdnpublic?>animate.css/3.5.2/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $cdnpublic?>simple-line-icons/2.4.1/css/simple-line-icons.min.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/font.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/app.css" type="text/css" />
  <link rel="stylesheet" href="https://admin.down.swap.wang/assets/plugins/toastr/toastr.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="app app-header-fixed  ">
  <!-- header -->
  <header id="header" class="app-header navbar" role="menu">
          <!-- navbar header -->
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="/" class="navbar-brand text-lt">
         
       <i class="fa fa-qq"></i>
          <span class="hidden-folded m-l-xs"><?php echo $conf['sitename']?></span>
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->
      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
        </div>
		
        <!-- / buttons -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="<?php echo ($islogin2==1)?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>">
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md" style="text-transform:uppercase;"><?php echo $conf['sitename']?></span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
			<?php if($islogin2==1){?>
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
            <!-- / dropdown -->
			          </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->
  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>导航</span>
              </li>
              <li>
                <a href="./">
                  <i class="glyphicon glyphicon-home icon text-primary-dker"></i>
				  <b class="label bg-info pull-right">❤</b>
                  <span class="font-bold">代刷首页</span>
                </a>
              </li>
              
              <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-leaf icon text-success-lter"></i>
                  <span>管理中心</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>管理中心</span>
                    </a>
                  </li>
				 	<li><a href="./user"><span class="sidebar-nav-mini-hide">分站后台</span></a></li> 
					<li><a href="./admin"><span class="sidebar-nav-mini-hide">站长后台</span></a></li>						
                </ul>
              </li>

           
              <li class="line dk"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>功能</span>
			<?php if($conf['fenzhan_buy']==1){?>
              </li>
                <li>
                <a href="index.php?mod=fzjs">
                  <i class="glyphicon glyphicon-send"></i>
                  <span>分站介绍</span>
                </a>
              </li>
			  </li>
                <li>
                <a href="user/regsite.php">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                  <span>分站搭建</span>
                </a>
              </li>
			  <?php }?>
			  <?php if(!empty($conf['invite_tid'])){?>
				<li><a target="_blank" href="./?mod=invite"><i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">推广中心</span></a></li>
				<?php }?>
				<?php if(!empty($conf['appurl'])){?>
				<li><a target="_blank" href="<?php echo $conf['appurl']; ?>"><i class="fa fa-android sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">APP下载</span></a></li>
				<?php }?>
              <li class="line dk hidden-folded"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>帮助</span>
              </li>
              <li>
                <a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']?$conf['qq']:$conf['kfqq']?>&site=qq&menu=yes">
                  <i class="glyphicon glyphicon-info-sign"></i>
                  <span>联系客服</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- nav -->
           <!-- aside footer -->
          <div class="wrapper m-t">
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded">60%</span>
              <span class="hidden-folded">Milestone</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-info" style="width: 60%;">
              </div>
            </div>
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded">35%</span>
              <span class="hidden-folded">Release</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-primary" style="width: 35%;">
              </div>
            </div>
          </div>
          <!-- / aside footer -->
        </div>
      </div>
  </aside>
  <!-- / aside -->
 <!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
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

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">在线商城</h1>
</div>
		<div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
			<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
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
      <!-- stats -->
      <div class="row">
	    <div class="col-lg-6 col-md-6">
			<div class="panel panel-info" draggable="true">
				<div class="panel-heading font-bold">平台公告</div>
				<div class="panel-body">
			   <?php echo $conf['anounce']?>                             </div>
			</div>
			</div>
			<div class="col-lg-6 col-md-6">
				
				<div class="panel panel-info" draggable="true">
					<div class="panel-heading font-bold">商品选购</div>
					<ul class="nav nav-tabs">
		<li class="active"><a href="#onlinebuy" data-toggle="tab">在线下单</a></li><li <?php if($conf['iskami']==0){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab">卡密下单</a></li><li><a href="#query" data-toggle="tab" id="tab-query">进度查询</a></li><li <?php if(empty($conf['lqqapi'])){?>class="hide"<?php }?>><a href="#lqq" data-toggle="tab">拉圈圈99+</a></li><li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab">抽奖</a></li>
	</ul>
	<div class="list-group-item">
		<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="onlinebuy">
<?php include TEMPLATE_ROOT.'default/shop2.inc.php'; ?>
		</div>
		<div class="tab-pane fade in" id="cardbuy">
			<div class="form-group">
				<a href="<?php echo $conf['kaurl']?>" class="btn btn-default btn-block" target="_blank"/>点击进入购买卡密</a>
			</div>
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
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
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
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
			<div id="result2" class="form-group text-center" style="display:none;">
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
			<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
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
		<div class="tab-pane fade in" id="kg">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text" name="url" id="url" value="" class="form-control" placeholder="请输入歌曲的分享链接" required="">
				</div>
				<div class="form-group" style="display:none;" id="song_v">
					<div class="input-group"><div class="input-group-addon">歌曲ID</div>
					<input type="text" id="songid" value="" class="form-control" required="">
				</div></div>
				<input type="submit" onclick="getsongid()" id="getsongid" class="btn btn-info btn-block" value="立即获取">
			</div>
			<div class="panel-footer">
			<span class="glyphicon glyphicon-info-sign"></span>
			进入全民K歌-选择歌曲-分享-复制链接
			</div>
			<div class="tab-pane fade in" id="ks">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text"id="kuaishou_url" value="" class="form-control" placeholder="请输入快手作品链接" required="">
				</div>
				<div  style="display:none;" id="kuaishou_v">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作者ID</div>
					<input type="text" id="anotherid" value="" class="form-control" required="">
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作品ID</div>
					<input type="text" id="videoid" value="" class="form-control" required="">
				</div></div>
				</div>
				<input type="submit" onclick="getkuaishouid()" id="getkuaishouid" class="btn btn-danger btn-block" value="立即获取">
			</div>
			<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
进入快手，选择一个作品，分享，复制链接

</div>
			</div>

		</div>
		</div>
	</div></div></div>
	</div>
	<div class="row">
						  <div class="col-lg-6 col-md-6" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
                            <div class="panel panel-info" draggable="true">
                                <div class="panel-heading font-bold">平台数据统计</div>
								<div class="panel-body text-center">
                                    
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-primary item">
                                            <span class="text-white font-thin h1 block" id="count_yxts"></span>
                                            <span class="text-muted text-xs">运营天数</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-info item">
                                            <span class="text-white font-thin h1 block" id="count_orders"></span>
                                            <span class="text-muted text-xs">订单总数</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-success item">
                                            <span class="text-white font-thin h1 block" id="count_orders1"></span>
                                            <span class="text-muted text-xs">成功订单</span>
                                        </div>
										</div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-dark item">
											<span class="text-white font-thin h1 block" id="count_money"></span>
                                            <span class="text-muted text-xs">成交金额</span>
										</div>
									</div>
										
                                </div>
                            </div>
                        </div> 
                                	
	
						
						
						<div class="col-lg-6 col-md-6" <?php if($conf['bottom']==''){?>style="display:none;"<?php }?>>
                            <div class="panel panel-info" draggable="true">
                                <div class="panel-heading font-bold">友情链接</div>
                                <?php echo $conf['bottom']?>
                            </div>
                        </div>				
	
      <!-- / stats -->
    </div>
	</div>
  <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
        <div class="wrapper b-t bg-light">
      <span class="pull-right">Powered by <a href="/" target="_blank"><?php echo $conf['sitename']?></a></span>
    	&copy; 2019 Copyright.
    </div>
  </footer>
  <!-- / footer -->

</div>
</div>
<!--音乐代码-->
<section class="u-audio hidden" data-src="<?php echo $conf['musicurl']?>"></section>
<div id="audio-play" <?php if(empty($conf['musicurl'])){?>style="display:none;"<?php }?>>
  <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
    <audio loop="loop" src="<?php echo $conf['musicurl']?>" id="media" preload="preload"></audio>
  </div>
</div>
<!--音乐代码-->
<script src="<?php echo $cdnpublic?>jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-load.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.config.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-nav.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-toggle.js"></script>

<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script type="text/javascript">
function getsongid(){
	var songurl=$("#url").val();
	if(songurl==''){alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){alert('请输入正确的歌曲的分享链接！');return false;}
	$('#song_v').hide();
	var songid = songurl.split('s=')[1].split('&')[0];
	$('#songid').val(songid);
	$('#song_v').slideDown();
}
function getkuaishouid(){
	var kuauishouurl=$("#kuaishou_url").val();
	if(kuauishouurl==''){alert('请确保每项不能为空！');return false;}
	if(kuauishouurl.indexOf('gifshow.com')<0 && kuauishouurl.indexOf('kuaishou.com')<0){alert('请输入正确的快手作品链接！');return false;}
	$('#kuaishou_v').hide();
	if(kuauishouurl.indexOf('userId=')>0){
		var anotherid = kuauishouurl.split('userId=')[1].split('&')[0];
	}else{
		var anotherid = kuauishouurl.split('photo/')[1].split('/')[0];
	}
	if(kuauishouurl.indexOf('photoId=')>0){
		var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
	}else{
		var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
	}
	$('#anotherid').val(anotherid);
	$('#videoid').val(videoid);
	$('#kuaishou_v').slideDown();
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