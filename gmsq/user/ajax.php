<?php
include("../includes/common.php");

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'checkdomain':
	$qz = daddslashes($_GET['qz']);
	$domain = $qz . '.' . daddslashes($_GET['domain']);
	$srow=$DB->get_row("SELECT * FROM shua_site WHERE domain='{$domain}' or domain2='{$domain}' limit 1");
	if($srow)exit('1');
	else exit('0');
break;
case 'checkuser':
	$user = daddslashes($_GET['user']);
	$srow=$DB->get_row("SELECT * FROM shua_site WHERE user='{$user}' limit 1");
	if($srow)exit('1');
	else exit('0');
break;
case 'reguser':
	if($islogin2==1)exit('{"code":-1,"msg":"您已登陆！"}');
	elseif($conf['user_open']==0)exit('{"code":-1,"msg":"当前站点未开启用户注册功能！"}');
	$user = trim(strip_tags(daddslashes($_POST['user'])));
	$pwd = trim(strip_tags(daddslashes($_POST['pwd'])));
	$qq = trim(daddslashes($_POST['qq']));
	$hashsalt = isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	$code = isset($_POST['code'])?$_POST['code']:null;
	$geetest_challenge = isset($_POST['geetest_challenge'])?$_POST['geetest_challenge']:null;
	$geetest_validate = isset($_POST['geetest_validate'])?$_POST['geetest_validate']:null;
	$geetest_seccode = isset($_POST['geetest_seccode'])?$_POST['geetest_seccode']:null;
	if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
		exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
	}
	if (!preg_match('/^[a-zA-Z0-9]+$/',$user)) {
		exit('{"code":-1,"msg":"用户名只能为英文或数字！"}');
	} elseif ($DB->get_row("SELECT * FROM shua_site WHERE user='{$user}' limit 1")) {
		exit('{"code":-1,"msg":"用户名已存在！"}');
	} elseif (strlen($pwd) < 6) {
		exit('{"code":-1,"msg":"密码不能低于6位"}');
	} elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/',$qq)) {
		exit('{"code":-1,"msg":"QQ格式不正确！"}');
	}
	if($conf['captcha_open']==1){
		if(isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])){
			require_once SYSTEM_ROOT.'class.geetestlib.php';
			$GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

			$data = array(
				'user_id' => $cookiesid,
				'client_type' => "web",
				'ip_address' => $clientip
			);

			if ($_SESSION['gtserver'] == 1) {   //服务器正常
				$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
				if ($result) {
					//echo '{"status":"success"}';
				} else{
					exit('{"code":-1,"msg":"验证失败，请重新验证"}');
				}
			}else{  //服务器宕机,走failback模式
				if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
					//echo '{"status":"success"}';
				}else{
					exit('{"code":-1,"msg":"验证失败，请重新验证"}');
				}
			}
		}else{
			exit('{"code":2,"msg":"请先完成验证"}');
		}
	}elseif (!$code || strtolower($code) != $_SESSION['vc_code']) {
		unset($_SESSION['vc_code']);
		exit('{"code":2,"msg":"验证码错误！"}');
	}
	$sql="insert into `shua_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`bottom`,`modal`,`addtime`,`lasttime`,`status`) values ('".$siterow['zid']."','0',NULL,NULL,'".$user."','".$pwd."','0','".$qq."',NULL,NULL,NULL,NULL,NULL,NULL,'".$date."','".$date."','1')";
	$zid = $DB->insert($sql);
	if($zid){
		unset($_SESSION['addsalt']);
		$DB->query("update `shua_orders` set `userid`='".$zid."' where `userid`='".$cookiesid."'");
		$session=md5($user.$pwd.$password_hash);
		$token=authcode("{$zid}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800, '/');
		log_result('分站登录', 'User:'.$user.' IP:'.$clientip, null, 1);
		exit('{"code":1,"msg":"注册用户成功","zid":"'.$zid.'"}');
	}else{
		exit('{"code":-1,"msg":"注册用户失败！'.$DB->error().'"}');
	}
break;
case 'paysite':
	if($islogin2==1 && $userrow['power']>0)exit('{"code":-1,"msg":"您已开通过分站！"}');
	elseif($conf['fenzhan_buy']==0)exit('{"code":-1,"msg":"当前站点未开启自助开通分站功能！"}');
	if($is_fenzhan == true && $siterow['power']==2){
		if($siterow['ktfz_price']>0)$conf['fenzhan_price']=$siterow['ktfz_price'];
		if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
		if($siterow['ktfz_price2']>0 && $siterow['ktfz_price2']>=$conf['fenzhan_cost2'])$conf['fenzhan_price2']=$siterow['ktfz_price2'];
	}
	$kind = intval($_POST['kind']);
	$qz = trim(strtolower(daddslashes($_POST['qz'])));
	$domain = trim(strtolower(strip_tags(daddslashes($_POST['domain']))));
	$user = trim(strip_tags(daddslashes($_POST['user'])));
	$pwd = trim(strip_tags(daddslashes($_POST['pwd'])));
	$name = trim(strip_tags(daddslashes($_POST['name'])));
	$qq = trim(daddslashes($_POST['qq']));
	$hashsalt = isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	$domain = $qz . '.' . $domain;
	if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
		exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
	}
	if ($kind!=0 && $kind!=1 && $kind!=2) {
		exit('{"code":-1,"msg":"分站类型错误！"}');
	} elseif (strlen($qz) < 2 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
		exit('{"code":-1,"msg":"域名前缀不合格！"}');
	} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
		exit('{"code":-1,"msg":"域名格式不正确！"}');
	} elseif ($DB->get_row("SELECT * FROM shua_site WHERE domain='{$domain}' or domain2='{$domain}' limit 1") || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
		exit('{"code":-1,"msg":"此前缀已被使用！"}');
	}
	if(!$islogin2){
		if (!preg_match('/^[a-zA-Z0-9]+$/',$user)) {
			exit('{"code":-1,"msg":"用户名只能为英文或数字！"}');
		} elseif ($DB->get_row("SELECT * FROM shua_site WHERE user='{$user}' limit 1")) {
			exit('{"code":-1,"msg":"用户名已存在！"}');
		} elseif (strlen($pwd) < 6) {
			exit('{"code":-1,"msg":"密码不能低于6位"}');
		} elseif (strlen($name) < 2) {
			exit('{"code":-1,"msg":"网站名称太短！"}');
		} elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/',$qq)) {
			exit('{"code":-1,"msg":"QQ格式不正确！"}');
		}
	}
	$fenzhan_expiry = $conf['fenzhan_expiry']>0?$conf['fenzhan_expiry']:12;
	$endtime = date("Y-m-d H:i:s", strtotime("+ {$fenzhan_expiry} months", time()));
	$trade_no=date("YmdHis").rand(111,999);
	if($kind==2){
		$need=addslashes($conf['fenzhan_price2']);
	}else{
		$need=addslashes($conf['fenzhan_price']);
	}
	if($need==0){
		if($conf['captcha_open']==1){
			if(isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])){
				require_once SYSTEM_ROOT.'class.geetestlib.php';
				$GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

				$data = array(
					'user_id' => $cookiesid,
					'client_type' => "web",
					'ip_address' => $clientip
				);

				if ($_SESSION['gtserver'] == 1) {   //服务器正常
					$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
					if ($result) {
						//echo '{"status":"success"}';
					} else{
						exit('{"code":-1,"msg":"验证失败，请重新验证"}');
					}
				}else{  //服务器宕机,走failback模式
					if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
						//echo '{"status":"success"}';
					}else{
						exit('{"code":-1,"msg":"验证失败，请重新验证"}');
					}
				}
			}else{
				exit('{"code":2,"msg":"请先完成验证"}');
			}
		}
		$keywords=addslashes($conf['keywords']);
		$description=addslashes($conf['description']);
		if($conf['fenzhan_html']==1){
			$anounce=addslashes($conf['anounce']);
			$alert=addslashes($conf['alert']);
		}
		if($islogin2==1){
			$sql="update `shua_site` set `power`='".$kind."',`domain`='".$domain."',`sitename`='".$name."',`keywords`='".$keywords."',`description`='".$description."',`anounce`='".$anounce."',`alert`='".$alert."',`endtime`='".$endtime."' where `zid`='".$userrow['zid']."'";
			$DB->query($sql);
			$zid=$userrow['zid'];
		}else{
			$sql="insert into `shua_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`alert`,`addtime`,`endtime`,`status`) values ('".$siterow['zid']."','".$kind."','".$domain."',NULL,'".$user."','".$pwd."','0','".$qq."','".$name."','".$keywords."','".$description."','".$anounce."','".$alert."','".$date."','".$endtime."','1')";
			$zid = $DB->insert($sql);
		}
		if($zid){
			$_SESSION['newzid']=$zid;
			unset($_SESSION['addsalt']);
			if(!$islogin2)$DB->query("update `shua_orders` set `userid`='".$zid."' where `userid`='".$cookiesid."'");
			$DB->query("update `shua_orders` set `zid`='".$zid."' where `userid`='".$zid."'");
			exit('{"code":1,"msg":"开通分站成功","zid":"'.$zid.'"}');
		}else{
			exit('{"code":-1,"msg":"开通分站失败！'.$DB->error().'"}');
		}
	}else{
		if($islogin2==1){
			$input='update|'.$userrow['zid'].'|'.$kind.'|'.$domain.'|'.$name.'|'.$endtime;
		}else{
			$input='add|'.$kind.'|'.$domain.'|'.$user.'|'.$pwd.'|'.$name.'|'.$qq.'|'.$endtime;
		}
		$sql="insert into `shua_pay` (`trade_no`,`tid`,`zid`,`input`,`num`,`name`,`money`,`ip`,`userid`,`addtime`,`status`) values ('".$trade_no."','-2','".($siterow['zid']?$siterow['zid']:1)."','".$input."','1','自助开通分站','".$need."','".$clientip."','".$cookiesid."','".$date."','0')";
		if($DB->query($sql)){
			unset($_SESSION['addsalt']);
			exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","need":"'.$need.'","pay_alipay":"'.$conf['alipay_api'].'","pay_wxpay":"'.$conf['wxpay_api'].'","pay_qqpay":"'.$conf['qqpay_api'].'","pay_rmb":"'.$islogin2.'","user_rmb":"'.$userrow['rmb'].'"}');
		}else{
			exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
		}
	}
