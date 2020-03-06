<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1){include_once TEMPLATE_ROOT.'argon/query.php';exit;}
if(isset($_GET['cid'])){include_once TEMPLATE_ROOT.'argon/buy.php';exit;}
include_once TEMPLATE_ROOT.'argon/head.php';
?>
	<div class="container-fluid mt--7">
      <div class="row" style="max-width:1200px;margin:0 auto;">
        <div class="col text-center">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">在线商城</h3>
            </div>
            <div class="card-body px-0 py-1">
               <div class="container">
                    <div class="alert alert-primary alert-dismissible" role="alert"  style="display:none;">
                        <span class="alert-inner--icon"><i class="fa fa-bell"></i></span>
                        <span class="alert-inner--text"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="row">
<?php
$classhide = explode(',',$siterow['class']);
$rs=$DB->query("select * from shua_class where active=1 order by sort asc");
while($row = $DB->fetch($rs)){
	if($is_fenzhan && in_array($row['cid'], $classhide))continue;
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
?>
		<div class="col-lg-4 col-md-6 col-6 my-2 px-1"><div class="card">   <a href="./?cid=<?php echo $row["cid"]?>" title="<?php echo $row["name"]?>"><img class="card-img-top lazy" data-original="<?php echo $productimg?>" /><div class="card-body p-2"><span class='btn btn-primary btn-block p-2'>点击进入</span></a></div></div></div>
<?php
}
?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="position-fixed wxd-b-menu">
    <div class="mt-3 d-none d-md-block">
        <a class="btn btn-success wxd-b-but" href="#BKefu" data-toggle="modal">
            <i class="fa fa-qq fa-2x"></i>
        </a>
    </div>
    <div class="mt-3 d-none d-md-block">
        <a class="btn btn-primary wxd-b-but" href="#gg" data-toggle="modal">
            <i class="fa fa-bell fa-2x"></i>
        </a>
    </div>
    <div class="mt-3" id="top" style="display: none;">
        <button class="btn btn-info wxd-b-but" style="padding:1rem 1.3rem;">
            <i class="fa fa-angle-up fa-2x"></i>
        </button>
    </div>
</div>

<div class="modal fade" id="BKefu" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div class="py-1 text-center">
                <i class="fa fa-comment-dots fa-3x mb-3"></i>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h6 class="">订单售后客服ＱＱ</h6>
                        <a target="_blank" class="dropdown-item" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"><img border="0" src="//wpa.qq.com/pa?p=2:<?php echo $conf['kfqq']?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/> <?php echo $conf['kfqq']?></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-primary" data-dismiss="modal">知道啦</button> 
            </div>
        </div>
    </div>
</div>

<div class="shuaibi-zhezhao" id="ShuaibiZhezhao"></div>
<div class="shuaibi-zzimg" id="ShuaibiZzimg">
    <span id="ShuaibiZzclose"><i class="fa fa-times fa-3x"></i></span>
    <img src="assets/img/bookmark.png" alt="bookmark">
</div>
<footer class="footer">
    <div class="row align-items-center justify-content-xl-between m-0">
      <div class="col-lg-12">
        <div class="copyright text-center text-muted">
          &copy; 2019 <a href="./" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['sitename']?></a>&nbsp;•&nbsp;<a href="javascript:void(0)" class="font-weight-bold ml-1" onclick="layer.alert('电脑用户请按键盘 <kbd>Ctrl</kbd> + <kbd>D</kbd> 将本站存为书签！', {icon: 7,title: '小提示',skin: 'layui-layer-molv layui-layer-wxd'})">收藏</a>
        </div>
      </div>
    </div>
</footer>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
    var gotop = $("#top");
    $(window).scroll(function () {
        console.log($(window).scrollTop());
    if ($(window).scrollTop() > 288) {
        gotop.fadeIn(588);
    } else {
        gotop.fadeOut(288);
    }
});
gotop.click(function () {
    $('body,html').animate({ scrollTop: 0 }, 688);18 });
});
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>