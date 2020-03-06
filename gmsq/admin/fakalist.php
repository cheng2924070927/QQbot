<?php  
include('../includes/common.php');
$title='发卡库存管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-md-12 center-block" style="float: none;">
';
$rs=$DB->query('SELECT * FROM shua_class WHERE active=1 order by sort asc');
$select='<option value="0">所有</option>';
while ($res=$DB->fetch($rs)) 
{
	$select .='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
$my=(isset($_GET['my'])?$_GET['my']:NULL);
if ($my=='move') 
{
	$cid=$_POST['cid'];
	if (!$cid) 
	{
		exit('<script language=\'javascript\'>alert(\'请选择分类\');history.go(-1);</script>');
	}
	$checkbox=$_POST['checkbox'];
	$i=0;
	foreach($checkbox as $tid)
	{
		$i=$i+1;
	}
	exit('<script language=\'javascript\'>alert(\'成功移动'.$i.'个商品\');history.go(-1);</script>');
}
else 
{
	if ($_GET['cid']) 
	{
		$cid=intval($_GET['cid']);
		$numrows=$DB->count('SELECT count(*) from shua_tools where is_curl=4 and cid=\''.$cid.'\'');
		$sql=' is_curl=4 and cid=\''.$cid.'\'';
	}
	else 
	{
		$numrows=$DB->count('SELECT count(*) from shua_tools where is_curl=4');
		$sql=' is_curl=4';
	}
	echo '<div class="block">
<div class="block-title clearfix">
<form action="fakalist.php" method="GET" class="form-inline">
 <div class="form-group">
   <select name="cid" class="form-control" default="';
	echo $_GET['cid'];
	echo '">';
	echo $select;
	echo '</select>
 </div>
 <button type="submit" class="btn btn-primary">进入分类</button>&nbsp;
</form>
</div>

	 <form name="form1" method="post" action="fakalist.php?my=move">
	 <div class="table-responsive">
       <table class="table table-striped">
         <thead><tr><th>ID</th><th>商品名称</th><th>剩余卡密</th><th>已售出</th><th>状态</th><th>操作</th></tr></thead>
         <tbody>
';
	$pagesize=30;
	$pages=intval($numrows/$pagesize);
	if ($numrows%$pagesize) 
	{
		$pages=$pages+1;
	}
	if (isset($_GET['page'])) 
	{
		$page=intval($_GET['page']);
	}
	else 
	{
		$page=1;
	}
	$offset=$pagesize*($page-1);
	$rs=$DB->query('SELECT a.*,(select count(b.tid) from shua_faka as b where b.tid=a.tid and orderid=0) as leftcount,(select count(b.tid) from shua_faka as b where b.tid=a.tid and orderid!=0) as sellcount FROM shua_tools as a WHERE'.$sql.' order by sort asc limit '.$offset.','.$pagesize);
	while ($res=$DB->fetch($rs)) 
	{
		echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['tid'].'" onClick="unselectall1()"><b>'.$res['tid'].'</b></td><td>'.$res['name'].'</td><td>'.$res['leftcount'].'</td><td>'.$res['sellcount'].'</td><td>'.($res['active']==1 ? '<span class="btn btn-xs btn-success" onclick="setActive('.$res['tid'].',0)">上架中</span>' : '<span class="btn btn-xs btn-warning" onclick="setActive('.$res['tid'].',1)">已下架</span>').'</td><td><a href="./fakakms.php?tid='.$res['tid'].'" class="btn btn-info btn-xs">查看卡密</a>&nbsp;<a href="./fakakms.php?my=add&tid='.$res['tid'].'" class="btn btn-success btn-xs">加卡</a>&nbsp;<a href="./list.php?tid='.$res['tid'].'" class="btn btn-warning btn-xs">订单</a>&nbsp;<a href="./shopedit.php?my=delete&tid='.$res['tid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此商品吗？\');">删除</a></td></tr>
';
	}
	echo '          </tbody>
       </table>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="cid"><option selected>批量操作</option><option value="-1">&gt;改为上架中</option><option value="-2">&gt;改为已下架</option><option value="-3">&gt;删除选中</option></select>
<input type="submit" name="Submit" value="确定">
</div>
</form>

<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
var checkflag1 = "false";
function check1(field) {
if (checkflag1 == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag1 = "true";
return "false"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag1 = "false";
return "true"; }
}

function unselectall1()
{
   if(document.form1.chkAll1.checked){
	document.form1.chkAll1.checked = document.form1.chkAll1.checked&0;
	checkflag1 = "false";
   } 	
}

function setActive(tid,active) {
	$.ajax({
		type : \'GET\',
		url : \'ajax.php?act=setTools&tid=\'+tid+\'&active=\'+active,
		dataType : \'json\',
		success : function(data) {
			window.location.reload();
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	});
}
function sort(cid,tid,sort) {
	$.ajax({
		type : \'GET\',
		url : \'ajax.php?act=setToolSort&cid=\'+cid+\'&tid=\'+tid+\'&sort=\'+sort,
		dataType : \'json\',
		success : function(data) {
			window.location.reload();
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	});
}
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>

';
	echo '<ul class="pagination">';
	$first=1;
	$prev=$page-1;
	$next=$page+1;
	$last=$pages;
	if ($page>1) 
	{
		echo '<li><a href="fakalist.php?page='.$first.$link.'">首页</a></li>';
		echo '<li><a href="fakalist.php?page='.$prev.$link.'">&laquo;</a></li>';
	}
	else 
	{
		echo '<li class="disabled"><a>首页</a></li>';
		echo '<li class="disabled"><a>&laquo;</a></li>';
	}
	$i=1;
	while ($i<$page) 
	{
		echo '<li><a href="fakalist.php?page='.$i.$link.'">'.$i.'</a></li>';
		$i=$i+1;
	}
	echo '<li class="disabled"><a>'.$page.'</a></li>';
	$i=$page+1;
	while ($i<=$pages) 
	{
		echo '<li><a href="fakalist.php?page='.$i.$link.'">'.$i.'</a></li>';
		$i=$i+1;
	}
	echo '';
	if ($page<$pages) 
	{
		echo '<li><a href="fakalist.php?page='.$next.$link.'">&raquo;</a></li>';
		echo '<li><a href="fakalist.php?page='.$last.$link.'">尾页</a></li>';
	}
	else 
	{
		echo '<li class="disabled"><a>&raquo;</a></li>';
		echo '<li class="disabled"><a>尾页</a></li>';
	}
	echo '</ul>';
}
echo '</div>
   </div>
 </div>';
?>