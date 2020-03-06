<?php
/**
 * 代理管理
**/
include("../includes/common.php");
$title='代理管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索代理</h4>
      </div>
      <div class="modal-body">
      <form action="ulist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入代理授权商的用户名或代理授权商的QQ号"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加代理用户</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=add_submit" method="POST">
<div class="form-group">
<label>用户名:</label><br>
<input type="text" class="form-control" name="user" value="" placeholder="代理授权商用于登录授权站后台的用户名" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="pwd" value="" placeholder="代理授权商用于登录授权站后台的密码" required>
</div>
<div class="form-group">
<label>可授权数量:</label><br>
<input type="text" class="form-control" name="peie" value="" placeholder="如果是无限授权填写99999即可" required>
</div>
<div class="form-group">
<label>代理QQ:</label><br>
<input type="text" class="form-control" name="qq" value="" placeholder="代理授权商的QQ号">
</div>
<div class="form-group">
<label>状态:</label>
<select name="active" class="form-control"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
echo '<br/><a href="./ulist.php">>>返回代理列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$uid=intval($_GET['uid']);
$row=$DB->get_row("select * from auth_daili where uid='$uid' limit 1");
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改代理用户信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=edit_submit&uid='.$uid.'" method="POST">
<div class="form-group">
<label>用户名:</label><br>
<input type="text" class="form-control" name="user" value="'.$row['user'].'" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="pwd" value="'.$row['pass'].'" required>
</div>
<div class="form-group">
<label>可授权数量:</label><br>
<input type="text" class="form-control" name="peie" value="'.$row['peie'].'" required>
</div>
<div class="form-group">
<label>代理QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'">
</div>
<div class="form-group">
<label>状态:</label>
<select name="active" class="form-control" default="'.$row['active'].'"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
echo '<br/><a href="./ulist.php">>>返回代理列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$peie=$_POST['peie'];
$qq=$_POST['qq'];
$active=$_POST['active'];
if($user==NULL or $pwd==NULL or $peie==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$rows=$DB->get_row("select * from auth_daili where user='$user' limit 1");
if($rows)
	showmsg('用户名已存在！',3);
$sql="insert into `auth_daili` (`user`,`pass`,`peie`,`qq`,`date`,`active`) values ('".$user."','".$pwd."','".$peie."','".$qq."','".$date."','".$active."')";
if($DB->query($sql)){
	showmsg('添加代理成功！<br/><br/><a href="./ulist.php">>>返回代理列表</a>',1);
}else
	showmsg('添加代理失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$uid=intval($_GET['uid']);
$rows=$DB->get_row("select * from auth_daili where uid='$uid' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$peie=$_POST['peie'];
$qq=$_POST['qq'];
$active=$_POST['active'];
if($user==NULL or $peie==NULL or $active==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update auth_daili set user='$user',pass='$pwd',peie='$peie',qq='$qq',date='$date',active='$active' where uid='{$uid}'"))
	showmsg('修改代理成功！<br/><br/><a href="./ulist.php">>>返回代理列表</a>',1);
else
	showmsg('修改代理失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$uid=intval($_GET['uid']);
$sql="DELETE FROM auth_daili WHERE uid='$uid'";
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./ulist.php">>>返回代理列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from auth_daili");
if(isset($_GET['id'])){
	$sql = " uid={$_GET['uid']}";
}elseif(isset($_GET['kw'])){
	$sql = " user='{$_GET['kw']}' or qq='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个代理授权商<br/><a href="./ulist.php?my=add" class="btn btn-primary">添加用户</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>UID</th><th>用户名</th><th>QQ</th><th>可授权数量</th><th>添加时间</th><th>状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM auth_daili WHERE{$sql} order by uid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['uid'].'</b></td><td>'.$res['user'].'</td><td><a href="tencent://message/?uin='.$res['qq'].'&amp;Site=qq&amp;Menu=yes">'.$res['qq'].'</a></td><td>'.$res['peie'].'</td><td>'.$res['date'].'</td><td>'.$res['active'].'</td><td><a href="./ulist.php?my=edit&uid='.$res['uid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./list.php?uid='.$res['uid'].'" class="btn btn-warning btn-xs">授权</a>&nbsp;<a href="./ulist.php?my=delete&uid='.$res['uid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此记录吗？\');">删除</a></td></tr>';
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
echo '<li><a href="ulist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="ulist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="ulist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="ulist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>