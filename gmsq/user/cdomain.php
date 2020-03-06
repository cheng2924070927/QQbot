<?php
/**
 * 自助更换域名
**/
include("../includes/common.php");
$title='自助更换域名';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
if($conf['fenzhan_editd']==0)showmsg('未开启自助更换域名功能',3);

$price = $conf['fenzhan_editd'];

$domains=explode(',',$conf['fenzhan_domain']);
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
if(empty($select))showmsg('请先到后台分站设置，填写可选分站域名',3);

if($_GET['act']=='submit'){
	$qz = trim(strtolower(daddslashes($_POST['qz'])));
	$domain = trim(strtolower(strip_tags(daddslashes($_POST['domain']))));
	$domain = $qz . '.' . $domain;
	if (strlen($qz) < 2 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
		showmsg('域名前缀不合格！',3);
	} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
		showmsg('域名格式不正确！',3);
	} elseif ($domain == $userrow['domain']) {
		showmsg('不能和之前的域名一样！',3);
	} elseif ($DB->get_row("SELECT * FROM shua_site WHERE domain='{$domain}' or domain2='{$domain}' limit 1") || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
		showmsg('此前缀已被使用！',3);
	}
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->query("update `shua_site` set `domain`='$domain',`rmb`=`rmb`-'{$price}' where `zid`='{$userrow['zid']}'");
	addPointRecord($userrow['zid'], $price, '消费', '自助更换域名');
	exit("<script language='javascript'>alert('成功更换域名为{$domain}，共花费{$price}元！');window.location.href='uset.php?mod=site';</script>");
}
?>
	  <div class="panel panel-default text-center" id="recharge">
		<div class="panel-heading">
			<h2 class="panel-title">自助更换域名</h2>
		</div>
		<div class="panel-body">
			<form action="./cdomain.php?act=submit" method="post" role="form">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						当前域名
					</div>
					<input name="domain" class="form-control" value="<?php echo $userrow['domain']?>" disabled/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						新的域名
					</div>
					<input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz"
						   class="form-control" required data-parsley-length="[2,8]"
						   placeholder="输入你想要的二级前缀">
					<select name="domain" class="form-control"><?php echo $select?></select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						更换费用
					</div>
					<input name="need" class="form-control" value="<?php echo $price?>" disabled/>
					<div class="input-group-addon">
						元
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="确定更换" class="btn btn-primary form-control"/>
			</div>
			</form>
		</div>
	</div>
  </div>
</div>