<?php
/**
 * 用户管理
**/
include("../includes/common.php");
$title='用户管理';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
      </div>
      <div class="modal-body">
      <form action="userlist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入用户名或QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
if($userrow['power']<1){
	showmsg('你没有权限使用此功能！',3);
}
$my=isset($_GET['my'])?$_GET['my']:null;


$numrows=$DB->count("SELECT count(*) from shua_site where upzid='{$userrow['zid']}' and power=0");
if(isset($_GET['zid'])){
	$zid=intval($_GET['zid']);
	$sql = " zid={$zid} and upzid='{$userrow['zid']}' and power=0";
}elseif(isset($_GET['kw'])){
	$kw=daddslashes($_GET['kw']);
	$sql = " (user='{$kw}' or qq='{$kw}') and upzid='{$userrow['zid']}' and power=0";
}else{
	$sql = " upzid='{$userrow['zid']}' and power=0";
}
$con='你共有 <b>'.$numrows.'</b> 个下级用户<br/><a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>UID</th><th>用户名</th><th>QQ</th><th>余额</th><th>注册时间</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_site WHERE{$sql} order by zid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['zid'].'</b></td><td>'.$res['user'].'</td><td>'.$res['qq'].'</td><td>'.$res['rmb'].'</td><td>'.$res['addtime'].'</td><td><a href="./userlist.php?my=edit&zid='.$res['zid'].'" class="btn btn-info btn-xs" disabled>编辑</a>&nbsp;<a href="./userlist.php?my=delete&zid='.$res['zid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此站点吗？\');" disabled>删除</a></td></tr>';
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
echo '<li><a href="userlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="userlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="userlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="userlist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
?>
    </div>
  </div>