<?php
/**
 * 订单列表
**/
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

function display_zt($zt,$id=0){
	if($zt==1)
		return '<a onclick="setResult('.$id.',\'订单结果\')" title="点此填写结果"><font color=green>已完成</font></a>';
	elseif($zt==2)
		return '<font color=orange>正在处理</font>';
	elseif($zt==3)
		return '<a onclick="setResult('.$id.')" title="点此填写异常原因"><font color=red>异常</font></a>';
	elseif($zt==4)
		return '<font color=grey>已退单</font>';
	else
		return '<font color=blue>待处理</font>';
}
function display_djzt($zt,$id=0){
	if($zt==1)
		return '<span onclick="showStatus('.$id.')" title="查看订单进度" class="btn btn-success btn-xs">成功</span>';
	elseif($zt==2)
		return '<span onclick="djOrder('.$id.')" title="点击重试" class="btn btn-danger btn-xs">失败</span>';
	elseif($zt==3)
		return '<a onclick="window.open(\'fakakms.php?orderid='.$id.'\')" title="查看卡密信息"><font color=green>已发卡</font></a>';
	elseif($zt==4)
		return '<span onclick="djOrder('.$id.')" title="点击重试" class="btn btn-danger btn-xs">未发卡</span>';
	else
		return '<font color=grey>未对接</font>';
}

$rs=$DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'">'.$res['name'].'</option>';
}


if(isset($_GET['kw']) && !empty($_GET['kw'])) {
	$sql=" `input`='{$_GET['kw']}' or `id`='{$_GET['kw']}' or `tradeno`='{$_GET['kw']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='包含 '.$_GET['kw'].' 的共有 <b>'.$numrows.'</b> 个订单';
	$link='&kw='.$_GET['kw'];
}elseif(isset($_GET['id'])) {
	$sql=" `id`='{$_GET['id']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='';
	$link='&id='.$_GET['id'];
}elseif(isset($_GET['tid'])) {
	$sql=" `tid`='{$_GET['tid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con=$shua_func[$_GET['tid']].' 共有 <b>'.$numrows.'</b> 个订单';
	$link='&tid='.$_GET['tid'];
}elseif(isset($_GET['zid'])) {
	$sql=" `zid`='{$_GET['zid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='站点ID '.$_GET['zid'].' 的共有 <b>'.$numrows.'</b> 个订单';
	$link='&zid='.$_GET['zid'];
}elseif(isset($_GET['type'])) {
	$sql=" `status`='{$_GET['type']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con=''.display_zt($_GET['type']).' 状态的共有 <b>'.$numrows.'</b> 个订单';
	if($_GET['type']==3)$con.='&nbsp;[<a href="list.php?my=fillall" onclick="return confirm(\'你确定要将所有异常订单改为待处理状态吗？\');">将所有异常订单改为待处理状态</a>]';
	$link='&type='.$_GET['type'];
}else{
	$numrows=$DB->count("SELECT count(*) from shua_orders");
	$ondate=$DB->count("select count(*) from shua_orders where status=1");
	$ondate2=$DB->count("select count(*) from shua_orders where status=2");
	$sql=" 1";
	$con='系统共有 <b>'.$numrows.'</b> 个订单，其中已完成的有 <b>'.$ondate.'</b> 个，正在处理的有 <b>'.$ondate2.'</b> 个。';
}
?>
	  <form name="form1" id="form1">
	  <div class="table-responsive">
<?php echo $con?>
        <table class="table table-striped table-bordered table-vcenter">
          <thead><tr><th>订单ID</th><th>商品名称</th><th>下单数据</th><th>份数</th><th>站点ID</th><th>添加时间</th><th>对接状态</th><th>订单状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$shua_func[$res['tid']].'</span></td><td><span onclick="inputOrder('.$res['id'].')" title="点击修改数据">'.$res['input'].($res['input2']?'<br/>'.$res['input2']:null).($res['input3']?'<br/>'.$res['input3']:null).($res['input4']?'<br/>'.$res['input4']:null).($res['input5']?'<br/>'.$res['input5']:null).'</span></td><td><span onclick="inputNum('.$res['id'].')" title="点击修改份数">'.$res['value'].'</span></td><td><a href ="sitelist.php?zid='.$res['zid'].'" target="_blank">'.$res['zid'].'</a></span></td><td>'.$res['addtime'].'</td><td>'.display_djzt($res['djzt'],$res['id']).'</td><td>'.display_zt($res['status'],$res['id']).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="4">已退单</option><option value="3">异常</option>'.($res['zid']>1?'<option value="6">退款</option>':null).'<option value="5">删除订单</option></select></td></tr>';
}
?>
          </tbody>
        </table>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="status"><option selected>操作订单</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option><option value="5">重新下单</option><option value="6">订单退款</option><option value="4">删除订单</option></select>
<button type="button" onclick="operation()">搜索</button>
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
if($pages>=10)$s=10;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
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
