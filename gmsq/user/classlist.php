<?php
/**
 * 分类管理
**/
include("../includes/common.php");
$title='分类管理';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

?>
<style>
<!-- body {  background: linear-gradient(to bottom,#333333,#333333);"background-size:100% 100%; } -->
</style>
   <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="padding-top:70px; float: none;">
     <div class="panel panel-primary">
    <div class="panel-heading" style="background: linear-gradient(to right,#14b7ff,#b221ff);">
        <h3 class="panel-title"><font color="#fff">商品分类管理</font></h3>
    </div>
     
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
$classhide = explode(',',$userrow['class']);
?>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>分类名称</th><th>是否显示</th></tr></thead>
          <tbody><form id="classlist">
<?php

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 ORDER BY sort ASC");
while($res = $DB->fetch($rs))
{
	echo '<tr><td><input type="text" class="form-control input-sm" name="name'.$res['cid'].'" value="'.$res['name'].'" placeholder="分类名称" disabled></td><td>'.(in_array($res['cid'],$classhide)?'<span class="btn btn-sm btn-warning" onclick="setActive('.$res['cid'].',1)">隐藏</span>':'<span class="btn btn-sm btn-success" onclick="setActive('.$res['cid'].',0)">显示</span>').'</td></tr>';
}
?>
			</form>
          </tbody>
        </table>
      </div>
    </div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
function setActive(cid,active) {
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=setClass&cid='+cid+'&active='+active,
		dataType : 'json',
		success : function(data) {
			window.location.reload();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
</script></div>
</div>