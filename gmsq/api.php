<?php

include("./includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
$url=daddslashes($_GET['url']);
$authcode=daddslashes($_GET['authcode']);

@header('Content-Type: application/json; charset=UTF-8');

if($act=='clone')
{
	$key=daddslashes($_GET['key']);
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=md5($password_hash.md5(SYS_KEY).$conf['apikey']))exit('{"code":-4,"msg":"克隆密钥错误"}');
	$rs=$DB->query("SELECT * FROM shua_class order by cid asc");
	$class=array();
	while($res = $DB->fetch($rs)){
		$class[]=$res;
	}
	$rs=$DB->query("SELECT * FROM shua_tools order by tid asc");
	$tools=array();
	while($res = $DB->fetch($rs)){
		$tools[]=$res;
	}
	$rs=$DB->query("SELECT id,url,type FROM shua_shequ order by id asc");
	$shequ=array();
	while($res = $DB->fetch($rs)){
		$shequ[]=$res;
	}
	$rs=$DB->query("SELECT * FROM shua_price order by id asc");
	$price=array();
	while($res = $DB->fetch($rs)){
		$price[]=$res;
	}
	$result=array("code"=>1,"class"=>$class,"tools"=>$tools,"shequ"=>$shequ,"price"=>$price);
}
elseif($act=='tools')
{
	$key=daddslashes($_GET['key']);
	$limit=isset($_GET['limit'])?intval($_GET['limit']):50;
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1 order by tid asc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('tid'=>$res['tid'],'cid'=>$res['cid'],'sort'=>$res['sort'],'name'=>$res['name'],'price'=>$res['price']);
	}
	exit(json_encode($data));
}
elseif($act=='orders')
{
	$tid=intval($_GET['tid']);
	$key=daddslashes($_GET['key']);
	$limit=isset($_GET['limit'])?intval($_GET['limit']):50;
	$format=isset($_GET['format'])?daddslashes($_GET['format']):'json';
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	if($tid){
		$tool=$DB->get_row("SELECT * FROM shua_tools WHERE tid='$tid' and active=1 limit 1");
		if(!$tool)exit('{"code":-5,"msg":"商品ID不存在"}');
		$sqls=" and tid='$tid'";
		$value=$tool['value']>0?$tool['value']:1;
	}
	$rs=$DB->query("SELECT * FROM shua_orders WHERE status=0{$sqls} order by id asc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'input'=>$res['input'],'input2'=>$res['input2'],'input3'=>$res['input3'],'input4'=>$res['input4'],'input5'=>$res['input5'],'value'=>$res['value'],'status'=>$res['status']);
		if($_GET['sign']==1)$DB->query("update `shua_orders` set status=1 where `id`='{$res['id']}'");
	}
	if($format=='text'){
		$txt = '';
		foreach($data as $row){
			$txt .= $row['input'] . ($row['input2']?'----'.$row['input2']:null) . ($row['input3']?'----'.$row['input3']:null) . ($row['input4']?'----'.$row['input4']:null) . ($row['input5']?'----'.$row['input5']:null) . '----' . $row['value'] . "\r\n";
		}
		exit($txt);
	}else{
		exit(json_encode($data));
	}
}
elseif($act=='change')
{
	$id=intval($_GET['id']);
	$key=daddslashes($_GET['key']);
	$status=intval($_GET['zt']); //1:已完成,2:正在处理,3:异常,4:待处理
	if(!$id || !$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	$row=$DB->get_row("SELECT * FROM shua_orders WHERE id='$id' limit 1");
	if($id=$row['id']) {
		$sql="update `shua_orders` set `status`='$status' where `id`='{$id}' limit 1";
		if($DB->query($sql)){
			$result=array("code"=>1,"msg"=>"修改成功","id"=>$id);
		}else{
			$result=array("code"=>-1,"msg"=>"修改成功","id"=>$id);
		}
	}
	else
	{
		$result=array("code"=>-5,"msg"=>"订单ID不存在");
	}
}
elseif($act == 'goodslist')
{
	$result['code'] = 0;
	if(isset($_POST['user']) && isset($_POST['pass'])){
		$user = trim(daddslashes($_POST['user']));
		$pass = trim(daddslashes($_POST['pass']));
		$userrow = $DB->get_row("SELECT * FROM `shua_site` WHERE `user` = '{$user}' LIMIT 1");
		if ($userrow && $userrow['user'] == $user && $userrow['pwd'] == $pass && $userrow['status'] == 1) {
			$islogin2 = 1;
			$price_obj = new Price($userrow['zid'],$userrow);
		} elseif ($userrow && $userrow['status'] == 0) {
			exit('{"code":-1,"message":"该账户已被封禁"}');
		} else {
			exit('{"code":-1,"message":"用户名或密码不正确"}');
		}
	}
	$rs=$DB->query("SELECT * FROM `shua_tools` WHERE `active` = 1 ORDER BY `cid` ASC,`sort` ASC");
	while($res = $DB->fetch($rs)){
		if($islogin2 == 1){
			$price_obj->setToolInfo($res['tid'],$res);
			$price = $price_obj->getToolPrice($res['tid']);
		}else{
			$price = 0;
		}
		$data[] = array('tid' => $res['tid'] , 'cid' => $res['cid'] , 'name' => $res['name'] , 'shopimg' => $res['shopimg'] , 'close' => $res['close'] , 'price' => $price);
	}
	$result['data'] = $data;
	exit(json_encode($result));
}
elseif($act == 'goodsdetails')
{
	$result['code'] = 0;
	$tid = intval($_POST['tid']);
	if(!$tid)exit('{"code":-1,"message":"商品ID不能为空"}');
	if(isset($_POST['user']) && isset($_POST['pass'])){
		$user = trim(daddslashes($_POST['user']));
		$pass = trim(daddslashes($_POST['pass']));
		$userrow = $DB->get_row("SELECT * FROM `shua_site` WHERE `user` = '{$user}' LIMIT 1");
		if ($userrow && $userrow['user'] == $user && $userrow['pwd'] == $pass && $userrow['status'] == 1) {
			$islogin2 = 1;
			$price_obj = new Price($userrow['zid'],$userrow);
		} elseif ($userrow && $userrow['status'] == 0) {
			exit('{"code":-1,"message":"该账户已被封禁"}');
		} else {
			exit('{"code":-1,"message":"用户名或密码不正确"}');
		}
	}
	$tool = $DB->get_row("SELECT * FROM `shua_tools` WHERE `tid` = {$tid} LIMIT 1");
	if($islogin2 == 1){
		$price_obj->setToolInfo($tid, $tool);
		$price = $price_obj->getToolPrice($tid);
	}else{
		$price = 0;
	}
	if($res['is_curl']==4){
		$isfaka = 1;
	}else{
		$isfaka = 0;
	}
	$data = array('tid'=>$tool['tid'],'cid'=>$tool['cid'],'sort'=>$tool['sort'],'name'=>$tool['name'],'value'=>$tool['value'],'price'=>$price,'prices'=>$tool['prices'],'input'=>$tool['input'],'inputs'=>$tool['inputs'],'desc'=>$tool['desc'],'alert'=>$tool['alert'],'shopimg'=>$tool['shopimg'],'repeat'=>$tool['repeat'],'multi'=>$tool['multi'],'min'=>$tool['min'],'max'=>$tool['max'],'close'=>$tool['close'],'isfaka'=>$isfaka);
	$result['data'] = $data;
	exit(json_encode($result));
}
elseif($act == 'pay')
{
	$result['code'] = -1;
	$tid = intval($_POST['tid']);
	if(!$tid)exit('{"code":-1,"message":"商品ID不能为空"}');
	$user = trim(daddslashes($_POST['user']));
	$pass = trim(daddslashes($_POST['pass']));
	$input1 = isset($_POST['input1']) ? trim(strip_tags(daddslashes($_POST['input1']))) : exit('{"code":-1,"message":"首个参数值不能为空"}');
	$input2 = trim(strip_tags(daddslashes($_POST['input2'])));
	$input3 = trim(strip_tags(daddslashes($_POST['input3'])));
	$input4 = trim(strip_tags(daddslashes($_POST['input4'])));
	$input5 = trim(strip_tags(daddslashes($_POST['input5'])));
	$num = isset($_POST['num']) ? intval($_POST['num']) : 1;
	$tool = $DB->get_row("SELECT * FROM `shua_tools` WHERE `tid` = {$tid} LIMIT 1");
	if ($tool && $tool['active'] == 1) {
		if($tool['close']==1)exit('{"code":-1,"msg":"当前商品维护中，停止下单！"}');
		$userrow = $DB->get_row("SELECT * FROM `shua_site` WHERE `user` = '{$user}' LIMIT 1");
		if ($userrow && $userrow['user'] == $user && $userrow['pwd'] == $pass && $userrow['status'] == 1) {
			$result['code'] = 0;
			if(in_array($input1,explode("|",$conf['blacklist']))) exit('{"code":-1,"message":"你的下单账号已被拉黑，无法下单！"}');
			if($tool['validate']==1 && is_numeric($input1)){ if(validate_qzone($input1)==false) exit('{"code":-1,"msg":"你的QQ空间设置了访问权限，无法下单！"}'); }
			if($tool['multi'] == 0 || $num < 1) $num = 1;
			
			$islogin2 = 1;
			$price_obj = new Price($userrow['zid'],$userrow);
			$price_obj->setToolInfo($tid,$tool);
			$price = $price_obj->getToolPrice($tid);
			$price=$price_obj->getFinalPrice($price, $num);
			if(!$price)exit('{"code":-1,"msg":"当前商品批发价格优惠设置不正确"}');

			$need = $price * $num;
			if($need == 0) exit('{"code":-2,"message":"不支持免费商品对接"}');
			if ($userrow['rmb'] < $need) exit('{"code":-2,"message":"余额不足，购买此商品还差' . ($need - $userrow['rmb']) . '元"}');

			$trade_no = date("YmdHis").rand(111,999).'RMB';
			$input = $input1 . ($input2 ? '|' . $input2 : null) . ($input3 ? '|' . $input3 : null) . ($input4 ? '|' . $inputvalue4 : null) . ($input5 ? '|' . $input5 : null);
			$sql = "INSERT INTO `shua_pay` (`trade_no`,`type`,`zid`,`input`,`num`,`addtime`,`name`,`money`,`ip`,`status`) VALUES";
			$sql .= "('{$trade_no}','rmb',{$userrow['zid']},'{$input}',{$num},'{$date}','{$tool['name']}',{$need},NULL,0)";
			if ($DB->query($sql)) {
				if ($DB->query("UPDATE `shua_site` SET `rmb` = rmb - {$need} WHERE `zid` = '{$userrow['zid']}'") && $DB->query("UPDATE `shua_pay` SET `status` = 1 WHERE `trade_no` = '{$trade_no}'")) {
					addPointRecord($userrow['zid'], $need, '消费', '购买 '.$tool['name']);
					$srow['tid'] = $tid;
					$srow['num'] = $num;
					$srow['input'] = $input;
					$srow['zid'] = $userrow['zid'];
					$srow['money'] = $need;
					$srow['trade_no'] = $trade_no;
					if($orderid = processOrder($srow)){
						$result['code'] = 0;
						$result['message'] = 'success';
						$result['orderid'] = $orderid;
					} else {
						$result['message'] = '下单失败 : ' . $DB->error();
					}
				} else {
					$result['message'] = '下单失败 : ' . $DB->error();
				}
			} else {
				$result['message'] = '下单失败 : ' . $DB->error();
			}
		} elseif ($userrow && $userrow['status'] == 0) {
			$result['message'] = '该账户已被封禁';
		} else {
			$result['message'] = '用户名或密码不正确';
		}
	} else {
		$result['message'] = '商品ID不存在';
	}
}
elseif($act == 'search') 
{
	$result['code'] = -1;
	$id = intval($_GET['id']);
	$row = $DB->get_row("SELECT * FROM `shua_orders` WHERE `id` = {$id} LIMIT 1");
	if ($row){
		$tool = $DB->get_row("select * from shua_tools where tid='{$row['tid']}' limit 1");
		$shequ = $DB->get_row("select * from shua_shequ where id='{$tool['shequ']}' limit 1");
		if($shequ['type']==1){
			$list = yile_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
		}elseif($shequ['type']==0 || $shequ['type']==2){
			$list = jiuwu_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
		}elseif($shequ['type']==3 || $shequ['type']==5){
			$list = xmsq_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
		}elseif($shequ['type']==10){
			$list = qqbug_chadan($shequ['password'], $row['djorder']);
		}elseif($shequ['type']==11){
			$list = jumeng_chadan($shequ['url'], $row['djorder']);
		}elseif($shequ['type']==20){
			if(class_exists("ExtendAPI") && method_exists('ExtendAPI','chadan')){
				$list = ExtendAPI::chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id'], $row['input']);
			}else{
				exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
			}
		}else{
			exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
		}
		if($list['order_state']=='已完成' && $row['status']==2){
			$DB->query("UPDATE `shua_orders` SET `status`=1 WHERE id='{$id}'");
		}
		if(is_array($list)){
			$result['code'] = 0;
			$result['message'] = 'success';
			$result['data'] = $list;
		}else{
			$result['message'] = '获取数据失败';
		}
	} else {
		$result['message'] = '订单不存在';
	}
}
elseif($act=='siteinfo')
{
	$count1=$DB->count("SELECT count(*) from shua_orders");
	$count2=$DB->count("SELECT count(*) from shua_orders where status>=1");
	$count3=$DB->count("SELECT count(*) from shua_site");
	$result=array('sitename'=>$conf['sitename'],'kfqq'=>$conf['qq']?$conf['qq']:$conf['kfqq'],'anounce'=>$conf['anounce'],'modal'=>$conf['modal'],'bottom'=>$conf['bottom'],'alert'=>$conf['alert'],'gg_search'=>$conf['gg_search'],'gg_panel'=>$conf['gg_panel'],'version'=>VERSION,'build'=>$conf['build'],'orders'=>$count1,'orders1'=>$count2,'sites'=>$count3,'appalert'=>$conf['appalert']);
}
elseif($act=='token')
{
	$key = isset($_GET['key'])?$_GET['key']:exit('No key');
	$result=array('token'=>get_app_token($key),'time'=>time());
}
else
{
	$result=array("code"=>-5,"msg"=>"No Act!");
}

echo json_encode($result);
$DB->close();
?>