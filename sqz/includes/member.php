<?php
if(!defined('IN_CRONLITE'))exit();

$my=isset($_GET['my'])?$_GET['my']:null;

$clientip=real_ip();

if(isset($_COOKIE["auth_token"]))
{
	$token=authcode(daddslashes($_COOKIE['auth_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$udata = $DB->get_row("SELECT * FROM auth_user WHERE user='$user' limit 1");
	$session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid) {
		$DB->query("UPDATE auth_user SET last='$date',dlip='$clientip' WHERE user = '$user'");
		$islogin=1;
		if($udata['active']==0){
			sysmsg('您的授权平台账号已被封禁！');
		}
	}
}
if(isset($_COOKIE["auth_token2"]))
{
	$token=authcode(daddslashes($_COOKIE['auth_token2']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$udata = $DB->get_row("SELECT * FROM auth_daili WHERE user='$user' limit 1");
	$session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid) {
		$DB->query("UPDATE auth_daili SET last='$date',dlip='$clientip' WHERE user = '$user'");
		$islogins=1;
		$daili_id=$udata['uid'];
		$sqcount=$DB->count("SELECT count(*) from auth_qqs where uid='$daili_id'");
		if($udata['active']==0){
			sysmsg('您的授权平台账号已被封禁！');
		}
	}
}
?>