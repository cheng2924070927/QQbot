<?php
if(!defined('IN_CRONLITE'))exit();

if($islogin2==1){
	$price_obj = new Price($userrow['zid'],$userrow);
	$cookiesid = $userrow['zid'];
}elseif($is_fenzhan == true){
	$price_obj = new Price($siterow['zid'],$siterow);
}else{
	$price_obj = new Price(1);
}

$tid=intval($_GET['tid']);
$tool=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
if(!$tool || $tool['active']!=1)sysmsg('当前商品不存在');
if($tool['close']==1)sysmsg('当前商品维护中，停止下单！');

if(isset($price_obj)){
	$price_obj->setToolInfo($tool['tid'],$tool);
	if($price_obj->getToolDel($tool['tid'])==1)sysmsg('商品已下架');
	$price=$price_obj->getToolPrice($tool['tid']);
}else $price=$tool['price'];

$count = $DB->count("SELECT count(*) FROM shua_faka WHERE tid='$tid' and orderid=0");

include_once TEMPLATE_ROOT.'faka/head2.php';

$fakainput = getFakaInput();
?>
<div class="view w">
<input type="hidden" id="tid" value="<?php echo $tid?>">
<input type="hidden" id="leftcount" value="<?php echo $count?>">
  	<div class="bl_view_img"><img src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/faka/images/default.jpg';?>"  alt="<?php echo $tool['name']?>" /></div>
    <div class="bl_view_title"><?php echo $tool['name']?></div>
  <div class="bl_view_tag">
   		<div class="bl_view_price">售价：<?php echo $price?> 元</div>
    </div>
	<div class="bl_view_tag">
    	<div class="bl_view_user">商品类型：<img src="assets/faka/images/zdfh.png">
</div>
    </div>
	<div class="bl_view_title">商品库存：
 <font size="2" color="#FF7200"> 库存<?php echo $count?>个</span>
</div>
<?php if($fakainput!='hide' && !$islogin2){?>
<div class="bl_view_title"> <span id="inputname"><?php echo $fakainput?>：</span>：<input class="search_input2" id="inputvalue" name="inputvalue" type="text" required></div>
<?php }else{?>
<input type="hidden" name="inputvalue" id="inputvalue" value="<?php echo $cookiesid?>"/>
<?php }?>
	<div class="bl_view_title"> 购买数量：<input class="search_input2" id="num" name="num" type="number" value="1" min="1" max="<?php echo $count?>" placeholder="请输入购买数量" required></div>
   
    <div class="go_buy"><input type="button" value="立即购买" id="submit_buy" /></div>
</div>
  <div class="bl_view_content w">
  	<h1>商品说明<span>具体使用方法请阅读商品说明</span></h1>
    <div class="bl_view_word">
    	    <p><?php echo $tool['desc']?></p> 
    </div>
  </div>

<div class="m_user w">
<a href="#">返回顶部</a>
</div>

<div class="copyright">Copyright &copy; 2019 <?php echo $conf['sitename']?></div>
</div>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
var hashsalt=<?php echo $addsalt_js?>;

$(window).load(function() {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
})
$(document).ready(function(){
$("#submit_buy").click(function(){
	var tid=$('#tid').val();
	var num=$('#num').val();
	var leftcount=$('#leftcount').val();
	var inputvalue=$('#inputvalue').val();
	if(inputvalue=='' || tid=='' || num==''){layer.alert('请确保每项不能为空！');return false;}
	if(num==''||num<=0){
		layer.alert('购买数量最低为1个');return;
	}
	if(parseInt(num)>parseInt(leftcount)){
		layer.alert('库存最多购买'+leftcount+'个');return;
	}
	if($('#inputname').html()=='手机号码：' && (inputvalue.length!=11||isNaN(inputvalue))){layer.alert('手机号码格式不正确');return false;}
	var load=layer.load(2,{time:0,shade: [0.2,'#000']});
	$.post('ajax.php?act=pay',{tid:tid,num:num,inputvalue:inputvalue,hashsalt:hashsalt},function(data){
		layer.close(load);
		if(data.code==0){
			$.cookie('email', inputvalue);
			window.location.href='./?mod=waporder&orderid='+data.trade_no;
		}else if(data.code == 1){
			alert('领取成功！');
			window.location.href='?buyok=1';
		}else if(data.code == 3){
			layer.alert(data.msg, {
				closeBtn: false
			}, function(){
				window.location.reload();
			});
		}else if(data.code == 4){
			var confirmobj = layer.confirm('请登录后再购买，是否现在登录？', {
			  btn: ['登录','注册','取消']
			}, function(){
				window.location.href='./user/login.php';
			}, function(){
				window.location.href='./user/reg.php';
			}, function(){
				layer.close(confirmobj);
			});
		}else{
			layer.alert(data.msg,{icon:2});
		}
	});
})
})
</script>
</body>
</html>
