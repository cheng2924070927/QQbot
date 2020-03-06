<?php
/**
 * 分站排行
**/
include("../includes/common.php");
$title='今日分站排行';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-md-10 center-block" style="float: none;">
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
$thtime=date("Y-m-d").' 00:00:00';
$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
if($_GET['last']==1){
	$sql = "select a.zid,(select b.sitename from shua_site as b where a.zid=b.zid) as sitename,count(id) as count,sum(money) as money from shua_orders as a where addtime>'$lastday' and addtime<'$thtime' and zid>1 group by zid order by money desc limit 10";
	$addstr = '已发放奖励';
}else{
	$sql = "select a.zid,(select b.sitename from shua_site as b where a.zid=b.zid) as sitename,count(id) as count,sum(money) as money from shua_orders as a where addtime>'$thtime' and zid>1 group by zid order by money desc limit 10";
	$addstr = '预计发放奖励';
}

?>
<div class="panel panel-success">
     <div class="panel-heading">分站排行</div>
<ul class="nav nav-tabs">
<li class="<?php echo $_GET['last']!=1?'active':null;?>" style="width:50%"><a href="rank.php"><center>今日销售排行</center></a></li>
<li class="<?php echo $_GET['last']==1?'active':null;?>" style="width:50%"><a href="rank.php?last=1"><center>昨日销售排行</center></a></li>
</ul>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th class="text-center">排名</th><th class="text-center">站点ID</th><th class="text-center">站点名称</th><th class="text-center">订单数</th><th class="text-center">销售金额</th><?php echo $conf['rank_reward']>0?'<th class="text-center">'.$addstr.'</th>':null;?></tr></thead>
          <tbody>
<?php
$rs=$DB->query($sql);
$i=1;
while($res = $DB->fetch($rs))
{
echo '<tr><td class="text-center"><span class="badge badge-danger">'.$i.'</span></td><td class="text-center"><b>'.$res['zid'].'</b></td><td class="text-center">'.mb_substr($res['sitename'], 0, 10, 'utf-8').'</td><td class="text-center">'.$res['count'].'</td><td class="text-center">'.$res['money'].'</td>';
if($conf['rank_reward']>0){
	if($i<=$conf['rank_reward'])$reward = round($res['money'] * $conf['rank_percentage'] / 100, 2);
	else $reward = 0;
	echo '<td class="text-center">'.$reward.'</td>';
}
echo '</tr>';
$i++;
}
?>
          </tbody>
        </table>
      </div>
<div class="panel-footer" <?php if(!$conf['rank_reward']){?>style="display:none;"<?php }?>>
<span class="glyphicon glyphicon-info-sign"></span>&nbsp;站长排行榜奖励会在每天0点后发放前一天的，奖励对象为销量排行榜前<?php echo $conf['rank_reward']?>名，当前额外提成奖励为销量的 <?php echo $conf['rank_percentage']?>%！
</div>
    </div>
 </div>
</div>