<?php  
include('../includes/common.php');
$title='克隆销售站';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-sm-12 col-md-10 col-lg-8 center-block" style="float: none;">
';
if (isset($_POST['submit'])) 
{
	$url=trim($_POST['url']);
	$key=trim($_POST['key']);
	$url_arr=parse_url($url);
	if ($url_arr['host']==$_SERVER['HTTP_HOST']) 
	{
		showmsg('无法自己克隆自己',3);
	}
	$data=get_curl($url.'api.php?act=clone&key='.$key);
	$arr=json_decode($data,true);
	if ((array_key_exists('code',$arr) && $arr['code']==1)) 
	{
		$success=0;
		if ((count($arr['class'])<2 || count($arr['tools'])<5)) 
		{
			showmsg('对方网站数据量过少。',3);
		}
		if (!isset($arr['price'])) 
		{
			showmsg('对方网站程序版本较低',3);
		}
		$DB->query('TRUNCATE TABLE `shua_class`');
		$success=$success+1;
		foreach($arr['class'] as $row)
		{
			$DB->query('INSERT INTO `shua_class` (`cid`,`name`,`sort`,`active`,`shopimg`) VALUES (\''.$row['cid'].'\',\''.$row['name'].'\',\''.$row['sort'].'\',\''.$row['active'].'\',\''.$row['shopimg'].'\')');
			$success=$success+1;
		}
		$DB->query('TRUNCATE TABLE `shua_tools`');
		$success=$success+1;
		foreach($arr['tools'] as $row)
		{
			$DB->query('INSERT INTO `shua_tools` (`tid`,`cid`,`name`,`price`,`prid`,`input`,`inputs`,`desc`,`alert`,`shopimg`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`sort`,`close`,`active`) VALUES (\''.$row['tid'].'\',\''.$row['cid'].'\',\''.$row['name'].'\',\''.$row['price'].'\',\''.$row['prid'].'\',\''.$row['input'].'\',\''.$row['inputs'].'\',\''.addslashes($row['desc']).'\',\''.addslashes($row['alert']).'\',\''.$row['shopimg'].'\',\''.$row['value'].'\',\''.$row['is_curl'].'\',\''.$row['curl'].'\',\''.$row['shequ'].'\',\''.$row['goods_id'].'\',\''.$row['goods_type'].'\',\''.$row['goods_param'].'\',\''.$row['repeat'].'\',\''.$row['multi'].'\',\''.$row['sort'].'\',\''.$row['close'].'\',\''.$row['active'].'\')');
			$success=$success+1;
		}
		$DB->query('TRUNCATE TABLE `shua_shequ`');
		$success=$success+1;
		foreach($arr['shequ'] as $row)
		{
			$DB->query('INSERT INTO `shua_shequ` (`id`,`url`,`username`,`password`,`type`) VALUES (\''.$row['id'].'\',\''.$row['url'].'\',NULL,NULL,\''.$row['type'].'\')');
			$success=$success+1;
		}
		$DB->query('TRUNCATE TABLE `shua_price`');
		$success=$success+1;
		foreach($arr['shequ'] as $row)
		{
			$DB->query('INSERT INTO `shua_price` (`id`,`kind`,`name`,`p_0`,`p_1`,`p_2`) VALUES (\''.$row['id'].'\',\''.$row['kind'].'\',\''.$row['name'].'\',\''.$row['p_0'].'\',\''.$row['p_1'].'\',\''.$row['p_2'].'\')');
			$success=$success+1;
		}
		showmsg('克隆完成，SQL成功执行'.$success.'句。',1);
	}
	else 
	{
		if (array_key_exists('code',$arr)) 
		{
			showmsg('克隆失败，原因：'.$arr['msg'],4);
		}
		else 
		{
			showmsg('克隆失败，返回数据解析错误。',4);
		}
	}
}
echo '
	 <div class="block">
       <div class="block-title"><h3 class="panel-title">克隆销售站</h3></div>
       <div class="">
		<div class="alert alert-info">
           使用此功能可一键克隆目标站点的分类、商品及社区对接数据（除社区账号密码外），方便站长快速丰富网站内容。
       </div>
		<div class="alert alert-danger">
           只支持签到萌宠机器人正版销售站相互克隆！无法克隆杂七杂八的代刷网！<br />克隆后将会清空本站所有商品和分类数据，请谨慎操作！
       </div>
         <form action="?" method="POST" role="form">
		   <div class="form-group">
				<div class="input-group"><div class="input-group-addon">目标销售站URL</div>
				<input type="text" name="url" value="" class="form-control" placeholder="本系统内置在官网内部,如果目标给您的是官网链接请这样填写：http://目标官网域名/gmsq/" required/>
				<div class="input-group-addon" onclick="checkurl()"><small>检测连通性</small></div>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">克隆密钥</div>
				<input type="text" name="key" value="" class="form-control" placeholder="请联系目标签到萌宠机器人官网站长获得" required/>
			</div></div>
           <p><input type="submit" name="submit" value="确定克隆" class="btn btn-primary form-control"/></p>
         </form>
       </div>
		<div class="panel-footer">
         <span class="glyphicon glyphicon-info-sign"></span> 本站克隆密钥：<a href="./set.php?mod=cloneset">点此获取</a><br>
<span class="glyphicon glyphicon-info-sign"></span>本站销售站克隆URL为：http://您的域名/gmsq/
<br />
<span class="glyphicon glyphicon-info-sign"></span>如果您用的是https协议那么您的销售站克隆URL为：https://您的域名/gmsq/<br>
              </div>
     </div>
   </div>
 </div>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
function checkurl(){
	var url = $("input[name=\'url\']").val();
	if(url.indexOf(\'http\')>=0 && url.substr(-1) == \'/\'){
		var ii = layer.load(2, {shade:[0.1,\'#fff\']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=checkclone",
			data : {url:url},
			dataType : \'json\',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.msg(\'连通性良好，可以克隆\');
				}else if(data.code == 2){
					layer.alert(\'无法自己克隆自己\');
				}else if(data.code == 3){
					layer.alert(\'对方官网的源码被用记事本改过，请先在对方网站清理BOM头部\');
				}else{
					layer.alert(\'对方官网无法连接或存在金盾或云锁等防火墙，或对方的官网不是正版！\');
				}
			} ,
			error:function(data){
				layer.close(ii);
				layer.msg(\'目标URL连接超时\');
				return false;
			}
		});
	}else{
		layer.alert(\'URL必须以 http:// 开头，以 / 结尾\');
	}
}
</script>';
?>