<?php
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$numrows=$DB->count("SELECT count(*) from shua_site where power>0");
if(isset($_GET['zid'])){
	$sql = " zid={$_GET['zid']} and power=0";
}elseif(isset($_GET['kw'])){
	$sql = " (user='{$_GET['kw']}' or qq='{$_GET['kw']}') and power=0";
	$link = '&kw='.$_GET['kw'];
}else{
	$sql = " power=0";
}
?>
	  <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>UID</th><th>用户名</th><th>站长QQ</th><th>余额</th><th>注册时间</th><th>状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_site WHERE{$sql} order by zid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['zid'].'</b></td><td>'.$res['user'].'</td><td>'.$res['qq'].'</td><td><a href="javascript:showRecharge('.$res['zid'].')" title="点击充值">'.$res['rmb'].'</a></td><td>'.$res['addtime'].'<br/><a href="javascript:setEndtime('.$res['zid'].')" title="点击续期">'.$res['endtime'].'</a></td><td>'.($res['status']==1?'<span class="btn btn-xs btn-success" onclick="setActive('.$res['zid'].',0)">开启</span>':'<span class="btn btn-xs btn-warning" onclick="setActive('.$res['zid'].',1)">关闭</span>').'</td><td><a href="./sitelist.php?my=add2&zid='.$res['zid'].'" class="btn btn-default btn-xs">开分站</a>&nbsp;<a href="./userlist.php?my=edit&zid='.$res['zid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./list.php?zid='.$res['zid'].'" class="btn btn-warning btn-xs">订单</a>&nbsp;<a href="./record.php?zid='.$res['zid'].'" class="btn btn-success btn-xs">明细</a>&nbsp;<a href="./userlist.php?my=delete&zid='.$res['zid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除该用户吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
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