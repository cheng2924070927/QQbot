<?php
if(!defined('IN_CRONLITE'))exit();

$orderid=trim(daddslashes($_GET['orderid']));
$row=$DB->get_row("select * from shua_pay where trade_no='$orderid' limit 1");
if(!$row)sysmsg('当前订单不存在');
if($row['status']==1)exit("<script language='javascript'>alert('当前订单已完成支付！');window.location.href='./?buyok=1';</script>");

include_once TEMPLATE_ROOT.'faka/head2.php';

?>
<style>
.payment-icon-list ul, .payment-list ul {
    padding: 1px 0;
}
.payment-icon-list li.curr:after, .payment-list li.curr:after {
    content: '';
    position: absolute;
    width: 17px;
    height: 17px;
    background-image: url(assets/faka/images/zf.png);
    bottom: 0;
    right: 0;
    background-position: 17px -119px;
}
.payment-list li {
    padding: 3px 3px;
    font-size: 14px;
    border: 1px solid #b4b7bf;
    border-radius: 3px;
    display: inline-block;
    position: relative;
    cursor: pointer;
    margin-right: 5px;
}
.payment-icon-list li.curr, .payment-list li.curr {
    border: 1px solid #0071ce;
	    border: 1px solid #db5b5a;
    color: #0071ce;
	   
}
.payment-icon-list li i, .payment-list li i {
    text-indent: -10000px;
    overflow: hidden;
    outline: 0;
}
.payment-icon-cft {
    background-image: url(assets/faka/images/alipaym.png);
background-position: 0px -76px;
}
.payment-icon-wx {
    background-image: url(assets/faka/images/wxpaym.png);
    background-position: 0px -75px;
}
.payment-icon-qq {
    background-image: url(assets/faka/images/qqpaym.png);
    background-position: 0px 69px;
}
.payment-icon-yu {
    background-image: url(assets/faka/images/yuem.png);
    background-position: 0px 70px;
}
.payment-icon-cft, .payment-icon-yu, .payment-icon-ms, .payment-icon-qq, .payment-icon-vs, .payment-icon-wx {
    display: inline-block;
    vertical-align: top;
    width: 99px;
    height: 30px;
}
em, i {
    font-style: normal;
    font-weight: 400;
}
</style>

	<div class="view w">
	   
	<div class="bl_view_title"><div align="center"><strong><font color="#009f1e"  size="3">订单生成成功，请完成支付！</font></strong></div></div>
    <div class="bl_view_title">订单号码：<?php echo $orderid?></div>
	<div class="bl_view_title">商品名称：<a href="./?mod=buy&tid=<?php echo $row['tid']?>" target="_blank"><?php echo $row['name']?></a></div>
	<div class="bl_view_title">订单金额： <b><?php echo $row['money']?>元</b><?php if($islogin2==1){?> &nbsp;&nbsp; <font color="#ee6500"  size="2">可用余额：<?php echo $userrow['rmb']?>元</font> 【<a href="./user/#chongzhi">充值余额</a>】<?php }?></div>
	
	<div class="bl_view_title">
		<div class="payment-list">
          <ul>
		  <?php if($islogin2==1){?><li data-paytype="rmb"><i class="payment-icon-yu">余额支付</i></li><?php }?>
		  <li data-paytype="alipay"><i class="payment-icon-cft">支付宝支付</i></li>		   <li data-paytype="wxpay"><i class="payment-icon-wx">微信支付</i></li><li data-paytype="qqpay"><i class="payment-icon-qq">QQ钱包支付</i></li>		
		 
          </ul>
		  <input type="hidden" id="orderid" value="<?php echo $orderid?>">
		  <input type="hidden" id="tid" value="<?php echo $row['tid']?>">
		  <SELECT id="paytype" name="paytype" style="display: none"> 
		  <?php if($islogin2==1){?><option value='rmb'>余额支付</option><?php }?>
		  <option value='alipay'>支付宝支付</option>		 <option value='wxpay'>微信支付</option>		 <option value='qqpay'>QQ钱包支付</option>			
 			</SELECT>
        </div>
		</div>
		<div class="go_buy"><input type="submit" id="dopay" value="立即付款" /></div><br/><font color="#FF0000"  size="2"> 付款后请不要关闭窗口，等网页转跳会自动转跳到卡密页面。</font>
        </div>

<div class="m_user w">
<a href="#">返回顶部</a>
</div>

<div class="copyright">Copyright &copy; 2019 <?php echo $conf['sitename']?></div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
})
function dopay(type,orderid){
	if(type == 'rmb'){
		var ii = layer.msg('正在提交订单请稍候...', {icon: 16,shade: 0.5,time: 15000});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=payrmb",
			data : {orderid: orderid},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					alert(data.msg);
					window.location.href='?buyok=1';
				}else if(data.code == -2){
					alert(data.msg);
					window.location.href='?buyok=1';
				}else if(data.code == -3){
					var confirmobj = layer.confirm('你的余额不足，请充值！', {
					  btn: ['立即充值','取消']
					}, function(){
						window.location.href='./user/#chongzhi';
					}, function(){
						layer.close(confirmobj);
					});
				}else if(data.code == -4){
					var confirmobj = layer.confirm('你还未登录，是否现在登录？', {
					  btn: ['登录','注册','取消']
					}, function(){
						window.location.href='./user/login.php';
					}, function(){
						window.location.href='./user/reg.php';
					}, function(){
						layer.close(confirmobj);
					});
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	}else{
		window.location.href='other/submit.php?type='+type+'&orderid='+orderid;
	}
}
function cancel(){
	var orderid=$('#orderid').val();
	var tid=$('#tid').val();
	$.ajax({
		type : "POST",
		url : "ajax.php?act=cancel",
		data : {orderid: orderid},
		dataType : 'json',
		success : function(data) {
			window.location.href='./?mod=buy&tid='+tid;
		},
		error:function(data){
			history.back(-1);
		}
	});
}
$(document).ready(function(){
$(".payment-list ul li:first").addClass('curr');
$(".payment-list ul li").click(function(){ $(this).parent().find('li').removeClass('curr');$(this).addClass('curr');
var paytype = $(this).attr('data-paytype');
$("#paytype").val(paytype);
});
$("#dopay").click(function(){
	var orderid=$('#orderid').val();
	var paytype=$('#paytype').val();
	dopay(paytype,orderid);
});
})
</script>
</body>
</html>
