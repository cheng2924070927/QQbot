<?php
if(!defined('IN_CRONLITE'))exit();
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'mall/WapPostProduct.php';exit;}
$title = '商品列表';
$cssadd = '<link href="'.$cdnpublic.'twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="'.$cdnpublic.'font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="'.$cdnserver.'assets/mall/css/nifty.min.css" rel="stylesheet">';
include TEMPLATE_ROOT.'mall/head.php';
?>
<div class="Main" style="min-height:360px;">
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">
		
		<style>
			.wxdy span { font-size:14px; line-height: 40px;}
			.wxdy em { font-size:14px; color: #1775F4;}
			
			img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
			.onclick{cursor: pointer;touch-action: manipulation;}
			</style>
	
        <div class="wxdy">
			
            <span style="color:#2287EB; font-size:20px;">提交订单</span>
        	
        </div>
		

		
		<div class="panel panel-primary">
			<div class="panel-body">

			<input type="hidden" name="cid" id="cid" value="0"/>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control" onChange="getPoint();"><option value="0">请选择商品</option></select>
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
	
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=false;
var homepage=true;
var hashsalt='<?php echo $addsalt?>';
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>

		</div>

	</div></div>
</div><div class="clear"></div>
<div class="anli_wrap"></div>


   <!--  bottom-->

<?php include TEMPLATE_ROOT.'mall/foot.php';?>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">

<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>