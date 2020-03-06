<?php  
include('../includes/common.php');
$title='抽奖配置';
include('head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$fl=$DB->query('SELECT * FROM shua_class WHERE active=1 order by sort asc');
$select='<option value="0">请选择分类</option>';
$shua_class[0]='默认分类';
while ($res=$DB->fetch($fl)) 
{
	$shua_class[$res['cid']]=$res['name'];
	$select .='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
$select2='<option value="0">请选择商品</option>';
echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">添加奖项</h4>
           </div>
           <div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">奖品名称</div>
						<input type="text" id="name" class="form-control" placeholder="请填写奖项名称">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">中奖几率</div>
						<input type="number" id="rate" class="form-control" placeholder="请填写中奖几率(百分比)">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">对应分类</div>
						<select id="cid" class="form-control">';
echo $select;
echo '</select>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">对应商品</div>
						<select id="tid" class="form-control">';
echo $select2;
echo '</select>
					</div>
				</div>
				<div class="form-group">
					<a class="btn btn-info btn-block" id="submit" data-dismiss="modal">确定添加</a>
				</div>
			</div>
       </div>
   </div>
</div>
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="edit_title">编辑奖项</h4>
           </div>
           <div class="modal-body">
			<input type="hidden" id="edit_val">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">奖品名称</div>
						<input type="text" id="edit_name" class="form-control" placeholder="请填写奖项名称">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">中奖几率</div>
						<input type="number" id="edit_rate" class="form-control" placeholder="请填写中奖几率(百分比)">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">对应分类</div>
						<select id="edit_cid" class="form-control" default="">';
echo $select;
echo '</select>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">对应商品</div>
						<select id="edit_tid" class="form-control">';
echo $select2;
echo '</select>
					</div>
				</div>
				<div class="form-group">
					<a class="btn btn-info btn-block" onclick="edit_ok($(\'#edit_val\').val())">确定修改</a>
				</div>
			</div>
       </div>
   </div>
</div>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;" id="main">
<div class="block">
<div class="block-title">
<h3 class="panel-title"><b>抽奖配置</b></h3>
</div>
<div class="">
<div class="form-group">
<div class="input-group">
<div class="input-group-addon">是否开启抽奖</div>
<select id="gift_open" class="form-control" default="';
echo $conf['gift_open'];
echo '">
<option value="0">0_关闭</option>
<option value="1">1_开启</option>
</select>
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-addon">每日每人抽奖次数</div>
<input class="form-control" type="number" id="cishu" value="';
echo $conf['cjcishu'];
echo '">
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-addon">抽奖上限提示信息</div>
<input class="form-control" type="text" id="cjmsg" value="';
echo $conf['cjmsg'];
echo '">
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-addon">抽奖付费金额</div>
<input class="form-control" type="text" id="cjmoney" value="';
echo $conf['cjmoney'];
echo '" placeholder="填0则不需要付费">
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-addon">是否显示中奖记录</div>
<select id="gift_log" class="form-control" default="';
echo $conf['gift_log'];
echo '">
<option value="0">0_关闭</option>
<option value="1">1_开启</option>
</select>
</div>
</div>
<a class="btn btn-info btn-block" id="cishu_submit">保存</a>
</div>
</div>
<div class="block">
<div class="block-title">
<h3 class="panel-title"><b>抽奖商品列表</b></h3>
</div>
<div class="">
<a class="btn btn-success" data-toggle="modal" data-target="#myModal">添加一个奖项</a>&nbsp;<a class="btn btn-warning" href="choujiang_list.php">查看中奖记录</a>
</div>
<table class="table table-striped" id="tab">
<thead><tr><th>奖品名称</th><th>对应商品</th><th>中奖几率</th><th>操作</th></tr></thead>
<tbody>
';
$rs=$DB->query('SELECT a.*,(SELECT b.name FROM shua_tools as b WHERE a.tid=b.tid) as shopname FROM shua_gift as a');
while ($row=$DB->fetch($rs)) 
{
	echo '<tr><td>'.$row['name'].'</td><td>'.$row['shopname'].'</td><td>'.$row['rate'].'%</td><td><a href="javascript:void(0)" onclick="editmember(\''.$row['id'].'\')" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="del_member(\''.$row['id'].'\')">删除</a></td></tr>';
}
echo '</tbody>
</table>
</div>
</div>
</div>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
$("#cishu_submit").click(function(){
	ii=layer.load(1,{shade:0.3});
	$.ajax({
		type:"get",
		url:"ajax.php?act=cishu&cishu="+$("#cishu").val()+"&gift_open="+$("#gift_open").val()+"&gift_log="+$("#gift_log").val()+"&cjmsg="+$("#cjmsg").val()+"&cjmoney="+$("#cjmoney").val(),
		dataType:"json",
		success:function(cishu){
			layer.close(ii);
			if(cishu.code==0){
				layer.msg(\'保存成功\',{icon:1,time:1000,shade:0.3});
			}else{
				layer.alert(cishu.msg);
			}
		}
	});
});
function editmember(id){
	ii=layer.load(1);
	$.ajax({
		type:"post",
		url:"ajax.php?act=edit_cj",
		data:{
			id:id
		},
		dataType:"json",
		success:function(edit){
			layer.close(ii);
			if(edit.code==0){
				$("#edit_val").val(edit.id);
				$("#edit_name").val(edit.name);
				$("#edit_rate").val(edit.rate);
				$("#edit_cid").val(edit.cid);
				$("#edit_tid").attr(\'default\',edit.tid);
				$("#edit_modal").modal(\'show\');
				$("#edit_cid").change();
			}else{
				layer.alert(edit.msg);
			}
		}
	});
}
function del_member(id){
	ii=layer.load(1);
	$.ajax({
		type:"post",
		url:"ajax.php?act=del_member",
		data:{
			id:id
		},
		dataType:"json",
		success:function(del){
			layer.close(ii);
			if(del.code==0){
				layer.msg(del.msg,{icon:1,time:1500,shade:0.3});
				$.ajax({
					type:"get",
					url:"choujiang.php",
					dataType:"html",
					success:function(html){
						$("#tab").html($(html).find(\'#tab\').html());
					}
				});
			}else{
				layer.alert(del.msg);
			}
		}
	});
}
function edit_ok(id){
	ii=layer.load(1);
	var name=$("#edit_name").val();
	var cid=$("#edit_cid").val();
	var tid=$("#edit_tid").val();
	var rate=$("#edit_rate").val();
	if(!name||tid==0 || rate==\'\'){
		layer.msg("请输入完整！",{icon:2,time:1000,shade:0.3});
		layer.close(ii);
		return false;
	}
	$.ajax({
		type:"post",
		url:"ajax.php?act=edit_cj_ok",
		data:{
			id:id,name:name,tid:tid,rate:rate
		},
		dataType:"json",
		success:function(add){
			$("#edit_modal").modal(\'hide\');
			if(add.code==0){
				layer.close(ii);
				layer.msg(add.msg,{icon:1,shade:0.3,time:1500});
				window.location.href="choujiang.php";
			}else{
				layer.close(ii);
				layer.alert(add.msg);
			}
		}
	});
}
$("#cid").change(function () {
	var cid = $(this).val();
	var ii = layer.load(2, {shade:[0.1,\'#fff\']});
	$("#tid").empty();
	$("#tid").append(\'<option value="0">请选择商品</option>\');
	$.ajax({
		type : "GET",
		url : "../ajax.php?act=gettool&cid="+cid,
		dataType : \'json\',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#tid").append(\'<option value="\'+res.tid+\'">\'+res.name+\'</option>\');
					num++;
				});
				$("#tid").val(0);
				if(num==0 && cid!=0)layer.alert(\'该分类下没有商品\');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	});
});
$("#edit_cid").change(function () {
	var cid = $(this).val();
	var ii = layer.load(2, {shade:[0.1,\'#fff\']});
	$("#edit_tid").empty();
	$("#edit_tid").append(\'<option value="0">请选择商品</option>\');
	$.ajax({
		type : "GET",
		url : "../ajax.php?act=gettool&cid="+cid,
		dataType : \'json\',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#edit_tid").append(\'<option value="\'+res.tid+\'">\'+res.name+\'</option>\');
					num++;
				});
				$("#edit_tid").val($("#edit_tid").attr(\'default\'));
				if(num==0 && cid!=0)layer.alert(\'该分类下没有商品\');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	});
});
window.onload=$("#cid").change();
$("#submit").click(function(){
	ii=layer.load(1);
	var name=$("#name").val();
	var cid=$("#cid").val();
	var tid=$("#tid").val();
	var rate=$("#rate").val();
	if(!name){
		layer.msg("请输入完整！",{icon:2,time:1000,shade:0.3});
		layer.close(ii);
		return false;
	}
	$.ajax({
		type:"post",
		url:"ajax.php?act=add_member",
		data:{
			name:name,tid:tid,rate:rate
		},
		dataType:"json",
		success:function(add){
			if(add.code==0){
				$(".modal-backdrop").remove();
				layer.close(ii);
				layer.msg(add.msg,{icon:1,shade:0.3,time:1500});
				$.ajax({
					type:"get",
					url:"choujiang.php",
					dataType:"html",
					success:function(html){
						$("#tab").html($(html).find(\'#tab\').html());
					}
				});
			}else{
				layer.close(ii);
				layer.alert(add.msg);
			}
		}
	});
});
</script>
</body>
</html>';