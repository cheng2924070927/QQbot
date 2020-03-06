<?php
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'getcount':
	$thtime=date("Y-m-d").' 00:00:00';
	$count1=$DB->count("SELECT count(*) from shua_orders");
	$count2=$DB->count("SELECT count(*) from shua_orders where status=1");
	$count3=$DB->count("SELECT count(*) from shua_orders where status=0");
	$count4=$DB->count("SELECT count(*) from shua_orders where addtime>='$thtime'");
	$count5=$DB->count("SELECT sum(money) from shua_pay where tid!=-1 and addtime>='$thtime' and status=1");

	$strtotime=strtotime($conf['build']);//获取开始统计的日期的时间戳
	$now=time();//当前的时间戳
	$yxts=ceil(($now-$strtotime)/86400);//取相差值然后除于24小时(86400秒)

	$count6=$DB->count("SELECT count(*) from shua_site");
	$count7=$DB->count("SELECT count(*) from shua_site where addtime>='$thtime'");
	$count8=$DB->count("SELECT sum(point) from shua_points where action='提成' and addtime>='$thtime'");

	$count11=$DB->count("SELECT sum(realmoney) FROM `shua_tixian` WHERE `status` = 0");

	$count12=$DB->count("SELECT sum(money) FROM `shua_pay` WHERE `type` = 'qqpay' AND `addtime` > '$thtime' AND `status` = 1");
	$count13=$DB->count("SELECT sum(money) FROM `shua_pay` WHERE `type` = 'wxpay' AND `addtime` > '$thtime' AND `status` = 1");
	$count14=$DB->count("SELECT sum(money) FROM `shua_pay` WHERE `type` = 'alipay' AND `addtime` > '$thtime' AND `status` = 1");

	$result=array("code"=>0,"yxts"=>$yxts,"count1"=>$count1,"count2"=>$count2,"count3"=>$count3,"count4"=>$count4,"count5"=>round($count5,2),"count6"=>$count6,"count7"=>$count7,"count8"=>round($count8,2),"count9"=>round($count9,2),"count10"=>round($count10,2),"count11"=>round($count11,2),"count12"=>round($count12,2),"count13"=>round($count13,2),"count14"=>round($count14,2),"chart"=>getDatePoint());
	exit(json_encode($result));
break;
case 'qdcount':
	$day=date("Y-m-d");
	$lastday = date("Y-m-d",strtotime("-1 day"));
	$count1=$DB->count("SELECT count(*) FROM shua_qiandao WHERE date='$day'");
	$count2=$DB->count("SELECT count(*) FROM shua_qiandao WHERE date='$lastday'");
	$count3=$DB->count("SELECT count(*) FROM shua_qiandao");
	$count4=$DB->count("SELECT sum(reward) FROM shua_qiandao WHERE date='$day'");
	$count5=$DB->count("SELECT sum(reward) FROM shua_qiandao WHERE date='$lastday'");
	$count6=$DB->count("SELECT sum(reward) FROM shua_qiandao");
	$result=array("count1"=>$count1,"count2"=>$count2,"count3"=>$count3,"count4"=>round($count4,2),"count5"=>round($count5,2),"count6"=>round($count6,2));
	exit(json_encode($result));
break;
case 'tool':
	$tid=intval($_POST['tid']);
	$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"商品ID不存在"}');
	exit('{"code":0,"name":"'.$rows['name'].'"}');
break;
case 'addClass':
	$name=$_POST['name'];
	if($name==null)
		exit('{"code":-1,"msg":"分类名不能为空"}');
	$rows=$DB->get_row("select * from shua_class where name='$name' limit 1");
	if($rows)
		exit('{"code":-1,"msg":"当前分类名称已存在"}');
	$sql="insert into `shua_class` (`name`,`active`) values ('".$name."','1')";
	if($cid=$DB->insert($sql)){
		$DB->query("UPDATE `shua_class` SET `sort`='$cid' WHERE `cid`='{$cid}'");
		exit('{"code":0,"msg":"添加分类成功！"}');
	}else
		exit('{"code":-1,"msg":"添加分类失败！'.$DB->error().'"}');
