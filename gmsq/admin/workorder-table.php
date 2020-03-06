<?php
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

function display_type($type){
	if($type==1)
		return '业务补单';
	elseif($type==2)
		return '卡密错误';
	elseif($type==3)
		return '充值没到账';
	elseif($type==4)
		return '中途改了密码';
	else
		return '其它问题';
}

function display_status($status){
	if($status==1)
		return '<font color="red">处理中</font>';
	elseif($status==2)
		return '<font color="green">已完成</font>';
	else
		return '<font color="blue">待处理</font>';
}

if(isset($_GET['status'])){
	$status = intval($_GET['status']);
	$sql = " status={$status}";
}else{
	$sql = " 1";
}
$numrows=$DB->count("SELECT count(*) from shua_workorder WHERE{$sql}");

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
?>
	  <form name="form1" id="form1">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>ZID</th><th>类型</th><th>订单号</th><th>问题描述</th><th>状态</th><th>提交时间</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM shua_workorder WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
$content=explode('*',$res['content']);
$content=mb_substr($content[0], 0, 16, 'utf-8');
echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()">&nbsp;<b>'.$res['id'].'</b></td><td><a href="./sitelist.php?zid='.$res['zid'].'" target="_blank">'.$res['zid'].'</a></td><td>'.display_type($res['type']).'</td><td><a href="./list.php?id='.$res['orderid'].'" target="_blank">'.$res['orderid'].'</a></td><td><a href="javascript:orderItem('.$res['id'].')">'.$content.'</a></td><td>'.display_status($res['status']).'</td><td>'.$res['addtime'].'</td><td><a href="javascript:orderItem('.$res['id'].')" class="btn btn-info btn-xs">查看</a>&nbsp;<a href="./workorder.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此工单吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
<input type="hidden" name="content"/>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="aid"><option selected>批量操作</option><option value="1">&gt;改为处理中</option><option value="2">&gt;改为已完成</option><option value="3">&gt;批量回复</option><option value="4">&gt;删除选中</option></select><button type="button" onclick="change()">执行</button>
      </div>
	  </form>
<?php
echo'<div class="text-center"><ul class="pagination">';
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
echo'</ul></div>';