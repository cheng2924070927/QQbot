<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
</style>
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top affix" role="navigation">
  <div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only"><?php echo $conf['sitename']?></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="./"><?php echo $conf['sitename']?></a>
	<p class="navbar-text pull-left text-muted hidden-xs hidden-sm"><small class="text-muted text-sm"><em><?php echo $_SERVER['HTTP_HOST']?></em></small></p>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
	  <li class=""><a href="./"><span class="glyphicon glyphicon-home"></span>&nbsp;下单首页</a></li>
	  <li class=""><a href="./?mod=query"><span class="glyphicon glyphicon-search"></span>&nbsp;查询订单</a></li>
	  <?php if($conf['fenzhan_buy']==1){?><li class=""><a href="./user/"><span class="glyphicon glyphicon-cog"></span>&nbsp;分站后台</a></li>
	  </ul><?php }?>
	  </ul>
  </div>
  </div>
</div>
  
<div class="container" style="margin-top: 60px">
 

<div class="row">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">

<div class="panel panel-primary">
    <div class="panel-heading" align="center">
        <h3 class="panel-title">购买商品</h3>
    </div>		
    <div class="panel-body">

			<?php echo $conf['alert']?>
			<input type="hidden" name="cid" id="cid" value="0"/>
			<div class="form-group" id="display_searchBar" style="display:none;">
				<div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-remove onclick" title="关闭" id="closeSearchBar"></span></div>
				<input type="text" id="searchkw" class="form-control" placeholder="搜索商品" onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索" id="doSearch"></span></div>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品名称</div>
				<select name="tid" id="tid" class="form-control" onchange="getPoint();" disabled style="appearance:none;-moz-appearance:none;-webkit-appearance:none;"><option value="0">请选择商品</option></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品价格</div>
				<input type="text" name="need" id="need" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_left" style="display:none;">
				<div class="input-group"><div class="input-group-addon">库存数量</div>
				<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_num" style="display:none;">
                <div class="input-group">
                <div class="input-group-addon">下单份数</div>
                <span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
				<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
				<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
			</div></div>
			<div id="inputsname"></div>
			<div id="alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">

 </div>
</div>
			
</div>		
</div>
</div>


<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=false;
var homepage=false;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>