<?php
//一键安装脚本
//请事先填写好config.php
//默认用户名密码为：admin/123456
error_reporting(0);
session_start();
@header('Content-Type: text/html; charset=UTF-8');
if(file_exists('install.lock')){
	exit('您已经安装过，如需重新安装请删除 install/install.lock 文件后再安装！');
}


function clearpack() {
	$array=glob('../daishua_release_*');
	foreach($array as $dir){
		unlink($dir);
	}
	$array=glob('../daishua_update_*');
	foreach($array as $dir){
		unlink($dir);
	}
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}

require './db.class.php';
include_once '../config.php';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
	exit('请先填写好config.php数据库并保存后再安装！');
} else {
	if(!$con=DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port'])){
		if(DB::connect_errno()==2002)
			exit('连接数据库失败，数据库地址填写错误！');
		elseif(DB::connect_errno()==1045)
			exit('连接数据库失败，数据库用户名或密码填写错误！');
		elseif(DB::connect_errno()==1049)
			exit('连接数据库失败，数据库名不存在！');
		else
			exit('连接数据库失败，['.DB::connect_errno().']'.DB::connect_error());
	}else{
		if(DB::query("select * from ".$dbconfig['dbqz']."_config where 1")!=FALSE)
			exit('系统检测到你已安装过凌吾公司代刷网了，请先清空数据库');
	}
}

$sql=file_get_contents("install.sql");
$sql=explode(';',$sql);
DB::query("set sql_mode = ''");
DB::query("set names utf8");
$t=0; $e=0; $error='';
for($i=0;$i<count($sql);$i++) {
	if ($sql[$i]=='')continue;
	if(DB::query($sql[$i])) {
		++$t;
	} else {
		++$e;
		$error.=DB::error().'<br/>';
	}
}
date_default_timezone_set("PRC");
$date = date("Y-m-d");
DB::query("INSERT INTO `shua_config` VALUES ('build', '".$date."')");
DB::query("INSERT INTO `shua_config` VALUES ('cronkey', '".rand(100000,999999)."')");
DB::query("INSERT INTO `shua_config` VALUES ('syskey', '".random(32)."')");
if($e==0) {
	echo '安装成功！<br/>SQL成功'.$t.'句/失败'.$e.'句<br/><a href="../">>>网站首页</a>｜<a href="../admin/">>>后台管理</a>';
	@file_put_contents("install.lock",'安装锁');
	clearpack();
} else {
	echo '安装失败<br/>SQL成功'.$t.'句/失败'.$e.'句<br/>错误信息：'.$error.'';
}