break;
case 'up_price':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	unset($islogin2);
	$price_obj = new Price($userrow['zid'],$userrow);
	$up=intval($_POST['up']);
	if($up<=0)exit('{"code":-1,"msg":"输入值不正确"}');
	$sql=$DB->query("select * from shua_tools where active=1");
	$data=array();
	while($row=$DB->fetch($sql)){
		if($row['price']==0){
			continue;
		}
		if(strpos($row['name'],'免费')!==false){
			continue;
		}
		$price_obj->setToolInfo($row['tid'],$row);
		$price = $price_obj->getToolPrice($tid);
		$a=(float)$up/100;
		$data[$row['tid']]['price']=round($price*($a+1),2);
	}
	$array_data=serialize($data);
	$DB->query("update `shua_site` set `price`='{$array_data}' where zid='{$userrow['zid']}'");
	exit('{"code":0}');
break;
case 'create_url':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	$force = trim(daddslashes($_GET['force']));
	if(!$userrow['domain'])exit('{"code":-1,"msg":"当前分站还未绑定域名"}');
	$url = 'http://'.$userrow['domain'].'/';
	if($force==1){
		$turl = fanghongdwz($url,true);
	}else{
		$turl = fanghongdwz($url);
	}
	if($turl == $url){
		$result = array('code'=>-1, 'msg'=>'生成失败，请联系站长更换接口');
	}elseif(strpos($turl,'/')){
		$result = array('code'=>0, 'msg'=>'succ', 'url'=>$turl);
	}else{
		$result = array('code'=>-1, 'msg'=>'生成失败：'.$turl);
	}
	exit(json_encode($result));