break;
case 'editClass':
	$cid=intval($_GET['cid']);
	$rows=$DB->get_row("select * from shua_class where cid='$cid' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"分类不存在"}');
	$name=$_POST['name'];
	if($name==null)
		exit('{"code":-1,"msg":"分类名不能为空"}');
	if($DB->query("update shua_class set name='$name' where cid='{$cid}'"))
		exit('{"code":0,"msg":"修改分类成功！"}');
	else
		exit('{"code":-1,"msg":"修改分类失败！'.$DB->error().'"}');
break;
case 'delClass':
	$cid=intval($_GET['cid']);
	$DB->query("DELETE FROM shua_tools WHERE cid='$cid'");
	$sql="DELETE FROM shua_class WHERE cid='$cid'";
	if($DB->query($sql))
		exit('{"code":0,"msg":"删除分类成功！"}');
	else
		exit('{"code":-1,"msg":"删除分类失败！'.$DB->error().'"}');
break;
case 'editClassAll':
	foreach($_POST as $k=>$v){
		if(substr($k,0,4)=='name'){
			$cid = intval(substr($k,4));
			$DB->query("update shua_class set name='$v' where cid='{$cid}'");
		}
	}
	exit('{"code":0,"msg":"修改分类成功！"}');
break;
case 'editClassImages':
	foreach($_POST as $k=>$v){
		if(substr($k,0,3)=='img'){
			$cid = intval(substr($k,3));
			$DB->query("update shua_class set shopimg='$v' where cid='{$cid}'");
		}
	}
	exit('{"code":0,"msg":"修改分类成功！"}');
break;
case 'getClassImage':
	$cid=intval($_GET['cid']);
	$rows=$DB->get_row("select shopimg from shua_tools where cid='$cid' and shopimg is not null limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"分类不存在"}');
	exit('{"code":0,"msg":"succ","url":"'.$rows['shopimg'].'"}');
break;
case 'uploadimg':
	if($_POST['do']=='upload'){
		$type = $_POST['type'];
		$filename = $type.'_'.md5_file($_FILES['file']['tmp_name']).'.png';
		$fileurl = 'assets/img/Product/'.$filename;
		if(copy($_FILES['file']['tmp_name'], ROOT.'assets/img/Product/'.$filename)){
			exit('{"code":0,"msg":"succ","url":"'.$fileurl.'"}');
		}else{
			exit('{"code":-1,"msg":"上传失败，请确保有本地写入权限"}');
		}
	}
	exit('{"code":-1,"msg":"null"}');
break;
case 'getTool':
	$tid=intval($_GET['tid']);
	$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"商品不存在"}');
	$rows['link'] = 'http://'.$_SERVER['HTTP_HOST'].'/?cid='.$rows['cid'].'&tid='.$rows['tid'];
	$result=array("code"=>0,"msg"=>"succ","data"=>$rows);
	exit(json_encode($result));
break;
case 'getPrice':
	$tid=intval($_GET['tid']);
	$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"商品不存在"}');
	if($_SESSION['priceselect']){
		$priceselect = $_SESSION['priceselect'];
	}else{
		$rs=$DB->query("SELECT * FROM shua_price order by id asc");
		$priceselect='<option value="0">不加价</option>';
		while($res = $DB->fetch($rs)){
			$kind = $res['kind']==1?'元':'倍';
			$priceselect.='<option value="'.$res['id'].'" kind="'.$res['kind'].'" p_2="'.$res['p_2'].'" p_1="'.$res['p_1'].'" p_0="'.$res['p_0'].'" >'.$res['name'].'('.$res['p_2'].$kind.'|'.$res['p_1'].$kind.'|'.$res['p_0'].$kind.')</option>';
		}
	}
	$data = '<div class="form-group"><div class="input-group"><div class="input-group-addon">成本价格</div><input type="text" id="price" value="'.$rows['price'].'" class="form-control" required onkeyup="changePrice()"/></div></div>
	<div class="form-group"><div class="input-group"><div class="input-group-addon">加价模板</div><select class="form-control" id="prid" onchange="changePrice()">'.$priceselect.'</select></div></div>
<table class="table table-striped table-bordered table-condensed">
<tbody>
<tr align="center"><td>销售价格</td><td>普及版价格</td><td>专业版价格</td></tr>
<tr>
<td><input type="text" id="price_s" value="" class="form-control input-sm" disabled/></td>
<td><input type="text" id="cost_s" value="" class="form-control input-sm" disabled/></td>
<td><input type="text" id="cost2_s" value="" class="form-control input-sm" disabled/></td>
</tr>
</table>
	<input type="submit" id="save" onclick="editPrice('.$tid.')" class="btn btn-primary btn-block" value="保存">
	<script>$("#prid").val('.$rows['prid'].');</script>';
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'editPrice':
	$tid=intval($_POST['tid']);
	$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"商品不存在"}');
	$price=$_POST['price'];
	$prid=intval($_POST['prid']);
	if($DB->query("UPDATE `shua_tools` SET `price`='$price',`prid`='$prid',`cost`='0',`cost2`='0' WHERE `tid`='{$tid}'"))
		exit('{"code":0,"msg":"succ"}');
	else
		exit('{"code":-1,"msg":"修改商品失败！'.$DB->error().'"}');
break;
case 'getAllPrice':
	if($_SESSION['priceselect']){
		$priceselect = $_SESSION['priceselect'];
	}else{
		$rs=$DB->query("SELECT * FROM shua_price order by id asc");
		$priceselect='<option value="0">不加价</option>';
		while($res = $DB->fetch($rs)){
			$kind = $res['kind']==1?'元':'倍';
			$priceselect.='<option value="'.$res['id'].'" kind="'.$res['kind'].'" p_2="'.$res['p_2'].'" p_1="'.$res['p_1'].'" p_0="'.$res['p_0'].'" >'.$res['name'].'('.$res['p_2'].$kind.'|'.$res['p_1'].$kind.'|'.$res['p_0'].$kind.')</option>';
		}
	}
	$data = '<div class="form-group"><div class="input-group"><select class="form-control" name="prid_n">'.$priceselect.'</select></div></div>
	<input type="submit" id="save" onclick="editAllPrice()" class="btn btn-primary btn-block" value="保存">';
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'editAllPrice':
	$prid=intval($_POST['prid']);
	$checkbox=$_POST['checkbox'];
	$i=0;
	foreach($checkbox as $tid){
		$DB->query("update shua_tools set prid={$prid},`cost`='0',`cost2`='0' where tid='$tid' limit 1");
		$i++;
	}
	exit('{"code":0,"msg":"成功改变'.$i.'个商品"}');
break;
case 'shop_move':
	$cid=intval($_POST['cid']);
	if(!$cid)exit('{"code":-1,"msg":"请选择分类"}');
	$checkbox=$_POST['checkbox'];
	$i=0;
	foreach($checkbox as $tid){
		$DB->query("update shua_tools set cid='$cid' where tid='$tid' limit 1");
		$i++;
	}
	exit('{"code":0,"msg":"成功移动'.$i.'个商品"}');
