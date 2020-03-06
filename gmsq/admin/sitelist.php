<?php  
include('../includes/common.php');
$title='分站管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-md-12 center-block" style="float: none;">
<div class="modal" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <h4 class="modal-title" id="myModalLabel">搜索分站</h4>
     </div>
     <div class="modal-body">
<input type="text" class="form-control" name="kw" placeholder="请输入分站用户名或域名"><br/>
<button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
</div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<div class="modal" align="left" id="search2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <h4 class="modal-title" id="myModalLabel">分类查看</h4>
     </div>
     <div class="modal-body">
<select name="power" class="form-control"><option value="1">普及版</option><option value="2">专业版</option></select><br/>
<button type="button" class="btn btn-primary btn-block" id="search2_submit">查看</button>
</div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<div class="modal" id="modal-rmb">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">余额充值</h4>
			</div>
			<div class="modal-body">
				<form id="form-rmb">
					<input type="hidden" name="zid" value="">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon p-0">
								<select name="do"
										style="-webkit-border-radius: 0;height:20px;border: 0;outline: none !important;border-radius: 5px 0 0 5px;padding: 0 5px 0 5px;">
									<option value="0">充值</option>
									<option value="1">扣除</option>
								</select>
							</span>
							<input type="number" class="form-control" name="rmb" placeholder="输入金额">
							<span class="input-group-addon">元</span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-info" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" id="recharge">确定</button>
			</div>
		</div>
	</div>
</div>

