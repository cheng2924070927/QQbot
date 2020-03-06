<?php  
include('../includes/common.php');
$title='商品管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '<style>
.table thead > tr > th{font-size: 14px;padding-top: 10px;padding-bottom: 10px;}
</style>
';
$rs=$DB->query('SELECT * FROM shua_class WHERE active=1 order by sort asc');
$select='<option value="0">未分类</option>';
$shua_class[0]='未分类';
while ($res=$DB->fetch($rs)) 
{
	$shua_class[$res['cid']]=$res['name'];
	$select .='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
$rs=$DB->query('SELECT * FROM shua_shequ order by id asc');
$shequselect='';
while ($res=$DB->fetch($rs)) 
{
	$shequselect .='<option value="'.$res['id'].'" type="'.$res['type'].'">'.$res['url'].'</option>';
}
if ($_SESSION['priceselect']) 
{
	$priceselect=$_SESSION['priceselect'];
}
else 
{
	$rs=$DB->query('SELECT * FROM shua_price order by id asc');
	$priceselect='<option value="0">不加价</option>';
	while ($res=$DB->fetch($rs)) 
	{
		$kind=($res['kind']==1 ? '元' : '倍');
		$priceselect .='<option value="'.$res['id'].'" kind="'.$res['kind'].'" p_2="'.$res['p_2'].'" p_1="'.$res['p_1'].'" p_0="'.$res['p_0'].'" >'.$res['name'].'('.$res['p_2'].$kind.'|'.$res['p_1'].$kind.'|'.$res['p_0'].$kind.')</option>';
	}
}
$my=(isset($_GET['my'])?$_GET['my']:NULL);
if ($my=='add') 
{
	echo '<div class="col-sm-12 col-md-6">
<div class="block">
<div class="block-title"><h3 class="panel-title">商品类型与对接设置</h3></div>
<form action="./shopedit.php?my=add_submit" method="POST">
<input type="hidden" name="backurl" value="';
	echo $_SERVER['HTTP_REFERER'];
	echo '"/>
<div class="">
<div class="form-group">
<label>购买成功后的动作:</label><br>
<select class="form-control" name="is_curl"><option value="0">0_无</option><option value="2">自动提交到社区/卡盟</option><option value="1">自定义访问URL/POST</option><option value="4">自动发卡密</option><option value="3">自动发送提醒邮件</option></select>
</div>
<div id="curl_display1" style="display:none;">
<div class="form-group">
<label>URL:</label><br>
<input type="text" class="form-control" name="curl" id="curl" value="">
</div>
<div class="form-group">
<label>POST:</label><br>
<input type="text" class="form-control" name="curl_post" id="curl_post" value="" placeholder="无POST内容请留空">
</div>
<font color="green">无POST内容请留空，POST格式：a=123&b=456<br/>变量代码：<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input]\');return false">[input]</a>&nbsp;第一个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input2]\');return false">[input2]</a>&nbsp;第二个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input3]\');return false">[input3]</a>&nbsp;第三个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input4]\');return false">[input4]</a>&nbsp;第四个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[name]\');return false">[name]</a>&nbsp;商品名称<br/>
<a href="#" onclick="Addstr(\'curl\',\'[price]\');return false">[price]</a>&nbsp;商品价格<br/>
<a href="#" onclick="Addstr(\'curl\',\'[num]\');return false">[num]</a>&nbsp;下单数量<br/>
<a href="#" onclick="Addstr(\'curl\',\'[time]\');return false">[time]</a>&nbsp;当前时间戳<br/></font>
<br/>
</div>
<div id="curl_display2" style="display:none;">
<div class="form-group">
<label>选择对接网站:</label>&nbsp;(<a href="shequlist.php" target="_blank">添加</a>)<br>
<select class="form-control" name="shequ">';
	echo $shequselect;
	echo '</select>
</div>
<div class="form-group" id="show_goodslist">
<label>选择对接商品:</label><br>
<div class="input-group">
<select class="form-control" id="goodslist"></select>
<span class="input-group-addon btn btn-success" id="getGoods">获取</span>
</div>
</div>
<div class="form-group" id="goods_id">
<label>商品ID（goods_id）:</label><br>
<input type="text" class="form-control" name="goods_id" value="">
</div>
<div class="form-group" id="goods_type">
<label>类型ID（goods_type）:</label><br>
<input type="text" class="form-control" name="goods_type" value="">
</div>
<div class="form-group" id="goods_param">
<label id="goods_param_name">参数名:</label><br>
<input type="text" class="form-control" name="goods_param" value="qq">
<pre><font color="green">对应输入框标题，多个参数请用|隔开；如果是对接卡盟，请直接填写下单页面地址</font></pre>
</div>
</div>
<div class="form-group" id="show_value">
<label>默认数量信息:</label><br>
<input type="text" class="form-control" name="value" value="" placeholder="用于对接社区使用或导出时显示" onkeyup="changeNum(this)">
<input type="hidden" id="price" value="">
</div>
<div id="GoodsInfo" class="alert alert-info" style="display:none;"></div>
</div></div>
</div>
<div class="col-sm-12 col-md-6">
<div class="block">
<div class="block-title"><h3 class="panel-title">商品基本信息设置</h3></div>
<div class="">
<div class="form-group">
<label>*商品分类:</label><br>
<select name="cid" class="form-control" default="';
	echo $_GET['cid'];
	echo '">';
	echo $select;
	echo '</select>
</div>
<div class="form-group">
<label>*商品名称:</label><br>
<input type="text" class="form-control" name="name" value="" required>
</div>
<div class="form-group">
<label>*成本价格:</label><br>
<input type="text" class="form-control" name="price" value="" required>
</div>
<div class="form-group">
<label>加价模板:</label>&nbsp;(<a href="./price.php" target="_blank">管理</a>)<br>
<select name="prid" class="form-control">';
	echo $priceselect;
	echo '</select>
</div>
<div class="form-group">
<label>第一个输入框标题:</label><br>
<input type="text" class="form-control" name="input" value="" placeholder="留空默认为“下单ＱＱ”">
</div>
<div class="form-group">
<label>更多输入框标题:</label><br>
<input type="text" class="form-control" name="inputs" value="" placeholder="留空则不显示更多输入框">
<pre><font color="green">多个输入框请用|隔开(不能超过4个)<br/>显示选择框，在名称后面加{选择1,选择2}，例如：分类名{普通,音乐,宠物}</font></pre>
</div>
<div class="form-group">
<label>商品简介:</label>(没有请留空)<br>
<textarea class="form-control" name="desc" rows="3" placeholder="当选择该商品时自动显示，支持HTML代码"></textarea>
</div>
<div class="form-group">
<label>提示内容:</label>(没有请留空)<br>
<input type="text" class="form-control" name="alert" value="" placeholder="当选择该商品时自动弹出提示，不支持HTML代码">
</div>
<div class="form-group">
<label>商品图片:</label><br>
<input type="file" id="file" onchange="fileUpload()" style="display:none;"/>
<div class="input-group">
<input type="text" class="form-control" id="shopimg" name="shopimg" value="" placeholder="填写图片URL，没有请留空"><span class="input-group-btn"><a href="javascript:fileSelect()" class="btn btn-success" title="上传图片"><i class="glyphicon glyphicon-upload"></i></a><a href="javascript:fileView()" class="btn btn-warning" title="查看图片"><i class="glyphicon glyphicon-picture"></i></a></span>
</div>
</div>
<div class="form-group">
<label>*显示数量选择框:</label><br>
<select class="form-control" name="multi"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<div class="form-group">
<label>*允许重复下单:</label><br>
<select class="form-control" name="repeat"><option value="0">0_否</option><option value="1">1_是</option></select>
</div>
<div class="form-group">
<label>*验证操作:</label><br>
<select class="form-control" name="validate"><option value="0">不开启验证</option><option value="1">验证QQ空间是否有访问权限</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>
<br/><a href="';
	echo (isset($_SERVER['HTTP_REFERER'])?strpos($_SERVER['HTTP_REFERER'],'./shoplist.php'):(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'shoplist.php'));
	echo '">>>返回商品列表</a>
</div></div>
</div>
';
}
else 
{
	if ($my=='edit') 
	{
		$tid=intval($_GET['tid']);
		$row=$DB->get_row('select * from shua_tools where tid=\''.$tid.'\' limit 1');
		echo '<div class="col-sm-12 col-md-6">
<div class="block">
<div class="block-title"><h3 class="panel-title">商品类型与对接设置</h3></div>
<div class="">
<form action="./shopedit.php?my=edit_submit&tid=';
		echo $tid;
		echo '" method="POST">
<input type="hidden" name="backurl" value="';
		echo $_SERVER['HTTP_REFERER'];
		echo '"/>
<div class="form-group">
<label>购买成功后的动作:</label><br>
<select class="form-control" name="is_curl" default="';
		echo $row['is_curl'];
		echo '"><option value="0">0_无</option><option value="2">自动提交到社区/卡盟</option><option value="1">自定义访问URL/POST</option><option value="4">自动发卡密</option><option value="3">自动发送提醒邮件</option></select>
</div>
<div id="curl_display1" style="';
		echo ($row['is_curl']!=1 ? 'display:none;' : NULL);
		echo '">
<div class="form-group">
<label>URL:</label><br>
<input type="text" class="form-control" name="curl" id="curl" value="';
		echo $row['curl'];
		echo '">
</div>
<div class="form-group">
<label>POST:</label><br>
<input type="text" class="form-control" name="curl_post" id="curl_post" value="';
		echo $row['goods_param'];
		echo '" placeholder="无POST内容请留空">
</div>
<font color="green">无POST内容请留空，POST格式：a=123&b=456<br/>变量代码：<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input]\');return false">[input]</a>&nbsp;第一个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input2]\');return false">[input2]</a>&nbsp;第二个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input3]\');return false">[input3]</a>&nbsp;第三个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[input4]\');return false">[input4]</a>&nbsp;第四个输入框内容<br/>
<a href="#" onclick="Addstr(\'curl\',\'[name]\');return false">[name]</a>&nbsp;商品名称<br/>
<a href="#" onclick="Addstr(\'curl\',\'[price]\');return false">[price]</a>&nbsp;商品价格<br/>
<a href="#" onclick="Addstr(\'curl\',\'[num]\');return false">[num]</a>&nbsp;下单数量<br/>
<a href="#" onclick="Addstr(\'curl\',\'[time]\');return false">[time]</a>&nbsp;当前时间戳<br/></font>
<br/>
</div>
<div id="curl_display2" style="';
		echo ($row['is_curl']!=2 ? 'display:none;' : NULL);
		echo '">
<div class="form-group">
<label>选择对接网站:</label><br>
<select class="form-control" name="shequ" default="';
		echo $row['shequ'];
		echo '">';
		echo $shequselect;
		echo '</select>
</div>
<div class="form-group" id="show_goodslist">
<label>选择对接商品:</label><br>
<div class="input-group">
<select class="form-control" id="goodslist" default="';
		echo $row['goods_id'];
		echo '"></select>
<span class="input-group-addon btn btn-success" id="getGoods">获取</span>
</div>
</div>
<div class="form-group" id="goods_id">
<label>商品ID（goods_id）:</label><br>
<input type="text" class="form-control" name="goods_id" value="';
		echo $row['goods_id'];
		echo '">
</div>
<div class="form-group" id="goods_type">
<label>类型ID（goods_type）:</label><br>
<input type="text" class="form-control" name="goods_type" value="';
		echo $row['goods_type'];
		echo '">
</div>
<div class="form-group" id="goods_param">
<label id="goods_param_name">参数名:</label><br>
<input type="text" class="form-control" name="goods_param" value="';
		echo $row['goods_param'];
		echo '">
<pre><font color="green">对应输入框标题，多个参数请用|隔开；如果是对接卡盟，请直接填写下单页面地址</font></pre>
</div>
</div>
<div class="form-group" id="show_value">
<label>默认数量信息:</label><br>
<input type="text" class="form-control" name="value" value="';
		echo $row['value'];
		echo '" placeholder="用于对接社区使用或导出时显示" onkeyup="changeNum(this)">
<input type="hidden" id="price" value="">
</div>
<div id="GoodsInfo" class="alert alert-info" style="display:none;"></div>
</div></div>
</div>
<div class="col-sm-12 col-md-6">
<div class="block">
<div class="block-title"><h3 class="panel-title">商品基本信息设置</h3></div>
<div class="">
<div class="form-group">
<label>商品分类:</label><br>
<select name="cid" class="form-control" default="';
		echo $row['cid'];
		echo '">';
		echo $select;
		echo '</select>
</div>
<div class="form-group">
<label>商品名称:</label><br>
<input type="text" class="form-control" name="name" value="';
		echo $row['name'];
		echo '" required>
</div>
<div class="form-group">
<label>*成本价格:</label><br>
<input type="text" class="form-control" name="price" value="';
		echo $row['price'];
		echo '" required>
</div>
<div class="form-group">
<label>加价模板:</label>&nbsp;(<a href="./price.php" target="_blank">管理</a>)<br>
<select name="prid" class="form-control" default="';
		echo $row['prid'];
		echo '">';
		echo $priceselect;
		echo '</select>
</div>
<div class="form-group">
<label>第一个输入框标题:</label><br>
<input type="text" class="form-control" name="input" value="';
		echo $row['input'];
		echo '" placeholder="留空默认为“下单ＱＱ”">
</div>
<div class="form-group">
<label>更多输入框标题:</label><br>
<input type="text" class="form-control" name="inputs" value="';
		echo $row['inputs'];
		echo '" placeholder="留空则不显示更多输入框">
<pre><font color="green">多个输入框请用|隔开(不能超过4个)<br/>显示选择框，在名称后面加{选择1,选择2}，例如：分类名{普通,音乐,宠物}</font></pre>
</div>
<div class="form-group">
<label>商品简介:</label>(没有请留空)<br>
<textarea class="form-control" name="desc" rows="3" placeholder="当选择该商品时自动显示，支持HTML代码">';
		echo htmlspecialchars($row['desc']);
		echo '</textarea>
</div>
<div class="form-group">
<label>提示内容:</label>(没有请留空)<br>
<input type="text" class="form-control" name="alert" value="';
		echo $row['alert'];
		echo '" placeholder="当选择该商品时自动弹出提示，不支持HTML代码">
</div>
<div class="form-group">
<label>商品图片:</label><br>
<input type="file" id="file" onchange="fileUpload()" style="display:none;"/>
<div class="input-group">
<input type="text" class="form-control" id="shopimg" name="shopimg" value="';
		echo $row['shopimg'];
		echo '" placeholder="填写图片URL，没有请留空"><span class="input-group-btn"><a href="javascript:fileSelect()" class="btn btn-success" title="上传图片"><i class="glyphicon glyphicon-upload"></i></a><a href="javascript:fileView()" class="btn btn-warning" title="查看图片"><i class="glyphicon glyphicon-picture"></i></a></span>
</div>
</div>
<div class="form-group">
<label>显示数量选择框:</label><br>
<select class="form-control" name="multi" default="';
		echo $row['multi'];
		echo '"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<div class="form-group">
<label>允许重复下单:</label><br>
<select class="form-control" name="repeat" default="';
		echo $row['repeat'];
		echo '"><option value="0">0_否</option><option value="1">1_是</option></select>
</div>
<div class="form-group">
<label>验证操作:</label><br>
<select class="form-control" name="validate" default="';
		echo $row['validate'];
		echo '"><option value="0">不开启验证</option><option value="1">验证QQ空间是否有访问权限</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>
<br/><a href="';
		echo (isset($_SERVER['HTTP_REFERER'])?strpos($_SERVER['HTTP_REFERER'],'./shoplist.php'):(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'shoplist.php'));
		echo '">>>返回商品列表</a>
</div></div>
</div>
';
	}
	else 
	{
		if ($my=='add_submit') 
		{
			$cid=$_POST['cid'];
			$name=$_POST['name'];
			$price=$_POST['price'];
			$prid=$_POST['prid'];
			$input=$_POST['input'];
			$inputs=$_POST['inputs'];
			$desc=$_POST['desc'];
			$alert=$_POST['alert'];
			$shopimg=$_POST['shopimg'];
			$value=$_POST['value'];
			$multi=$_POST['multi'];
			$validate=$_POST['validate'];
			$is_curl=$_POST['is_curl'];
			$curl=$_POST['curl'];
			$shequ=$_POST['shequ'];
			$goods_id=$_POST['goods_id'];
			$goods_type=$_POST['goods_type'];
			$goods_param=($is_curl==1 ? $_POST['curl_post'] : $_POST['goods_param']);
			$repeat=$_POST['repeat'];
			if (($name==NULL || $price==NULL)) 
			{
				showmsg('保存错误，商品名称和价格不能为空！',3);
			}
			else 
			{
				if (($is_curl==2 && !$shequ)) 
				{
					showmsg('请选择对接社区！',3);
				}
				else 
				{
					$sql='INSERT INTO `shua_tools` (`cid`,`name`,`price`,`prid`,`input`,`inputs`,`desc`,`alert`,`shopimg`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`validate`,`sort`,`active`) VALUES (\''.$cid.'\',\''.$name.'\',\''.$price.'\',\''.$prid.'\',\''.$input.'\',\''.$inputs.'\',\''.$desc.'\',\''.$alert.'\',\''.$shopimg.'\',\''.$value.'\',\''.$is_curl.'\',\''.$curl.'\',\''.$shequ.'\',\''.$goods_id.'\',\''.$goods_type.'\',\''.$goods_param.'\',\''.$repeat.'\',\''.$multi.'\',\''.$validate.'\',\''.$sort.'\',\'1\')';
					if ($tid=$DB->insert($sql)) 
					{
						$DB->query('UPDATE `shua_tools` SET `sort`=\''.$tid.'\' WHERE `tid`=\''.$tid.'\'');
						showmsg('添加商品成功！<br/><br/><a href="shopedit.php?my=edit&tid='.$tid.'">>>编辑当前商品</a><br/><a href="'.$_POST['backurl'].'">>>返回商品列表</a>',1);
					}
					else 
					{
						showmsg('添加商品失败！'.$DB->error(),4);
					}
				}
			}
		}
		else 
		{
			if ($my=='edit_submit') 
			{
				$tid=$_GET['tid'];
				$rows=$DB->get_row('SELECT * FROM shua_tools WHERE tid=\''.$tid.'\' LIMIT 1');
				if (!$rows) 
				{
					showmsg('当前记录不存在！',3);
				}
				$cid=$_POST['cid'];
				$name=$_POST['name'];
				$price=$_POST['price'];
				$prid=$_POST['prid'];
				$input=$_POST['input'];
				$inputs=$_POST['inputs'];
				$desc=$_POST['desc'];
				$alert=$_POST['alert'];
				$shopimg=$_POST['shopimg'];
				$value=$_POST['value'];
				$multi=$_POST['multi'];
				$validate=$_POST['validate'];
				$is_curl=$_POST['is_curl'];
				$curl=$_POST['curl'];
				$shequ=$_POST['shequ'];
				$goods_id=$_POST['goods_id'];
				$goods_type=$_POST['goods_type'];
				$goods_param=($is_curl==1 ? $_POST['curl_post'] : $_POST['goods_param']);
				$repeat=$_POST['repeat'];
				if (($name==NULL || $price==NULL)) 
				{
					showmsg('保存错误，商品名称和价格不能为空！',3);
				}
				else 
				{
					if (($is_curl==2 && !$shequ)) 
					{
						showmsg('请选择对接社区！',3);
					}
					else 
					{
						if ($DB->query('UPDATE `shua_tools` SET `cid`=\''.$cid.'\',`name`=\''.$name.'\',`price`=\''.$price.'\',`prid`=\''.$prid.'\',`cost`=\'0\',`cost2`=\'0\',`input`=\''.$input.'\',`inputs`=\''.$inputs.'\',`desc`=\''.$desc.'\',`alert`=\''.$alert.'\',`shopimg`=\''.$shopimg.'\',`value`=\''.$value.'\',`is_curl`=\''.$is_curl.'\',`curl`=\''.$curl.'\',`shequ`=\''.$shequ.'\',`goods_id`=\''.$goods_id.'\',`goods_type`=\''.$goods_type.'\',`goods_param`=\''.$goods_param.'\',`repeat`=\''.$repeat.'\',`multi`=\''.$multi.'\',`validate`=\''.$validate.'\' WHERE `tid`=\''.$tid.'\'')) 
						{
							showmsg('修改商品成功！<br/><br/><a href="'.$_POST['backurl'].'">>>返回商品列表</a>',1);
						}
						else 
						{
							showmsg('修改商品失败！'.$DB->error(),4);
						}
					}
				}
			}
			else 
			{
				if ($my=='delete') 
				{
					$tid=$_GET['tid'];
					$sql='DELETE FROM shua_tools WHERE tid=\''.$tid.'\' limit 1';
					if ($DB->query($sql)) 
					{
						showmsg('删除成功！<br/><br/><a href="'.$_SERVER['HTTP_REFERER'].'">>>返回商品列表</a>',1);
					}
					else 
					{
						showmsg('删除失败！'.$DB->error(),4);
					}
				}
			}
		}
	}
}
echo '<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
function getFloat(number, n) {
	n = n ? parseInt(n) : 0;
	if (n <= 0) return Math.ceil(number);
	number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
	return number;
}
function changeNum(obj){
	var num = parseInt($(obj).val());
	var price = parseFloat($("#price").val());
	if(num == 0 || isNaN(price))return false;
	$("input[name=\'price\']").val(getFloat(num * price, 2));
}
function fileSelect(){
	$("#file").trigger("click");
}
function fileView(){
	var shopimg = $("#shopimg").val();
	if(shopimg==\'\') {
		layer.alert("请先上传图片，才能预览");
		return;
	}
	if(shopimg.indexOf(\'http\') == -1)shopimg = \'../\'+shopimg;
	layer.open({
		type: 1,
		area: [\'360px\', \'400px\'],
		title: \'商品图片查看\',
		shade: 0.3,
		anim: 1,
		shadeClose: true,
		content: \'<center><img width="300px" src="\'+shopimg+\'"></center>\'
	});
}
function fileUpload(){
	var fileObj = $("#file")[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("do","upload");
	formData.append("type","shop");
	formData.append("file",fileObj);
	var ii = layer.load(2, {shade:[0.1,\'#fff\']});
	$.ajax({
		url: "ajax.php?act=uploadimg",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg(\'上传图片成功\');
				$("#shopimg").val(data.url);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	})
}
function Addstr(id, str) {
	$("#"+id).val($("#"+id).val()+str);
}
$(document).ready(function(){
	$("select[name=\'is_curl\']").change(function(){
		if($(this).val() == 1){
			$("#curl_display1").css("display","inherit");
			$("#curl_display2").css("display","none");
		}else if($(this).val() == 2){
			$("#curl_display1").css("display","none");
			$("#curl_display2").css("display","inherit");
		}else{
			$("#curl_display1").css("display","none");
			$("#curl_display2").css("display","none");
		}
		if($(this).val() == 4){
			$("#show_value").css("display","none");
		}else{
			$("#show_value").css("display","inherit");
		}
	});
	$("select[name=\'shequ\']").change(function(){
		var type = $("select[name=\'shequ\'] option:selected").attr("type");
		if(type == 4){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","inherit");
		}else if(type == 1 || type == 3 || type == 5 || type == 11 || type == 12){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","none");
		}else if(type == 10){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","none");
		}else if(type >= 6){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","inherit");
		}else{
			$("#goods_type").css("display","inherit");
			$("#goods_param").css("display","inherit");
		}
		if(type >= 6 && type <= 9){
			$("#show_value").css("display","none");
			$("#goods_id").css("display","none");
			$("#show_goodslist").css("display","none");
			$("#goods_param_name").html("下单页面地址：");
			if($("input[name=\'goods_param\']").val().indexOf(\'http\')<0)$("input[name=\'goods_param\']").val("");
		}else if(type == 10){
			$("#show_value").css("display","inherit");
			$("#goods_id").css("display","inherit");
			$("#show_goodslist").css("display","none");
			$("#goods_param_name").html("下单页面地址：");
		}else if(type == 20){
';
if (class_exists('ExtendAPI')) 
{
	ExtendAPI::shopEditJs();
}
echo "		}else{
			\$(\"#show_value\").css(\"display\",\"inherit\");
			\$(\"#goods_id\").css(\"display\",\"inherit\");
			\$(\"#show_goodslist\").css(\"display\",\"inherit\");
			\$(\"#goods_param_name\").html(\"参数名：\");
		}
		if(type == 4){
			\$(\"#show_goodslist\").css(\"display\",\"none\");
		}
	});
	\$(\"#getGoods\").click(function(){
		var shequ=\$(\"select[name='shequ']\").val();
		if(shequ==''){layer.alert('请先选择一个对接网站');return false;}
		\$('#goodslist').empty();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		\$.ajax({
			type : \"POST\",
			url : \"ajax.php?act=getGoodsList\",
			data : {shequ:shequ},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					\$('#getGoods').attr('type',data.type);
					\$.each(data.data, function(i, item){
						if(data.type == 'jiuwu')
							\$('#goodslist').append('<option value=\"'+item.id+'\" goodstype=\"'+item.type+'\" shopimg=\"'+item.shopimg+'\" minnum=\"'+item.minnum+'\" maxnum=\"'+item.maxnum+'\" price=\"'+item.price+'\">'+item.name+'</option>');
						else if(data.type == 'yile')
							\$('#goodslist').append('<option value=\"'+item.id+'\">'+item.name+'</option>');
						else if(data.type == 'xingmo')
							\$('#goodslist').append('<option value=\"'+item.id+'\" shopimg=\"'+item.shopimg+'\">'+item.name+'</option>');
						else if(data.type == 'jumeng')
							\$('#goodslist').append('<option value=\"'+item.id+'\" shopimg=\"'+item.shopimg+'\" minnum=\"'+item.minnum+'\" maxnum=\"'+item.maxnum+'\">'+item.name+'</option>');
						else
							\$('#goodslist').append('<option value=\"'+item.id+'\">'+item.name+'</option>');
					});
					if(\$(\"#goodslist\").attr('default')!='undefined'){
						\$('#goodslist').val(\$(\"#goodslist\").attr('default'));
					}
				}else{
					layer.alert(data.msg);
				}
			},
			error:function(data){
				layer.msg('服务器错误');
				return false;
			}
		});
	});
	\$(\"#goodslist\").change(function () {
		var type = \$('#getGoods').attr('type');
		if(type == 'jiuwu'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var goodstype = \$(\"#goodslist option:selected\").attr('goodstype');
			var minnum = \$(\"#goodslist option:selected\").attr('minnum');
			var maxnum = \$(\"#goodslist option:selected\").attr('maxnum');
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			var price = \$(\"#goodslist option:selected\").attr('price');
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"input[name='goods_type']\").val(goodstype);
			\$(\"input[name='shopimg']\").val(shopimg);
			\$(\"#price\").val(price);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"input[name='goods_param']\").val(data.param);
						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/index.php?m=Home&c=Goods&a=detail&id='+goodsid+'&goods_type='+goodstype+'\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>社区商品售价：</b>'+data.price+'<br/><b>最小下单数量：</b>'+minnum+'<br/><b>最大下单数量：</b>'+maxnum);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else if(type == 'yile'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"input[name='shopimg']\").val(data.image);
						var paramname = data.paramname;
						var inputs ='';
						\$.each(paramname.split('|'), function(i, v) {
							if(i==0){
								\$(\"input[name='input']\").val(v);
							}else{
								if(v=='QQ空间说说ID')v='说说ID';
								inputs += '|'+v;
							}
						});
						\$(\"input[name='inputs']\").val(inputs.substr(1));
						\$(\"#price\").val(data.price);

						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/home/order/'+goodsid+'\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>商品简介：</b>'+data.desc+'<br/><b>社区商品售价：</b>'+data.price+' 元<br/><b>最小下单数量：</b>'+data.limit_min+'<br/><b>最大下单数量：</b>'+data.limit_max);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else if(type == 'jumeng'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var minnum = \$(\"#goodslist option:selected\").attr('minnum');
			var maxnum = \$(\"#goodslist option:selected\").attr('maxnum');
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"input[name='shopimg']\").val(shopimg);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"#price\").val(data.money);
						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/login'+goodsid+'.html\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>社区商品售价：</b>'+data.money+'<br/><b>最小下单数量：</b>'+minnum+'<br/><b>最大下单数量：</b>'+maxnum);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else{
			var goodsid = \$(\"#goodslist option:selected\").val();
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			if(typeof (shopimg) != \"undefined\")\$(\"input[name='shopimg']\").val(shopimg);
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"#GoodsInfo\").hide();
			\$(\"#price\").val('');
		}
	});
	var items = \$(\"select[default]\");
	for (i = 0; i < items.length; i++) {
		\$(items[i]).val(\$(items[i]).attr(\"default\")||0);
	}
	\$(\"select[name='shequ']\").change();
});
</script>";
?>