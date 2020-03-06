<?php
//decode by http://www.anle.ooo/
include("../includes/common.php"); $title='授权站后台'; include './head.php'; if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>"); ?>
<?php
$count1=$DB->count("SELECT count(*) from auth_qqs"); $count2=$DB->count("SELECT count(*) from auth_daili"); $mysqlversion=$DB->count("select VERSION()"); ?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">签到萌宠机器人授权站后台管理系统</h3></div>
          <ul class="list-group">
            <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>授权数量：</b> <?=$count1?></li>
			<li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>代理数量：</b> <?=$count2?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?=$date?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>用户权限：</b> 最高权限帐户</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>功能菜单：</b> 
              <a href="./list.php?my=add" class="btn btn-xs btn-success">添加授权</a>&nbsp;<a href="./log.php" class="btn btn-xs btn-warning">系统日志</a>&nbsp;<a href="https://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes" class="btn btn-xs btn-info"  target="_blank">联系作者</a>
&nbsp;<a href="https://lovek.me" class="btn btn-xs btn-info"  target="_blank">作者博客</a>
            </li>

            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>LovelyGod想说的话：</b> 
              <span>后台没有做任何多余特效，简洁明白，有利于您的工作效率，平台没有写计时功能，请物理记账，到期手工删除授权！我是一名还在学习中的前端萌新，给您带来了不便，抱歉啦！</span>
            </li>
<li class="list-group-item">
<center><b>如何让用户在您的授权站查询到授权信息：</b></center>
<br />
<p>点击添加授权按钮，可添加普通用户授权，第一个框填写机器人QQ，第二个框填写主人QQ，第三个框选择是否开启此用户，注意别填错了！不然授权站查询不到相关信息！！弄好后访问授权站查询页面试一下能不能查到相关信息！</p>
<br />
<center><b>如何给授权商开授权站后台：</b></center>
<br />
<p>选择代理管理面板（按钮在退出登录的左边），点击添加用户按钮，这里是添加授权商的地方！第一个框填写授权商账号（登录授权站后台用），第二个框填写授权商密码（登陆授权站后台用），第三个框填写该授权商可授权多少人，如果是无限授权直接填写99999即可，注意别填错了！第四个框填写授权商的QQ号，第五个框填写该授权商是否开启！</p>
<br />
<center><b>授权商的后台的网址是什么：</b></center>
<br />
<center>授权商后台网址：http(s)://您的域名/sqz/user/</center>
<br />
<center><b>授权商的后台可以做什么：</b></center>
<br />
<p>授权商卖出授权后，有些用户喜欢先来授权站查一下自己的授权是否正版，为了让这类用户第一时间可以在您的授权站内查询到自己的正版授权信息，我们开发了授权商面板，授权商的后台可以直接添加用户授权，不能开授权商！开授权商是您的专属！要告诉您的授权商给用户授权前先来授权站添加正版授权信息！！！</p>
<br />
<hr />
</b>我已经说的很明白了！您如果还不理解可以加我<a href="https://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes"  target="_blank">QQ：2924070927</a>,我会耐心解答</b>
<hr />
有些人想把授权站与机器人官网分离出来，我在这里郑重的告诉你，本套授权站已完美与签到萌宠机器人官网融为一体，分离出来会产生意想不到的bug，这并不是拖拽一个文件夹就能解决的，如果您是全栈大佬您可以尝试分离本套程序！分离后前端所有代码都需要重新整理一遍链接！没有基础的小白禁止尝试！
<hr />
<center><b>以下的话与您的网站没什么关系，您可以忽略掉，没必要浪费您宝贵的时间哦!</b></center>
<hr />
这套机器人官网全站源码是我Lovely God送给在JKJPro用户群内的所有人的！禁止外传！免得其他做签到萌宠插件的拿到本套源码给我们抢生意！
我无偿做这套程序，只希望这款插件能越做越大，感谢插件的开发者<a href="https://wpa.qq.com/msgrd?v=3&uin=1544545655&site=qq&menu=yes"  target="_blank">小凯大大</a>。听说最近代挂网想给我们抢生意了，我们名声不够大想欺负我们不是？大家拿到本套源码搭建好后都修改一下自己的内容，做一下SEO排名优化，上各大搜索引擎排名，关键词尽量设置多个，用户好搜索到！给我在QQ内使劲宣传！官网什么的都给你们做好了！希望大家能团结！抢我生意者，干他！愿这款插件能名声远扬！
            </li>
<li class="list-group-item"><span class="glyphicon glyphicon-stats">
我做这整套源码花了将近半个月，当我第一次在群内发布指令表demo的时候，这个项目就已经开始了！这套程序的所有代码你在网上是不到的！只在JKJPro用户群内公布！
<b><hr /></b>
我是一名还在学习中的前端萌新，写这些纯属是在练习自己的能力，我先后还模仿写过天猫官网、京东官网、bilibili主站等一些出名的站点，不上手练习是学不会的，欢迎感兴趣的小伙伴<a href="https://jq.qq.com/?_wv=1027&k=5f9xMe1"  target="_blank">来我这里一起交流学习！</a>不懂的可以互相问问，等以后群里大佬多了我还指望你们能带带我，嘻嘻~
            </li>
          </ul>
      </div>
	  <div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">服务器信息</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php echo $mysqlversion ?>
		</li>
		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize'); ?>
		</li>
	</ul>
</div>
    </div>
  </div>