';
$my=(isset($_GET['my'])?$_GET['my']:NULL);
if ($my=='replace') 
{
	echo '<div class="block">
<div class="block-title"><h3 class="panel-title">分站域名批量修改</h3></div>';
	echo '<div class="">';
	echo '<form action="./sitelist.php?my=replace_do" method="POST">
<div class="form-group">
	<div class="input-group"><div class="input-group-addon">原域名</div>
	<input type="text" name="olddomain" value="" class="form-control" placeholder="只填写主域名，例如：domain.com" required/>
</div></div>
<div class="form-group">
	<div class="input-group"><div class="input-group-addon">替换为</div>
	<input type="text" name="newdomain" value="" class="form-control" placeholder="只填写主域名，例如：domain.com" required/>
</div></div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
	echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
	echo '</div></div>';
}
else 
{
	if ($my=='replace_do') 
	{
		$olddomain=trim($_POST['olddomain']);
		$newdomain=trim($_POST['newdomain']);
		if ($olddomain==NULL || $newdomain==NULL) 
		{
			showmsg('请确保每项都不为空！',3);
		}
		else 
		{
			if ($olddomain==$newdomain) 
			{
				showmsg('原域名和新域名不能一样！',3);
			}
			else 
			{
				if (!preg_match('/^[a-zA-Z0-9\\.\\-\\_]+$/',$newdomain) || strpos($newdomain,'.')===false) 
				{
					showmsg('新域名不合法',3);
				}
				else 
				{
					$sql='update shua_site set domain = replace(domain,\''.$olddomain.'\',\''.$newdomain.'\'), domain2 = replace(domain2,\''.$olddomain.'\',\''.$newdomain.'\')';
					if ($DB->query($sql)) 
					{
						showmsg('批量修改域名成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>',1);
					}
					else 
					{
						showmsg('批量修改域名失败！'.$DB->error(),4);
					}
				}
			}
		}
	}
	else 
	{
		if ($my=='add') 
		{
			echo '<div class="block">
<div class="block-title"><h3 class="panel-title">添加一个分站</h3></div>';
			echo '<div class="">';
			echo '<form action="./sitelist.php?my=add_submit" method="POST">
<div class="form-group">
<label>分站类型:</label><br>
<select class="form-control" name="power"><option value="1">普及版</option><option value="2">专业版</option></select>
</div>
<div class="form-group">
<label>管理员用户名:</label><br>
<input type="text" class="form-control" name="user" value="" required>
</div>
<div class="form-group">
<label>管理员密码:</label><br>
<input type="text" class="form-control" name="pwd" value="123456" required>
</div>
<div class="form-group">
<label>绑定域名:</label><br>
<input type="text" class="form-control" name="domain" value="" placeholder="分站要用的域名" required>
</div>
<!--div class="form-group">
<label>额外域名:</label><br>
<input type="text" class="form-control" name="domain2" placeholder="不需要填写" value="">
</div-->
<div class="form-group">
<label>站点余额:</label><br>
<input type="text" class="form-control" name="rmb" value="0" required>
</div>
<div class="form-group">
<label>站长QQ:</label><br>
<input type="text" class="form-control" name="qq" value="">
</div>
<div class="form-group">
<label>到期时间:</label><br>
<input type="date" class="form-control" name="endtime" value="'.date('Y-m-d',strtotime('+1 years')).'" required>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
			echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
			echo '</div></div>';
		}
		else 
		{
			if ($my=='add2') 
			{
				$zid=$_GET['zid'];
				$row=$DB->get_row('select * from shua_site where zid=\''.$zid.'\' limit 1');
				echo '<div class="block">
<div class="block-title"><h3 class="panel-title">添加一个分站</h3></div>';
				echo '<div class="">';
				echo '<form action="./sitelist.php?my=add2_submit&zid='.$zid.'" method="POST">
<div class="form-group">
<label>分站类型:</label><br>
<select class="form-control" name="power"><option value="1">普及版</option><option value="2">专业版</option></select>
</div>
<div class="form-group">
<label>绑定域名:</label><br>
<input type="text" class="form-control" name="domain" value="" placeholder="分站要用的域名" required>
</div>
<!--div class="form-group">
<label>额外域名:</label><br>
<input type="text" class="form-control" name="domain2" placeholder="不需要填写" value="">
</div-->
<div class="form-group">
<label>到期时间:</label><br>
<input type="date" class="form-control" name="endtime" value="'.date('Y-m-d',strtotime('+1 years')).'" required>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
				echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
				echo '</div></div>';
			}
			else 
			{
				if ($my=='edit') 
				{
					$zid=$_GET['zid'];
					$row=$DB->get_row('select * from shua_site where zid=\''.$zid.'\' limit 1');
					echo '<div class="block">
<div class="block-title"><h3 class="panel-title">修改分站信息</h3></div>';
					echo '<div class="">';
					echo '<form action="./sitelist.php?my=edit_submit&zid='.$zid.'" method="POST">
<div class="form-group">
<label>分站类型:</label><br>
<select class="form-control" name="power" default="'.$row['power']."\"><option value=\"1\">普及版</option><option value=\"2\">专业版</option></select>\\r\\n</div>".($row['power']==1?'<div class="form-group">
<label>上级站点ID:</label><br>
<input type="text" class="form-control" name="upzid" value="'.$row['upzid']."\" disabled>\\r\\n</div>":NULL).'<div class="form-group">
<label>绑定域名:</label><br>
<input type="text" class="form-control" name="domain" value="'.$row['domain'].'" required>
</div>
<div class="form-group">
<label>额外域名:</label><br>
<input type="text" class="form-control" name="domain2" value="'.$row['domain2'].'">
</div>
<div class="form-group">
<label>站点余额:</label><br>
<input type="text" class="form-control" name="rmb" value="'.$row['rmb'].'" required>
</div>
<div class="form-group">
<label>站长QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'">
</div>
<div class="form-group">
<label>站点名称:</label><br>
<input type="text" class="form-control" name="sitename" value="'.$row['sitename'].'">
</div>
<div class="form-group">
<label>结算账号:</label><br>
<input type="text" class="form-control" name="pay_account" value="'.$row['pay_account'].'">
</div>
<div class="form-group">
<label>结算姓名:</label><br>
<input type="text" class="form-control" name="pay_name" value="'.$row['pay_name'].'">
</div>
<div class="form-group">
<label>到期时间:</label><br>
<input type="date" class="form-control" name="endtime" value="'.date('Y-m-d',strtotime($row['endtime'])).'" required>
</div>
<div class="form-group">
<label>重置密码:</label><br>
<input type="text" class="form-control" name="pwd" value="" placeholder="不重置请留空">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
					echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
					echo '<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script></div></div>';
				}
				else 
				{
					if ($my=='add_submit') 
					{
						$power=intval($_POST['power']);
						$user=trim($_POST['user']);
						$pwd=trim($_POST['pwd']);
						$domain=trim(strtolower($_POST['domain']));
						$domain2=trim(strtolower($_POST['domain2']));
						$rmb=$_POST['rmb'];
						$qq=trim($_POST['qq']);
						$endtime=$_POST['endtime'];
						$sitename=$conf['sitename'];
						$keywords=$conf['keywords'];
						$description=$conf['description'];
						if ($user==NULL || $pwd==NULL || $domain==NULL || $endtime==NULL) 
						{
							showmsg('保存错误,请确保每项都不为空!',3);
						}
						else 
						{
							$rows=$DB->get_row('select * from shua_site where user=\''.$user.'\' limit 1');
							if ($rows) 
							{
								showmsg('用户名已存在！',3);
							}
							$rows=$DB->get_row('select * from shua_site where domain=\''.$domain.'\' limit 1');
							if ($rows || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode('|',$conf['fenzhan_remain']))) 
							{
								showmsg('域名已存在！',3);
							}
							if ($conf['fenzhan_html']==1) 
							{
								$anounce=$conf['anounce'];
								$alert=$conf['alert'];
							}
							$sql='insert into `shua_site` (`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`alert`,`addtime`,`endtime`,`status`) values (\''.$power.'\',\''.$domain.'\',\''.$domain2.'\',\''.$user.'\',\''.$pwd.'\',\''.$rmb.'\',\''.$qq.'\',\''.$sitename.'\',\''.$keywords.'\',\''.$description.'\',\''.addslashes($anounce).'\',\''.addslashes($alert).'\',\''.$date.'\',\''.$endtime.'\',\'1\')';
							if ($DB->query($sql)) 
							{
								showmsg('添加分站成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>',1);
							}
							else 
							{
								showmsg('添加分站失败！'.$DB->error(),4);
							}
						}
					}
					else 
					{
						if ($my=='add2_submit') 
						{
							$zid=intval($_GET['zid']);
							$rows=$DB->get_row('select * from shua_site where zid=\''.$zid.'\' limit 1');
							if (!$rows) 
							{
								showmsg('当前记录不存在！',3);
							}
							$power=intval($_POST['power']);
							$domain=trim(strtolower($_POST['domain']));
							$domain2=trim(strtolower($_POST['domain2']));
							$endtime=$_POST['endtime'];
							$sitename=$conf['sitename'];
							$keywords=$conf['keywords'];
							$description=$conf['description'];
							if ($domain==NULL || $endtime==NULL) 
							{
								showmsg('保存错误,请确保每项都不为空!',3);
							}
							else 
							{
								$rows=$DB->get_row('select * from shua_site where domain=\''.$domain.'\' limit 1');
								if ($rows || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode('|',$conf['fenzhan_remain']))) 
								{
									showmsg('域名已存在！',3);
								}
								if ($DB->query('update shua_site set power=\''.$power.'\',domain=\''.$domain.'\',domain2=\''.$domain2.'\',rmb=\''.$rmb.'\',qq=\''.$qq.'\',sitename=\''.$sitename.'\',keywords=\''.$keywords.'\',description=\''.$description.'\',endtime=\''.$endtime.'\' where zid=\''.$zid.'\'')) 
								{
									showmsg('添加分站成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a><br/><a href="./sitelist.php">>>返回分站列表</a>',1);
								}
								else 
								{
									showmsg('添加分站失败！'.$DB->error(),4);
								}
							}
						}
						else 
						{
							if ($my=='edit_submit') 
							{
								$zid=intval($_GET['zid']);
								$rows=$DB->get_row('select * from shua_site where zid=\''.$zid.'\' limit 1');
								if (!$rows) 
								{
									showmsg('当前记录不存在！',3);
								}
								$power=intval($_POST['power']);
								$domain=trim(strtolower($_POST['domain']));
								$domain2=trim(strtolower($_POST['domain2']));
								$rmb=$_POST['rmb'];
								$qq=trim($_POST['qq']);
								$endtime=$_POST['endtime'];
								$sitename=$_POST['sitename'];
								$pay_account=$_POST['pay_account'];
								$pay_name=$_POST['pay_name'];
								if (!empty($_POST['pwd'])) 
								{
									$sql=',pwd=\''.$_POST['pwd'].'\'';
								}
								if (($sitename==NULL || $rmb==NULL) || $domain==NULL || $endtime==NULL) 
								{
									showmsg('保存错误,请确保每项都不为空!',3);
								}
								else 
								{
									if ($DB->query('update shua_site set power=\''.$power.'\',domain=\''.$domain.'\',domain2=\''.$domain2.'\',rmb=\''.$rmb.'\',qq=\''.$qq.'\',sitename=\''.$sitename.'\',pay_account=\''.$pay_account.'\',pay_name=\''.$pay_name.'\',endtime=\''.$endtime.'\''.$sql.' where zid=\''.$zid.'\'')) 
									{
										showmsg('修改分站成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>',1);
									}
									else 
									{
										showmsg('修改分站失败！'.$DB->error(),4);
									}
								}
							}
							else 
							{
								if ($my=='delete') 
								{
									$zid=$_GET['zid'];
									$sql='DELETE FROM shua_site WHERE zid=\''.$zid.'\'';
									if ($DB->query($sql)) 
									{
										showmsg('删除成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>',1);
									}
									else 
									{
										showmsg('删除失败！'.$DB->error(),4);
									}
								}
								else 
								{
									$numrows=$DB->count('SELECT count(*) from shua_site');
									echo '<div class="block">
<div class="block-title clearfix">
<h2>系统共有 <b>';
									echo $numrows;
									echo '</b> 个分站</h2>
</div>
<a href="./sitelist.php?my=add" class="btn btn-primary">添加分站</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search2" id="search2" class="btn btn-warning">分类查看</a>&nbsp;<a href="javascript:listTable(\'start\')" class="btn btn-default" title="刷新分站列表"><i class="fa fa-refresh"></i></a>
<div id="listTable"></div>
';
								}
							}
						}
					}
				}
			}
		}
	}
}
echo "    </div>
 </div>
