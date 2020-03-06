<?php
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $title ?></title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/appui/css/main.css">
  <link rel="stylesheet" href="../assets/appui/css/themes.css">
  <link id="theme-link" rel="stylesheet" href="<?php echo $_COOKIE['optionThemeColor']?$_COOKIE['optionThemeColor']:'../assets/appui/css/themes/themes.css';?>">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="//cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../assets/appui/js/plugins.js"></script>
  <script src="../assets/appui/js/app.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<?php if($islogin==1){?>
<!-- Start: Header -->
    <div id="page-wrapper">
        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full enable-cookies">
<div id="sidebar-alt" tabindex="-1" aria-hidden="true">
<a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 888px;"><div id="sidebar-scroll-alt" style="overflow: hidden; width: auto; height: 888px;">
<div class="sidebar-content">
<div class="sidebar-section">
<style>
h4{font-family:"微软雅黑",Georgia,Serif;}
</style>
<h4 class="text-light">框架变色(New)</h4>
<br>
<ul class="sidebar-themes clearfix">
<li class="">
<a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/themes-2.2.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-default"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/classy-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-classy"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/social-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-social"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/flat-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-flat"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/amethyst-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-amethyst"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/creme-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-creme"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/passion-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
<span class="section-side themed-background-dark-passion"></span>
<span class="section-content"></span>
</a>
<br>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/classy-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/social-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/flat-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/amethyst-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/creme-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/passion-2.4.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light" data-original-title="">
<span class="section-side"></span>
<span class="section-content"></span>
</a>
</li>

<li class="">
<a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/classy-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-classy"></span>
<span class="section-content"></span>
</a>
<br>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/social-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-social"></span>
<span class="section-content"></span>
</a>
</li>
<li>
<a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/flat-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-flat"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/amethyst-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-amethyst"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/creme-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-creme"></span>
<span class="section-content"></span>
</a>
</li>
<li class="">
<a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="" data-theme="../assets/appui/css/themes/passion-2.4.css" data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
<span class="section-header"></span>
<span class="section-side themed-background-dark-passion"></span>
<span class="section-content"></span>
</a>
</li>
</ul>
</div>
</div>
</div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 888px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 1; z-index: 90; right: 1px;"></div></div>
</div>
            <div id="sidebar">
                <div id="sidebar-brand" class="themed-background">
				<a href="./" class="sidebar-title">
                    <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">管理后台</span>
                </a>
				</div>
                <div id="sidebar-scroll">
                    <div class="sidebar-content">
                        <ul class="sidebar-nav">

<li>
	<a class="<?php echo checkIfActive('index,')?>" href="./">
		<i class="fa fa-home sidebar-nav-icon"></i>
		<span class="sidebar-nav-mini-hide">后台首页</span>
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive('list,export')?>" href="./list.php">
		<i class="fa fa-list sidebar-nav-icon"></i>
		<span class="sidebar-nav-mini-hide">订单管理</span>
	</a>
</li>

<li class="<?php echo checkIfActive('classlist,shoplist,shopedit,kmlist,price')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-shopping-cart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">商品管理</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("classlist") ?>" href="./classlist.php">
		分类列表
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("shoplist,shopedit") ?>" href="./shoplist.php">
		商品列表
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("price") ?>" href="./price.php">
		加价模板
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("kmlist") ?>" href="./kmlist.php">
		卡密列表
	</a>
</li>
	</ul>
</li>

<li class="<?php echo checkIfActive('fakalist,fakakms,mailcon')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-th sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">发卡管理</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("fakalist") ?>" href="./fakalist.php">
		库存管理
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("fakakms") ?>" href="./fakakms.php?my=add">
		添加卡密
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("mailcon") ?>" href="./set.php?mod=mailcon">
		发信模板
	</a>
</li>
	</ul>
</li>

<li class="<?php echo checkIfActive('sitelist,tixian,record,rank,userlist,fenzhan,message,workorder')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-sitemap sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">分站管理</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("sitelist") ?>" href="./sitelist.php">
		分站列表
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("userlist") ?>" href="./userlist.php">
		用户列表
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("record") ?>" href="./record.php">
		收支明细
	</a>
</li>
<?php if($conf['fenzhan_tixian']==1){?>
<li>
	<a class="<?php echo checkIfActive("tixian") ?>" href="./tixian.php">
		余额提现
	</a>
</li>
<?php }?>
<li>
	<a class="<?php echo checkIfActive("rank") ?>" href="./rank.php">
		分站排行
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("workorder") ?>" href="./workorder.php">
		工单列表
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("message") ?>" href="./message.php">
		站内通知
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("fenzhan") ?>" href="./set.php?mod=fenzhan">
		分站设置
	</a>
</li>
	</ul>
</li>

<li class="<?php echo checkIfActive('shequlist,pricejk,log,clone,cloneset,shequ')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cubes sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">对接设置</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("shequlist") ?>" href="./shequlist.php">
		对接站点管理
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("pricejk") ?>" href="./pricejk.php">
		价格监控
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("log") ?>" href="./log.php">
		对接日志
		</a>
</li>
<li>
	<a class="<?php echo checkIfActive("clone,cloneset") ?>" href="./clone.php">
		克隆销售站
	</a>
</li>
	</ul>
</li>

