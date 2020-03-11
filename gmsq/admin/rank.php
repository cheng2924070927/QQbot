<?php
/**
 * 分站排行
**/
include("../includes/common.php");
$title='分站排行';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-xs-12 col-md-10 center-block" style="float: none;">
<?php
if($_GET['my']=='setdo' && $_POST['do']=='submit'){
	$rank_reward=$_POST['rank_reward'];
	$rank_percentage=$_POST['rank_percentage'];
	if($rank_reward>0){
		if($rank_percentage==null)showmsg('奖励销量的比例不能为空',3);
		elseif($rank_percentage<0 || $rank_percentage>50)showmsg('请设置合理的奖励比例',3);
	}
	saveSetting('rank_reward',$rank_reward);
	saveSetting('rank_percentage',$rank_percentage);
	$ad=$CACHE->clear();
	if($ad)showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}elseif($_GET['my']=='set'){
$cron_lasttime = $DB->get_column("SELECT `v` FROM `shua_config` WHERE `k` = 'cron_rank_time' LIMIT 1");
$cron_money = $DB->get_column("SELECT `v` FROM `shua_config` WHERE `k` = 'cron_rank_money' LIMIT 1");
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">分站排行奖励设置</h3>&nbsp;&nbsp;[<a href="rank.php">返回</a>]</div>
<div class="">
<div class="alert alert-success">监控地址：<br/><a style="color:white" target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/gmsq/cron.php?do=rank&key=<?php echo $conf['cronkey']; ?>">http://<?php echo $_SERVER['HTTP_HOST'] ?>/gmsq/cron.php?do=rank&key=<?php echo $conf['cronkey']; ?></a></div>
<div class="alert alert-warning">监控说明：每天一次或1小时一次都可以，只能在一个地方监控，千万不要多节点监控或在多处监控，否则会导致数据错乱。也可以每天凌晨手动打开一次。</div>
  <form action="./rank.php?my=setdo" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
    <div class="form-group">
	  <label class="col-sm-2 control-label">每日奖励前几名</label>
	  <div class="col-sm-10"><input type="text" name="rank_reward" value="<?php echo $conf['rank_reward']; ?>" class="form-control" placeholder="（0或留空为关闭奖励）"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">奖励销量的比例<br/>（百分数）</label>
	  <div class="col-sm-10"><input type="text" name="rank_percentage" value="<?php echo $conf['rank_percentage']; ?>" class="form-control" placeholder="（填写百分数，例如填写3将额外奖励当日销量的3%）"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
<table class="table table-bordered">
	<tbody>
		<tr>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-calendar-times-o"></i> 上次发放奖励时间<br><?php echo $cron_lasttime?>
			</th>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-money"></i> 上次发放奖励金额<br><?php echo $cron_money?>
			</th>
		</tr>
	</tbody>
</table>
<?php
}else{
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
<div class="block">
     <div class="block-title"><h2>分站排行</h2></div>
<ul class="nav nav-tabs">
<li class="<?php echo $_GET['last']!=1?'active':null;?>" style="width:33.333333%"><a href="rank.php"><center>今日销售排行</center></a></li>
<li class="<?php echo $_GET['last']==1?'active':null;?>" style="width:33.333333%"><a href="rank.php?last=1"><center>昨日销售排行</center></a></li>
<li style="width:33.333333%"><a href="rank.php?my=set"><center>分站排行奖励设置</center></a></li>
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
    </div>
<?php }?>
 </div>
</div>