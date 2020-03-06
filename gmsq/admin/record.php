<?php
/**
 * 收支明细
**/
include("../includes/common.php");
$title='收支明细';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-md-12 center-block" style="float: none;">
<?php
if(isset($_GET['zid'])){
	$zid = intval($_GET['zid']);
	$sql = " zid=$zid";
	$link = '&zid='.$zid;
}else{
	$zid = 0;
	$sql = " 1";
}
$thtime=date("Y-m-d").' 00:00:00';
$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$income_today=$DB->count("SELECT sum(point) FROM shua_points WHERE action='提成' AND{$sql} AND addtime>'$thtime'");
$outcome_today=$DB->count("SELECT sum(point) FROM shua_points WHERE action='消费' AND{$sql} AND addtime>'$thtime'");
$income_lastday=$DB->count("SELECT sum(point) FROM shua_points WHERE action='提成' AND{$sql} AND addtime<'$thtime' AND addtime>'$lastday'");
$outcome_lastday=$DB->count("SELECT sum(point) FROM shua_points WHERE action='消费' AND{$sql} AND addtime<'$thtime' AND addtime>'$lastday'");

$numrows=$DB->count("SELECT count(*) from shua_points WHERE{$sql}");
?>
<div class="block">
     <div class="block-title"><h2><?php echo ($zid>0?'分站ZID:<b>'.$zid.'</b> ':'全部分站')?>收支明细</h2></div>
		  <div class="table-responsive">
<table class="table table-bordered">
<tbody>
<tr height="25">
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>今日收益</b></br><?php echo round($income_today,2)?>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>今日消费</b></br></span><?php echo round($outcome_today,2)?>元</font></td>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>昨日收益</b></br><?php echo round($income_lastday,2)?>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>昨日消费</b></br></span><?php echo round($outcome_lastday,2)?>元</font></td>
</tr>
</tbody>
</table>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>站点ID</th><th>类型</th><th>金额</th><th>详情</th><th>时间</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_points WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td><a href="sitelist.php?zid='.$res['zid'].'">'.$res['zid'].'</a></td><td>'.$res['action'].'</td><td><font color="'.(in_array($res['action'],array('提成','赠送','退款','退回','充值','加款'))?'red':'green').'">'.$res['point'].'</font></td><td>'.$res['bz'].'</td><td>'.$res['addtime'].'</td></tr>';
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
echo '<li><a href="record.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="record.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="record.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$s=10;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="record.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="record.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="record.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
 </div>
</div>