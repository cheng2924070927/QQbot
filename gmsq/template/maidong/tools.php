<?php
include_once 'head.php';
?>
<div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
	<div id="sidebar">
		<div id="sidebar-brand" class="themed-background">
			<a href="index.php" class="sidebar-title"> <i class="fa fa-qq"></i><span class="sidebar-nav-mini-hide"><?php echo mb_substr($conf['sitename'],0,10,'utf-8')?></span></a>
		</div>
		<div id="sidebar-scroll">
			<div class="sidebar-content">
				<ul class="sidebar-nav">
					<li><a href="./">　<i class="icon">&#xe664;</i><span class="sidebar-nav-mini-hide">　网站首页</span></a></li>
					<?php if($conf['fenzhan_buy']==1){?>
					<li><a href="./user/regsite.php">　<i class="fa fa-star sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">开通分站</span></a></li>
					<?php }?>
					<li><a href="./user/">　<i class="icon">&#xe601;</i><span class="sidebar-nav-mini-hide">　管理后台</span></a></li>
					<?php if(!empty($conf['invite_tid'])){?>
					<li><a target="_blank" href="./?mod=invite">　<i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">推广中心</span></a></li>
					<?php }?>
					<?php if(!empty($conf['appurl'])){?>
					<li><a target="_blank" href="<?php echo $conf['appurl']; ?>">　<i class="fa fa-android sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">APP下载</span></a></li>
					<?php }?>
					<li><a href="./?mod=tools" class=" active">　<i class="icon">&#xe608;</i><span class="sidebar-nav-mini-hide">　实用工具</span></a></li>
					<li><a href="./?mod=about">　<i class="icon">&#xe6f6;</i><span class="sidebar-nav-mini-hide">　关于我们</span></a></li>
				</ul>
			</div>
		</div>
		<div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
			<div class="text-center">
				<small>2019 <i class="fa fa-heart text-danger"></i> <a href="./"> <?php echo $conf['sitename']?></a></small><br>
			</div>
		</div>
	</div>
		<div id="main-container">
			<header class="navbar navbar-inverse navbar-fixed-top">
				<ul class="nav navbar-nav-custom">
					<li><a href="javascript:void(0)"
						onclick="App.sidebar('toggle-sidebar');this.blur();"> <i
							class="fa fa-ellipsis-v fa-fw animation-fadeInRight"
							id="sidebar-toggle-mini"></i> <i
							class="fa fa-bars fa-fw animation-fadeInRight"
							id="sidebar-toggle-full"></i> 菜单
					</a></li>
				</ul>
				<ul class="nav navbar-nav-custom pull-right">
					<li class="dropdown">
			<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
			<img src="<?php echo ($islogin2==1)?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>" alt="avatar">
			</a>
			<ul class="dropdown-menu dropdown-menu-right">
			<?php if($islogin2==1){?>
				<li class="dropdown-header text-center">
					<strong><?php echo $userrow['user']?></strong>
				</li>
				<li>
					<a href="./user/">
					<i class="fa fa-user fa-fw pull-right"></i>
					用户中心
					</a>
				</li>
				<li>
					<a href="./user/uset.php?mod=user">
					<i class="fa fa-pencil-square fa-fw pull-right"></i>
					密码修改
					</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="./user/login.php?logout">
					<i class="fa fa-power-off fa-fw pull-right"></i>
					退出登录
					</a>
				</li>
			<?php }else{?>
				<li class="dropdown-header text-center">
					<strong>未登录</strong>
				</li>
				<li>
					<a href="./user/login.php">
					<i class="fa fa-user fa-fw pull-right"></i>
					登录
					</a>
				</li>
				<li>
					<a href="./user/reg.php">
					<i class="fa fa-plus-circle fa-fw pull-right"></i>
					注册
					</a>
				</li>
			<?php }?>
			</ul>
		</li>
				</ul>
			</header>
			<div id="page-content">
			<div class="row">
<div class="col-sm-6">
<div class="block">
<div class="panel-heading" style="text-align: center;"><h3 class="panel-title">
	全民K歌获取歌曲ID</h3></div>
	<div class="list-group">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text" name="url" id="url" value="" class="form-control" placeholder="请输入歌曲的分享链接" required="">
				</div>
				<div class="form-group" style="display:none;" id="song_v">
					<div class="input-group"><div class="input-group-addon">歌曲ID</div>
					<input type="text" id="songid" value="" class="form-control" required="">
				</div></div>
				<input type="submit" onclick="getsongid()" id="getsongid" class="form-control" value="立即获取">
			</div>
		</div>
	</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
进入全民K歌-选择歌曲-分享-复制链接
</div>
</div>
</div>
<div class="col-sm-6">
<div class="block">
<div class="panel-heading" style="text-align: center;"><h3 class="panel-title">
	获取快手ID</h3></div>
	<div class="list-group">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text"id="kuaishou_url" value="" class="form-control" placeholder="请输入快手作品链接" required="">
				</div>
				<div  style="display:none;" id="kuaishou_v">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作者ID</div>
					<input type="text" id="anotherid" value="" class="form-control" required="">
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作品ID</div>
					<input type="text" id="videoid" value="" class="form-control" required="">
				</div></div>
				</div>
				<input type="submit" onclick="getkuaishouid()" id="getkuaishouid" class="form-control" value="立即获取">
			</div>
		</div>
	</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
进入快手，选择一个作品，分享，复制链接
</div>
</div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function getsongid(){
	var songurl=$("#url").val();
	if(songurl==''){alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){alert('请输入正确的歌曲的分享链接！');return false;}
	$('#song_v').hide();
	try{
		var songid = songurl.split('s=')[1].split('&')[0];
	}catch(e){
		alert('请输入正确的歌曲的分享链接！');return false;
	}
	$('#songid').val(songid);
	$('#song_v').slideDown();
}
function getkuaishouid(){
	var kuauishouurl=$("#kuaishou_url").val();
	if(kuauishouurl==''){alert('请确保每项不能为空！');return false;}
	if(kuauishouurl.indexOf('gifshow.com')<0 && kuauishouurl.indexOf('kuaishou.com')<0){alert('请输入正确的快手作品链接！');return false;}
	$('#kuaishou_v').hide();
	try{
		if(kuauishouurl.indexOf('userId=')>0){
			var anotherid = kuauishouurl.split('userId=')[1].split('&')[0];
		}else{
			var anotherid = kuauishouurl.split('photo/')[1].split('/')[0];
		}
		if(kuauishouurl.indexOf('photoId=')>0){
			var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
		}else{
			var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
		}
	}catch(e){
		alert('请输入正确的快手作品链接！');return false;
	}
	$('#anotherid').val(anotherid);
	$('#videoid').val(videoid);
	$('#kuaishou_v').slideDown();
}
</script>
		</div>
	</div>
</div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
</body>
</html>