</div>
<script src=\"//cdn.staticfile.org/layer/2.3/layer.js\"></script>
<script>
function listTable(query){
	var url = window.document.location.href.toString();
	var queryString = url.split(\"?\")[1];
	query = query || queryString;
	if(query == 'start' || query == undefined){
		query = '';
		history.replaceState({}, null, './sitelist.php');
	}else if(query != undefined){
		history.replaceState({}, null, './sitelist.php?'+query);
	}
	layer.closeAll();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'GET',
		url : 'sitelist-table.php?'+query,
		dataType : 'html',
		cache : false,
		success : function(data) {
			layer.close(ii);
			\$(\"#listTable\").html(data)
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function showRecharge(zid) {
	\$(\"input[name='zid']\").val(zid);
	\$('#modal-rmb').modal('show');
}
function setSuper(zid) {
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setSuper&zid='+zid,
		dataType : 'json',
		success : function(data) {
			layer.msg('切换成功');
			listTable();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function setActive(zid,active) {
	\$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setSite&zid='+zid+'&active='+active,
		dataType : 'json',
		success : function(data) {
			listTable();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function setEndtime(zid) {
	layer.prompt({title: '需要延时多少个月', value: '12', formType: 0}, function(text, index){
		\$.ajax({
			type : 'POST',
			url : 'ajax.php?act=setEndtime',
			data : {zid:zid,month:text},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					layer.msg(data.msg);
					listTable();
				}else{
					layer.alert(data.msg);
				}
			},
			error:function(data){
				layer.msg('服务器错误');
				return false;
			}
		});
	});
}
\$(document).ready(function(){
	\$(\"#recharge\").click(function(){
		var zid=\$(\"input[name='zid']\").val();
		var actdo=\$(\"select[name='do']\").val();
		var rmb=\$(\"input[name='rmb']\").val();
		if(rmb==''){layer.alert('请输入金额');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		\$.ajax({
			type : \"POST\",
			url : \"ajax.php?act=siteRecharge\",
			data : {zid:zid,actdo:actdo,rmb:rmb},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					layer.msg('修改余额成功');
					\$('#modal-rmb').modal('hide');
					listTable();
				}else{
					layer.alert(data.msg);
				}
			},
			error:function(data){
				layer.msg('服务器错误');
				return false;
			}
		});
	});
	\$(\"#search_submit\").click(function(){
		var kw=\$(\"input[name='kw']\").val();
		\$(\"#search\").modal('hide');
		if(kw == ''){
			listTable('start');
		}else{
			listTable('kw='+kw);
		}
	});
	\$(\"#search2_submit\").click(function(){
		var power=\$(\"select[name='power']\").val();
		\$(\"#search2\").modal('hide');
		if(power == '0'){
			listTable('start');
		}else{
			listTable('power='+power);
		}
	});
});
\$(document).ready(function(){
	listTable();
})
</script>";
?>