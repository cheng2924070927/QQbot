<?php
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if($userrow['power']==2){
	$type = '0,2,4';
}elseif($userrow['power']==1){
	$type = '0,2,3';
}else{
	$type = '0,1';
}
$msgcount=$DB->count("SELECT count(*) FROM shua_message WHERE type IN ($type) AND active=1");
$msgread = explode(',',$userrow['msgread']);
$limit=isset($_GET['limit'])?intval($_GET['limit']):10;
$rs=$DB->query("SELECT * FROM shua_message WHERE type IN ($type) AND active=1 ORDER BY id DESC LIMIT 0,$limit");
$msgrow=array();
while($res = $DB->fetch($rs)){
	if(in_array($res['id'],$msgread))$res['read']=true;
	else $res['read']=false;
	$msgrow[]=$res;
}

$title = '消息列表';
include 'head.php';

if($conf['ui_bing']==1){
	$background_image='//cdn.qqzzz.net/assets/img/background/'.rand(1,19).'.jpg';
	$conf['ui_background']=3;
}elseif($conf['ui_bing']==2){
	if(date("Ymd")==$conf['ui_bing_date']){
		$background_image=$conf['ui_backgroundurl'];
		if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
	}else{
		$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
		$bing_data = get_curl($url);
		$bing_arr=json_decode($bing_data,true);
		if (!empty($bing_arr['images'][0]['url'])) {
			$background_image='//cn.bing.com'.$bing_arr['images'][0]['url'];
			saveSetting('ui_backgroundurl', $background_image);
			saveSetting('ui_bing_date', date("Ymd"));
			$CACHE->clear();
			if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
		}
	}
	$conf['ui_background']=3;
}else{
	$background_image='../assets/img/bj.png';
}
if($conf['ui_background']==0)
$repeat='background-repeat:repeat;';
elseif($conf['ui_background']==1)
$repeat='background-repeat:repeat-x;
background-size:auto 100%;';
elseif($conf['ui_background']==2)
$repeat='background-repeat:repeat-y;
background-size:100% auto;';
elseif($conf['ui_background']==3)
$repeat='background-repeat:no-repeat;
background-size:100% 100%;';
?>
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
.onclick{cursor: pointer;touch-action: manipulation;}
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="container" style="padding-top:70px;">
	<div class="row">
		<div class="col-sm-12 col-md-6 center-block" style="float: none;">
			<div class="panel panel-default">
			<div class="list-group-item reed text-center" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;<b>消息列表&nbsp;(<?php echo $msgcount?>)</b></font></h3></div>
			<div class="table-responsive">
			<div class="panel-body">
			<table class="table table-hover table-bordered">
				<tbody id="msglist">
<?php
foreach($msgrow as $row){
	echo '<tr class="onclick '.($row['read']?'':'warning').'" onclick="show('.$row['id'].')"><td>'.($row['read']?'<span class="label label-success">已读</span>':'<span class="label label-warning">未读</span>').'&nbsp;<b>'.$row['title'].'</b><br/><small class="pull-right"><font color="grey">'.$row['addtime'].'</font></small></td></tr>';
}
if($msgcount==0){
	echo '<tr><td class="text-center"><font color="grey">消息列表空空如也</font></td></tr>';
}
?>			
			</tbody>
        </table>
		<?php if($msgcount>$limit){?>
		<center><a href="?limit=<?php echo $limit+10;?>" id="btnload">加载更多</a></center>
		<?php }?>
			</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
function show(id) {
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=msginfo&id='+id,
		dataType : 'json',
		success : function(data) {
			if(data.code==0){
				layer.open({
				  type: 1,
				  skin: 'layui-layer-lan',
				  anim: 2,
				  shadeClose: true,
				  title: '查看消息内容',
				  content: '<div class="msg-head"><h4><b>'+data.title+'</b></h4><small><font color="grey">管理员  '+data.date+'</font></small></div><div class="msg-body">'+data.content+'</div>',
				  end: function(){
					  window.location.reload()
				  }
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
</script>