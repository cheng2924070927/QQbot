<?php
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$title = '推广赚钱';
include 'head.php';

if($conf['ui_bing']==1){
	$background_image='//cdn.qqzzz.net/assets/img/background/'.rand(1,19).'.jpg';
	$conf['ui_background']=3;
}elseif($conf['ui_bing']==2){
	if(date("Ymd")==$conf['ui_bing_date']){
		$background_image=$conf['ui_backgroundurl'];
		if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
	}else{
		$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
		$bing_data = get_curl($url);
		$bing_arr=json_decode($bing_data,true);
		if (!empty($bing_arr['images'][0]['url'])) {
			$background_image='//cn.bing.com'.$bing_arr['images'][0]['url'];
			saveSetting('ui_backgroundurl', $background_image);
			saveSetting('ui_bing_date', date("Ymd"));
			$CACHE->clear();
			if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
		}
	}
	$conf['ui_background']=3;
}else{
	$background_image='../assets/img/bj.png';
}
if($conf['ui_background']==0)
$repeat='background-repeat:repeat;';
elseif($conf['ui_background']==1)
$repeat='background-repeat:repeat-x;
background-size:auto 100%;';
elseif($conf['ui_background']==2)
$repeat='background-repeat:repeat-y;
background-size:100% auto;';
elseif($conf['ui_background']==3)
$repeat='background-repeat:no-repeat;
background-size:100% 100%;';

$count1=$DB->count("SELECT count(*) from shua_orders where zid={$userrow['zid']}");
?>
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.img-circle{width: 15%!important;}
</style>
<div class="container" style="padding-top:70px;">
	<div class="row">
		<div class="col-sm-12">
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
if(!$userrow['domain'])showmsg('当前分站还未绑定域名',3);
$url = 'http://'.$userrow['domain'].'/';
if($conf['fanghong_api']>0){
	$turl = fanghongdwz($url);
	if($turl == $url){
		showmsg('防红地址生成失败，请联系站长更换接口',3);
	}elseif(strpos($turl,'/')===false){
		showmsg('防红地址生成失败:'.$turl,3);
	}
}else{
	$turl = $url;
}
?>
			<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><b>推广赚钱</b></h3></div>
				<div class="panel-body">
					<p>① 首先在 <a href="shoplist.php" class="label label-primary">商品管理</a> 一键提升价格，增加提成（建议提成比例不要超过10），也可不提升价格薄利多销，根据自己需求进行选择！</p>
                    <p>② 将以下图片保存至本地或者复制文字广告，在QQ好友、QQ群、QQ空间、微信好友、微信朋友圈、贴吧、论坛等地方发表！</p>
                    <p>③ 用户扫描下面任一一张二维码或访问任一文字广告内连接均可进入您的网站，下单均可获得提成哦~</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
			<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#pic" data-toggle="tab"><i class="fa fa-image"></i> 图片广告</a></li>
				<li><a href="#text" data-toggle="tab"><i class="fa fa-file-text"></i> 文字广告</a></li>
			</ul>
			<a href="javascript:void(0);" onclick="TgTips()" class="btn btn-primary btn-sm pull-right" style="top:15px;right:28px;position: absolute!important;">投稿</a>
			</div>
			<div class="panel-body">
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="pic">
						<div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片①</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=1&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
							<div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片②</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=2&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
							<div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片③</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=3&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
							<div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片④</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=4&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
							<div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片⑤</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=5&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
							<div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片⑥</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=6&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					<div class="tab-pane fade in" id="text">
						<div class="col-12 col-md-6 col-lg-4">
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告①</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-a">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-a">
                                        刷名片赞、空间人气、说说赞、快手双击、快手浏览、全民K歌鲜花、QQ刷钻等。每天还可免费抽奖，欢迎收藏！<br><br>
                                        自助下单地址：<?php echo $turl?></p>
                                </div>
                            </div>
                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告②</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-b">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-b">
                                        1998年马化腾创立腾讯QQ，让你注册，你不注册。 现在一个5位数的QQ几万。2003年马云说开 淘宝店不要钱，让你开店，你不开。10年后淘宝造就了无数个亿万富翁。2009年曹国 伟创立微博，让你开通，你不开。如今一个微博搞笑排行榜年净赚1500万，2018年我 给你一个刷业务网站，再不好好珍惜的话，好好想想你还会错过什么？<br><br>
                                        自助下单地址：<?php echo $turl?></p>
                                </div>
                            </div>
						</div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告③</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-c">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-c">
                                        有时候你想约个炮，却不小心谈了场恋爱。有时候你想好好谈个恋爱，却发现只是约了个炮，世界那么大，床却那么小， 床上的两个人曾经那么好，却不能到老。我喜欢牵了手就能成婚的故事，却活在了一个上了床也没有结果的时代！ 有些人总埋怨泡不上妞、回头看看你的QQ，不是QQ会员，也不是QQ黄钻！谁会跟你走？在这个扣扣上遍地是会员， 空间满屏是黄钻的年代，不如加入我们吧！代唰欢迎您的加盟，会员钻全网最低价，还能免费抽年费，运气好还能成永久成绝版，价格就像我们宣传语那么直白！<br><br>
                                        自助下单地址：<?php echo $turl?></p>
                                </div>
                            </div>
                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告④</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-d">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-d">
                                        还在互赞QQ名片？空间说说？空间留言？多费时间呀？给你们个网站无需注册，直接下单！<br><br>
                                        自助下单地址：<?php echo $turl?></p>
                                </div>
                            </div>
                        </div>
						<div class="col-12 col-md-6 col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告⑤</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-e">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-e">
                                        [QQ红包]恭喜发财<br>一个能刷QQ名片赞的网站价格低到冰点！！！现在老板疯了，疯狂送福利中，你还不赶快来下一单？还能搭建分站赚零花钱！这么便宜实惠还有优质售后的平台确定不来？<br><br>
                                        自助下单地址：<?php echo $turl?></p>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告⑥</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-f">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-f" class="text-center">    
                                        QQ代唰商城<br><?php echo $turl?><br>【自动处理】【下单秒唰】<br>【钻类业务】【搭建分站】<br>【唰名片赞】【空间业务】<br>【快手业务】【王者代练】<br>【抖音业务】【代挂业务】<br>【Ｋ歌业务】【新浪微博】<br>每天免费抽奖，赢好礼<br>开通分站每天签到送现金！<br>建议收藏网站方便下次访问，不迷路
                                    </p>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
function CunTips() {
	layer.alert('保存方法：<br><b>手机</b>：长按图片即可将图片保存至本地！(需要在浏览器才能保存哦)<br><b>电脑</b>：鼠标指针放在图片上并点击右键»图片另存为，即可保存！', {
		icon: 6,
		title: '小提示',
		skin: 'layui-layer-molv layui-layer-wxd'
	})
}
function TgTips() {
	layer.alert('若您有更好的图文广告模板，文字广告语，均可联系客服进行投稿哦~<br>期待下一个投稿的您~！', {
		icon: 6,
		title: '小提示',
		skin: 'layui-layer-molv layui-layer-wxd'
	})
}
$(document).ready(function(){
	var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function(e) {
            layer.msg('复制成功！',{time: 1000, icon: 1});
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！',{time: 2000, icon: 2});
        });
})
</script>