break;
case 'shop_change':
	$aid=$_POST['aid'];
	$checkbox=$_POST['checkbox'];
	$i=0;
	foreach($checkbox as $tid){
		if($aid==1){
			$DB->query("update shua_tools set active=1 where tid='$tid' limit 1");
		}elseif($aid==2){
			$DB->query("update shua_tools set active=0 where tid='$tid' limit 1");
		}elseif($aid==3){
			$DB->query("update shua_tools set close=0 where tid='$tid' limit 1");
		}elseif($aid==4){
			$DB->query("update shua_tools set close=1 where tid='$tid' limit 1");
		}elseif($aid==5){
			$DB->query("DELETE FROM shua_tools WHERE tid='$tid' limit 1");
		}elseif($aid==6){
			$DB->query("insert into `shua_tools` (`cid`,`name`,`price`,`prid`,`cost`,`cost2`,`input`,`inputs`,`alert`,`desc`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`sort`,`active`) select `cid`,`name`,`price`,`prid`,`cost`,`cost2`,`input`,`inputs`,`alert`,`desc`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`sort`,`active` from `shua_tools` where `tid` = '$tid'");
		}
		$i++;
	}
	exit('{"code":0,"msg":"成功改变'.$i.'个商品"}');
break;
case 'delTool':
	$tid=intval($_GET['tid']);
	$sql="DELETE FROM shua_tools WHERE tid='$tid' limit 1";
	if($DB->query($sql))
		exit('{"code":0,"msg":"删除商品成功！"}');
	else
		exit('{"code":-1,"msg":"删除商品失败！'.$DB->error().'"}');
break;
case 'setStatus':
	$id=intval($_GET['name']);
	$status=intval($_GET['status']);
	if($status==5){
		if($DB->query("DELETE FROM shua_orders WHERE id='$id'"))
			exit('{"code":200}');
		else
			exit('{"code":400,"msg":"删除订单失败！'.$DB->error().'"}');
	}else{
		if($DB->query("update shua_orders set status='$status',result=NULL where id='{$id}'"))
			exit('{"code":200}');
		else
			exit('{"code":400,"msg":"修改订单失败！'.$DB->error().'"}');
	}
break;
case 'order':
	$id=intval($_GET['id']);
	$rows=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$tool=$DB->get_row("select * from shua_tools where tid='{$rows['tid']}' limit 1");
	if(strpos($rows['tradeno'],'kid')!==false){
		$kid=explode(':',$rows['tradeno']);
		$kid=$kid[1];
		$trade=$DB->get_row("select * from shua_kms where kid='$kid' limit 1");
		$trade['type']='卡密';
		$addstr='<li class="list-group-item"><b>使用卡密：</b>'.$trade['km'].'</li>';
	}elseif(strpos($rows['tradeno'],'invite')!==false){
		$trade['type']='推广赠送';
	}elseif(!empty($rows['tradeno'])){
		$trade=$DB->get_row("select * from shua_pay where trade_no='{$rows['tradeno']}' limit 1");
		$addstr='<li class="list-group-item"><b>支付订单号：</b>'.$trade['trade_no'].'</li><li class="list-group-item"><b>支付金额：</b>'.$trade['money'].'</li><li class="list-group-item"><b>支付IP：</b><a href="http://m.ip138.com/ip.asp?ip='.$trade['ip'].'" target="_blank">'.$trade['ip'].'</a></li>';
	}else{
		$trade['type']='默认';
	}
	$input=$tool['input']?$tool['input']:'下单QQ';
	$inputs=explode('|',$tool['inputs']);
	$value=$tool['value']>0?$tool['value']:1;
	$data = '<li class="list-group-item"><b>商品名称：</b>'.$tool['name'].'</li><li class="list-group-item"><b>下单数据：</b><br/>'.$input.'：'.$rows['input'].($rows['input2']?'<br/>'.$inputs[0].'：'.$rows['input2']:null).($rows['input3']?'<br/>'.$inputs[1].'：'.$rows['input3']:null).($rows['input4']?'<br/>'.$inputs[2].'：'.$rows['input4']:null).($rows['input5']?'<br/>'.$inputs[3].'：'.$rows['input5']:null).'</li><li class="list-group-item"><b>下单数量：</b>'.($rows['value']*$value).'</li><li class="list-group-item"><b>站点ID：</b>'.$rows['zid'].'</li><li class="list-group-item"><b>下单时间：</b>'.$rows['addtime'].'</li><li class="list-group-item"><b>购买方式：</b>'.$trade['type'].'</li>'.$addstr;
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'order2':
	$id=intval($_GET['id']);
	$rows=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$tool=$DB->get_row("select * from shua_tools where tid='{$rows['tid']}' limit 1");
	$input=$tool['input']?$tool['input']:'下单ＱＱ';
	$inputs=explode('|',$tool['inputs']);
	$data = '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname">'.$input.'</div><input type="text" id="inputvalue" value="'.$rows['input'].'" class="form-control" required/></div></div>';
	if($inputs[0])$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname2">'.$inputs[0].'</div><input type="text" id="inputvalue2" value="'.$rows['input2'].'" class="form-control" required/></div></div>';
	if($inputs[1])$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname3">'.$inputs[1].'</div><input type="text" id="inputvalue3" value="'.$rows['input3'].'" class="form-control" required/></div></div>';
	if($inputs[2])$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname4">'.$inputs[2].'</div><input type="text" id="inputvalue4" value="'.$rows['input4'].'" class="form-control" required/></div></div>';
	if($inputs[3])$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname5">'.$inputs[3].'</div><input type="text" id="inputvalue5" value="'.$rows['input5'].'" class="form-control" required/></div></div>';
	$data .= '<input type="submit" id="save" onclick="saveOrder('.$id.')" class="btn btn-primary btn-block" value="保存">';
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'order3':
	$id=intval($_GET['id']);
	$rows=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$data = '<div class="form-group"><div class="input-group"><div class="input-group-addon">份数</div><input type="text" id="num" value="'.$rows['value'].'" class="form-control" required/></div></div>';
	$data .= '<input type="submit" id="save" onclick="saveOrderNum('.$id.')" class="btn btn-primary btn-block" value="保存">';
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'editOrder':
	$id=intval($_POST['id']);
	$inputvalue=trim(daddslashes($_POST['inputvalue']));
	$inputvalue2=trim(daddslashes($_POST['inputvalue2']));
	$inputvalue3=trim(daddslashes($_POST['inputvalue3']));
	$inputvalue4=trim(daddslashes($_POST['inputvalue4']));
	$inputvalue5=trim(daddslashes($_POST['inputvalue5']));
	$sds=$DB->query("update `shua_orders` set `input`='$inputvalue',`input2`='$inputvalue2',`input3`='$inputvalue3',`input4`='$inputvalue4',`input5`='$inputvalue5' where `id`='$id'");
	if($sds)
		exit('{"code":0,"msg":"修改订单成功！"}');
	else
		exit('{"code":-1,"msg":"修改订单失败！'.$DB->error().'"}');
