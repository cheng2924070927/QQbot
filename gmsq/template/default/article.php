<?php
if(!defined('IN_CRONLITE'))exit();

$type = array(0,1);
$id=isset($_GET['id'])?intval($_GET['id']):sysmsg('文章ID不存在');
$row=$DB->get_row("select * from shua_message where id='$id' and active=1 limit 1");
if(!$row)
	sysmsg('当前文章不存在！');
if(!in_array($row['type'],$type))
	sysmsg('你没有权限查看此消息内容');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $row['title']?> - <?php echo $conf['sitename']?></title>
    <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/simple/css/plugins.css">
    <link rel="stylesheet" href="assets/simple/css/main.css">
    <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<br/>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-list"></i>&nbsp;&nbsp;<b>文章内容</b></h2>
        </div>
<ol class="breadcrumb">
	<li>
		<a href="./">首页</a>
	</li>
	<li>
		<a href="./?mod=articlelist">文章列表</a>
	</li>
	<li class="active"><?php echo $row['title']?></li>
</ol>
<div class="text-center">
<h3><strong><?php echo $row['title']?></strong></h3>
<span class="text-muted"><?php echo $row['addtime']?></span>
</div><hr/>
<?php echo $row['content']?>
			<hr>
			<div class="form-group">
			<a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回首页</a>
			<a href="./?mod=articlelist" class="btn btn-info btn-rounded" style="float:right;"><i class="fa fa-list"></i>&nbsp;返回列表</a>
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