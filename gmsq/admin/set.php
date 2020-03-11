<?php 
include('../includes/common.php');
$title='后台管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
if ($mod=='account_n' && $_POST['do']=='submit') 
{
	$user=$_POST['user'];
	$oldpwd=$_POST['oldpwd'];
	$newpwd=$_POST['newpwd'];
	$newpwd2=$_POST['newpwd2'];
	if ($user==NULL) 
	{
		showmsg('用户名不能为空！',3);
	}
	saveSetting('admin_user',$user);
	if (!empty($newpwd) && !empty($newpwd2)) 
	{
		if ($oldpwd!=$conf['admin_pwd']) 
		{
			showmsg('旧密码不正确！',3);
		}
		if ($newpwd!=$newpwd2) 
		{
			showmsg('两次输入的密码不一致！',3);
		}
		saveSetting('admin_pwd',$newpwd);
	}
	$ad=$CACHE->clear();
}
else 
{
	if ($mod=='account') 
	{
		echo '<div class="block">
<div class="block-title"><h3 class="panel-title">管理员账号配置</h3></div>
<div class="">
 <form action="./set.php?mod=account_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">用户名</label>
	 <div class="col-sm-10"><input type="text" name="user" value="';
		echo $conf['admin_user'];
		echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">旧密码</label>
	 <div class="col-sm-10"><input type="password" name="oldpwd" value="" class="form-control" placeholder="请输入当前的管理员密码"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">新密码</label>
	 <div class="col-sm-10"><input type="password" name="newpwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">重输密码</label>
	 <div class="col-sm-10"><input type="password" name="newpwd2" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>

 </form>
</div>
</div>
';
	}
	else 
	{
		if ($mod=='site_n' && $_POST['do']=='submit') 
		{
			$sitename=$_POST['sitename'];
			$title=$_POST['title'];
			$keywords=$_POST['keywords'];
			$description=$_POST['description'];
			$kfqq=$_POST['kfqq'];
			$verify_open=$_POST['verify_open'];
			$faka_input=$_POST['faka_input'];
			$captcha_open=$_POST['captcha_open'];
			$captcha_id=$_POST['captcha_id'];
			$captcha_key=$_POST['captcha_key'];
			$iskami=$_POST['iskami'];
			$kaurl=$_POST['kaurl'];
			$blacklist=$_POST['blacklist'];
			$hide_tongji=$_POST['hide_tongji'];
			$tongji_time=$_POST['tongji_time'];
			$ui_shop=$_POST['ui_shop'];
			$lqqapi=$_POST['lqqapi'];
			$build=$_POST['build'];
			$qqjump=$_POST['qqjump'];
			$apikey=$_POST['apikey'];
			$cronkey=$_POST['cronkey'];
			$ui_bing=$_POST['ui_bing'];
			if ($sitename==NULL) 
			{
				showmsg('必填项不能为空！',3);
			}
			saveSetting('sitename',$sitename);
			saveSetting('title',$title);
			saveSetting('keywords',$keywords);
			saveSetting('description',$description);
			saveSetting('kfqq',$kfqq);
			saveSetting('verify_open',$verify_open);
			saveSetting('faka_input',$faka_input);
			saveSetting('captcha_open',$captcha_open);
			saveSetting('captcha_id',$captcha_id);
			saveSetting('captcha_key',$captcha_key);
			saveSetting('iskami',$iskami);
			saveSetting('kaurl',$kaurl);
			saveSetting('blacklist',$blacklist);
			saveSetting('hide_tongji',$hide_tongji);
			saveSetting('tongji_time',$tongji_time);
			saveSetting('ui_shop',$ui_shop);
			saveSetting('lqqapi',$lqqapi);
			saveSetting('build',$build);
			saveSetting('qqjump',$qqjump);
			saveSetting('apikey',$apikey);
			saveSetting('cronkey',$cronkey);
			saveSetting('ui_bing',$ui_bing);
			$ad=$CACHE->clear();
			if ($ad) 
			{
				showmsg('修改成功！',1);
			}
			else 
			{
				showmsg('修改失败！<br/>'.$DB->error(),4);
			}
		}
		else 
		{
			if ($mod=='site') 
			{
				echo '<div class="block">
<div class="block-title"><h3 class="panel-title">网站信息配置</h3></div>
<div class="">
 <form action="./set.php?mod=site_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站名称</label>
	 <div class="col-sm-10"><input type="text" name="sitename" value="';
				echo $conf['sitename'];
				echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">标题栏后缀</label>
	 <div class="col-sm-10"><input type="text" name="title" value="';
				echo $conf['title'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">关键字</label>
	 <div class="col-sm-10"><input type="text" name="keywords" value="';
				echo $conf['keywords'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站描述</label>
	 <div class="col-sm-10"><input type="text" name="description" value="';
				echo $conf['description'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">客服ＱＱ</label>
	 <div class="col-sm-10"><input type="text" name="kfqq" value="';
				echo $conf['kfqq'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">下单验证模块</label>
	 <div class="col-sm-10"><select class="form-control" name="verify_open" default="';
				echo $conf['verify_open'];
				echo '"><option value="1">开启</option><option value="0">关闭</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">发卡下单标题</label>
	 <div class="col-sm-10"><select class="form-control" name="faka_input" default="';
				echo $conf['faka_input'];
				echo '"><option value="0">你的邮箱</option><option value="1">手机号码</option><option value="2">你的ＱＱ</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">是否开启<br />卡密下单</label>
	 <div class="col-sm-10"><select class="form-control" name="iskami" default="';
				echo $conf['iskami'];
				echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">卡密购买地址</label>
	 <div class="col-sm-10"><input type="text" name="kaurl" value="';
				echo $conf['kaurl'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站显示订单金额统计信息</label>
	 <div class="col-sm-10"><select class="form-control" name="hide_tongji" default="';
				echo $conf['hide_tongji'];
				echo '"><option value="0">开启</option><option value="1">关闭</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">首页统计数据缓存时间(秒)</label>
	 <div class="col-sm-10"><input type="text" name="tongji_time" value="';
				echo $conf['tongji_time'];
				echo '" class="form-control" placeholder="留空或0则不缓存，设置缓存可提升网页打开速度"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">下单黑名单</label>
	 <div class="col-sm-10"><input type="text" name="blacklist" value="';
				echo $conf['blacklist'];
				echo '" class="form-control" placeholder="多个账号之间用|隔开"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站首页背景图</label>
	 <div class="col-sm-10"><select class="form-control" name="ui_bing" default="';
				echo $conf['ui_bing'];
				echo '"><option value="0">自定义背景图片</option><option value="1">随机壁纸</option><option value="2">Bing每日壁纸</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">首页下单显示模式</label>
	 <div class="col-sm-10"><select class="form-control" name="ui_shop" default="';
				echo $conf['ui_shop'];
				echo '"><option value="0">经典模式</option><option value="1">分类图片宫格</option><option value="2">分类图片列表</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">机器人官网创建时间</label>
	 <div class="col-sm-10"><input type="date" name="build" value="';
				echo $conf['build'];
				echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">拉圈圈赞API</label>
	 <div class="col-sm-10"><input type="text" name="lqqapi" value="';
				echo $conf['lqqapi'];
				echo '" class="form-control" placeholder="填写后将在首页显示免费拉圈圈，没有请留空"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">手机QQ打开网站跳转其他浏览器</label>
	 <div class="col-sm-10"><select class="form-control" name="qqjump" default="';
				echo $conf['qqjump'];
				echo '"><option value="0">关闭</option><option value="1">开启</option></select>
	 <pre>此功能没有任何防红效果，理论上直接在QQ发域名推广都会拦截，建议生成防红链接进行推广</pre></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">API对接密钥</label>
	 <div class="col-sm-10"><input type="text" name="apikey" value="';
				echo $conf['apikey'];
				echo '" class="form-control" placeholder="用于下单软件，随便填写即可"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">监控密钥</label>
	 <div class="col-sm-10"><input type="text" name="cronkey" value="';
				echo $conf['cronkey'];
				echo '" class="form-control" placeholder="用于易支付补单监控使用"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">免费商品开启滑动验证码</label>
	 <div class="col-sm-10"><select class="form-control" name="captcha_open" default="';
				echo $conf['captcha_open'];
				echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div id="captcha_frame" style="';
				echo ($conf['captcha_open']==0 ? 'display:none;' : NULL);
				echo '">
	<div class="form-group">
	 <label class="col-sm-2 control-label">极限验证码ID</label>
	 <div class="col-sm-10"><input type="text" name="captcha_id" value="';
				echo $conf['captcha_id'];
				echo '" class="form-control"/></div>
	</div>
	<div class="form-group">
	 <label class="col-sm-2 control-label">极限验证码KEY</label>
	 <div class="col-sm-10"><input type="text" name="captcha_key" value="';
				echo $conf['captcha_key'];
				echo '" class="form-control"/>
	 <pre><a href="http://www.geetest.com/apply.html" rel="noreferrer" target="_blank">注册极限验证码</a></pre></div>
	</div>
	</div>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
	高级功能：<a href="./set.php?mod=cleanbom">清理BOM头部</a>｜<a href="./set.php?mod=defend">防CC模块设置</a>｜<a href="./set.php?mod=proxy">代理服务器设置</a>

 </form>
</div>
</div>
<script>
$("select[name=\'captcha_open\']").change(function(){
	if($(this).val() == 1){
		$("#captcha_frame").css("display","inherit");
	}else{
		$("#captcha_frame").css("display","none");
	}
});
</script>
';
			}
			else 
			{
				if ($mod=='fenzhan_n' && $_POST['do']=='submit') 
				{
					$fenzhan_tixian=$_POST['fenzhan_tixian'];
					$fenzhan_skimg=$_POST['fenzhan_skimg'];
					$tixian_rate=$_POST['tixian_rate'];
					$tixian_min=$_POST['tixian_min'];
					$fenzhan_kami=$_POST['fenzhan_kami'];
					$user_open=$_POST['user_open'];
					$user_level=$_POST['user_level'];
					$fenzhan_buy=$_POST['fenzhan_buy'];
					$fenzhan_expiry=$_POST['fenzhan_expiry'];
					$fenzhan_price2=$_POST['fenzhan_price2'];
					$fenzhan_price=$_POST['fenzhan_price'];
					$fenzhan_editd=$_POST['fenzhan_editd'];
					$fenzhan_free=$_POST['fenzhan_free'];
					$fenzhan_domain=str_replace('，',',',$_POST['fenzhan_domain']);
					$fenzhan_cost2=$_POST['fenzhan_cost2'];
					$fenzhan_cost=$_POST['fenzhan_cost'];
					$fenzhan_html=$_POST['fenzhan_html'];
					$fenzhan_upgrade=$_POST['fenzhan_upgrade'];
					$fenzhan_remain=str_replace('，',',',$_POST['fenzhan_remain']);
					$fenzhan_page=$_POST['fenzhan_page'];
					$fenzhan_template=$_POST['fenzhan_template'];
					saveSetting('fenzhan_tixian',$fenzhan_tixian);
					saveSetting('fenzhan_skimg',$fenzhan_skimg);
					saveSetting('tixian_rate',$tixian_rate);
					saveSetting('tixian_min',$tixian_min);
					saveSetting('user_open',$user_open);
					saveSetting('user_level',$user_level);
					saveSetting('fenzhan_kami',$fenzhan_kami);
					saveSetting('fenzhan_buy',$fenzhan_buy);
					saveSetting('fenzhan_expiry',$fenzhan_expiry);
					saveSetting('fenzhan_price2',$fenzhan_price2);
					saveSetting('fenzhan_price',$fenzhan_price);
					saveSetting('fenzhan_editd',$fenzhan_editd);
					saveSetting('fenzhan_free',$fenzhan_free);
					saveSetting('fenzhan_domain',$fenzhan_domain);
					saveSetting('fenzhan_cost2',$fenzhan_cost2);
					saveSetting('fenzhan_cost',$fenzhan_cost);
					saveSetting('fenzhan_html',$fenzhan_html);
					saveSetting('fenzhan_upgrade',$fenzhan_upgrade);
					saveSetting('fenzhan_remain',$fenzhan_remain);
					saveSetting('fenzhan_page',$fenzhan_page);
					saveSetting('fenzhan_template',$fenzhan_template);
					$ad=$CACHE->clear();
					if ($ad) 
					{
						showmsg('修改成功！',1);
					}
					else 
					{
						showmsg('修改失败！<br/>'.$DB->error(),4);
					}
				}
				else 
				{
					if ($mod=='fenzhan') 
					{
						echo '<div class="block">
<div class="block-title"><h3 class="panel-title">分站相关配置</h3></div>
<div class="">
 <form action="./set.php?mod=fenzhan_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
   <div class="form-group">
	 <label class="col-sm-2 control-label">开启提现</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_tixian" default="';
						echo $conf['fenzhan_tixian'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">是否启用收款图</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_skimg" default="';
						echo $conf['fenzhan_skimg'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">提现余额比例</label>
	 <div class="col-sm-10"><input type="text" name="tixian_rate" value="';
						echo $conf['tixian_rate'];
						echo '" class="form-control" placeholder="填写百分数"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">提现最低余额</label>
	 <div class="col-sm-10"><input type="text" name="tixian_min" value="';
						echo $conf['tixian_min'];
						echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">生成卡密功能</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_kami" default="';
						echo $conf['fenzhan_kami'];
						echo '"><option value="1">开启</option><option value="0">关闭</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">用户注册功能</label>
	 <div class="col-sm-10"><select class="form-control" name="user_open" default="';
						echo $conf['user_open'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">新注册用户价格等级</label>
	 <div class="col-sm-10"><select class="form-control" name="user_level" default="';
						echo $conf['user_level'];
						echo '"><option value="0">商品售价</option><option value="1">普及版价格</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">自助开通分站</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_buy" default="';
						echo $conf['fenzhan_buy'];
						echo '"><option value="1">开启</option><option value="0">关闭</option></select></div>
	</div><br/>
	<div id="frame_set1" style="';
						echo ($conf['fenzhan_buy']==0 ? 'display:none;' : NULL);
						echo '">
	<div class="form-group">
	 <label class="col-sm-2 control-label">分站默认有效期</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_expiry" value="';
						echo $conf['fenzhan_expiry'];
						echo '" class="form-control"/><pre>填写月数，如果为0则是永久不过期</pre></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">专业版价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_price2" value="';
						echo $conf['fenzhan_price2'];
						echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">普及版价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_price" value="';
						echo $conf['fenzhan_price'];
						echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">专业版成本价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_cost2" value="';
						echo $conf['fenzhan_cost2'];
						echo '" class="form-control"/><pre>注意：分站成本价格请勿低于初始赠送余额</pre></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">普及版成本价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_cost" value="';
						echo $conf['fenzhan_cost'];
						echo '" class="form-control"/><pre>注意：分站成本价格请勿低于初始赠送余额</pre></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">初始赠送余额</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_free" value="';
						echo $conf['fenzhan_free'];
						echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">普及版升级价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_upgrade" value="';
						echo $conf['fenzhan_upgrade'];
						echo '" class="form-control" placeholder="不填写则不开启自助升级专业版功能"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">自助修改域名价格</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_editd" value="';
						echo $conf['fenzhan_editd'];
						echo '" class="form-control" placeholder="不填写则不开启自助修改域名"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">分站自动复制主站公告代码</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_html" default="';
						echo $conf['fenzhan_html'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">分站可选择域名</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_domain" value="';
						echo $conf['fenzhan_domain'];
						echo '" class="form-control"/><pre>多个域名用,隔开！</pre></div>
	</div><br/>
	</div>
	<div class="form-group">
	 <label class="col-sm-2 control-label">主站预留域名</label>
	 <div class="col-sm-10"><input type="text" name="fenzhan_remain" value="';
						echo $conf['fenzhan_remain'];
						echo '" class="form-control"/><pre>主站域名无法被分站绑定，多个域名用,隔开！</pre></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">未绑定域名显示404页面</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_page" default="';
						echo $conf['fenzhan_page'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">分站可更换首页模板</label>
	 <div class="col-sm-10"><select class="form-control" name="fenzhan_template" default="';
						echo $conf['fenzhan_template'];
						echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
	高级功能：<a href="./sitelist.php?my=replace">分站域名批量修改</a>
 </form>
</div>
</div>
<script>
$("select[name=\'fenzhan_buy\']").change(function(){
	if($(this).val() == 1){
		$("#frame_set1").css("display","inherit");
	}else{
		$("#frame_set1").css("display","none");
	}
});
$("select[name=\'fenzhan_page\']").change(function(){
	if($(this).val() == 1){
		alert(\'开启后必须保证主站预留域名已正确填写，否则主站将无法访问。注意！！www.lovek.me与lovek.me是两个域名！！\');
	}
});
</script>
';
					}
					else 
					{
						if ($mod=='template_n' && $_POST['do']=='submit') 
						{
							$template=$_POST['template'];
							$cdnserver=$_POST['cdnserver'];
							if (Template::exists($template)==false) 
							{
								showmsg('该模板首页文件不存在！',3);
							}
							saveSetting('template',$template);
							saveSetting('cdnserver',$cdnserver);
							$ad=$CACHE->clear();
							if ($ad) 
							{
								showmsg('修改成功！',1);
							}
							else 
							{
								showmsg('修改失败！<br/>'.$DB->error(),4);
							}
						}
						else 
						{
							if ($mod=='template') 
							{
								$mblist=Template::getList();
								echo '<div class="block">
<div class="block-title"><h3 class="panel-title">首页模板设置</h3></div>
<div class="">
 <form action="./set.php?mod=template_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
   <div class="form-group">
	 <label class="col-sm-2 control-label">选择模板</label>
	 <div class="col-sm-10"><select class="form-control" name="template" default="';
								echo $conf['template'];
								echo '">
	 ';
								foreach($mblist as $row)
								{
									echo '<option value="'.$row.'">'.$row.'</option>';
								}
								echo '	 </select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">静态资源CDN</label>
	 <div class="col-sm-10"><select class="form-control" name="cdnserver" default="';
								echo $conf['cdnserver'];
								echo '">
	 <option value="0">关闭</option>
	 <option value="1">彩虹CDN一号</option>
	 </select></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
网站模板对应template目录里面的名称，会自动获取
</div>
</div>
';
							}
							else 
							{
								if ($mod=='defend_n' && $_POST['do']=='submit') 
								{
									$defendid=$_POST['defendid'];
									$file="<?php\\r\\n//防CC模块设置\\r\\ndefine('CC_Defender', ".$defendid.");\\r\\n?>";
									file_put_contents(SYSTEM_ROOT.'base.php',$file);
									showmsg('修改成功！',1);
								}
								else 
								{
									if ($mod=='defend') 
									{
										echo '<div class="block">
<div class="block-title"><h3 class="panel-title">防CC模块设置</h3></div>
<div class="">
 <form action="./set.php?mod=defend_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
   <div class="form-group">
	 <label class="col-sm-2 control-label">CC防护等级</label>
	 <div class="col-sm-10"><select class="form-control" name="defendid" default="';
										echo CC_Defender;
										echo '">
	 <option value="0">关闭</option>
	 <option value="1">低(推荐)</option>
	 <option value="2">中</option>
	 <option value="3">高</option>
	 </select></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>CC防护说明<br/>
高：全局使用防CC，会影响网站APP和对接软件的正常使用<br/>
中：会影响搜索引擎的收录，建议仅在正在受到CC攻击且防御不佳时开启<br/>
低：用户首次访问进行验证（推荐）<br/>
</div>
</div>
';
									}
									else 
									{
										if ($mod=='qiandao_n' && $_POST['do']=='submit') 
										{
											$qiandao_reward=$_POST['qiandao_reward'];
											$qiandao_mult=$_POST['qiandao_mult'];
											$qiandao_day=$_POST['qiandao_day'];
											saveSetting('qiandao_reward',$qiandao_reward);
											saveSetting('qiandao_mult',$qiandao_mult);
											saveSetting('qiandao_day',$qiandao_day);
											$ad=$CACHE->clear();
											if ($ad) 
											{
												showmsg('修改成功！',1);
											}
											else 
											{
												showmsg('修改失败！<br/>'.$DB->error(),4);
											}
										}
										else 
										{
											if ($mod=='qiandao') 
											{
												echo '<div class="block">
<div class="block-title"><h3 class="panel-title">签到模块设置</h3></div>
<div class="">
 <form action="./set.php?mod=qiandao_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
   <div class="form-group">
	 <label class="col-sm-2 control-label">奖励余额初始值</label>
	 <div class="col-sm-10"><input type="text" name="qiandao_reward" value="';
												echo $conf['qiandao_reward'];
												echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">每日递增倍数</label>
	 <div class="col-sm-10"><input type="text" name="qiandao_mult" value="';
												echo $conf['qiandao_mult'];
												echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">最多递增天数</label>
	 <div class="col-sm-10"><input type="text" name="qiandao_day" value="';
												echo $conf['qiandao_day'];
												echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>奖励余额初始值填写一个值代表所有类型分站都一样，填写3个值并用|隔开代表不同类型分站不一样，例如0.01|0.02|0.03 分别是普通用户、普及版分站、专业版分站的奖励余额初始值。
</div>
</div>
<div class="block">
<div class="block-title"><h3 class="panel-title" id="title">签到统计</h3></div>
<div class="">
<table class="table table-bordered">
	<tbody>
		<tr>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-user-circle-o"></i> 今日签到<br><span id="count1"></span>人
			</th>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-user-circle"></i> 昨日签到<br><span id="count2"></span>人
			</th>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-pie-chart"></i> 累计签到<br><span id="count3"></span>人
			</th>
		</tr>
		<tr>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-money"></i> 今日送出余额<br><span id="count4"></span>元
			</th>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-money"></i> 昨日送出余额<br><span id="count5"></span>人
			</th>
			<th style="font-size: 13px;" class="text-center">
				<i class="fa fa-bar-chart"></i> 累计送出余额<br><span id="count6"></span>人
			</th>
		</tr>
	</tbody>
</table>
</div>
</div>
<script>
$(document).ready(function(){
	$(\'#title\').html(\'正在加载数据中...\');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=qdcount",
		dataType : \'json\',
		async: true,
		success : function(data) {
			$(\'#count1\').html(data.count1);
			$(\'#count2\').html(data.count2);
			$(\'#count3\').html(data.count3);
			$(\'#count4\').html(data.count4);
			$(\'#count5\').html(data.count5);
			$(\'#count6\').html(data.count6);
			$(\'#title\').html(\'签到统计\');
		}
	});
})
</script>
';
											}
											else 
											{
												if ($mod=='proxy_n' && $_POST['do']=='submit') 
												{
													$proxy=$_POST['proxy'];
													$server_hash=md5($_SERVER['SERVER_SOFTWARE'].$_SERVER['SERVER_ADDR']);
													saveSetting('proxy',$proxy);
													saveSetting('server_hash',$server_hash);
													$ad=$CACHE->clear();
													if ($ad) 
													{
														showmsg('修改成功！',1);
													}
													else 
													{
														showmsg('修改失败！<br/>'.$DB->error(),4);
													}
												}
												else 
												{
													if ($mod=='proxy') 
													{
														$server_hash=md5($_SERVER['SERVER_SOFTWARE'].$_SERVER['SERVER_ADDR']);
														if ($server_hash===$conf['server_hash'] && $conf['proxy']==1) 
														{
															$is_proxy=1;
														}
														else 
														{
															$is_proxy=0;
														}
														echo '<div class="block">
<div class="block-title"><h3 class="panel-title">代理服务器设置</h3></div>
<div class="">
 <form action="./set.php?mod=proxy_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
 ';
														if (check_china()==true) 
														{
															echo '  <div class="alert alert-info">你当前的服务器位于国内，无需使用代理服务器。</div>
 ';
														}
														else 
														{
															echo '    <div class="form-group">
	 <label class="col-sm-2 control-label">代理服务器开关</label>
	 <div class="col-sm-10"><select class="form-control" name="proxy" default="';
															echo $is_proxy;
															echo '">
	 <option value="0">关闭</option>
	 <option value="1">开启</option>
	 </select></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 ';
														}
														echo '  </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>本功能适用于国外服务器对接一些屏蔽国外访问的社区或者卡盟，开启后使用国内代理服务器进行对接。<br/>
注意：如果网站更换主机之后需要重新修改当前配置。
</div>
</div>
';
													}
													else 
													{
														if ($mod=='shequ_n' && $_POST['do']=='submit') 
														{
															$shequ_status=$_POST['shequ_status'];
															$kameng_status=$_POST['kameng_status'];
															$shequ_tixing=$_POST['shequ_tixing'];
															saveSetting('shequ_status',$shequ_status);
															saveSetting('kameng_status',$kameng_status);
															saveSetting('shequ_tixing',$shequ_tixing);
															$ad=$CACHE->clear();
															if ($ad) 
															{
																showmsg('修改成功！',1);
															}
															else 
															{
																showmsg('修改失败！<br/>'.$DB->error(),4);
															}
														}
														else 
														{
															if ($mod=='shequ') 
															{
																echo '<div class="block">
<div class="block-title"><h3 class="panel-title">网站对接配置</h3></div>
<div class="">
 <form action="./set.php?mod=shequ_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">社区下单成功后订单状态</label>
	 <div class="col-sm-10"><select class="form-control" name="shequ_status" default="';
																echo $conf['shequ_status'];
																echo '"><option value="1">已完成（默认）</option><option value="2">正在处理</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">卡盟下单成功后订单状态</label>
	 <div class="col-sm-10"><select class="form-control" name="kameng_status" default="';
																echo $conf['kameng_status'];
																echo '"><option value="1">已完成（默认）</option><option value="2">正在处理</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">下单失败发送提醒邮件</label>
	 <div class="col-sm-10"><select class="form-control" name="shequ_tixing" default="';
																echo $conf['shequ_tixing'];
																echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
使用此功能，用户下单后会自动提交到社区。<br/>
如果对方网站开启了金盾等防火墙可能导致无法成功提交！
</div>
</div>
';
															}
															else 
															{
																if ($mod=='cloneset') 
																{
																	$key=md5($password_hash.md5(SYS_KEY).$conf['apikey']);
																	echo '<div class="block">
<div class="block-title"><h3 class="panel-title">克隆销售站配置</h3></div>
<div class="">
 <form action="./set.php?mod=shequ_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">克隆密钥</label>
	 <div class="col-sm-10"><input type="text" name="key" value="';
																	echo $key;
																	echo '" class="form-control" disabled/></div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
此密钥是用于其他销售站克隆本站商品<br/>
提示：修改API对接密钥可同时重置克隆密钥。<br/>
</div>
</div>
';
																}
																else 
																{
																	if ($mod=='invite_n' && $_POST['do']=='submit') 
																	{
																		$invite_tid=$_POST['invite_tid'];
																		$invite_money=$_POST['invite_money'];
																		saveSetting('invite_tid',$invite_tid);
																		saveSetting('invite_money',$invite_money);
																		$ad=$CACHE->clear();
																		if ($ad) 
																		{
																			showmsg('修改成功！',1);
																		}
																		else 
																		{
																			showmsg('修改失败！<br/>'.$DB->error(),4);
																		}
																	}
																	else 
																	{
																		if ($mod=='invite') 
																		{
																			echo '<div class="block">
<div class="block-title"><h3 class="panel-title">推广链接设置</h3></div>
<div class="">
 <form action="./set.php?mod=invite_n" method="post" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label>赠送商品ID</label>
	 <input type="text" name="invite_tid" value="';
																			echo $conf['invite_tid'];
																			echo '" class="form-control" placeholder="不填写则关闭推广链接功能"/>
	 <pre>在商品列表，点击商品进入，在地址栏中tid=后面的数字即为商品ID</pre>
	</div>
	<div class="form-group">
	 <label>赠送商品名称</label>
	 <input type="text" name="invite_name" value="" class="form-control" disabled/>
	</div>
	<div class="form-group">
	 <label>被推荐人下单金额超过多少才赠送商品</label>
	 <input type="text" name="invite_money" value="';
																			echo $conf['invite_money'];
																			echo '" class="form-control" placeholder="不填写则不限最小金额"/>
	</div>
	<div class="form-group">
	 <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
推广链接生成地址：/gmsq/?mod=invite<br/>
别人用生成后的链接访问，并成功下单之后，推荐人可以获得相应的赠送商品。<br/>
推广页面模板文件：/gmsq/template/default/invite.php
</div>
</div>
<script>
$("input[name=\'invite_tid\']").blur(function () {
	var tid=$("input[name=\'invite_tid\']").val();
	if(tid == \'\')return;
	$.ajax({
		type : "POST",
		url : "ajax.php?act=tool",
		data : {tid:tid},
		dataType : \'json\',
		success : function(data) {
			if(data.code == 0){
				$("input[name=\'invite_name\']").val(data.name);
			}else{
				alert(data.msg);
			}
		} 
	});
});
$("input[name=\'invite_tid\']").blur();
</script>
';
																		}
																		else 
																		{
																			if ($mod=='dwz_n' && $_POST['do']=='submit') 
																			{
																				$fanghong_url=trim($_POST['fanghong_url']);
																				saveSetting('fanghong_url',$fanghong_url);
																				$ad=$CACHE->clear();
																				if ($ad) 
																				{
																					showmsg('修改成功！',1);
																				}
																				else 
																				{
																					showmsg('修改失败！<br/>'.$DB->error(),4);
																				}
																			}
																			else 
																			{
																				if ($mod=='dwz') 
																				{
																					echo '<div class="block">
<div class="block-title"><h3 class="panel-title">防红链接生成接口设置</h3></div>
<div class="">
 <form action="./set.php?mod=dwz_n" method="post" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	<label>防红API接口地址：</label>
		<div class="input-group">
		<input type="text" name="fanghong_url" value="';
																					echo $conf['fanghong_url'];
																					echo '" class="form-control" placeholder="不填写则关闭防红链接生成"/>
		<div class="input-group-addon" onclick="checkurl()"><small>检测地址</small></div>
	</div></div>
	<div class="form-group">
	 <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
一般防红接口地址为 http://防红网站域名/dwz.php?longurl= 具体可以咨询相应站长<br/>
<b>没有或不知道的请不要填写！否则会导致推广页面链接无法生成！</b><br /><br />
<span class="glyphicon glyphicon-info-sign"></span><b>Lovely God：</b>我为您找到了几个直连防红的API接口,选择一个直接填入上方即可：
<ul>
<li>https://www.99zuan.cn/dwz.php?longurl=（推荐）</li>
<li>http://fh.666bc.cn/sup.php?longurl=</li>
<li>http://fh.360v.club/dwz.php?longurl=</li>
<li>禁止1分钟内多次生成！恶意刷生成链接容易被拉黑域名，你们应该都懂！</li>
<li>如果您的站点访问量较大，请使用付费防红，免费版满足不了您的需要，免费版每日访问量过大会可能会限制访问！</li>
</ul>
<span class="glyphicon glyphicon-info-sign"></span>
<b>以下的网站我找不到API接口，你们可以自己去生成防红直连：</b><br />
<ul>
<li><a href="https://www.91she.cn/" target=_blank>https://www.91she.cn/</a>（推荐）</li>
<li><a href="http://www.fanghong.net/" target=_blank>http://www.fanghong.net/</a>（绿标，但有广告，不推荐）</li>
</ul>
</div>
</div>
';
																					if ($conf['fanghong_url']) 
																					{
																						echo '<div class="block">
	<div class="block-title"><h3 class="panel-title">获取防红链接</h3></div>
	<div class="">
		<div class="input-group">
			<span class="input-group-addon">签到萌宠机器人官网网址</span>
			<input class="form-control" id="longurl" value="http://';
																						echo $_SERVER['HTTP_HOST'];
																						echo '/">
		</div>
		<div class="well well-sm">如果您的网址在QQ内报毒或者打不开，您可以使用此功能生成防毒链接！</div>
		<a class="btn btn-block btn-success" id="create_url">生成我的防毒链接</a><br />
<span class="glyphicon glyphicon-info-sign"></span>
<b>都为你们找好了，以下是短网址生成网站，纯网址缩短不带任何防红效果，不懂勿用：</b>
<ul>
<li><a href="http://u6.gg/" target=_blank>http://u6.gg/</a></li>
<li><a href="http://suo.nz/" target=_blank>http://suo.nz/</a>（需登录）</li>
<li>百度短网址：<a href="https://dwz.cn/" target=_blank>https://dwz.cn/</a>（需登录）（推荐）</li>
</ul>
<br /><br />
	</div>
</div>
';
																					}
																					echo '<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script src="//cdn.staticfile.org/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
function checkurl(){
	var url = $("input[name=\'fanghong_url\']").val();
	if(url.indexOf(\'http\')>=0 && url.indexOf(\'=\')>=0){
		var ii = layer.load(2, {shade:[0.1,\'#fff\']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=checkdwz",
			data : {url:url},
			dataType : \'json\',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.msg(\'检测正常\');
				}else if(data.code == 2){
					layer.alert(\'链接无法访问或返回内容不是json格式\');
				}else{
					layer.alert(\'该链接无法访问\');
				}
			} ,
			error:function(data){
				layer.close(ii);
				layer.msg(\'目标URL连接超时\');
				return false;
			}
		});
	}else{
		layer.alert(\'链接地址错误\');
	}
}
$(document).ready(function(){
var url = $("input[id=\'longurl\']").val();
var clipboard = new Clipboard(\'#copyurl\');
clipboard.on(\'success\', function (e) {
	layer.msg(\'复制成功！\');
});
clipboard.on(\'error\', function (e) {
	layer.msg(\'复制失败，请长按链接后手动复制\');
});
$("#create_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, \'#fff\']});
	$.get("ajax.php?act=create_url&longurl="+url, function(data) {
		layer.close(ii);
		if(data.code == 0){
			$("#target_url").val(data.url);
			$("#copyurl").attr(\'data-clipboard-text\',data.url);
			$(\'#fanghongurl\').modal(\'show\');
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, \'json\');
});
$("#recreate_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, \'#fff\']});
	$.get("ajax.php?act=create_url&force=1&longurl="+url, function(data) {
		layer.close(ii);
		if(data.code == 0){
			layer.msg(\'生成链接成功\');
			$("#target_url").val(data.url);
			$("#copyurl").attr(\'data-clipboard-text\',data.url);
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, \'json\');
});
});
</script>
<div class="modal fade in" id="fanghongurl" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button><h4 class="modal-title">防红链接生成</h4></div>
			<div class="modal-body">
				<div class="form-group"><div class="input-group"><div class="input-group-addon">防红链接</div><input type="text" id="target_url" value="" class="form-control" disabled=""></div><br>
				<center><button class="btn btn-info btn-sm" id="recreate_url">重新生成</button>&nbsp;<button class="btn btn-warning btn-sm" id="copyurl" data-clipboard-text="">一键复制链接</button>&nbsp;<a href="https://lovek.me"  target=_blank><button class="btn btn-info btn-sm">Lovely God博客</button></a></center>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-white" data-dismiss="modal">关闭</button></div>
		</div>
	</div>
</div>
';
																				}
																				else 
																				{
																					if ($mod=='mailtest') 
																					{
																						$mail_name=($conf['mail_recv'] ? $conf['mail_recv'] : $conf['mail_name']);
																						if (!empty($mail_name)) 
																						{
																							$result=send_mail($mail_name,'邮件发送测试。','这是一封测试邮件！-LovelyGod<br/><br/>来自：'.$siteurl);
																							if ($result==1) 
																							{
																								showmsg('邮件发送成功！',1);
																							}
																							else 
																							{
																								showmsg('邮件发送失败！'.$result,3);
																							}
																						}
																						else 
																						{
																							showmsg('您还未设置邮箱！',3);
																						}
																					}
																					else 
																					{
																						if ($mod=='mail_n' && $_POST['do']=='submit') 
																						{
																							$mail_cloud=$_POST['mail_cloud'];
																							$mail_smtp=$_POST['mail_smtp'];
																							$mail_port=$_POST['mail_port'];
																							$mail_name=($mail_cloud==1 ? $_POST['mail_name2'] : $_POST['mail_name']);
																							$mail_pwd=$_POST['mail_pwd'];
																							$mail_apiuser=$_POST['mail_apiuser'];
																							$mail_apikey=$_POST['mail_apikey'];
																							$mail_recv=$_POST['mail_recv'];
																							saveSetting('mail_cloud',$mail_cloud);
																							saveSetting('mail_smtp',$mail_smtp);
																							saveSetting('mail_port',$mail_port);
																							saveSetting('mail_name',$mail_name);
																							saveSetting('mail_pwd',$mail_pwd);
																							saveSetting('mail_apiuser',$mail_apiuser);
																							saveSetting('mail_apikey',$mail_apikey);
																							saveSetting('mail_recv',$mail_recv);
																							$ad=$CACHE->clear();
																							if ($ad) 
																							{
																								showmsg('修改成功！',1);
																							}
																							else 
																							{
																								showmsg('修改失败！<br/>'.$DB->error(),4);
																							}
																						}
																						else 
																						{
																							if ($mod=='mail') 
																							{
																								echo '<div class="block">
<div class="block-title"><h3 class="panel-title">发信邮箱配置</h3></div>
<div class="">
 <form action="./set.php?mod=mail_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
   <div class="form-group">
	 <label class="col-sm-2 control-label">发信模式</label>
	 <div class="col-sm-10"><select class="form-control" name="mail_cloud" default="';
																								echo $conf['mail_cloud'];
																								echo '"><option value="0">普通模式</option><option value="1">搜狐Sendcloud</option></select></div>
	</div><br/>
	<div id="frame_set1" style="';
																								echo ($conf['mail_cloud']==1 ? 'display:none;' : NULL);
																								echo '">
	<div class="form-group">
	 <label class="col-sm-2 control-label">SMTP服务器</label>
	 <div class="col-sm-10"><input type="text" name="mail_smtp" value="';
																								echo $conf['mail_smtp'];
																								echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">SMTP端口</label>
	 <div class="col-sm-10"><input type="text" name="mail_port" value="';
																								echo $conf['mail_port'];
																								echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">邮箱账号</label>
	 <div class="col-sm-10"><input type="text" name="mail_name" value="';
																								echo $conf['mail_name'];
																								echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">邮箱密码</label>
	 <div class="col-sm-10"><input type="text" name="mail_pwd" value="';
																								echo $conf['mail_pwd'];
																								echo '" class="form-control"/></div>
	</div><br/>
	</div>
	<div id="frame_set2" style="';
																								echo ($conf['mail_cloud']==0 ? 'display:none;' : NULL);
																								echo '">
	<div class="form-group">
	 <label class="col-sm-2 control-label">API_USER</label>
	 <div class="col-sm-10"><input type="text" name="mail_apiuser" value="';
																								echo $conf['mail_apiuser'];
																								echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">API_KEY</label>
	 <div class="col-sm-10"><input type="text" name="mail_apikey" value="';
																								echo $conf['mail_apikey'];
																								echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">发信邮箱</label>
	 <div class="col-sm-10"><input type="text" name="mail_name2" value="';
																								echo $conf['mail_name'];
																								echo '" class="form-control"/></div>
	</div><br/>
	</div>
	<div class="form-group">
	 <label class="col-sm-2 control-label">收信邮箱</label>
	 <div class="col-sm-10"><input type="text" name="mail_recv" value="';
																								echo $conf['mail_recv'];
																								echo '" class="form-control" placeholder="不填默认为发信邮箱"/></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>';
																								if ($conf['mail_name']) 
																								{
																									echo '[<a href="set.php?mod=mailtest">给 ';
																									echo ($conf['mail_recv'] ? $conf['mail_recv'] : $conf['mail_name']);
																									echo ' 发一封测试邮件</a>]';
																								}
																								echo '	</div><br/>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
此功能为用户下单时给自己发邮件提醒。<br/>使用普通模式发信时，建议使用QQ邮箱，SMTP服务器smtp.qq.com，端口465，密码不是QQ密码也不是邮箱独立密码，是QQ邮箱设置界面生成的<a href="http://service.mail.qq.com/cgi-bin/help?subtype=1&&no=1001256&&id=28"  target="_blank" rel="noreferrer">授权码</a>。为确保发信成功率，发信邮箱和收信邮箱最好同一个
</div>
</div>
<script>
$("select[name=\'mail_cloud\']").change(function(){
	if($(this).val() == 0){
		$("#frame_set1").css("display","inherit");
		$("#frame_set2").css("display","none");
	}else{
		$("#frame_set1").css("display","none");
		$("#frame_set2").css("display","inherit");
	}
});
</script>
';
																							}
																							else 
																							{
																								if ($mod=='gonggao_n' && $_POST['do']=='submit') 
																								{
																									$anounce=$_POST['anounce'];
																									$modal=$_POST['modal'];
																									$bottom=$_POST['bottom'];
																									$alert=$_POST['alert'];
																									$gg_search=$_POST['gg_search'];
																									$gg_panel=$_POST['gg_panel'];
																									$gg_reguser=$_POST['gg_reguser'];
																									$chatframe=$_POST['chatframe'];
																									$appurl=$_POST['appurl'];
																									$appalert=$_POST['appalert'];
																									$gg_announce=$_POST['gg_announce'];
																									$musicurl=$_POST['musicurl'];
																									saveSetting('anounce',$anounce);
																									saveSetting('modal',$modal);
																									saveSetting('bottom',$bottom);
																									saveSetting('alert',$alert);
																									saveSetting('gg_search',$gg_search);
																									saveSetting('chatframe',$chatframe);
																									saveSetting('gg_panel',$gg_panel);
																									saveSetting('gg_reguser',$gg_reguser);
																									saveSetting('appurl',$appurl);
																									saveSetting('appalert',$appalert);
																									saveSetting('gg_announce',$gg_announce);
																									saveSetting('musicurl',$musicurl);
																									$ad=$CACHE->clear();
																									if ($ad) 
																									{
																										showmsg('修改成功！',1);
																									}
																									else 
																									{
																										showmsg('修改失败！<br/>'.$DB->error(),4);
																									}
																								}
																								else 
																								{
																									if ($mod=='gonggao') 
																									{
																										echo '<div class="block">
<div class="block-title"><h3 class="panel-title">网站公告配置</h3></div>
<div class="">
 <form action="./set.php?mod=gonggao_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">首页公告</label>
	 <div class="col-sm-10"><textarea class="form-control" name="anounce" rows="6">';
																										echo htmlspecialchars($conf['anounce']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">首页弹出公告</label>
	 <div class="col-sm-10"><textarea class="form-control" name="modal" rows="5">';
																										echo htmlspecialchars($conf['modal']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">首页底部排版<br />(部分模板显示)</label>
	 <div class="col-sm-10"><textarea class="form-control" name="bottom" rows="5">';
																										echo htmlspecialchars($conf['bottom']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">在线下单提示<br />(部分模板显示)</label>
	 <div class="col-sm-10"><textarea class="form-control" name="alert" rows="5">';
																										echo htmlspecialchars($conf['alert']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">订单查询<br />页面公告</label>
	 <div class="col-sm-10"><textarea class="form-control" name="gg_search" rows="5">';
																										echo htmlspecialchars($conf['gg_search']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">分站后台公告</label>
	 <div class="col-sm-10"><textarea class="form-control" name="gg_panel" rows="5">';
																										echo htmlspecialchars($conf['gg_panel']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">所有分站显示的<br />首页公告</label>
	 <div class="col-sm-10"><textarea class="form-control" name="gg_announce" rows="5" placeholder="此处公告内容将在所有分站首页公告显示。顺序是先显示此公告再显示分站自定义公告">';
																										echo htmlspecialchars($conf['gg_announce']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站首页<br />聊天代码</label>
	 <div class="col-sm-10"><textarea class="form-control" name="chatframe" rows="3">';
																										echo htmlspecialchars($conf['chatframe']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">签到萌宠机器人<br />APP下载地址</label>
	 <div class="col-sm-10"><input type="text" name="appurl" value="';
																										echo $conf['appurl'];
																										echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">APP启动<br />弹出内容</label>
	 <div class="col-sm-10"><textarea class="form-control" name="appalert" rows="3">';
																										echo htmlspecialchars($conf['appalert']);
																										echo '</textarea></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">销售站首页<br />背景音乐</label>
	 <div class="col-sm-10"><input type="text" name="musicurl" value="';
																										echo $conf['musicurl'];
																										echo '" class="form-control" placeholder="填写音乐的URL"/></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
实用工具：<a href="set.php?mod=copygg">一键复制其他销售站排版</a>｜<a href="http://www.w3school.com.cn/tiy/t.asp?f=html_basic" target="_blank" rel="noreferrer">HTML在线测试</a>｜<a href="http://pic.xiaojianjian.net/" target="_blank" rel="noreferrer">图床</a>｜<a href="http://www.musictool.top/" target="_blank" rel="noreferrer">音乐外链URL获取</a><br/>
销售站首页聊天代码获取地址：<a href="http://changyan.kuaizhan.com/" target="_blank" rel="noreferrer">搜狐畅言</a>
</div>
</div>
';
																									}
																									else 
																									{
																										if ($mod=='mailcon_reset') 
																										{
																											$faka_mail='<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>签到萌宠机器人官网<br/>[domain]';
																											saveSetting('faka_mail',$faka_mail);
																											$ad=$CACHE->clear();
																											if ($ad) 
																											{
																												showmsg('修改成功！',1);
																											}
																											else 
																											{
																												showmsg('修改失败！<br/>'.$DB->error(),4);
																											}
																										}
																										else 
																										{
																											if ($mod=='mailcon_n' && $_POST['do']=='submit') 
																											{
																												$faka_mail=$_POST['faka_mail'];
																												saveSetting('faka_mail',$faka_mail);
																												$ad=$CACHE->clear();
																												if ($ad) 
																												{
																													showmsg('修改成功！',1);
																												}
																												else 
																												{
																													showmsg('修改失败！<br/>'.$DB->error(),4);
																												}
																											}
																											else 
																											{
																												if ($mod=='mailcon') 
																												{
																													echo '<div class="block">
<div class="block-title"><h3 class="panel-title">发信邮件模板设置</h3></div>
<div class="">
 <form action="./set.php?mod=mailcon_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">发卡邮件模板</label>
	 <div class="col-sm-10"><textarea class="form-control" name="faka_mail" id="faka_mail" rows="6">';
																													echo htmlspecialchars($conf['faka_mail']);
																													echo '</textarea></div>
	</div>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/><br/>
	 <a href="./set.php?mod=mailcon_reset" class="btn btn-warning btn-block" onclick="return confirm(\'确定要重置吗？\');">重置模板设置</a><br/>
	</div>
	</div>
 </form>
</div>
<div class="panel-footer">
<font color="green">变量代码：<br/>
<a href="#" onclick="Addstr(\'faka_mail\',\'[kmdata]\');return false">[kmdata]</a>&nbsp;卡密内容<br/>
<a href="#" onclick="Addstr(\'faka_mail\',\'[name]\');return false">[name]</a>&nbsp;商品名称<br/>
<a href="#" onclick="Addstr(\'faka_mail\',\'[alert]\');return false">[alert]</a>&nbsp;商品简介<br/>
<a href="#" onclick="Addstr(\'faka_mail\',\'[date]\');return false">[date]</a>&nbsp;购买时间<br/>
<a href="#" onclick="Addstr(\'faka_mail\',\'[email]\');return false">[email]</a>&nbsp;收信人邮箱<br/></font>
</div>
</div>
<script>
function Addstr(id, str) {
	$("#"+id).val($("#"+id).val()+str);
}
</script>
';
																												}
																												else 
																												{
																													if ($mod=='copygg_n' && $_POST['do']=='submit') 
																													{
																														$url=$_POST['url'];
																														$content=$_POST['content'];
																														$url_arr=parse_url($url);
																														if ($url_arr['host']==$_SERVER['HTTP_HOST']) 
																														{
																															showmsg('无法自己复制自己',3);
																														}
																														$data=get_curl($url.'api.php?act=siteinfo');
																														$arr=json_decode($data,true);
																														if (array_key_exists('sitename',$arr)) 
																														{
																															if (in_array('anounce',$content)) 
																															{
																																saveSetting('anounce',str_replace($arr['kfqq'],$conf['kfqq'],$arr['anounce']));
																															}
																															if (in_array('modal',$content)) 
																															{
																																saveSetting('modal',str_replace($arr['kfqq'],$conf['kfqq'],$arr['modal']));
																															}
																															if (in_array('bottom',$content)) 
																															{
																																saveSetting('bottom',str_replace($arr['kfqq'],$conf['kfqq'],$arr['bottom']));
																															}
																															$ad=$CACHE->clear();
																															if ($ad) 
																															{
																																showmsg('修改成功！',1);
																															}
																															else 
																															{
																																showmsg('修改失败！<br/>'.$DB->error(),4);
																															}
																														}
																														else 
																														{
																															showmsg('获取数据失败，对方网站无法连接或存在金盾或云锁等防火墙，或对方的签到萌宠机器人官网不是正版！',4);
																														}
																													}
																													else 
																													{
																														if ($mod=='copygg') 
																														{
																															echo '<div class="block">
<div class="block-title"><h3 class="panel-title">一键复制其他销售站排版</h3></div>
<div class="">
 <form action="./set.php?mod=copygg_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">目标销售站URL</label>
	 <div class="col-sm-10"><input type="text" name="url" value="" class="form-control" placeholder="本系统内置在官网内部,需要复制目标的话请这样填写目标链接：http://目标官网域名/gmsq/" required/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">复制内容</label>
	 <div class="col-sm-10"><label><input name="content[]" type="checkbox" value="anounce" checked/> 首页公告</label><br/><label><input name="content[]" type="checkbox" value="modal" checked/> 弹出公告</label><br/><label><input name="content[]" type="checkbox" value="bottom" checked/> 底部排版</label></div>
	</div>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
	</div>
<br /><br /><hr />
<center>只支持签到萌宠机器人正版销售站相互复制！无法复制杂七杂八的代刷网！<br />复制后您将失去当前的排版，请谨慎操作！</center>
	</div>
 </form>
</div>
</div>
';
																														}
																														else 
																														{
																															if (($mod=='pay_n' && $_POST['do']=='submit')) 
																															{
																																if (!file_exists('unlockpay') && file_exists('pay.lock')) 
																																{
																																	showmsg('为保障你的资金安全，如需修改支付商户和密钥，请删除<font color=red> admin/pay.lock </font>文件后再修改！',3);
																																}
																																if (!file_exists('unlockpay') && file_exists('pay.lock')) 
																																{
																																	showmsg('为保障你的资金安全，如需修改支付商户和密钥，请删除<font color=red> admin/pay.lock </font>文件后再修改！',3);
																																}
																																if ($_POST['payapi']==(-1)) 
																																{
																																	if (empty($_POST['epay_url'])) 
																																	{
																																		showmsg('请填写接口网址',3);
																																	}
																																	$conf['payapi']=-1;
																																	$conf['epay_url']=$_POST['epay_url'];
																																}
																																saveSetting('alipay_api',$_POST['alipay_api']);
																																saveSetting('alipay_pid',$_POST['alipay_pid']);
																																saveSetting('alipay_key',$_POST['alipay_key']);
																																saveSetting('alipay2_api',$_POST['alipay2_api']);
																																saveSetting('tenpay_api',$_POST['tenpay_api']);
																																saveSetting('tenpay_pid',$_POST['tenpay_pid']);
																																saveSetting('tenpay_key',$_POST['tenpay_key']);
																																saveSetting('qqpay_api',$_POST['qqpay_api']);
																																saveSetting('wxpay_api',$_POST['wxpay_api']);
																																if (($conf['alipay_api']==2 || $conf['tenpay_api']==2) || $conf['qqpay_api']==2 || $conf['wxpay_api']==2) 
																																{
																																	saveSetting('payapi',$_POST['payapi']);
																																	saveSetting('epay_url',($_POST['payapi']==(-1)?$_POST['epay_url']:NULL));
																																	saveSetting('epay_pid',$_POST['epay_pid']);
																																	saveSetting('epay_key',$_POST['epay_key']);
																																}
																																if ($conf['alipay_api']==5 || $conf['qqpay_api']==5 || $conf['wxpay_api']==5) 
																																{
																																	saveSetting('codepay_id',$_POST['codepay_id']);
																																	saveSetting('codepay_key',$_POST['codepay_key']);
																																}
																																$ad=$CACHE->clear();
																																if ($ad) 
																																{
																																	showmsg('修改成功！',1);
																																}
																																else 
																																{
																																	showmsg('修改失败！<br/>'.$DB->error(),4);
																																}
																															}
																															else 
																															{
																																if ($mod=='pay') 
																																{																																	
																																	echo '<div class="block">
<div class="block-title"><h3 class="panel-title">支付接口配置</h3></div>
<div class="">
 <form action="./set.php?mod=pay_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝即时到账</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay_api" default="';
																																	echo $conf['alipay_api'];
																																	echo '"><option value="0">关闭</option><option value="1">支付宝官方即时到账接口</option><option value="3">支付宝当面付扫码支付</option><option value="2">凌吾易支付免签约接口</option><option value="5">码支付免签约接口</option></select>
			<pre id="payapi_06"  style="';
																																	if ($conf['alipay_api']!=3) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '"><font color="green">*支付宝当面付接口配置请修改other/f2fpay/config.php</font></pre>
		</div>
	</div>
	<div id="payapi_01" style="';
																																	if ($conf['alipay_api']!=1) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '">
	<div class="form-group">
		<label class="col-lg-3 control-label">合作者身份(PID)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_pid" class="form-control" value="';
																																	echo $conf['alipay_pid'];
																																	echo '">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">安全校验码(Key)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_key" class="form-control" value="';
																																	echo $conf['alipay_key'];
																																	echo '">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝手机网站支付</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay2_api" default="';
																																	echo $conf['alipay2_api'];
																																	echo '"><option value="0">关闭</option><option value="1">支付宝手机网站支付接口</option></select>
			<pre id="payapi_02"  style="';
																																	if ($conf['alipay2_api']!=1) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '">相关信息与以上支付宝即时到账接口一致，开启前请确保已开通支付宝手机支付，否则会导致手机用户无法支付！</pre>
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">财付通即时到账</label>
		<div class="col-lg-8">
			<select class="form-control" name="tenpay_api" default="';
																																	echo $conf['tenpay_api'];
																																	echo '"><option value="0">关闭</option><option value="1">财付通官方支付接口</option><option value="2">凌吾易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_03" style="';
																																	if ($conf['tenpay_api']!=1) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '">
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通商户号</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_pid" class="form-control"
				  value="';
																																	echo $conf['tenpay_pid'];
																																	echo '">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通密钥</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_key" class="form-control" value="';
																																	echo $conf['tenpay_key'];
																																	echo '">
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="qqpay_api" default="';
																																	echo $conf['qqpay_api'];
																																	echo '"><option value="0">关闭</option><option value="1">QQ钱包官方支付接口</option><option value="2">凌吾易支付免签约接口</option><option value="5">码支付免签约接口</option></select>
			<pre id="payapi_05"  style="';
																																	if ($conf['qqpay_api']!=1) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '"><font color="green">*QQ钱包支付接口配置请修改other/qqpay/qpayMch.config.php</font></pre>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">微信支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="wxpay_api" default="';
																																	echo $conf['wxpay_api'];
																																	echo '"><option value="0">关闭</option><option value="1">微信官方扫码+公众号支付接口</option><option value="3">微信官方扫码+H5支付接口</option><option value="2">凌吾易支付免签约接口</option><option value="5">码支付免签约接口</option></select>
			<pre id="payapi_04"  style="';
																																	if (($conf['wxpay_api']!=1 && $conf['wxpay_api']!=3)) 
																																	{
																																		echo 'display:none;';
																																	}
																																	echo '"><font color="green">*微信支付接口配置请修改other/wxpay/WxPay.Config.php</font></pre>
		</div>
	</div>
	';
																																	if (($conf['alipay_api']==2 || $conf['tenpay_api']==2) || $conf['qqpay_api']==2 || $conf['wxpay_api']==2) 
																																	{
																																		echo '	<div class="form-group">
		<label class="col-lg-3 control-label">凌吾易支付接入商</label>
		<div class="col-lg-8">
			<select class="form-control" name="payapi" default="';
																																		echo $conf['payapi'];
																																		echo '">';
																																		echo $payadd;
																																		echo '<option value="-1">凌吾易支付</option></select>
		</div>
	</div>
	<div class="form-group" id="payapi_07" style="';
																																		if ($conf['payapi']!=(-1)) 
																																		{
																																			echo 'display:none;';
																																		}
																																		echo '">
		<label class="col-lg-3 control-label">凌吾易支付接口     <a href="http://payeco.hl-5.com/"><font color="blue">     点我注册</font></a></label>
	<div class="col-lg-8">
			<input type="text" name="epay_url" class="form-control"
				  value="';
																																		echo $conf['epay_url'];
																																		echo '" placeholder="http://payeco.hl-5.com/">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付商户ID</label>
		<div class="col-lg-8">
			<input type="text" name="epay_pid" class="form-control"
				  value="';
																																		echo $conf['epay_pid'];
																																		echo '">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付商户密钥</label>
		<div class="col-lg-8">
			<input type="text" name="epay_key" class="form-control" value="';
																																		echo $conf['epay_key'];
																																		echo '">
		</div>
	</div>
	';
																																	}
																																	echo '	';
																																	if ($conf['alipay_api']==5 || $conf['qqpay_api']==5 || $conf['wxpay_api']==5) 
																																	{
																																		echo '	<div class="form-group">
		<label class="col-lg-3 control-label">易支付ID</label>
		<div class="col-lg-8">
			<input type="text" name="codepay_id" class="form-control"
				  value="';
																																		echo $conf['codepay_id'];
																																		echo '">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付商户密钥</label>
		<div class="col-lg-8">
			<input type="text" name="codepay_key" class="form-control" value="';
																																		echo $conf['codepay_key'];
																																		echo '">
			<pre><font color="green">codepay.fateqq.com</font></pre>
		</div>
	</div>
	';
																																	}
																																	echo '	<div class="form-group">
	 <div class="col-sm-offset-3 col-sm-8"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/><hr/>
	 请对接码支付！这是目前本套程序最稳定的一个接口!微信接口可以使用官方扫码<br /><a href="https://codepay.fateqq.com/"target=_blank>前往码支付官网注册账号</a>
	 |<span style="color:red;">码支付需要服务器监控，不然销售站无法获得订单信息<br>关于如何把码支付的软件挂载到服务器上，码支付官网有自己的教程，<a href="https://codepay.kjkl8.com/help/SJl0QUWEM.html"  target=_blank>点我去看</a></span><br>都是做机器人生意的，不要告诉我你没有服务器，这个地方不懂的话<a href="https://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes"  target=_blank>可以问我</a>
	</div>
	</div>
 </form>
</div>
</div>
<script>
$("select[name=\'alipay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_01").css("display","inherit");
		$("#payapi_06").css("display","none");
	}else if($(this).val() == 3){
		$("#payapi_01").css("display","none");
		$("#payapi_06").css("display","inherit");
	}else{
		$("#payapi_01").css("display","none");
		$("#payapi_06").css("display","none");
	}
});
$("select[name=\'tenpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_03").css("display","inherit");
	}else{
		$("#payapi_03").css("display","none");
	}
});
$("select[name=\'wxpay_api\']").change(function(){
	if($(this).val() == 1 || $(this).val() == 3){
		$("#payapi_04").css("display","inherit");
	}else{
		$("#payapi_04").css("display","none");
	}
});
$("select[name=\'qqpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_05").css("display","inherit");
	}else{
		$("#payapi_05").css("display","none");
	}
});
$("select[name=\'alipay2_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_02").css("display","inherit");
	}else{
		$("#payapi_02").css("display","none");
	}
});
$("select[name=\'payapi\']").change(function(){
	if($(this).val() == -1){
		$("#payapi_07").css("display","inherit");
	}else{
		$("#payapi_07").css("display","none");
	}
});
</script>
';
																																}
																																else 
																																{
																																	if ($mod=='epay_n') 
																																	{
																																		$payapi=pay_api(true);
																																		$account=$_POST['account'];
																																		$username=$_POST['username'];
																																		if (($account==NULL || $username==NULL)) 
																																		{
																																			showmsg('保存错误,请确保每项都不为空!',3);
																																		}
																																		else 
																																		{
																																			$data=get_curl($payapi.'api.php?act=change&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&account='.$account.'&username='.$username.'&url='.$_SERVER['HTTP_HOST']);
																																			$arr=json_decode($data,true);
																																			if ($arr['code']==1) 
																																			{
																																				showmsg('修改成功!',1);
																																			}
																																			else 
																																			{
																																				showmsg($arr['msg']);
																																			}
																																		}
																																	}
																																	else 
																																	{
																																		if ($mod=='epay') 
																																		{
																																			if (!empty($conf['epay_pid']) && !empty($conf['epay_key'])) 
																																			{
																																				$payapi=pay_api(true);
																																				$data=get_curl($payapi.'api.php?act=query&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&url='.$_SERVER['HTTP_HOST']);
																																				$arr=json_decode($data,true);
																																				if ($arr['code']==(-2)) 
																																				{
																																					showmsg('易支付KEY校验失败！');
																																				}
																																				else 
																																				{
																																					if (!array_key_exists('code',$arr)) 
																																					{
																																						showmsg('获取失败，请刷新重试！');
																																					}
																																				}
																																				$stype=($arr['stype']?$arr['stype']:'支付宝');
																																			}
																																			else 
																																			{
																																				showmsg('你还未填写彩虹易支付商户ID和密钥，请返回填写！');
																																			}
																																			if (array_key_exists('active',$arr) && $arr['active']==0) 
																																			{
																																				showmsg('该商户已被封禁');
																																			}
																																			$key=substr($arr['key'],0,8).'****************'.substr($arr['key'],24,32);
																																			if (!file_exists('pay.lock')) 
																																			{
																																				;
																																				file_put_contents('pay.lock','pay.lock');
																																				error_reporting(0);
																																			}
																																			echo '<div class="block">
<div class="block-title"><h3 class="panel-title">彩虹易支付设置</h3></div>
<div class="">
<ul class="nav nav-tabs"><li class="active"><a href="#">彩虹易支付设置</a></li><li><a href="./set.php?mod=epay_order">订单记录</a></li><li><a href="./set.php?mod=epay_settle">结算记录</a></li></ul>
 <form action="./set.php?mod=epay_n" method="post" class="form-horizontal" role="form">
   <h4>商户信息查看：</h4>
	<div class="form-group">
	 <label class="col-sm-2 control-label">商户ID</label>
	 <div class="col-sm-10"><input type="text" name="pid" value="';
																																			echo $arr['pid'];
																																			echo '" class="form-control" disabled/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">商户KEY</label>
	 <div class="col-sm-10"><input type="text" name="key" value="';
																																			echo $key;
																																			echo '" class="form-control" disabled/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">商户余额</label>
	 <div class="col-sm-10"><input type="text" name="money" value="';
																																			echo $arr['money'];
																																			echo '" class="form-control" disabled/></div>
	</div><br/>
	<h4>收款账号设置：</h4>
	<div class="form-group">
	 <label class="col-sm-2 control-label">结算方式</label>
	 <div class="col-sm-10"><input type="text" name="type" value="';
																																			echo $stype;
																																			echo '" class="form-control" disabled/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">结算账号</label>
	 <div class="col-sm-10"><input type="text" name="account" value="';
																																			echo $arr['account'];
																																			echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">真实姓名</label>
	 <div class="col-sm-10"><input type="text" name="username" value="';
																																			echo $arr['username'];
																																			echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="确定修改" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
	<h4><span class="glyphicon glyphicon-info-sign"></span> 注意事项</h4>
1.结算账号和真实姓名请仔细核对，一旦错误将无法结算到账！<br/>2.每笔交易会有';
																																			echo 100-$arr['money_rate'];
																																			echo '%的手续费，这个手续费是支付宝、微信和财付通收取的，非本接口收取。<br/>3.结算为T+1规则，当天满';
																																			echo $arr['settle_money'];
																																			echo '元在第二天会自动结算
 </form>
</div>
</div>
';
																																		}
																																		else 
																																		{
																																			if ($mod=='epay_settle') 
																																			{
																																				$payapi=pay_api(true);
																																				$data=get_curl($payapi.'api.php?act=settle&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&limit=20&url='.$_SERVER['HTTP_HOST']);
																																				$arr=json_decode($data,true);
																																				if ($arr['code']==(-2)) 
																																				{
																																					showmsg('易支付KEY校验失败！');
																																				}
																																				echo '<div class="block"><div class="block-title w h"><h3 class="panel-title">彩虹易支付结算记录</h3></div>
	<div class="table-responsive">
       <table class="table table-striped">
         <thead><tr><th>ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th></tr></thead>
         <tbody>';
																																				foreach($arr['data'] as $res)
																																				{
																																					echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['account'].'</td><td><b>'.$res['money'].'</b></td><td><b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td></tr>';
																																				}
																																				echo '</tbody>
       </table>
     </div>
	 </div>';
	 
																																			}
																																			else 
																																			{
																																				if ($mod=='epay_order') 
																																				{
																																					$payapi=pay_api(true);
																																					$data=get_curl($payapi.'api.php?act=orders&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&limit=30&url='.$_SERVER['HTTP_HOST']);
																																					$arr=json_decode($data,true);
																																					if ($arr['code']==(-2)) 
																																					{
																																						showmsg('易支付KEY校验失败！');
																																					}
																																					echo '<div class="block"><div class="block-title"><h3 class="panel-title">彩虹易支付订单记录</h3></div>订单只展示前30条[<a href="set.php?mod=epay">返回</a>]
	<div class="table-responsive">
       <table class="table table-striped">
         <thead><tr><th>交易号/商户订单号</th><th>付款方式</th><th>商品名称/金额</th><th>创建时间/完成时间</th><th>状态</th></tr></thead>
         <tbody>';
																																					foreach($arr['data'] as $res)
																																					{
																																						echo '<tr><td>'.$res['trade_no'].'<br/>'.$res['out_trade_no'].'</td><td>'.$res['type'].'</td><td>'.$res['name'].'<br/>￥ <b>'.$res['money'].'</b></td><td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td><td>'.($res['status']==1 ? '<font color=green>已完成</font>' : '<font color=red>未完成</font>').'</td></tr>';
																																					}
																																					echo '</tbody>
       </table>
     </div>
	 </div>';
																																				}
																																				else 
																																				{
																																					if ($mod=='upimg') 
																																					{
																																						echo '<div class="block"><div class="block-title"><h3 class="panel-title">更改首页LOGO</h3><div class="block-options pull-right"><a class="btn btn-default" href="set.php?mod=upbgimg">更改背景图</a></div></div><div class="">';
																																						if ($_POST['s']==1) 
																																						{
																																							if (uploadimg('logo')) 
																																							{
																																								echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
																																							}
																																							else 
																																							{
																																								echo '上传失败，可能没有文件写入权限';
																																							}
																																						}
																																						echo '<form action="set.php?mod=upimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../assets/img/logo.png?r='.rand(10000,99999).'" style="max-width:100%">';
																																						echo '</div></div>';
																																					}
																																					else 
																																					{
																																						if ($mod=='upbgimg') 
																																						{
																																							echo '<div class="block"><div class="block-title"><h3 class="panel-title">更改首页背景图</h3><div class="block-options pull-right"><a class="btn btn-default" href="set.php?mod=upimg">更改LOGO</a></div></div><div class="">';
																																							if ($_POST['s']==1) 
																																							{
																																								saveSetting('ui_background',$_POST['ui_background']);
																																								$CACHE->clear();
																																								if (uploadimg('bj')) 
																																								{
																																									echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
																																								}
																																								else 
																																								{
																																									echo '上传失败，可能没有文件写入权限';
																																								}
																																							}
																																							echo '<form action="set.php?mod=upbgimg" method="POST" enctype="multipart/form-data">
<input type="hidden" name="s" value="1" />
<div class="form-group">
<label for="file"></label>
<input type="file" name="file" id="file" />
</div>
<div class="form-group">
<label>显示效果:</label><br><select class="form-control" name="ui_background" default="'.$conf['ui_background'].'"><option value="0">纵向和横向重复</option><option value="1">横向重复,纵向拉伸</option><option value="2">纵向重复,横向拉伸</option><option value="3">不重复,全屏拉伸</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../assets/img/bj.png?r='.rand(10000,99999).'" style="max-width:100%">';
																																							echo '</div></div>';
																																						}
																																						else 
																																						{
																																							if ($mod=='cleanbom') 
																																							{
																																								$filename=ROOT.'config.php';
																																								$contents=file_get_contents($filename);
																																								$charset[1]=substr($contents,0,1);
																																								$charset[2]=substr($contents,1,1);
																																								$charset[3]=substr($contents,2,1);
																																								if (ord($charset[1])==239 && ord($charset[2])==187) 
																																								{
																																									$rest=substr($contents,3);
																																									file_put_contents($filename,$rest);
																																									showmsg('找到BOM并已自动去除',1);
																																								}
																																								else 
																																								{
																																									showmsg('没有找到BOM',2);
																																								}
																																							}
																																						}
																																					}
																																				}
																																			}
																																		}
																																	}
																																}
																															}
																														}
																													}
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
echo '<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
   </div>
 </div>';
function curl_get_230($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_231($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_232($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_233($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_234($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_235($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_236($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_237($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_238($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_239($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_240($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_241($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_242($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_243($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_244($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_245($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_246($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_247($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_248($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_249($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_250($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_251($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_252($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_253($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_254($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_255($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_256($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_257($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_258($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_259($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_260($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_261($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
function curl_get_262($url)
{
	$ch=curl_init($url);
	$httpheader[]='Accept: */*';
	$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
	$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
	$httpheader[]='Connection: close';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
?>