break;
case 'qiandao':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	if(!$conf['qiandao_reward'])exit('{"code":-1,"msg":"当前站点未开启签到功能"}');
	if(!isset($_SESSION['isqiandao']) || $_SESSION['isqiandao']!=$userrow['zid'])exit('{"code":-1,"msg":"校验失败，请刷新页面重试"}');
	$day = date("Y-m-d");
	$lastday = date("Y-m-d",strtotime("-1 day"));
	
	if ($DB->get_row("SELECT * FROM shua_qiandao WHERE zid='{$userrow['zid']}' and date='$day' order by id desc limit 1")) {
		exit('{"code":-1,"msg":"今天已经签到过了, 明天在来吧！"}');
	}
	if ($row = $DB->get_row("SELECT * FROM shua_qiandao WHERE zid='{$userrow['zid']}' and date='$lastday' order by id desc limit 1")) {
		$continue = $row['continue']+1;
	}else{
		$continue = 1;
	}
	if($continue > $conf['qiandao_day']) $continue = $conf['qiandao_day'];
	$reward = $conf['qiandao_reward'];
	if(strpos($reward,'|')){
		$reward = explode('|',$reward);
		$reward = $reward[$userrow['power']];
		if(!$reward)exit('{"code":-1,"msg":"未配置好签到奖励余额初始值"}');
	}
	for($i=1;$i<$continue;$i++){
		$reward *= $conf['qiandao_mult'];
	}
	$reward = round($reward,2);
	$sql="insert into `shua_qiandao` (`zid`,`qq`,`reward`,`date`,`time`,`continue`) values ('".$userrow['zid']."','".$userrow['qq']."','".$reward."','".$day."','".$date."','".$continue."')";
	if($DB->query($sql)){
		unset($_SESSION['isqiandao']);
		$DB->query("update shua_site set rmb=rmb+{$reward} where zid='{$userrow['zid']}'");
		addPointRecord($userrow['zid'], $reward, '赠送', '您今天签到获得了'.$reward.'元奖励');
		$result = array('code'=>0, 'msg'=>'签到成功，获得'.$reward.'元现金奖励！');
	}else{
		$result = array('code'=>-1, 'msg'=>'签到失败'.$DB->error());
	}
	exit(json_encode($result));
