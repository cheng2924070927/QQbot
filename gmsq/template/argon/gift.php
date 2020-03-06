<?php
if(!defined('IN_CRONLITE'))exit();
if($conf["gift_open"]==0){sysmsg('网站未开启抽奖功能');exit;}
include_once TEMPLATE_ROOT.'argon/head.php';
?>
    <div class="container-fluid mt--7">
      <div class="row" style="max-width:1200px;margin:0 auto;">
        <div class="col text-center">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">每日抽奖</h3>
            </div>
            <div class="card-body px-0">
               <div class="container">
                <div class="row">
                  <div class="col-lg-5 col-12">
                    <div class="card mb-3" id="gift">
                        <div class="card-body text-center">
                            <div class="alert alert-warning">
                                每个人每天可以抽奖 <?php echo $conf["cjcishu"];?> 次哦！
                                </ul>
                            </div>
                            <div id="roll">点击下方按钮开始抽奖</div>
                            <hr>
                            <p>
                              <a class="btn btn-primary btn-block text-white" id="start" style="display:block;">开始抽奖</a>
                              <a class="btn btn-danger btn-block text-white" id="stop" style="display:none;">停止</a>
                            </p> 
                            <div id="result"></div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-7 col-12">
                      <div class="" id="gift">
                        <div class="giftlist" style="display:none;">
                          <li class="list-group-item active"><h3 class="text-white">最新中奖记录</h3></li>
                          <ul class="list-group" id="pst_1"></ul>
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
    <div class="mt-3" style="display:none;">
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
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>