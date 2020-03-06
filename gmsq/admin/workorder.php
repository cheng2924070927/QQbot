<?php
include("../includes/common.php");
$title = '工单列表';
include("./head.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$count1=$DB->count('SELECT count(*) FROM shua_workorder WHERE 1');
$count2=$DB->count('SELECT count(*) FROM shua_workorder WHERE status=0');
$count3=$DB->count('SELECT count(*) FROM shua_workorder WHERE status=1');
$count4=$DB->count('SELECT count(*) FROM shua_workorder WHERE status=2');
				if (isset($_GET['status'])) 
				{
					$status=intval($_GET['status']);
					$sql=' status='.$status;
				}
				else 
				{
					$sql=' 1';
				}
?>
<div class="row">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="block">
<div class="block-title clearfix">
<h2>工单列表&nbsp;&nbsp;<a href="javascript:listTable('start')" class="btn btn-primary btn-xs">全部(<?php echo $count1?>)</a>&nbsp;<a href="javascript:listTable('status=0')" class="btn btn-info btn-xs">待处理(<?php echo $count2?>)</a>&nbsp;<a href="javascript:listTable('status=1')" class="btn btn-warning btn-xs">处理中(<?php echo $count3?>)</a>&nbsp;<a href="javascript:listTable('status=2')" class="btn btn-success btn-xs">已完成(<?php echo $count4?>)</a></h2>
</div>
<div id="listTable"></div>
    </div>
  </div>
</div>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
var checkflag1 = "false";
function check1(field) {
if (checkflag1 == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag1 = "true";
return "false"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag1 = "false";
return "true"; }
}

function unselectall1()
{
    if(document.form1.chkAll1.checked){
	document.form1.chkAll1.checked = document.form1.chkAll1.checked&0;
	checkflag1 = "false";
    } 	
}

function listTable(query){
	var url = window.document.location.href.toString();
	var queryString = url.split("?")[1];
	query = query || queryString;
	if(query == 'start' || query == undefined){
		query = '';
		history.replaceState({}, null, './workorder.php');
	}else if(query != undefined){
		history.replaceState({}, null, './workorder.php?'+query);
	}
	layer.closeAll();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'workorder-table.php?'+query,
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
function orderItem(id){
	var url = './workorder-item.php?my=view&id='+id;
	layer.open({
      type: 2,
      title: 'ID:'+id+' 工单详情',
      shadeClose: true,
      shade: false,
      area: ['100%', '100%'],
      content: url,
	  cancel: function(){
		  listTable()
	  }
    });
}
function change(){
	if($("select[name='aid']").val() == 3 && $("input[name='content']").val()==''){
		layer.prompt({title: '请输入回复的内容', formType: 2}, function(text, index){
			layer.close(index);
			$("input[name='content']").val(text);
			change()
		});
		return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'POST',
		url : 'ajax.php?act=workorder_change',
		data : $('#form1').serialize(),
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				listTable();
				layer.alert(data.msg);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('请求超时');
			listTable();
		}
	});
	return false;
}
$(document).ready(function(){
	listTable();
})
</script>