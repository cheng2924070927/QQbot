<?php
/**
 * 授权列表
**/
include("../includes/common.php");
$title='授权列表';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加一个授权</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./list.php?my=add_submit" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label>机器人QQ:</label><br>
<input type="text" class="form-control" name="qq" value="" required>
</div>
<div class="form-group">
<label>主人QQ:</label><br>
<input type="text" class="form-control" name="oqq" value="" required>
</div>
<div class="form-group">
<label>是否激活:</label><br><select class="form-control" name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
echo '<br/><a href="./list.php">>>返回授权列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=intval($_GET['id']);
$row=$DB->get_row("select * from auth_qqs where id='$id' and uid='$daili_id' limit 1");
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改授权信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./list.php?my=edit_submit&id='.$id.'" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label>机器人QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'" required>
</div>
<div class="form-group">
<label>主人QQ:</label><br>
<input type="text" class="form-control" name="oqq" value="'.$row['oqq'].'" required>
</div>
<div class="form-group">
<label>是否激活:</label><br><select class="form-control" name="active" default="'.$row['active'].'"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./list.php">>>返回授权列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
}
elseif($my=='add_submit')
{
$qq=trim(strip_tags(daddslashes($_POST['qq'])));
$oqq=trim(strip_tags(daddslashes($_POST['oqq'])));
$active=intval($_POST['active']);
if($qq==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->get_row("select * from auth_qqs where qq='$qq' limit 1"))
	showmsg('添加失败，该群号已授权',3);
if($udata['peie']<=$sqcount){
	showmsg('您的授权配额已用完，请联系管理员充值！',3);
}
if($DB->query("insert into `auth_qqs` (`uid`,`qq`,`oqq`,`date`,`active`) values ('".$daili_id."','".$qq."','".$oqq."','".$date."','".$active."')")){
	$city=get_ip_city($clientip);
	$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$udata['user']."','新增授权','".$date."','".$city."','".$qq."')");
	showmsg('添加授权成功！<br/><br/><a href="./list.php">>>返回授权列表</a>',1);
}else
	showmsg('添加授权失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from auth_qqs where id='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$qq=trim(strip_tags(daddslashes($_POST['qq'])));
$oqq=trim(strip_tags(daddslashes($_POST['oqq'])));
$active=intval($_POST['active']);
if($qq==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update auth_qqs set qq='$qq',oqq='$oqq',active='$active' where id='{$id}' and uid='$daili_id'"))
	showmsg('修改授权成功！<br/><br/><a href="./list.php">>>返回授权列表</a>',1);
else
	showmsg('修改授权失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from auth_qqs where id='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$sql="DELETE FROM auth_qqs WHERE id='$id' and uid='$daili_id'";
if($DB->query($sql)){
	$city=get_ip_city($clientip);
	$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','删除授权','".$date."','".$city."','".$rows['qq']."')");
	showmsg('删除授权成功！<br/><br/><a href="./list.php">>>返回授权列表</a>',1);
}else
	showmsg('删除授权失败！'.$DB->error(),4);
}
else
{

if(isset($_GET['kw'])) {
	$kw=daddslashes($_GET['kw']);
	$sql=" (`qq`='{$kw}' or `oqq`='{$kw}') and uid='$daili_id'";
	$numrows=$DB->count("SELECT count(*) from auth_qqs WHERE{$sql}");
	$con='包含 '.$kw.' 的共有 <b>'.$numrows.'</b> 条记录';
	$link='&kw='.$kw;
}else{
	$sql=" uid='$daili_id'";
	$numrows=$DB->count("SELECT count(*) from auth_qqs where{$sql}");
	$con='代理授权商(UID:'.$daili_id.')共有 <b>'.$numrows.'</b> 个授权';
}

echo '<div class="alert alert-info">';
echo '<form action="list.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>搜索</label>
    <input type="text" class="form-control" name="kw" placeholder="授权机器人QQ号" required>
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>
  <a href="./list.php?my=add" class="btn btn-success">添加一个授权</a>
</form>';
echo $con.'</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>机器人QQ</th><th>主人QQ</th><th>添加时间</th><th>状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM auth_qqs WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td><a href="tencent://message/?uin='.$res['qq'].'&Site=qq&Menu=yes">'.$res['qq'].'</a></td><td><a href="tencent://message/?uin='.$res['oqq'].'&Site=qq&Menu=yes">'.$res['oqq'].'</a></td><td>'.$res['date'].'</td><td>'.$res['active'].'</td><td><a href="./list.php?my=edit&id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./list.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此记录吗？\');">删除</a></td></tr>';
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
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
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