break;
case 'editOrderNum':
	$id=intval($_POST['id']);
	$num=intval($_POST['num']);
	$sds=$DB->query("update `shua_orders` set `value`='$num' where `id`='$id'");
	if($sds)
		exit('{"code":0,"msg":"修改订单成功！"}');
	else
		exit('{"code":-1,"msg":"修改订单失败！'.$DB->error().'"}');
break;
case 'operation':
	$status=$_POST['status'];
	$checkbox=$_POST['checkbox'];
	$i=0;
	$statuss=$conf['shequ_status']?$conf['shequ_status']:1;
	foreach($checkbox as $id){
		if($status==4)$DB->query("DELETE FROM shua_orders WHERE id='$id'");
		elseif($status==5){
			$result = do_goods($id);
			if(strpos($result,'成功')!==false){
				$DB->query("update shua_orders set status='$statuss',djzt='1',result=NULL where id='{$id}'");
			}
		}elseif($status==6){
			$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
			if($row && $row['zid']>1 && $row['status']==3){
				$tc_point=$DB->get_column("select point from shua_points where zid='{$row['zid']}' and action='提成' and orderid='$id' limit 1");
				$money=$row['money'];
				if($tc_point>0)$money-=$tc_point;
				$DB->query("update `shua_site` set `rmb`=`rmb`+{$money} where `zid`='{$row['zid']}'");
				addPointRecord($row['zid'], $money, '退款', '订单(ID'.$id.')已退款到分站余额');
				$DB->query("update shua_orders set status='4',result=NULL where id='{$id}'");
			}
		}
		else $DB->query("update shua_orders set status='$status' where id='$id' limit 1");
		$i++;
	}
	exit('{"code":0,"msg":"成功改变'.$i.'条订单状态"}');
break;
case 'result':
	$id=intval($_POST['id']);
	$rows=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	exit('{"code":0,"result":"'.$rows['result'].'"}');
break;
case 'setresult':
	$id=intval($_POST['id']);
	$rows=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$result=$_POST['result'];
	if($DB->query("update shua_orders set result='$result' where id='{$id}'"))
		exit('{"code":0,"msg":"修改订单成功！"}');
	else
		exit('{"code":-1,"msg":"修改订单失败！'.$DB->error().'"}');
break;
case 'checkshequ':
	$url = $_POST['url'];
	if(gethostbyname($url)=='127.0.0.1'){
		exit('{"code":0}');
	}else{
		exit('{"code":1}');
	}
break;
case 'checkclone':
	$url = $_POST['url'];
	$url_arr = parse_url($url);
	if($url_arr['host']==$_SERVER['HTTP_HOST'])exit('{"code":2}');
	$data = get_curl($url.'api.php?act=clone');
	$arr = json_decode($data,true);
	if(array_key_exists('code',$arr) && array_key_exists('msg',$arr)){
		exit('{"code":1}');
	}elseif(substr(bin2hex($data),0,6)=='efbbbf'){
		exit('{"code":3}');
	}else{
		exit('{"code":0}');
	}
break;
case 'checkdwz':
	$url = $_POST['url'];
	$data = get_curl($url);
	if(json_decode($data,true)){
		exit('{"code":1}');
	}elseif($data){
		exit('{"code":2}');
	}else{
		exit('{"code":0}');
	}