<li class="<?php echo checkIfActive('site,gonggao,mail,pay,template,upimg,upbgimg,clean,cleanbom,defend,proxy,copygg,mailtest,epay')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cog sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">系统设置</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("site") ?>" href="./set.php?mod=site">
		网站信息配置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("gonggao,copygg") ?>" href="./set.php?mod=gonggao">
		网站公告配置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("mail") ?>" href="./set.php?mod=mail">
		发信邮箱配置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("pay,epay") ?>" href="./set.php?mod=pay">
		支付接口配置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("template") ?>" href="./set.php?mod=template">
		首页模板设置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("upimg,upbgimg") ?>" href="./set.php?mod=upimg">
		网站Logo设置
	</a>
</li>
<li>
<li>
	<a class="<?php echo checkIfActive("clean") ?>" href="./clean.php">
		系统数据清理
</a>
</li>
	</ul>
</li>

<li class="<?php echo checkIfActive('qiandao,invite,dwz,choujiang')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">其它功能</span></a>
	<ul>
<li>
	<a class="<?php echo checkIfActive("qiandao") ?>" href="./set.php?mod=qiandao">
		每日签到设置
	</a>
</li>
<li>
	<a class="<?php echo checkIfActive("invite") ?>" href="./set.php?mod=invite">
		推广链接设置
			</a>
</li>
<li>

	<a class="<?php echo checkIfActive("choujiang") ?>" href="./choujiang.php">
		抽奖商品设置
	</a>
</li>
<li>
		<a class="<?php echo checkIfActive("dwz") ?>" href="./set.php?mod=dwz">
		防红接口设置
	</a>
</li>
	</ul>
</li>
<li class="<?php echo checkIfActive('qiandao,invite,dwz,choujiang')?>">
	<a href="javascript:void(0)" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">更多</span></a>
	<ul>
<li>
<a class="<?php echo checkIfActive("qiandao1") ?>" href="https://wpa.qq.com/msgrd?v=3&uin=1544545655&site=qq&menu=yes"  target=_blank>
		联系JKJPro插件开发者
	</a>
</li>
<li>
<a class="<?php echo checkIfActive("qiandao2") ?>" href="https://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes"  target=_blank>
		联系JKJPro官网开发者
	</a>
</li>
<li>
<a class="<?php echo checkIfActive("qiandao3") ?>" href="https://jq.qq.com/?_wv=1027&k=5tDE4Gj"  target=_blank>
		快来加本萌的群鸭！
	</a>
</li>
<li>
<a class="<?php echo checkIfActive("pay,epay") ?>2" href="https://lovek.me/donate/" target=_blank>
		给Lovely God买棒棒糖
	</a>
</li>
<li>
<a class="<?php echo checkIfActive("pay,epay") ?>3" href="http://lpit.xyz/jqrsqwz">
		查询您的网站是否正版
	</a>
<hr />
<center>关于正版授权</center><br />
<p>搭建出来的站长记得联系QQ：2924070927添加你的网站到我的授权站！本套源码设计的初衷是只限JKJPro用户群内的人使用，防止外人盗取源码占为己有！以后如果有外人用这套源码抢我们生意的话，直接放出我的授权站网址让用户查询到您的网站才是正版！！</p>
</li>


                        </ul>
                    </div>
                </div>
                <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
<div class="progress progress-mini push-bit">
<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div>
<div class="text-center">
<small><span id="year-copy">2019</span> © <a href="#"><?php echo $conf['sitename']?></a></small>
</div>
</div>
            </div>
            <div id="main-container">
                <header class="navbar navbar-inverse navbar-fixed-top">
 
<ul class="nav navbar-nav-custom">
 
<li>

<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
<i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
<i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>菜单
</a>
</li>
<li>
<a href="javascript:void(0)" onclick="javascript:history.go(-1);">
<i class="fa fa-reply fa-fw animation-fadeInRight"></i> 返回
</a>
</li>
</ul>
 
 
<ul class="nav navbar-nav-custom pull-right">
<li>
<a href="javascript:void(0)" onclick="javascript:window.location.reload();" title="刷新">
<i class="fa fa-refresh fa-fw animation-fadeInRight"></i> 刷新
</a>
</li>
<li>
<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');this.blur();">

<i class="fa fa-wrench sidebar-nav-icon"></i>
</a>
</li>
<li class="dropdown">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo ($conf['kfqq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$conf['kfqq'].'&src_uin='.$conf['kfqq'].'&fid='.$conf['kfqq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'../assets/img/user.png'?>" alt="avatar">
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li class="dropdown-header text-center">
<strong>签到萌宠机器人正版销售站</strong></li>
<li>
<a href="set.php?mod=account">
<i class="fa fa-pencil-square fa-fw pull-right"></i>
修改销售站后台密码
</a>
</li>
<li class="divider">
</li>
<li>
<li>
<a href="../">
<i class="fa fa-home fa-fw pull-right"></i>
销售站首页
</a>
</li>
<li class="divider">
</li>
<li>
<li>
<a href="login.php?logout">
<i class="fa fa-power-off fa-fw pull-right"></i>
安全退出销售站后台
</a>
</li>
</ul>
</li>
</ul>
</header>
<div id="page-content">
		<div id="myDiv"></div>
			<div class="main pjaxmain">
				<div class="content-header">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="header-section">
                                    <h1><?php echo $title ?></h1>
                                </div>
                            </div>
                        </div>
				</div>
<div class="row">
<?php }?>