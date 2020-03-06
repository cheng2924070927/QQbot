<?php
if(!defined('IN_CRONLITE'))exit();
$type = '0,1';
$msgcount=$DB->count("SELECT count(*) FROM shua_message WHERE type IN ($type) AND active=1");
$limit=isset($_GET['limit'])?intval($_GET['limit']):10;
$rs=$DB->query("SELECT * FROM shua_message WHERE type IN ($type) AND active=1 ORDER BY id DESC LIMIT 0,$limit");
$msgrow=array();
while($res = $DB->fetch($rs)){
	$msgrow[]=$res;
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename']?> - 文章列表</title>
    <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/simple/css/plugins.css">
    <link rel="stylesheet" href="assets/simple/css/main.css">
    <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.onclick{cursor: pointer;touch-action: manipulation;}
</style>
</head>
<body>
<br/>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-list"></i>&nbsp;&nbsp;<b>文章列表</b></h2>
        </div>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<tbody id="msglist">
<?php
foreach($msgrow as $row){
	echo '<tr class="widget animation-fadeInQuick onclick" onclick="window.location.href=\'./?mod=article&id='.$row['id'].'\'"><td><b>'.$row['title'].'</b></a><br/><small class="pull-right"><span class="text-muted">'.$row['addtime'].'</span></small></td></tr>';
}
if($msgcount==0){
	echo '<tr><td class="text-center"><font color="grey">消息列表空空如也</font></td></tr>';
}
?>			
			</tbody>
        </table>
		<?php if($msgcount>$limit){?>
		<center><a href="./?mod=articlelist&limit=<?php echo $limit+10;?>" id="btnload">加载更多</a></center>
		<?php }?>
			</div>
			<hr>
			<div class="form-group">
			<a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回首页</a>
			<a href="./user/" class="btn btn-info btn-rounded" style="float:right;"><i class="fa fa-user"></i>&nbsp;用户中心</a>
			</div>
        </div>
      </div>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
</body>
</html>