break;
case 'qdcount':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	$day=date("Y-m-d");
	$lastday = date("Y-m-d",strtotime("-1 day"));
	$count1=$DB->count("SELECT count(*) FROM shua_qiandao WHERE date='$day'");
	$count2=$DB->count("SELECT count(*) FROM shua_qiandao WHERE date='$lastday'");
	$count3=$DB->count("SELECT count(*) FROM shua_qiandao");
	$rewardcount=$DB->count("SELECT sum(reward) FROM shua_qiandao WHERE zid='{$userrow['zid']}'");
	$result=array("count1"=>$count1,"count2"=>$count2,"count3"=>$count3,"rewardcount"=>round($rewardcount,2));
	exit(json_encode($result));
break;
case 'msg':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	if($userrow['power']==2){
		$type = '0,2,4';
	}elseif($userrow['power']==1){
		$type = '0,2,3';
	}else{
		$type = '0,1';
	}
	$msgread = trim($userrow['msgread'],',');
	if(empty($msgread))$msgread='0';
	$count=$DB->count("SELECT count(*) FROM shua_message WHERE id NOT IN ($msgread) and type IN ($type)");
	$count2=$DB->count("SELECT count(*) FROM shua_workorder WHERE zid='{$userrow['zid']}' AND status=1");
	$thtime=date("Y-m-d").' 00:00:00';
	$income_today=$DB->count("SELECT sum(point) FROM shua_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime>'$thtime'");
	exit('{"code":0,"count":'.$count.',"count2":'.$count2.',"income_today":"'.round($income_today,2).'"}');
break;
case 'msginfo':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	if($userrow['power']==2){
		$type = array(0,2,4);
	}elseif($userrow['power']==1){
		$type = array(0,2,3);
	}else{
		$type = array(0,1);
	}
	$id=intval($_GET['id']);
	$row=$DB->get_row("select * from shua_message where id='$id' and active=1 limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前消息不存在！"}');
	if(!in_array($row['type'],$type))
		exit('{"code":-1,"msg":"你没有权限查看此消息内容"}');
	if(!in_array($id,explode(',',$userrow['msgread']))){
		$msgread_n = $userrow['msgread'].$id.',';
		$DB->query("UPDATE shua_message SET count=count+1 WHERE id='$id'");
		$DB->query("UPDATE shua_site SET msgread='".$msgread_n."' WHERE zid='{$userrow['zid']}'");
	}
	$result=array("code"=>0,"msg"=>"succ","title"=>$row['title'],"type"=>$row['type'],"content"=>$row['content'],"date"=>$row['addtime']);
	exit(json_encode($result));
break;
case 'recharge':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	$value=daddslashes($_GET['value']);
	$trade_no=date("YmdHis").rand(111,999);
	if(!is_numeric($value) || !preg_match('/^[0-9.]+$/', $value))exit('{"code":-1,"msg":"提交参数错误！"}');
	$sql="insert into `shua_pay` (`trade_no`,`tid`,`input`,`name`,`money`,`ip`,`addtime`,`status`) values ('".$trade_no."','-1','".$userrow['zid']."','在线充值余额','".$value."','".$clientip."','".$date."','0')";
	if($DB->query($sql)){
		exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","money":"'.$value.'","name":"在线充值余额"}');
	}else{
		exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
	}
break;
case 'setClass':
	if(!$islogin2)exit('{"code":-1,"msg":"未登录"}');
	$cid=intval($_GET['cid']);
	$active=intval($_GET['active']);
	$classhide = explode(',',$userrow['class']);
	if($active == 1 && in_array($cid, $classhide)){
		$classhide = array_diff($classhide, array($cid));
	}elseif($active == 0 && !in_array($cid, $classhide)){
		$classhide[] = $cid;
	}
	$class = implode(',',$classhide);
	$DB->query("update `shua_site` set `class`='{$class}' where zid='{$userrow['zid']}'");
	exit('{"code":0}');
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}