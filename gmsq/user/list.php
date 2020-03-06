<?php
/**
 * 订单管理
**/
include("../includes/common.php");
$title='订单管理';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索订单</h4>
      </div>
      <div class="modal-body">
      <form action="list.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入下单账号"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" align="left" id="search2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">分类查看订单</h4>
      </div>
      <div class="modal-body">
      <form action="list.php" method="GET">
<select name="type" class="form-control"><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option><option value="4">删除订单</option></select><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
function display_zt($zt){
	if($zt==1)
		return '<font color=green>已完成</font>';
	elseif($zt==2)
		return '<font color=orange>正在处理</font>';
	elseif($zt==3)
		return '<font color=red>异常</font>';
	elseif($zt==4)
		return '<font color=grey>已退款</font>';
	else
		return '<font color=blue>待处理</font>';
}

$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1");
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
}

if(isset($_GET['kw'])) {
	$kw=daddslashes($_GET['kw']);
	$sql=" (`input`='{$kw}' or `id`='{$kw}' or `tradeno`='{$kw}') and zid='{$userrow['zid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='包含 '.$_GET['kw'].' 的共有 <b>'.$numrows.'</b> 个订单';
	$link='&kw='.$_GET['kw'];
}else{
	$numrows=$DB->count("SELECT count(*) from shua_orders where zid='{$userrow['zid']}'");
	$ondate=$DB->count("select count(*) from shua_orders where status=1 and zid='{$userrow['zid']}'");
	$ondate2=$DB->count("select count(*) from shua_orders where status=2 and zid='{$userrow['zid']}'");
	$sql=" zid='{$userrow['zid']}'";
	$con='共有 <b>'.$numrows.'</b> 个订单，其中已完成的有 <b>'.$ondate.'</b> 个，正在处理的有 <b>'.$ondate2.'</b> 个。';
}

$con.='&nbsp;[<a href="#" data-toggle="modal" data-target="#search" id="search">搜索</a>]';

echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>商品名称</th><th>下单账号</th><th>份数</th><th>购买时间</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$shua_func[$res['tid']].'</td><td>'.$res['input'].'</td><td>'.$res['value'].'</td><td>'.$res['addtime'].'</td><td>'.display_zt($res['status']).'</td><td><a href="javascript:showOrder('.$res['id'].',\''.md5($res['id'].SYS_KEY.$res['id']).'\')" title="查看订单详细" class="btn btn-info btn-xs">详细</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
function showOrder(id,skey){
	if(id==0)return false;
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	var status = ['<span class="label label-primary">待处理</span>','<span class="label label-success">已完成</span>','<span class="label label-warning">处理中</span>','<span class="label label-danger">异常</span>','<font color=red>已退款</font>'];
	$.ajax({
		type : "POST",
		url : "../ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table table-condensed table-hover">';
				item += '<tr><td colspan="6" style="text-align:center"><b>订单基本信息</b></td></tr><tr><td class="info">订单编号</td><td colspan="5">'+id+'</td></tr><tr><td class="info">商品名称</td><td colspan="5">'+data.name+'</td></tr><tr><td class="info">订单金额</td><td colspan="5">'+data.money+'元</td></tr><tr><td class="info">购买时间</td><td colspan="5">'+data.date+'</td></tr><tr><td class="info">下单信息</td><td colspan="5">'+data.inputs+'</td></tr><tr><td class="info">订单状态</td><td colspan="5">'+status[data.status]+'</td></tr>';
				if(data.list && data.list.order_state){
					item += '<tr><td colspan="6" style="text-align:center"><b>订单实时状态</b></td><tr><td class="warning">下单数量</td><td>'+data.list.num+'</td><td class="warning">下单时间</td><td colspan="3">'+data.list.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+data.list.start_num+'</td><td class="warning">当前数量</td><td>'+data.list.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+data.list.order_state+'</font></td></tr>';
				}else if(data.kminfo){
					item += '<tr><td colspan="6" style="text-align:center"><b>以下是你的卡密信息</b></td><tr><td colspan="6">'+data.kminfo+'</td></tr>';
				}else if(data.result){
					item += '<tr><td colspan="6" style="text-align:center"><b>处理结果</b></td><tr><td colspan="6">'+data.result+'</td></tr>';
				}
				if(data.alert){
					item += '<tr><td colspan="6" style="text-align:center"><b>商品简介</b></td><tr><td colspan="6">'+data.desc+'</td></tr>';
				}
				item += '</table>';
				layer.open({
				  type: 1,
				  title: '订单详细信息',
				  skin: 'layui-layer-rim',
				  content: item
				});
			}else{
				layer.alert(data.msg);
			}
		}
	});
}
</script>