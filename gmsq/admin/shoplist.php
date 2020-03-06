<?php  
include('../includes/common.php');
$title='商品管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-md-12 center-block" style="float: none;">
';
$rs=$DB->query('SELECT * FROM shua_price order by id asc');
$priceselect='<option value="0">不加价</option>';
$price_class[0]='不加价';
while ($res=$DB->fetch($rs)) 
{
	$kind=($res['kind']==1 ? '元' : '倍');
	$priceselect .='<option value="'.$res['id'].'" kind="'.$res['kind'].'" p_2="'.$res['p_2'].'" p_1="'.$res['p_1'].'" p_0="'.$res['p_0'].'" >'.$res['name'].'('.$res['p_2'].$kind.'|'.$res['p_1'].$kind.'|'.$res['p_0'].$kind.')</option>';
	$price_class[$res['id']]=$res['name'];
}
$_SESSION['priceselect']=$priceselect;
$_SESSION['price_class']=$price_class;
$my=(isset($_GET['my'])?$_GET['my']:null);
if ($my=='qk2') 
{
	$sql='TRUNCATE TABLE `shua_tools`';
	if ($DB->query($sql)) 
	{
		exit('<script language=\'javascript\'>alert(\'清空成功！\');window.location.href=\'shoplist.php\';</script>');
	}
	else 
	{
		exit('<script language=\'javascript\'>alert(\'清空失败！'.$DB->error().'\');history.go(-1);</script>');
	}
}
else 
{
	echo '<div class="block">
<div class="block-title clearfix">
<h2 id="blocktitle"></h2>
</div>
 <form onsubmit="return searchItem()" method="GET" class="form-inline">
 <a href="./shopedit.php?my=add&cid=';
	echo $_GET['cid'];
	echo '" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;添加商品</a>&nbsp;
 <div class="form-group">
   <input type="text" class="form-control" name="kw" placeholder="请输入商品名称">
 </div>
 <button type="submit" class="btn btn-info">搜索</button>&nbsp;
 <a href="javascript:listTable(\'start\')" class="btn btn-default" title="刷新商品列表"><i class="fa fa-refresh"></i></a>
</form>

<div id="listTable"></div>
';
}
echo '    </div>
';
if (!isset($_GET['cid'])) 
{
	echo '<font color="grey">提示：查看单个分类的商品列表可进行商品排序操作';
}
echo "  </div>
     
