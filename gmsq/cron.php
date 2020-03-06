<?php
/*支付接口订单监控文件
说明：用于请求支付接口订单列表，同步未通知到本站的订单，防止漏单。
监控频率建议5分钟一次
注意：千万不要监控太快或使用多节点监控！！！否则会被支付接口自动屏蔽IP地址
*/

include("./includes/common.php");
$payapi = 'http://payeco.hl-5.com';
if (function_exists("set_time_limit"))
{
	@set_time_limit(0);
}
if (function_exists("ignore_user_abort"))
{
	@ignore_user_abort(true);
}

@header('Content-Type: text/html; charset=UTF-8');

if($conf['epay_pid'] && $conf['epay_key']){
$data = get_curl($payapi.'api.php?act=orders&limit=50&pid='.$conf['epay_pid'].'&key='.$conf['epay_key']);
$arr = json_decode($data, true);
if($arr['code']==1){
	foreach($arr['data'] as $row){
		if($row['status']==1){
			$out_trade_no = $row['out_trade_no'];
			$srow=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$out_trade_no}' limit 1");
			if($srow && $srow['status']==0){
				$DB->query("update `shua_pay` set `status` ='1',`endtime` ='$date' where `trade_no`='{$out_trade_no}'");
				processOrder($srow);
				echo '已成功补单:'.$out_trade_no.'<br/>';
			}
		}
	}
	exit('ok');
}else{
	exit($arr['msg']);
}
}else{
	exit('未配置易支付信息');
}