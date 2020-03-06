<?php
if(!defined('IN_CRONLITE'))exit();
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'faka/wapbuy.php';exit;}

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

include_once TEMPLATE_ROOT.'faka/head.php';

$fakainput = getFakaInput();
?>
<br/>
<div class="topliucheng"><img src="<?php echo $cdnserver?>assets/faka/images/goumaizn02.png" title=""></div>

<div id="body">

<div class="bobo">

<div class="left">

<div class="top">

<div class="tou"><img src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/faka/images/default.jpg';?>" width="150" alt="<?php echo $tool['name']?>" /></div>

<div class="bianhao">商品编号：NO.<?php echo $tid?><br />

<font color="#ff0000"  size="2">
售价：<?php echo $price?> 元</font>
</div>

<div class="wu"></div><div class="bianhao">
手机扫码购买<br/>
<img src="http://www.liantu.com/api.php?w=150&m=10&text=<?php echo $siteurl?>">
</div>
</div>

</div>
<div class="rigth">
<div class="trade-goodinfo">
<?php echo $tool['name']?></div>
<div class="trade-goodinfo2">
                                                        <span  style="color:#080808">售价</span>
                                                        <span class="trade-price">¥<?php echo $price?></span>
																										
						
                                                        <span style="float:right"><img src="assets/faka/images/zdfh.png">

                                                        </span>
                                                </div><br/>

<input type="hidden" id="tid" value="<?php echo $tid?>">
<input type="hidden" id="leftcount" value="<?php echo $count?>">
<?php if($fakainput!='hide' && !$islogin2){?>
<div class="from">
        <div class="from_wz_3" id="inputname"><?php echo $fakainput?>：</div>
        <div class="from_in_2"><input type="text" id="inputvalue" name="inputvalue" class="z" value="" required></div>
      </div>
<?php }else{?>
<input type="hidden" name="inputvalue" id="inputvalue" value="<?php echo $cookiesid?>"/>
<?php }?>
<div class="from">
 <div class="from_wz_3">购买数量：</div>
 <div class="from_in_2">
 <input id="num" name="num" class="z" type="number" value="1" placeholder="请输入购买数量" required min="1" max="<?php echo $count?>" >
 
 </div>
 <div class="from_in_2 yanzheng" style="width:200px"> <font size="2" color="#FF7200"> 库存<?php echo $count?>个</span> </div>

      </div>
	   


      <div class="from">

        <div class="from_off_4"></div>
		<div class="from_in_4" style="width:100px">
		
		<input type="button" style="cursor:pointer;" class="button button-3d button-primary button-small" value="立即购买" id="submit_buy"/>
		
	
		</div> <div class="from_in_2 yanzheng" style="width:100px">
	 <a href="#" onclick="javascript:history.go(-1);" class="button button-3d button-highlight button-rounded button-small">返回</a></div>
        </div>


		
 <div class="trade-goodinfo2">
	  商品介绍：
      </div>
      <div class="xiangqing">
	  <p>
	  <?php echo $tool['desc']?></p>      </div>

</div>

</div>

</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
var hashsalt=<?php echo $addsalt_js?>;

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
			window.location.href='./?mod=order&orderid='+data.trade_no;
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
<div id="footer">
    		&copy; 2019 <?php echo $conf['sitename']?>
</div>