<script src=\"//cdn.staticfile.org/layer/2.3/layer.js\"></script>
<script>
var checkflag1 = \"false\";
function check1(field) {
if (checkflag1 == \"false\") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag1 = \"true\";
return \"false\"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag1 = \"false\";
return \"true\"; }
}

function unselectall1()
{
   if(document.form1.chkAll1.checked){
	document.form1.chkAll1.checked = document.form1.chkAll1.checked&0;
	checkflag1 = \"false\";
   } 	
}

function listTable(query){
	var url = window.document.location.href.toString();
	var queryString = url.split(\"?\")[1];
	query = query || queryString;
	if(query == 'start' || query == undefined){
		query = '';
		history.replaceState({}, null, './shoplist.php');
	}else if(query != undefined){
		history.replaceState({}, null, './shoplist.php?'+query);
	}
	layer.closeAll();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'GET',
		url : 'shoplist-table.php?'+query,
		dataType : 'html',
		cache : false,
		success : function(data) {
			layer.close(ii);
			\$(\"#listTable\").html(data)
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function show(tid) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=getTool&tid='+tid,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class=\"table table-condensed table-hover\">';
				item += '<tr><td colspan=\"6\" style=\"text-align:center\"><b>商品详情</b></td></tr><tr><td class=\"info\">商品ID</td><td colspan=\"5\">'+data.data.tid+'</td></tr><tr><td class=\"info\">商品名称</td><td colspan=\"5\">'+data.data.name+'</td></tr><tr><td class=\"info\">商品链接</td><td colspan=\"5\"><a href=\"'+data.data.link+'\" target=\"_blank\">'+data.data.link+'</a></td></tr>';
				item += '</table>';
				layer.open({
				 type: 1,
				 title: '商品详情',
				 skin: 'layui-layer-rim',
				 content: item
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function editAllPrice(){
	var prid = \$(\"select[name='prid_n']\").val();
	\$(\"input[name='prid']\").val(prid);
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'POST',
		url : 'ajax.php?act=editAllPrice',
		data : \$('#form1').serialize(),
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				listTable();
				layer.alert(data.msg);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('请求超时');
			listTable();
		}
	});
}
function change(){
	if(\$(\"select[name='aid']\").val() == 10){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		\$.ajax({
			type : 'GET',
			url : 'ajax.php?act=getAllPrice',
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					layer.open({
					 type: 1,
					 title: '修改加价模板',
					 skin: 'layui-layer-rim',
					 content: data.data
					});
				}else{
					layer.alert(data.msg);
				}
			},
			error:function(data){
				layer.msg('服务器错误');
				return false;
			}
		});
		return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'POST',
		url : 'ajax.php?act=shop_change',
		data : \$('#form1').serialize(),
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				listTable();
				layer.alert(data.msg);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('请求超时');
			listTable();
		}
	});
	return false;
}
function move(){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'POST',
		url : 'ajax.php?act=shop_move',
		data : \$('#form1').serialize(),
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				listTable();
				layer.alert(data.msg);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('请求超时');
			listTable();
		}
	});
	return false;
}
function searchItem(){
	var kw=\$(\"input[name='kw']\").val();
	if(kw==''){
		listTable('start');
	}else{
		listTable('kw='+kw);
	}
	return false;
}
function setActive(tid,active) {
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setTools&tid='+tid+'&active='+active,
		dataType : 'json',
		success : function(data) {
			listTable();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function setClose(tid,close) {
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setTools&tid='+tid+'&close='+close,
		dataType : 'json',
		success : function(data) {
			listTable();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function delTool(tid) {
	var confirmobj = layer.confirm('你确实要删除此商品吗？', {
	 btn: ['确定','取消']
	}, function(){
	 \$.ajax({
		type : 'GET',
		url : 'ajax.php?act=delTool&tid='+tid,
		dataType : 'json',
		success : function(data) {
			if(data.code == 0){
				layer.msg('删除成功');
				listTable();
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	 });
	}, function(){
	 layer.close(confirmobj);
	});
}
function sort(cid,tid,sort) {
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setToolSort&cid='+cid+'&tid='+tid+'&sort='+sort,
		dataType : 'json',
		success : function(data) {
			listTable();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function getPrice(tid) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=getPrice&tid='+tid,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.open({
				 type: 1,
				 title: '修改商品价格',
				 skin: 'layui-layer-rim',
				 content: data.data
				});
				 changePrice();
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function editPrice(tid) {
	var price=\$(\"#price\").val();
	var prid=\$(\"#prid\").val();
	if(price == ''){
		layer.alert('商品售价不能为空！');
		return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : \"POST\",
		url : \"ajax.php?act=editPrice\",
		data : {tid:tid,price:price,prid:prid},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				listTable();
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function getFloat(number, n) {
	n = n ? parseInt(n) : 0;
	if (n <= 0) return Math.round(number);
	number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
	return number;
}
function changePrice(){
	var price=\$(\"#price\").val();
	var prid=\$(\"#prid\").val();
	if(price == '') return false;
	if(prid==0){
		\$(\"#price_s\").val(price);
		\$(\"#cost_s\").val(price);
		\$(\"#cost2_s\").val(price);
	}else{
		price = parseFloat(price);
		var kind = parseInt(\$(\"#prid option:selected\").attr('kind'));
		var p_2 = parseFloat(\$(\"#prid option:selected\").attr('p_2'));
		var p_1 = parseFloat(\$(\"#prid option:selected\").attr('p_1'));
		var p_0 = parseFloat(\$(\"#prid option:selected\").attr('p_0'));
		\$(\"#price_s\").val(getFloat(kind==1?price+p_0:price*p_0 ,2));
		\$(\"#cost_s\").val(getFloat(kind==1?price+p_1:price*p_1 ,2));
		\$(\"#cost2_s\").val(getFloat(kind==1?price+p_2:price*p_2 ,2));
	}
}
\$(document).ready(function(){
	listTable();
})
</script>";
?>