break;
case 'getTixian': //查看提现信息
	$id=intval($_GET['id']);
	$rows=$DB->get_row("select * from shua_tixian where id='$id' limit 1");
	if(!$rows)
		exit('{"code":-1,"msg":"当前提现记录不存在！"}');
	$data = '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现方式</div><select class="form-control" id="pay_type" default="'.$userrow['pay_type'].'"><option value="0">支付宝</option><option value="1">微信</option><option value="2">QQ钱包</option></select></div></div>';
	$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现账号</div><input type="text" id="pay_account" value="'.$rows['pay_account'].'" class="form-control" required/></div></div>';
	$data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现姓名</div><input type="text" id="pay_name" value="'.$rows['pay_name'].'" class="form-control" required/></div></div>';
	$data .= '<input type="submit" id="save" onclick="saveInfo('.$id.')" class="btn btn-primary btn-block" value="保存">';
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'editTixian': //修改提现信息
	$id=intval($_POST['id']);
	$pay_type=trim(daddslashes($_POST['pay_type']));
	$pay_account=trim(daddslashes($_POST['pay_account']));
	$pay_name=trim(daddslashes($_POST['pay_name']));
	$sds=$DB->query("update `shua_tixian` set `pay_type`='$pay_type',`pay_account`='$pay_account',`pay_name`='$pay_name' where `id`='$id'");
	if($sds)
		exit('{"code":0,"msg":"修改记录成功！"}');
	else
		exit('{"code":-1,"msg":"修改记录失败！'.$DB->error().'"}');
break;
case 'opTixian': //操作提现
	$id=intval($_POST['id']);
	$op=$_POST['op'];
	if($op == 'delete'){
		$sql="DELETE FROM shua_tixian WHERE id='$id'";
		if($DB->query($sql))
			exit('{"code":0,"msg":"删除成功！"}');
		else
			exit('{"code":-1,"msg":"删除失败！'.$DB->error().'"}');
	}elseif($op == 'complete'){
		if($DB->query("update shua_tixian set status=1,endtime=NOW() where id='$id'"))
			exit('{"code":0,"msg":"已变更为已提现状态"}');
		else
			exit('{"code":-1,"msg":"变更失败！'.$DB->error().'"}');
	}elseif($op == 'reset'){
		if($DB->query("update shua_tixian set status=0 where id='$id'"))
			exit('{"code":0,"msg":"已变更为未提现状态"}');
		else
			exit('{"code":-1,"msg":"变更失败！'.$DB->error().'"}');
	}elseif($op == 'back'){
		$rows=$DB->get_row("select * from shua_tixian where id='$id' limit 1");
		$DB->query("update shua_site set rmb=rmb+{$rows['money']} where zid='{$rows['zid']}'");
		addPointRecord($rows['zid'], $rows['money'], '退回', '提现被退回到分站余额'.$rows['money'].'元，请检查提现方式是否正确');
		if($DB->query("DELETE FROM shua_tixian WHERE id='$id'"))
			exit('{"code":0,"msg":"已成功退回到分站余额"}');
		else
			exit('{"code":-1,"msg":"退回失败！'.$DB->error().'"}');
	}
break;
case 'getmoney': //退款查询
	$id=intval($_POST['id']);
	$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	if($row['zid']<1)exit('{"code":-1,"msg":"退款失败，该订单属于主站"}');
	if($row['status']==4)exit('{"code":-1,"msg":"该订单已退款请勿重复提交"}');
	//if($row['status']!=0&&$row['status']!=3)exit('{"code":-1,"msg":"只有未处理和异常的订单才支持退款"}');
	if($row['money']==0){
		$tool=$DB->get_row("select * from shua_tools where tid='{$row['tid']}' limit 1");
		$money=$tool['price'];
		$money=$row['value']*$money;
	}else{
		$money=$row['money'];
	}
	//$tc_point=$DB->get_column("select point from shua_points where zid='{$row['zid']}' and action='提成' and orderid='$id' limit 1");
	//if($tc_point>0)$money-=$tc_point;
	if($money==0)exit('{"code":-1,"msg":"该订单为0元"}');
	exit('{"code":0,"money":"'.$money.'"}');
break;
case 'refund': //退款操作
	$id=intval($_POST['id']);
	$money=trim(daddslashes($_POST['money']));
	$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	if($row['zid']<1)exit('{"code":-1,"msg":"退款失败，该订单属于主站"}');
	if($row['status']==4)exit('{"code":-1,"msg":"该订单已退款请勿重复提交"}');
	if($row['status']!=0&&$row['status']!=3)exit('{"code":-1,"msg":"只有未处理和异常的订单才支持退款"}');
	if($money<=0)$money=$row['money'];
	$DB->query("update `shua_site` set `rmb`=`rmb`+{$money} where `zid`='{$row['zid']}'");
	rollbackPoint($id);
	addPointRecord($row['zid'], $money, '退款', '订单(ID'.$id.')已退款到分站余额');
	$DB->query("update shua_orders set status='4',result=NULL where id='{$id}'");
	exit('{"code":0,"msg":"该订单已成功退款给分站ID'.$row['zid'].'"}');
break;
case 'djOrder': //重新下单
	$id=intval($_GET['id']);
	$url=$_POST['url'];
	$post=$_POST['post'];
	$result = do_goods($id,$url,$post);
	if(strpos($result,'成功')!==false){
		exit('{"code":0,"msg":"下单成功！"}');
	}else{
		exit('{"code":-1,"msg":"'.$result.'"}');
	}
