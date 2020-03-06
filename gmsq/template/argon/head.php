<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link type="text/css" href="<?php echo $cdnserver?>assets/css/argon.css" rel="stylesheet">
  <link type="text/css" href="<?php echo $cdnserver?>assets/css/argon2.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <nav class="navbar navbar-vertical navbar-expand-md navbar-light bg-white d-md-none">

      <!-- 侧栏按钮 -->
      <!--LOGO-->
      <a class="navbar-brand pt-0" href="./">
        <img src="<?php echo $logo?>" class="navbar-brand-img" alt="LOGO">
      </a>
      <!--导航right-->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item page-item dropdown">
          <a class="nav-link page-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-qq"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <h6 class="dropdown-header text-dark">订单售后客服ＱＱ</h6>
            <a target="_blank" class="dropdown-item" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"><img border="0" src="//wpa.qq.com/pa?p=2:<?php echo $conf['kfqq']?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/> <?php echo $conf['kfqq']?></a>
          </div>
        </li>
        <li class="nav-item page-item">
          <a class="nav-link page-link nav-link-icon" href="#gg" data-toggle="modal">
            <i class="fa fa-bell"></i>
          </a>
        </li>
            <li class="nav-item dropdown ml-3">
			<?php if($islogin2==1){?>
            <a href="./user/" class="nav-shuaibi-link">用户中心</a>
			<?php }else{?>
			<a href="./user/login.php" class="nav-shuaibi-link">登录</a>
            <a href="./user/reg.php" class="nav-shuaibi-link">注册</a>
			<?php }?>
        </li>
        
              </ul>
  </nav>
<div class="modal fade" id="gg" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-body">
            <div class="py-1 text-center">
                <i class="ni ni-bell-55 ni-3x mb-3"></i>
<?php echo $conf['anounce']?>
            </div>
            </div>
            <div class="modal-footer py-2">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">知道啦</button> 
            </div>
        </div>
    </div>
</div>  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="mb-0 text-white text-uppercase d-none d-md-inline-block" href="./">
            <img src="<?php echo $logo?>" class="navbar-brand-img" alt="LOGO" style="max-width: 200px;max-height: 80px;">
        </a>
        <!-- 导航right -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
			<?php if($islogin2==1){?>
            <a href="./user/" class="nav-link nav-shuaibi-link pr-0">用户中心</a>
			<?php }else{?>
			<a href="./user/login.php" class="nav-link nav-shuaibi-link pr-0">登录</a>
            <a href="./user/reg.php" class="nav-link nav-shuaibi-link pr-0">注册</a>
			<?php }?>
            </li>
                    </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
		  <?php if($conf['fenzhan_buy']==0 && $conf['gift_open']==0){?>
          <div class="row">
            <div class="col-6">
              <a href="./" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-shopping-cart"></i>
                  <span>在线下单</span>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="./?mod=query" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-search"></i>
                  <span>查询订单</span>
                </div>
              </a>
            </div>
          </div>
		  <?php }else{?>
		  <div class="row">
            <div class="col-lg-3 col-md-6 col-6">
              <a href="./" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-shopping-cart"></i>
                  <span>在线下单</span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
              <a href="./?mod=query" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-search"></i>
                  <span>查询订单</span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-6" <?php if($conf['fenzhan_buy']==0){?>style="display:none;"<?php }?>>
              <a href="./?mod=site" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-users"></i>
                  <span>成为代理</span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-6" <?php if($conf['gift_open']==0){?>style="display:none;"<?php }?>>
              <a href="./?mod=gift" class="btn-icon-clipboard">
                <div>
                  <i class="fa fa-gift"></i>
                  <span>每日抽奖</span>
                </div>
              </a>
            </div>
          </div>
		  <?php }?>
        </div>
      </div>
    </div>