<?php
/**
 * 注册用户
**/
$is_defend=true;
include("../includes/common.php");
if($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
if(!$conf['user_open'] && $conf['fenzhan_buy']==1){
	exit("<script language='javascript'>window.location.href='./regsite.php';</script>");
}elseif(!$conf['user_open']){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('未开放新用户注册');window.location.href='./';</script>");
}
$title='用户注册';
include './head2.php';

$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
include_once(SYSTEM_ROOT."hieroglyphy.class.php");
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);
?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br /><br /><br />
    <div class="widget">
    <div class="widget-content themed-background-flat text-center"  style="background-image: url(<?php echo $cdnserver?>assets/simple/img/userbg.jpg);background-size: 100% 100%;" >
<img  class="img-circle"src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'];?>&spec=100" alt="Avatar" alt="avatar" height="60" width="60" />
<p></p>
    </div>

    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>新用户注册</b></h2>
        </div>
          <form>
            <div class="input-group"><div class="input-group-addon"><span class="fa fa-user"></span></div>
              <input type="text" name="user" value="" class="form-control" required="required" placeholder="输入登录用户名"/>
            </div><br/>
            <div class="input-group"><div class="input-group-addon"><span class="fa fa-lock"></span></div>
              <input type="text" name="pwd" class="form-control" required="required" placeholder="输入6位以上密码"/>
            </div><br/>
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-qq"></span></div>
              <input type="text" name="qq" class="form-control" required="required" placeholder="输入QQ号，用于找回密码"/>
            </div><br/>
			<?php if($conf['captcha_open']==1){?>
			<div id="captcha"><div id="captcha_text">
                正在加载验证码
            </div>
            <div id="captcha_wait">
                <div class="loading">
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                </div>
            </div></div>
			<div id="captchaform"></div>
			<br/>
			<?php }else{?>
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-adjust"></span></div>
              <input type="text" name="code" class="form-control input-lg" required="required" placeholder="输入验证码"/>
			  <span class="input-group-addon" style="padding: 0">
				<img id="codeimg" src="./code.php?r=<?php echo time();?>" height="43" onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
			  </span>
            </div><br/>
			<?php }?>
            <div class="form-group">
              <input type="button" value="立即注册" id="submit_reg" class="btn btn-danger btn-block"/>
            </div>
			<hr>
			<div class="form-group">
			<a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
			<a href="login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa fa-user"></i>&nbsp;返回登录</a>
			</div>
          </form>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="../assets/js/reguser.js"></script>
</body>
</html>