<?php
/**
 * 余额提现处理
**/
include("../includes/common.php");
$title='余额提现处理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-md-12 center-block" style="float: none;">
<div class="block">
<div class="block-title clearfix">
<h2>余额提现列表</h2>
</div>
<form method="get">
		<input type="hidden" name="my" value="search">
		<div class="input-group xs-mb-15">
			<input type="text" placeholder="请输入要搜索的提现账号或者姓名！" name="kw"
				   class="form-control text-center"
				   required>
			<span class="input-group-btn">
			<button type="button" id="search_submit" class="btn btn-primary">立即搜索</button>
			<a onclick="listTable('type=2')" style="margin-left:5px;" class="btn btn-danger hidden-xs">QQ钱包</a>
			<a onclick="listTable('type=1')" style="margin-left:5px;margin-right:5px;" class="btn btn-info hidden-xs">微信</a>
			<a onclick="listTable('type=0')" class="btn btn-warning hidden-xs">支付宝</a>
			</span>
		</div>
	</form>
<div id="listTable"></div>
    </div>
  </div>
</div>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
function listTable(query){
	var url = window.document.location.href.toString();
	var queryString = url.split("?")[1];
	query = query || queryString;
	if(query == 'start' || query == undefined){
		query = '';
		history.replaceState({}, null, './tixian.php');
	}else if(query != undefined){
		history.replaceState({}, null, './tixian.php?'+query);
	}
	layer.closeAll();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'tixian-table.php?'+query,
		dataType : 'html',
		cache : false,
		success : function(data) {
			layer.close(ii);
			$("#listTable").html(data)
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function inputInfo(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=getTixian&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.open({
				  type: 1,
				  title: '修改数据',
				  skin: 'layui-layer-rim',
				  content: data.data
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function saveInfo(id) {
	var pay_type=$("#pay_type").val();
	var pay_account=$("#pay_account").val();
	var pay_name=$("#pay_name").val();
	if(pay_account=='' || pay_name==''){layer.alert('请确保每项不能为空！');return false;}
	$('#save').val('Loading');
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=editTixian",
		data : {id:id,pay_type:pay_type,pay_account:pay_account,pay_name:pay_name},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				window.location.reload();
			}else{
				layer.alert(data.msg);
			}
			$('#save').val('保存');
		} 
	});
}
function skimg(zid){
	layer.open({
		type: 1,
		area: ['360px', '400px'],
		title: '站点'+zid+'的收款图查看',
		shade: 0.3,
		anim: 1,
		shadeClose: true, //开启遮罩关闭
		content: '<center><img width="300px" src="../assets/img/skimg/sk_'+zid+'.png"></center>'
	});
}
function back(id, money) {
	var confirmobj = layer.confirm('你确实要将'+money+'元退回到该分站余额吗？', {
	  btn: ['确定','取消']
	}, function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=opTixian",
			data : {id:id,op:'back'},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					listTable();
					layer.alert(data.msg);
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	}, function(){
	  layer.close(confirmobj);
	});
}
function delItem(id) {
	var confirmobj = layer.confirm('你确实要删除此记录吗？', {
	  btn: ['确定','取消']
	}, function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=opTixian",
			data : {id:id,op:'delete'},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					listTable();
					layer.alert(data.msg);
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	}, function(){
	  layer.close(confirmobj);
	});
}
function operation(id,op) {
	if(op == 'back'){
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=opTixian",
		data : {id:id,op:op},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				listTable();
				layer.alert(data.msg);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
$(document).ready(function(){
	listTable();
	$("#search_submit").click(function(){
		var kw=$("input[name='kw']").val();
		if(kw == ''){
			listTable('start');
		}else{
			listTable('kw='+kw);
		}
	});
})
</script>