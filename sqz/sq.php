<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="这是一款支持50+签到业务的机器人,一键签到,一健萌宠，功能丰富">
  <title>正版查询 - 签到萌宠机器人</title>
  <meta name="keywords" content="签到萌宠机器人,授权查询,一健萌宠,LovelyGod,一键签到,骗子查询系统,智能AI机器人">
  <link rel="shortcut icon" href="/static/images/favicon.ico">
  <link rel="stylesheet" href="./assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="./assets/css/sweetalert.css"/>
  <script src="./js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="./assets/css/coolcat.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <style type="text/css">
    *{ 
  cursor:url(https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.2/cursor.ico),auto;
}
  </style>
</head>
<body class="bg-default">
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/sqz">签到萌宠机器人-授权站</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/">签到萌宠机器人-授权站</a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
              <ul class="navbar-nav mr-auto">         
          <li class="nav-item">
            <a href="/sqz" class="nav-link">
              <span class="nav-link-inner--text">首页</span>
            </a>
          </li>
            <li>
          <li class="nav-item">
            <a href="/gmsq" class="nav-link">
              <span class="nav-link-inner--text">正版授权购买</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/" class="nav-link">
              <span class="nav-link-inner--text">签到萌宠机器人官网</span>
            </a>
          </li>
            <li>
          <li class="nav-item">
            <a href="/sqz/user/login.php" class="nav-link">
              <span class="nav-link-inner--text">授权商登录</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://www.lanzous.com/b00ndgv7g" class="nav-link" target="_blank">
              <span class="nav-link-inner--text">机器人下载</span>
            </a>
          </li>
             <li class="nav-item">
            <a onclick="return confirm('请直奔主题,不要问在不在')" href="https://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes" class="nav-link">
              <span class="nav-link-inner--text">联系客服</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://jq.qq.com/?_wv=1027&k=5if0NmR" class="nav-link" target="_blank">
              <span class="nav-link-inner--text">售后Q群</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-success py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">正版授权查询</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="#">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>签到萌宠机器人，请支持正版！</small>
              </div>
             <form action="?" class="form-sign" method="get" name="auth" onSubmit="return checkURL();"> 
                <div class="form-group mb-2">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>                  
                    <input type="text" placeholder="请输入您的机器人QQ号码" class="form-control" name="qq" value="">
                  </div>
                </div>         
               <br/>
               <input type="submit" class="btn btn-success form-control" name="submit" value="确认查询"><br/>                
                <?php
include("./includes/common.php");

if($qq=$_GET['qq']) {
	$qq=daddslashes($qq);
	echo '<label>QQ号：</label>'.$qq.'<br>';
	if(checkauth($qq)) {
		echo '<div class="alert alert-success"><img src="/sqz/assets/ico_success.png">恭喜，该QQ号为正版授权！</div>';
	}else{
		echo '<div class="alert alert-danger"><img src="/sqz/assets/ico_tip.png">抱歉！未查询到此QQ号相关信息</div>';
	}
}

?>           </form>                                 
            </div>
          </div> 

            <div class="col-6">
              <a href="/gmsq" class="text-light"><small>点击购买正版授权</small></a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-3" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 <a href="https://lovek.me" class="font-weight-bold ml-1" target="_blank">@Lovely God</a> 提供技术支持
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="/" class="nav-link" target="_blank">签到萌宠机器人官网</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
var OriginTitile = document.title;
  var titleTime;
document.addEventListener('visibilitychange', function() {
 if (document.hidden) {
    document.title = '(つェ⊂)我藏好了哦~ ' + OriginTitile;
    clearTimeout(titleTime);
  }
  else {
    document.title = '(*´∇｀*) 被你发现啦~ ' + OriginTitile;
    titleTime = setTimeout(function() {
        document.title = OriginTitile;
       }, 2000);
     }
  });
</script>
</body>
</html>