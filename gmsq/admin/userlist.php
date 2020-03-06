<?php  
include('../includes/common.php');
$title='用户管理';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '    <div class="col-md-12 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
     </div>
     <div class="modal-body">
<input type="text" class="form-control" name="kw" placeholder="请输入用户名"><br/>
<button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
</div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<div class="modal fade" id="modal-rmb">
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
if ($my=='add') 
{
	echo '<div class="block">
<div class="block-title"><h3 class="panel-title">添加一个用户</h3></div>';
	echo '<div class="">';
	echo '<form action="./userlist.php?my=add_submit" method="POST">
<div class="form-group">
<label>用户名:</label><br>
<input type="text" class="form-control" name="user" value="" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="pwd" value="123456" required>
</div>
<div class="form-group">
<label>余额:</label><br>
<input type="text" class="form-control" name="rmb" value="0" required>
</div>
<div class="form-group">
<label>QQ:</label><br>
<input type="text" class="form-control" name="qq" value="">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
	echo '<br/><a href="./userlist.php">>>返回用户列表</a>';
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
		echo '<form action="./userlist.php?my=edit_submit&zid='.$zid.'" method="POST">
<div class="form-group">
<label>上级站点ID:</label><br>
<input type="text" class="form-control" name="upzid" value="'.$row['upzid'].'" disabled>
</div>
<div class="form-group">
<label>余额:</label><br>
<input type="text" class="form-control" name="rmb" value="'.$row['rmb'].'" required>
</div>
<div class="form-group">
<label>QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'">
</div>
<div class="form-group">
<label>重置密码:</label><br>
<input type="text" class="form-control" name="pwd" value="" placeholder="不重置请留空">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
		echo '<br/><a href="./userlist.php">>>返回用户列表</a>';
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
			$user=trim($_POST['user']);
			$pwd=trim($_POST['pwd']);
			$rmb=$_POST['rmb'];
			$qq=trim($_POST['qq']);
			if (($user==NULL || $pwd==NULL) || $qq==NULL) 
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
				$sql='insert into `shua_site` (`power`,`user`,`pwd`,`rmb`,`qq`,`addtime`,`status`) values (0,\''.$user.'\',\''.$pwd.'\',\''.$rmb.'\',\''.$qq.'\',\''.$date.'\',\'1\')';
				if ($DB->query($sql)) 
				{
					showmsg('添加用户成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a>',1);
				}
				else 
				{
					showmsg('添加用户失败！'.$DB->error(),4);
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
				$rmb=$_POST['rmb'];
				$qq=trim($_POST['qq']);
				if (!empty($_POST['pwd'])) 
				{
					$sql=',pwd=\''.$_POST['pwd'].'\'';
				}
				if ($rmb==NULL) 
				{
					showmsg('保存错误,请确保每项都不为空!',3);
				}
				else 
				{
					if ($DB->query('update shua_site set rmb=\''.$rmb.'\',qq=\''.$qq.'\''.$sql.' where zid=\''.$zid.'\'')) 
					{
						showmsg('修改用户成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a>',1);
					}
					else 
					{
						showmsg('修改用户失败！'.$DB->error(),4);
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
						showmsg('删除成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a>',1);
					}
					else 
					{
						showmsg('删除失败！'.$DB->error(),4);
					}
				}
				else 
				{
					$numrows=$DB->count('SELECT count(*) from shua_site WHERE power=0');
					echo '<div class="block">
<div class="block-title clearfix">
<h2>系统共有 <b>';
					echo $numrows;
					echo '</b> 个用户</h2>
</div>
<a href="./userlist.php?my=add" class="btn btn-primary">添加用户</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;<a href="javascript:listTable(\'start\')" class="btn btn-default" title="刷新用户列表"><i class="fa fa-refresh"></i></a>
<div id="listTable"></div>
';
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
		history.replaceState({}, null, './userlist.php');
	}else if(query != undefined){
		history.replaceState({}, null, './userlist.php?'+query);
	}
	layer.closeAll();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	\$.ajax({
		type : 'GET',
		url : 'userlist-table.php?'+query,
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
});
\$(document).ready(function(){
	listTable();
})
</script>";
?>