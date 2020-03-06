<?php
/**
 * 自助开通分站
**/
$is_defend=true;
include("../includes/common.php");
if($islogin2==1 && $userrow['power']>0){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已开通过分站！');window.location.href='./';</script>");
}elseif($conf['fenzhan_buy']==0){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('当前站点未开启自助开通分站功能！');window.location.href='./';</script>");
}

if($is_fenzhan == true && $siterow['power']==2){
	if($siterow['ktfz_price']>0)$conf['fenzhan_price']=$siterow['ktfz_price'];
	if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
	if($siterow['ktfz_price2']>0 && $siterow['ktfz_price2']>=$conf['fenzhan_cost2'])$conf['fenzhan_price2']=$siterow['ktfz_price2'];
}
$title='自助开通分站';
include './head2.php';

$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
include_once(SYSTEM_ROOT."hieroglyphy.class.php");
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

$kind = isset($_GET['kind'])?$_GET['kind']:0;

if($is_fenzhan == true && $siterow['power']==2 && !empty($siterow['ktfz_domain'])){
	$domains=explode(',',$siterow['ktfz_domain']);
}else{
	$domains=explode(',',$conf['fenzhan_domain']);
}
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
if(empty($select))showmsg('请先到后台分站设置，填写可选分站域名',3);
?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br />
    <div class="widget">
    <div class="widget-content themed-background-flat text-center"  style="background-image: url(<?php echo $cdnserver?>assets/simple/img/userbg.jpg);background-size: 100% 100%;" >
<img  class="img-circle"src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'];?>&spec=100" alt="Avatar" alt="avatar" height="60" width="60" />
<p></p>
    </div>

    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>自助开通分站</b></h2>
        </div>
				<div class="row text-center">
                    <div class="col-xs-6">
                    <a class="btn btn-block btn-info" href="#about" data-toggle="modal">分站详细介绍</a>
                    </div>
                    <div class="col-xs-6">
                    <a class="btn btn-block btn-info" href="#userjs" data-toggle="modal">分站版本介绍</a>
                    </div>
                </div>
				<br>
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                分站版本
                            </div>
                            <select name="kind" class="form-control"><option value="1" <?php if($kind==0){?>selected<?php }?>>普及版(<?php echo $conf['fenzhan_price']?>元)</option><option value="2" <?php if($kind==1){?>selected<?php }?>>专业版(<?php echo $conf['fenzhan_price2']?>元)</option></select>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                二级域名
                            </div>
                            <input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz"
                                   class="form-control" required data-parsley-length="[2,8]"
                                   placeholder="输入你想要的二级前缀">
                            <select name="domain" class="form-control"><?php echo $select?></select>
                        </div>
                    </div>
					<?php if(!$islogin2){?>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理账号
                            </div>
                            <input type="text" name="user" class="form-control" required placeholder="输入要注册的用户名">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理密码
                            </div>
                            <input type="text" name="pwd" class="form-control" required placeholder="输入管理员密码">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                绑定ＱＱ
                            </div>
                            <input type="number" name="qq" class="form-control" required
                                   data-parsley-length="[5,10]"
                                   placeholder="输入你的QQ号" value="">
                        </div>
                    </div>
					<?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                网站名称
                            </div>
                            <input type="text" name="name" class="form-control" required
                                   data-parsley-length="[2,10]"
                                   placeholder="输入网站名称">
                        </div>
                    </div>
                    <input type="button" id="submit_buy" value="点此立即拥有分站" class="btn btn-danger btn-block">
					<hr>
					<div class="form-group">
						<a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
						<a href="login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa-user"></i>&nbsp;返回登录</a>
					</div>
                </form>
        </div>
	</div>

<!--分站介绍开始-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">版本介绍</h4>
		</div>
		<div class="block">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>专属销售平台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                        <tr class="">
                            <td>三种在线支付接口</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>赚取用户提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>赚取下级分站提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="warning">
                            <td>设置下级分站商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>搭建下级分站</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送专属精致APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--分站介绍结束-->

<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">详细介绍</h4>
		</div>
		<div class="modal-body">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">分站是怎么获取收益的？</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							其实很简单，你只需要把你的分站域名发给你的用户让他购买，一旦购买付款成功，你的账户就会增加你所赚差价的金额，自己是可以设置销售价格的哦！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">赚到的钱在哪里？我如何得到？</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							分站后台有完整的消费明细和余额信息，后台余额可供您在平台消费，满<?php echo $conf['tixian_min']; ?>元可以在后台提现到QQ钱包微信或者支付宝中。
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">需要我自己供货吗？哪来的商品货源？</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，如果网站没有您想要的商品可联系主站客服添加即可！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed" aria-expanded="false">这个和卡盟一样吗？有什么区别？</a>
						</h4>
					</div>
					<div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							完全不同，销售提成最高享受商品售价的30%，货源更精，无需注册,无需预存，在线支付，更简单快捷！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">可以自己上架商品吗？可以修改售价吗？</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有分站暂时都不支持自己上架商品，但可以修改销售价格，我们会在这方面后期做出相对于的更新服务！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">为什么要选择你们呢？</a>
						</h4>
					</div>
					<div id="collapseSix" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							我们是全网最专业的最好的签到萌宠机器人供应商！我们的机器人和那些杂七杂八的盗版机器人不同！机器人消息简洁无多余，智能聊天智能处理信息！功能也丰富多彩！您可以自己选择开启那些功能！我们有专业的维护人员，有BUG请及时上报！
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="../assets/js/regsite.js"></script>
</body>
</html>