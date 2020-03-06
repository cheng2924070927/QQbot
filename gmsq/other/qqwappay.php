<?php
require 'inc.php';

@header('Content-Type: text/html; charset=UTF-8');

$trade_no=daddslashes($_GET['trade_no']);
if($conf['qqpay_api']!=1)exit('当前支付接口未开启');
$row=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$trade_no}' limit 1");
if(!$row)exit('该订单号不存在，请返回来源地重新发起请求！');

require_once (SYSTEM_ROOT.'qqpay/qpayMchAPI.class.php');

//入参
$params = array();
$params["out_trade_no"] = $trade_no;
$params["body"] = $row['name'];
$params["fee_type"] = "CNY";
$params["notify_url"] = $siteurl.'qqpay_notify.php';
$params["spbill_create_ip"] = $clientip;
$params["total_fee"] = intval($row['money']*100);
$params["trade_type"] = "NATIVE";

//api调用
$qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi', null, 10);
$ret = $qpayApi->reqQpay($params);
$result = QpayMchUtil::xmlToArray($ret);
//print_r($arr);

if($result['return_code']=='SUCCESS' && $result['result_code']=='SUCCESS'){
	$code_url = 'https://myun.tenpay.com/mqq/pay/qrcode.html?_wv=1027&_bid=2183&t='.$result['prepay_id'];
}elseif(isset($result["err_code"])){
	sysmsg('QQ钱包支付下单失败！['.$result["err_code"].'] '.$result["err_code_des"]);
}else{
	sysmsg('QQ钱包支付下单失败！['.$result["return_code"].'] '.$result["return_msg"]);
}
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false){
	exit("<script>window.location.href='{$code_url}';</script>");
}
?>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>QQ钱包支付</title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-default">
	<div class="panel-heading" style="text-align: center;"><h3 class="panel-title">
		<img src="assets/icon/qqpay.ico">QQ钱包支付手机版
	</div>
		<div class="list-group" style="text-align: center;">
			<div class="list-group-item"><h1>￥<?php echo $row['money']?><h1></div>
			<div class="list-group-item">商品名称：<?php echo $row['name']?><br/>商户订单号：<?php echo $row['trade_no']?><br/>创建时间：<?php echo $row['addtime']?></div>
			<div class="list-group-item"><a href="" id="openUrl" class="btn btn-primary btn-block">跳转到QQ支付</a></div>
			<div class="list-group-item"><a href="#" onclick="checkresult()" class="btn btn-success btn-block">检测支付状态</a></div>
			<div class="list-group-item"><a href="qqpay.php?trade_no=<?php echo $trade_no?>&sitename=<?php echo $_GET['sitename']?>" class="btn btn-default btn-sm btn-block">使用扫码支付</a></div>
		</div>
</div>
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script>
	var isSafari = navigator.userAgent.indexOf("Safari") > -1;
	var code_url = '<?php echo $code_url?>';
	var	tencentSeries = 'mqqapi://forward/url?src_type=web&style=default&=1&version=1&url_prefix='+window.btoa(code_url);
	if(isSafari){
		location.href = tencentSeries;
	}
	else{
		var iframe = document.createElement("iframe");
        iframe.style.display = "none";
        iframe.src = tencentSeries;
        document.body.appendChild(iframe);
	}
	document.getElementById("openUrl").href = tencentSeries; 
    // 检查是否支付完成
    function loadmsg() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "getshop.php",
            timeout: 10000, //ajax请求超时时间10s
            data: {type: "qqpay", trade_no: "<?php echo $row['trade_no']?>"}, //post数据
            success: function (data, textStatus) {
                //从服务器得到数据，显示数据并继续查询
                if (data.code == 1) {
					if (confirm("您已支付完成，需要跳转到订单页面吗？")) {
                        window.location.href=data.backurl;
                    } else {
                        // 用户取消
                    }
                }else{
                    setTimeout("loadmsg()", 4000);
                }
            },
            //Ajax请求超时，继续查询
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus == "timeout") {
                    setTimeout("loadmsg()", 1000);
                } else { //异常
                    setTimeout("loadmsg()", 4000);
                }
            }
        });
    }
	function checkresult() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "getshop.php",
            timeout: 10000, //ajax请求超时时间10s
            data: {type: "qqpay", trade_no: "<?php echo $row['trade_no']?>"}, //post数据
            success: function (data, textStatus) {
                //从服务器得到数据，显示数据并继续查询
                if (data.code == 1) {
					if (confirm("您已支付完成，需要跳转到订单页面吗？")) {
                        window.location.href=data.backurl;
                    } else {
                        // 用户取消
                    }
                }
            },
            //Ajax请求超时，继续查询
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.msg('服务器错误');
            }
        });
    }
    window.onload = loadmsg();
</script>
</body>
</html>