break;
case 'showStatus': //订单进度查询
	$id=intval($_GET['id']);
	$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$tool=$DB->get_row("select * from shua_tools where tid='{$row['tid']}' limit 1");
	$shequ=$DB->get_row("select * from shua_shequ where id='{$tool['shequ']}' limit 1");
	if($shequ['type']==1){
		$list = yile_chadan($shequ['url'], $row['djorder'], $shequ['username'], $shequ['password']);
	}elseif($shequ['type']==0 || $shequ['type']==2){
		$list = jiuwu_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
	}elseif($shequ['type']==3 || $shequ['type']==5){
		$list = xmsq_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
	}elseif($shequ['type']==10){
		$list = qqbug_chadan($shequ['password'], $row['djorder']);
		$shequ['url']='QQbug社区';
	}elseif($shequ['type']==11){
		$list = jumeng_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
	}elseif($shequ['type']==4){
		$list = jiuliu_chadan($shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id']);
	}elseif($shequ['type']==12){
		$list = this_chadan($shequ['url'], $row['djorder']);
	}elseif($shequ['type']==20){
		if(class_exists("ExtendAPI") && method_exists('ExtendAPI','chadan')){
			$list = ExtendAPI::chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id'], $row['input']);
		}else{
			exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
		}
	}else{
		exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
	}
	if(($list['order_state']=='已完成'||$list['order_state']=='订单已完成') && $row['status']==2){
		$DB->query("update shua_orders set status=1 where id='{$id}'");
	}
	if(is_array($list)){
		$list['orderid'] = $row['djorder'];
		$result=array('code'=>0,'msg'=>'succ','domain'=>$shequ['url'],'data'=>$list);
	}elseif($list){
		$result=array('code'=>-1,'msg'=>$list);
	}else{
		$result=array('code'=>-1,'msg'=>'获取数据失败');
	}
	exit(json_encode($result));
break;
case 'setTools': //商品上下架
	$tid=intval($_GET['tid']);
	if(isset($_GET['active'])){
		$active=intval($_GET['active']);
		$DB->query("update shua_tools set active='$active' where tid='{$tid}'");
	}else{
		$close=intval($_GET['close']);
		$DB->query("update shua_tools set close='$close' where tid='{$tid}'");
	}
	exit('{"code":0,"msg":"succ"}');
break;
case 'setClass': //分类上下架
	$cid=intval($_GET['cid']);
	$active=intval($_GET['active']);
	$DB->query("update shua_class set active='$active' where cid='{$cid}'");
	exit('{"code":0,"msg":"succ"}');
break;
case 'setToolSort': //排序操作
	$cid=intval($_GET['cid']);
	$tid=intval($_GET['tid']);
	$sort=intval($_GET['sort']);
	if(setToolSort($cid,$tid,$sort)){
		exit('{"code":0,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"失败"}');
	}
break;
case 'setClassSort': //排序操作
	$cid=intval($_GET['cid']);
	$sort=intval($_GET['sort']);
	if(setClassSort($cid,$sort)){
		exit('{"code":0,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"失败"}');
	}
break;
case 'getGoodsList': //获取对接商品列表
	$shequ=intval($_POST['shequ']);
	$row=$DB->get_row("select * from shua_shequ where id='$shequ' limit 1");
	if($row['type']==1){
		$type = 'yile';
		$list = yile_goodslist($row['url'],$row['username'],$row['password']);
	}elseif($row['type']==0 || $row['type']==2){
		$type = 'jiuwu';
		$list = jiuwu_goodslist_details($row['url'],$row['username'],$row['password']);
	}elseif($row['type']==3 || $row['type']==5){
		$type = 'xingmo';
		$list = xmsq_goodslist($row['url']);
	}elseif($row['type']==11){
		$type = 'jumeng';
		$list = jumeng_goodslist($row['url'],$row['username'],$row['password']);
	}elseif($row['type']==12){
		$type = 'this';
		$list = this_goodslist($row['url'],$row['username'],$row['password']);
	}elseif($row['type']==20){
		$type = 'extend';
		if(class_exists("ExtendAPI") && method_exists('ExtendAPI','chadan')){
			$list = ExtendAPI::goodslist($row['url'], $row['username'], $row['password']);
		}
	}else{
		exit('{"code":-1,"msg":"请直接在参数名处填写下单页面地址"}');
	}
	if(!is_array($list))$result=array('code'=>-1,'msg'=>$list);
	else $result=array('code'=>0,'msg'=>'succ','type'=>$type,'data'=>$list);
	exit(json_encode($result));
break;
case 'getGoodsParam': //获取对接参数名
	$shequ=intval($_POST['shequ']);
	$goodsid=intval($_POST['goodsid']);
	$row=$DB->get_row("select * from shua_shequ where id='$shequ' limit 1");
	if($row['type']==1){
		$result = yile_goods_details($row['url'],$goodsid,$row['username'],$row['password']);
		$paramname = '';
		foreach($result['inputs'] as $v){
			$paramname.=$v[0].'|';
		}
		$result['paramname'] = trim($paramname, '|');
		$result['code'] = 0;
	}elseif($row['type']==11){
		$result = jumeng_goods_details($row['url'],$goodsid,$row['username'],$row['password']);
		$result['code'] = 0;
	}else{
		$result = jiuwu_goodsparam($row['url'],$goodsid,$row['username'],$row['password']);
	}
	if(!is_array($result)){
		$result['code'] = -1;
		$result['msg'] = $result;
	}
	exit(json_encode($result));
break;
case 'getfakatool': //获取发卡商品
	$cid=intval($_GET['cid']);
	$rs=$DB->query("SELECT * FROM shua_tools WHERE cid='$cid' and is_curl=4 and active=1 order by sort asc");
	$data = array();
	while($res = $DB->fetch($rs)){
		$data[]=array('tid'=>$res['tid'],'name'=>$res['name']);
	}
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'setSite': //开启关闭站点
	$zid=intval($_GET['zid']);
	$active=intval($_GET['active']);
	$DB->query("update shua_site set status='$active' where zid='{$zid}'");
	exit('{"code":0,"msg":"succ"}');
break;
case 'setSuper': //切换站点版本
	$zid=intval($_GET['zid']);
	$row=$DB->get_row("select * from shua_site where zid='$zid' limit 1");
	if($row['power']==2)$power=1;
	else $power=2;
	$DB->query("update shua_site set power='$power' where zid='{$zid}'");
	exit('{"code":0,"msg":"succ"}');
break;
case 'setEndtime': //分站延时
	$zid=intval($_POST['zid']);
	$month=intval($_POST['month']);
	$row=$DB->get_row("select * from shua_site where zid='$zid' limit 1");
	if($row['endtime']>date("Y-m-d")) $endtime = date("Y-m-d", strtotime("+ {$month} months", strtotime($row['endtime'])));
	else $endtime = date("Y-m-d", strtotime("+ {$month} months"));
	$DB->query("update shua_site set endtime='$endtime' where zid='{$zid}'");
	exit('{"code":0,"msg":"succ"}');
break;
case 'siteRecharge': //分站充值
	$zid=intval($_POST['zid']);
	$do=intval($_POST['actdo']);
	$rmb=floatval($_POST['rmb']);
	$row=$DB->get_row("select * from shua_site where zid='$zid' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前分站不存在！"}');
	if($do==1 && $rmb>$row['rmb'])$rmb=$row['rmb'];
	if($do==0){
		$DB->query("update shua_site set rmb=rmb+{$rmb} where zid='{$zid}'");
		addPointRecord($zid, $rmb, '加款', '后台加款'.$rmb.'元');
	}else{
		$DB->query("update shua_site set rmb=rmb-{$rmb} where zid='{$zid}'");
		addPointRecord($zid, $rmb, '扣除', '后台扣款'.$rmb.'元');
	}
	exit('{"code":0,"msg":"succ"}');
break;
case 'setMessage': //站内通知状态
	$id=intval($_GET['id']);
	$active=intval($_GET['active']);
	$DB->query("update shua_message set active='$active' where id='{$id}'");
	exit('{"code":0,"msg":"succ"}');
break;
case 'getMessage': //查看站内通知
	$id=intval($_GET['id']);
	$row=$DB->get_row("select * from shua_message where id='$id' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前通知不存在！"}');
	$result=array("code"=>0,"msg"=>"succ","title"=>$row['title'],"type"=>$row['type'],"content"=>$row['content'],"date"=>$row['addtime']);
	exit(json_encode($result));
break;
case 'addPriceRule': //添加加价模板
	$name=trim(daddslashes($_POST['name']));
	$kind=intval($_POST['kind']);
	$p_2=trim(daddslashes($_POST['p_2']));
	$p_1=trim(daddslashes($_POST['p_1']));
	$p_0=trim(daddslashes($_POST['p_0']));
	if($name==null || $p_2==null || $p_1==null || $p_0==null){
		exit('{"code":-1,"msg":"请确保各项不能为空！"}');
	}elseif($p_2>$p_1){
		exit('{"code":-1,"msg":"专业版加价不能高于普及版加价"}');
	}elseif($p_2>$p_0){
		exit('{"code":-1,"msg":"专业版加价不能高于普通用户加价"}');
	}elseif($p_1>$p_0){
		exit('{"code":-1,"msg":"普及版加价不能高于普通用户加价"}');
	}elseif($DB->get_row("select * from shua_price where name='$name' limit 1")){
		exit('{"code":-1,"msg":"模板名称已存在"}');
	}
	$sql="insert into `shua_price` (`kind`,`name`,`p_0`,`p_1`,`p_2`) values ('".$kind."','".$name."','".$p_0."','".$p_1."','".$p_2."')";
	if($DB->query($sql)){
		$CACHE->clear('pricerules');
		exit('{"code":0,"msg":"添加加价模板成功！"}');
	}else{
		exit('{"code":-1,"msg":"添加加价模板失败！'.$DB->error().'"}');
	}
break;
case 'editPriceRule': //修改加价模板
	$id=intval($_POST['prid']);
	$name=trim(daddslashes($_POST['name']));
	$kind=intval($_POST['kind']);
	$p_2=trim(daddslashes($_POST['p_2']));
	$p_1=trim(daddslashes($_POST['p_1']));
	$p_0=trim(daddslashes($_POST['p_0']));
	if($name==null || $p_2==null || $p_1==null || $p_0==null){
		exit('{"code":-1,"msg":"请确保各项不能为空！"}');
	}elseif($p_2>$p_1){
		exit('{"code":-1,"msg":"专业版加价不能高于普及版加价"}');
	}elseif($p_2>$p_0){
		exit('{"code":-1,"msg":"专业版加价不能高于普通用户加价"}');
	}elseif($p_1>$p_0){
		exit('{"code":-1,"msg":"普及版加价不能高于普通用户加价"}');
	}elseif($DB->get_row("select * from shua_price where id!=$id and name='$name' limit 1")){
		exit('{"code":-1,"msg":"模板名称已存在"}');
	}
	$sql="update shua_price set kind='$kind',name='$name',p_2='$p_2',p_1='$p_1',p_0='$p_0' where id='{$id}'";
	if($DB->query($sql)){
		$CACHE->clear('pricerules');
		exit('{"code":0,"msg":"修改加价模板成功！"}');
	}else{
		exit('{"code":-1,"msg":"修改加价模板失败！'.$DB->error().'"}');
	}
break;
case 'getPriceRule':
	$id=intval($_GET['id']);
	$row=$DB->get_row("select * from shua_price where id='$id' limit 1");
	$row['code']=0;
	exit(json_encode($row));
break;
case 'delPriceRule':
	$id=intval($_GET['id']);
	$sql="DELETE FROM shua_price WHERE id='$id' limit 1";
	if($DB->query($sql)){
		$CACHE->clear('pricerules');
		exit('{"code":0,"msg":"删除成功！"}');
	}else{
		exit('{"code":-1,"msg":"删除失败！'.$DB->error().'"}');
	}
break;
case 'workorder_change':
	$aid=$_POST['aid'];
	$checkbox=$_POST['checkbox'];
	$i=0;
	foreach($checkbox as $id){
		if($aid==1){
			$DB->query("update shua_workorder set status=0 where id='$id' limit 1");
			$i++;
		}elseif($aid==2){
			$DB->query("update shua_workorder set status=2 where id='$id' limit 1");
			$i++;
		}elseif($aid==3){
			$rows=$DB->get_row("select * from shua_workorder where id='$id' limit 1");
			$content=str_replace(array('*','^','|'),'',trim(strip_tags(daddslashes($_POST['content']))));
			if($rows && $rows['status']<2 && !empty($content)){
				$content = addslashes($rows['content']).'*1^'.$date.'^'.$content;
				$DB->query("update shua_workorder set content='$content',status=1 where id='$id' limit 1");
				$i++;
			}
		}elseif($aid==4){
			$DB->query("DELETE FROM shua_workorder WHERE id='$id' limit 1");
			$i++;
		}
	}
	exit('{"code":0,"msg":"成功改变'.$i.'个工单"}');
break;
case 'add_member':
	$name=$_POST['name'];
	$tid=$_POST['tid'];
	$rate=str_replace('%','',$_POST['rate']);
	if(!$name||!$tid||!$rate){
		exit('{"code":-1,"msg":"请输入完整！"}');
	}
	$sql=$DB->query("INSERT INTO `shua_gift`(`name`,`tid`,`rate`,`ok`) VALUES ('{$name}','{$tid}',{$rate},0)");
	if($sql){
		exit('{"code":0,"msg":"添加成功"}');
	}else{
		exit('{"code":1,"msg":"添加失败，'.$DB->error().'"}');
	}
break;
case 'edit_cj':
	$id=$_POST['id'];
	if(!$id){
		exit('{"code":-1,"msg":"请输入完整！"}');
	}
	$sql=$DB->get_row("SELECT * FROM shua_gift where id='{$id}'");
	if($sql){
		$cid = $DB->get_column("select cid from shua_tools where tid='{$sql['tid']}' limit 1");
		exit('{"code":0,"msg":"查询成功","id":"'.$id.'","name":"'.$sql['name'].'","cid":"'.$cid.'","tid":"'.$sql['tid'].'","rate":"'.$sql['rate'].'"}');
	}else{
		exit('{"code":1,"msg":"查询失败，'.$DB->error().'"}');
	}
break;
case 'edit_cj_ok':
	$id=$_POST['id'];
	$name=$_POST['name'];
	$tid=$_POST['tid'];
	$rate=$_POST['rate'];
	if(!$id){
		exit('{"code":-1,"msg":"请输入完整！"}');
	}
	$sql=$DB->query("UPDATE shua_gift set name='{$name}',tid='{$tid}',rate='{$rate}' where id='{$id}'");
	if($sql){
		exit('{"code":0,"msg":"修改成功"}');
	}else{
		exit('{"code":1,"msg":"修改失败，'.$DB->error().'"}');
	}
break;
case 'del_member':
	$id=$_POST['id'];
	if(!$id){
		exit('{"code":-1,"msg":"请输入完整！"}');
	}
	$sql=$DB->query("DELETE FROM shua_gift WHERE id='{$id}'");
	if($sql){
		exit('{"code":0,"msg":"删除成功"}');
	}else{
		exit('{"code":1,"msg":"删除失败，'.$DB->error().'"}');
	}
break;
case 'cishu':
	$cishu=$_GET['cishu'];
	$gift_open=$_GET['gift_open'];
	$cjmsg=$_GET['cjmsg'];
	$cjmoney=$_GET['cjmoney'];
	$gift_log=$_GET['gift_log'];
	if($cishu==''||$cishu==0 || $gift_open==''||$cjmsg==''){
		exit('{"code":-1,"msg":"请输入完整！"}');
	}
	if($cjmoney==''){
		$cjmoney=0;
	}
	saveSetting('cjcishu',$cishu);
	saveSetting('gift_open',$gift_open);
	saveSetting('cjmsg',$cjmsg);
	saveSetting('cjmoney',$cjmoney);
	saveSetting('gift_log',$gift_log);
	$ad=$CACHE->clear();
	if($ad){
		exit('{"code":0,"msg":"修改成功"}');
	}else{
		exit('{"code":1,"msg":"修改失败，'.$DB->error().'"}');
	}
break;
case 'create_url':
	$force = trim(daddslashes($_GET['force']));
    $url = trim(daddslashes($_GET['longurl']));
	if($force==1){
		$turl = fanghongdwz($url,true);
	}else{
		$turl = fanghongdwz($url);
	}
	if($turl == $url){
		$result = array('code'=>-1, 'msg'=>'生成失败，请更换接口');
	}else{
		$result = array('code'=>0, 'msg'=>'succ', 'url'=>$turl);
	}
	exit(json_encode($result));
break;
case 'getServerIp':
	$ip = getServerIp();
	exit('{"code":0,"ip":"'.$ip.'"}');
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}