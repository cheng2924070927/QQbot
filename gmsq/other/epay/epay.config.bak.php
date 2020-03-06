<?php
/* *
 * 可对接多个易支付的配置文件
 * 请将本文件改名为epay.config.php
 */

//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

if($type == 'alipay' || $_GET['type']=='alipay'){
//支付API地址
$alipay_config['apiurl']    = '';
//商户ID
$alipay_config['partner']		= '';
//商户KEY
$alipay_config['key']			= '';
}elseif($type == 'wxpay' || $_GET['type']=='wxpay'){
//支付API地址
$alipay_config['apiurl']    = 'http://chongzhi.pro/';
//商户ID
$alipay_config['partner']		= 'http://chongzhi.pro/';
//商户KEY
$alipay_config['key']			= 'http://chongzhi.pro/';
}elseif($type == 'qqpay' || $_GET['type']=='qqpay'){
//支付API地址
$alipay_config['apiurl']    = 'http://chongzhi.pro/';
//商户ID
$alipay_config['partner']		= '';
//商户KEY
$alipay_config['key']			= '';
}
?>