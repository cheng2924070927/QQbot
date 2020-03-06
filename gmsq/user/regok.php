<?php
/**
 * 开通成功页面
**/
include("../includes/common.php");
$title='开通分站成功';
include './head2.php';
?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br /><br /><br />
    <div class="widget">
    <div class="widget-content themed-background-flat text-center"  style="background-image: url(<?php echo $cdnserver?>assets/simple/img/userbg.jpg);background-size: 100% 100%;" >
<img  class="img-circle"src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'];?>&spec=100" alt="Avatar" alt="avatar" height="60" width="60" />
<p></p>
    </div>
<?php
if(isset($_GET['orderid'])){
	$orderid = daddslashes($_GET['orderid']);
	$row=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$orderid}' limit 1");
	if(!$row || $row['status']==0 || $row['tid']!=-2)showmsg('订单不存在或未完成支付！',3);
	if(!$cookiesid || $row['userid']!=$cookiesid)showmsg('仅限查看自己开通的分站信息',3);
	$input=explode('|',$row['input']);
	$type = $input[0];
	if($type == 'update'){
		$zid = intval($input[1]);
		$row=$DB->get_row("SELECT * FROM shua_site WHERE zid='{$zid}' limit 1");
		$kind = intval($row['power']);
		$domain = $row['domain'];
		$user = $row['user'];
		$pwd = $row['pwd'];
		$name = $row['sitename'];
		$qq = $row['qq'];
		$endtime = $row['endtime'];
	}else{
		$kind = intval($input[1]);
		$domain = daddslashes($input[2]);
		$user = daddslashes($input[3]);
		$pwd = daddslashes($input[4]);
		$name = daddslashes($input[5]);
		$qq = daddslashes($input[6]);
		$endtime = daddslashes($input[7]);
	}
	$url = 'http://'.$domain.'/';
}elseif(isset($_GET['zid'])){
	$zid = intval($_GET['zid']);
	$row=$DB->get_row("SELECT * FROM shua_site WHERE zid='{$zid}' limit 1");
	if(!$row || !$_SESSION['newzid'] || $_SESSION['newzid']!=$zid)showmsg('你所开通的分站信息不存在！',3);
	$kind = intval($row['power']);
	$domain = $row['domain'];
	$user = $row['user'];
	$pwd = $row['pwd'];
	$name = $row['sitename'];
	$qq = $row['qq'];
	$endtime = $row['endtime'];
	$url = 'http://'.$domain.'/';
}else{
	showmsg('缺少参数',4);
}
?>

    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user"></i>&nbsp;&nbsp;<b>开通分站成功</b></h2>
        </div>
			<div class="alert alert-success">
				恭喜你分站开通成功，请牢记以下信息
			</div>
                <li class="list-group-item"><b>分站网址：</b><a href="<?php echo $url?>" target="_blank"><?php echo $url?></a></li>
				<li class="list-group-item"><b>分站管理后台：</b><a href="<?php echo $url?>user/" target="_blank"><?php echo $url?>user/</a></li>
				<li class="list-group-item"><b>管理员用户名：</b><?php echo $user?></a></li>
				<li class="list-group-item"><b>管理员密码：</b><?php echo $pwd?></a></li>
				<br /><br />
            </div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
</body>
</html>