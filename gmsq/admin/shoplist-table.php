<?php
/**
 * 商品管理
**/
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");


function display_shoptype($type){
	if($type==1||$type==2)
		return '<span class="btn-warning btn-xs">对接</span>';
	elseif($type==4)
		return '<span class="btn-success btn-xs">发卡</span>';
	else
		return '<span class="btn-info btn-xs">自营</span>';
}

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">未分类</option>';
$shua_class[0]='未分类';
while($res = $DB->fetch($rs)){
	$shua_class[$res['cid']]=$res['name'];
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}

if($_SESSION['price_class']){
	$price_class = $_SESSION['price_class'];
}else{
	$rs=$DB->query("SELECT * FROM shua_price order by id asc");
	$price_class[0]='不加价';
	while($res = $DB->fetch($rs)){
		$price_class[$res['id']]=$res['name'];
	}
}

if(isset($_GET['kw'])){
	$kw = trim(daddslashes($_GET['kw']));
	$numrows=$DB->count("SELECT count(*) from shua_tools where name LIKE '%$kw%'");
	$sql=" name LIKE '%$kw%'";
	$con='包含 <b>'.$kw.'</b> 的共有 <b>'.$numrows.'</b> 个商品';
	$link='&kw='.$kw;
}elseif(isset($_GET['cid'])){
	$cid = intval($_GET['cid']);
	$numrows=$DB->count("SELECT count(*) from shua_tools where cid='$cid'");
	$sql=" cid='$cid'";
	$con='分类 <a href="../?cid='.$cid.'" target="_blank">'.$shua_class[$cid].'</a> 共有 <b>'.$numrows.'</b> 个商品';
	$link='&cid='.$cid;
}elseif(isset($_GET['prid'])){
	$prid = intval($_GET['prid']);
	$numrows=$DB->count("SELECT count(*) from shua_tools where prid='$prid'");
	$sql=" prid='$prid'";
	$con='加价模板 '.$price_class[$prid].' 共有 <b>'.$numrows.'</b> 个商品';
	$link='&prid='.$prid;
}else{
	$numrows=$DB->count("SELECT count(*) from shua_tools");
	$sql=" 1";
	$con='系统共有 <b>'.$numrows.'</b> 个商品';
}
?>
	  <form name="form1" id="form1">
	  <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>商品名称</th><th>成本价格</th><th>加价模板</th><th>商品类型</th><th class="<?php echo isset($_GET['cid'])?'':'hide';?>">排序操作</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_tools WHERE{$sql} order by sort asc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['tid'].'" onClick="unselectall1()">&nbsp;<a href="javascript:show('.$res['tid'].')" style="color:#000">'.$res['name'].'</a></td><td><span onclick="getPrice('.$res['tid'].')">'.$res['price'].'</span></td><td><span onclick="getPrice('.$res['tid'].')">'.($res['cost']>0?'<font color="red">未设置</font>':$price_class[$res['prid']]).'</span></td><td>'.display_shoptype($res['is_curl']).'
</td><td class="'.(isset($_GET['cid'])?'':'hide').'"><a class="btn btn-xs sort_btn" title="移到顶部" onclick="sort('.$res['cid'].','.$res['tid'].',0)"><i class="fa fa-long-arrow-up"></i></a><a class="btn btn-xs sort_btn" title="移到上一行" onclick="sort('.$res['cid'].','.$res['tid'].',1)"><i class="fa fa-chevron-circle-up"></i></a><a class="btn btn-xs sort_btn" title="移到下一行" onclick="sort('.$res['cid'].','.$res['tid'].',2)"><i class="fa fa-chevron-circle-down"></i></a><a class="btn btn-xs sort_btn" title="移到底部" onclick="sort('.$res['cid'].','.$res['tid'].',3)"><i class="fa fa-long-arrow-down"></i></a></td>
<td>'.($res['close']==1?'<span class="btn btn-xs btn-warning" onclick="setClose('.$res['tid'].',0)">已下架</span>':'<span class="btn btn-xs btn-success" onclick="setClose('.$res['tid'].',1)">上架中</span>').'&nbsp;'.($res['active']==1?'<span class="btn btn-xs btn-success" onclick="setActive('.$res['tid'].',0)">显示</span>':'<span class="btn btn-xs btn-warning" onclick="setActive('.$res['tid'].',1)">隐藏</span>').'</td><td><a href="./shopedit.php?my=edit&tid='.$res['tid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./list.php?tid='.$res['tid'].'" class="btn btn-warning btn-xs">订单</a>&nbsp;<span href="./shopedit.php?my=delete&tid='.$res['tid'].'" class="btn btn-xs btn-danger" onclick="delTool('.$res['tid'].')">删除</span></td></tr>
';
}
?>
          </tbody>
        </table>
<input type="hidden" name="prid"/>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="aid"><option selected>批量操作</option><option value="10">&gt;改加价模板</option><option value="1">&gt;改为显示</option><option value="2">&gt;改为隐藏</option><option value="3">&gt;改为上架中</option><option value="4">&gt;改为已下架</option><option value="5">&gt;删除选中</option><option value="6">&gt;复制选中</option></select><button type="button" onclick="change()">执行</button>&nbsp;&nbsp;
<select name="cid"><option selected>将选定商品移动到分类</option><?php echo $select?></select><button type="button" onclick="move()">确定移动</button>
</div>
</form>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$first.$link.'\')">首页</a></li>';
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$prev.$link.'\')">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$i.$link.'\')">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$i.$link.'\')">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$next.$link.'\')">&raquo;</a></li>';
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$last.$link.'\')">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
?>
<script>
$("#blocktitle").html('<?php echo $con?>');
</script>