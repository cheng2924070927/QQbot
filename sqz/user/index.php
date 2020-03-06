<?php
include("../includes/common.php");
$title='授权商后台';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">签到萌宠机器人授权商后台管理系统</h3></div>
          <ul class="list-group">
		    <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> <b>用户名：</b> <?=$udata['user']?></li>
			<li class="list-group-item"><span class="glyphicon glyphicon-signal"></span> <b>用户组：</b> <font color="green">授权代理商</font></li>
		    <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>可授权数量：</b> <?=$udata['peie']?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>已授权数量：</b> <?=$sqcount?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?=$date?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>功能菜单：</b> 
              <a href="./list.php?my=add" class="btn btn-xs btn-success">添加授权</a>
            </li>
            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>公告：</b> 
              <span>后台没有做任何多余特效，简洁明白，有利于您的工作效率</span>
            </li>
<li class="list-group-item">
<center><b>如何将用户提交到授权站：</b></center>
<br />
<p>点击后台首页的添加授权按钮，填写相关信息即可添加用户授权，第一个框填写机器人QQ，第二个框填写主人QQ，第三个框选择是否开启此用户，注意别填错了！不然授权站查询不到相关信息！！弄好后访问授权站查询页面试一下能不能查到相关信息！</p>
<hr />
<p>已经说的很明白了，还不懂的话请联系本站客服</p>
            </li>
          </ul>
      </div>
    </div>
  </div>