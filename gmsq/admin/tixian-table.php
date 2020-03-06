<?php
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

function display_zt($zt){
	if($zt==1)
		return '<font color=green>已完成</font>';
	else
		return '<font color=blue>未完成</font>';
}
function display_type($type){
	if($type==1)
		return '微信';
	elseif($type==2)
		return 'QQ钱包';
	else
		return '支付宝';
}


if(isset($_GET['type'])){
	$type = intval($_GET['type']);
	$sql=" pay_type='$type'";
	$link='&type='.$type;
}elseif(isset($_GET['kw'])){
	$sql=" `pay_account`='{$_GET['kw']}' or `pay_name`='{$_GET['kw']}'";
	$link='&kw='.$_GET['kw'];
}else{
	$sql = " 1";
}
$numrows=$DB->count("SELECT count(*) from shua_tixian WHERE{$sql}");
?>
	<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>ZID</th><th>金额</th><th>实际到账</th><th>提现方式</th><th>提现账号</th><th>姓名</th><?php echo $conf['fenzhan_skimg']==1?'<th>收款图</th>':null;?><th>申请时间</th><th>完成时间</th><th>状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_tixian WHERE{$sql} ORDER BY id DESC limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['zid'].'</td><td>'.$res['money'].'</td><td>'.$res['realmoney'].'</td><td>'.display_type($res['pay_type']).'</td><td><span onclick="inputInfo('.$res['id'].')" title="修改信息">'.$res['pay_account'].'</span></td><td><span onclick="inputInfo('.$res['id'].')" title="修改信息">'.$res['pay_name'].'</span></td>'.($conf['fenzhan_skimg']==1?'<td><a href="javascript:skimg('.$res['zid'].')">点击查看</a></td>':null).'<td>'.$res['addtime'].'</td><td>'.($res['status']==1?$res['endtime']:null).'</td><td>'.display_zt($res['status']).'</td><td>'.($res['status']==0?'<a href="javascript:operation('.$res['id'].',\'complete\')" class="btn btn-success btn-xs">完成</a>&nbsp;<a href="javascript:back('.$res['id'].',\''.$res['money'].'\')" class="btn btn-xs btn-info">退回</a>':'<a href="javascript:operation('.$res['id'].',\'reset\')" class="btn btn-info btn-xs">撤销</a>').'&nbsp;<a href="./record.php?zid='.$res['zid'].'" class="btn btn-warning btn-xs">明细</a>&nbsp;<a href="javascript:delItem('.$res['id'].')" class="btn btn-xs btn-danger">删除</a></td></tr>';
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
echo '<li><a href="tixian.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="tixian.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="tixian.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="tixian.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="tixian.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="tixian.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';