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
					<li><a href="./?mod=tools">　<i class="icon">&#xe608;</i><span class="sidebar-nav-mini-hide">　实用工具</span></a></li>
					<li><a href="./?mod=about" class=" active">　<i class="icon">&#xe6f6;</i><span class="sidebar-nav-mini-hide">　关于我们</span></a></li>
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
						<div class="block full">
                            <div class="block-title text-center">
                                <h2>关于我们</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1 col-lg-6 col-lg-offset-3">
                                    <article>
                                        <div>
                                            <div class="widget-content themed-background-flat img-logo-about">
												<p class="desc"><?php echo $conf['sitename']?></p>
												<p class="descp">　最专业的空间业务代刷平台</p>
											</div>
                                            <h3 class="sub-header text-right">
                                                <a href="javascript:void(0)" class="pull-left"><strong> </strong></a>
                                                <small class="text-muted"><em>建立于：<?php echo $conf['build']?></em></small>
                                            </h3>
                                        </div>
                                        <p>　　专业的代刷自助下单平台，优质的售后服务，致力于最专业的代刷平台！</p>
                                        <p>　　我们的货源全部精挑细选全网性价比最高的，实时掌握代刷市场的动态！</p>
										<p>　　选择我们，你将拥有你一个让你一辈子不会后悔服务团队，这里带给你的不光是优质的服务，还有各种下单随机翻倍送的惊喜！</p>
										<p>　　欢迎搭建分站，带给你无尽的赚钱乐趣，你可以把它当成一份娱乐，学会推广，你就会有收入！</p>
									</article>
                                </div>
                            </div>
                        </div>
				</div>	
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