<?php
/**
 * 登录
**/
$verifycode = 0;//验证码开关

if(!function_exists("imagecreate") || !file_exists('code.php'))$verifycode=0;
include("../includes/common.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$code=daddslashes($_POST['code']);
	if ($verifycode==1 && (!$code || strtolower($code) != $_SESSION['vc_code'])) {
		unset($_SESSION['vc_code']);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('验证码错误！');history.go(-1);</script>");
	}elseif($user===$conf['admin_user'] && $pass===$conf['admin_pwd']) {
		unset($_SESSION['vc_code']);
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
		saveSetting('adminlogin',$date);
		log_result('后台登录', 'IP:'.$clientip, null, 1);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆管理中心成功！');window.location.href='./';</script>");
	}else {
		unset($_SESSION['vc_code']);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='用户登录';
include './head.php';
?>
<div id="login-container">
	<h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
	<i class="fa fa-cube"></i><strong><?php echo $conf['sitename']?></strong>
	</h1>
	<div class="block animation-fadeInQuickInv">
		<div class="block-title">
			<h2>管理员后台登录</h2>
		</div>
		<form id="form-login" action="login.php" method="post" class="form-horizontal">
			<div class="form-group">
				<div class="col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" id="user" name="user" class="form-control" placeholder="用户名" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" id="pass" name="pass" class="form-control" placeholder="密码" required>
					</div>
				</div>
			</div>
			<?php if($verifycode==1){?>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-adjust"></span></span>
					<input type="text" id="code" name="code" class="form-control input-lg" placeholder="输入验证码" autocomplete="off" required>
					<span class="input-group-addon" style="padding: 0">
						<img id="codeimg" src="./code.php?r=<?php echo time();?>" height="43" onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
					</span>
					</div>
				</div>
			</div>
			<?php }?>
			<div class="form-group form-actions">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-effect-ripple btn-block btn-primary"><i class="fa fa-check"></i>登录</button>
				</div>
			</div>
		</form>
	</div>
	<footer class="text-muted text-center animation-pullUp">
	<small><span id="year-copy"></span> &copy; <a href="#"><?php echo $conf['sitename']?></a></small>
	</footer>
</div>
</body>
</html>