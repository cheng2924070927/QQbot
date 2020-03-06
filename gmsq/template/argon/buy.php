<?php
if(!defined('IN_CRONLITE'))exit();
$cid = isset($_GET['cid'])?$_GET['cid']:exit('分类ID不正确');
$info=$DB->get_row("SELECT * FROM shua_class WHERE cid=$cid");
include_once TEMPLATE_ROOT.'argon/head.php';
?>
    <div class="container-fluid mt--7">
      <div class="row" style="max-width:1200px;margin:0 auto;">
        <div class="col text-center">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0"><?php echo $info['name']?></h3>
            </div>
            <div class="card-body px-0">
               <div class="container">
                <div class="row">
                  <div class="col-lg-6 col-12">
                      <div class="panel-body">
                        <input type="hidden" name="cid" id="cid" value="0"/>
                        <div class="input-group">
                            <div class="input-group-addon">
                                选择商品
                            </div>
                            <select name="tid" id="tid" class="form-control" onChange="getPoint();"><option value="0">请选择商品</option></select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-addon">
                                商品价格
                            </div>
                            <input type="text" name="need" id="need" class="form-control" disabled/>
                        </div>
                        <div class="input-group" id="display_left" style="display:none;">
                            <div class="input-group-addon">
                                库存数量
                            </div>
                            <input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
                        </div>
                        <div class="input-group" id="display_num" style="display:none;">
                            <div class="input-group-prepend">
                                <div class="input-group-addon">
                                    下单份数
                                </div>
                                <span id="num_min" class="btn btn-success wxd-index-bor-rad0" style="border-top-left-radius: .375rem;border-bottom-left-radius: .375rem;"><i class="fa fa-minus"></i></span>
                            </div>
                            <input id="num" name="num" class="form-control" type="number" min="1" value="1" style="text-align:center;"/>
                            <div class="input-group-append">
                                <span id="num_add" class="btn btn-success"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
			            <div id="inputsname"></div>
                        <div  class="alert alert-warning text-left" style="display:none;font-weight: bold;"></div>
			            <input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br/>
	                  </div>
                  </div>
                  <div class="col-lg-6 col-12">
                        <div id="alert_frame" class="alert alert-warning text-left" style="display:none;font-weight: bold;"></div>
                  </div>
                </div>
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
    <div class="mt-3">
        <a class="btn btn-danger wxd-b-but" href="javascript:void(0)" onClick="javascript :history.back(-1);" style="padding:1rem 1.2rem;">
            <i class="fa fa-times fa-2x"></i>
        </a>
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
var isModal=false;
var homepage=false;
var hashsalt=<?php echo $addsalt_js?>;
	setTimeout(function () { 
        layer.tips('点我选择商品哦~', '#tid', {
            tips: [1, '#7788ff'],
            time: 3000
        }); 
    }, 500); 
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>