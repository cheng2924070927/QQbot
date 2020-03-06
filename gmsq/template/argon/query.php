<?php
if(!defined('IN_CRONLITE'))exit();
include_once TEMPLATE_ROOT.'argon/head.php';
?>
    <div class="container-fluid mt--7">
      <div class="row" style="max-width:1200px;margin:0 auto;">
        <div class="col text-center">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">在线查单</h3>
            </div>
            <div class="card-body px-0">
               <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-12 shuaibi-but10">
                      <div class="panel-body">
                        <div class="alert alert-success px-0" role="alert" ><?php echo $conf['gg_search']?></div>
	                  </div>
                  </div>
                  <div class="col-lg-8 col-12">
                        <div class="form-group">
							<div class="input-group focused text-left">
								<div class="input-group-btn">
									<select class="form-control" id="searchtype" style="padding: 6px 4px;width:100px"><option value="0">下单账号</option><option value="1">订单号</option></select>
								</div>
								<input type="text" name="qq" id="qq3" value="" class="form-control pl-2" placeholder="请输入要查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
								<div class="input-group-append">
									<a href="#querydoc" class="btn btn-danger shuaibi-dow0" data-toggle="modal"><i class="fa fa-question-circle"></i></a>
								</div>
							</div>
                        </div>
                        <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
                        <div id="result2" class="form-group" style="display:none;">
                          <center class="my-1 d-md-none"><small><font color="#ff0000">下方表单可以左右滑动哦！</font></small></center>
                            <div class="table-responsive">
                                <table class="table table-vcenter table-condensed table-striped">
                                <thead><tr><th class="d-none d-md-block">下单账号</th><th>商品名称</th><th>数量</th><th>购买时间</th><th>状态</th><th>操作</th></tr></thead>
                                <tbody id="list">
                                </tbody>
                                </table>
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
        <div class="modal fade" id="querydoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">怎么查询订单？</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font><hr>
                        <div class="bd-example">
                            <details>
                                <summary>QQ相关业务查单教程</summary>
                                <p>例如您购买的是QQ名片赞，输入下单时填写的QQ账号即可查询订单！</p>
                            </details>
                            <details>
                                <summary>邮箱类业务查单教程</summary>
                                <p>例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的！需要填写完整的邮箱账号！</p>
                            </details>
                            <details>
                                <summary>快手类业务查单教程</summary>
                                <p>例如您购买的是快手商品，需要在浏览器打开您的作品链接，然后查看作品链接里“userid=”后面的字母，输入快手号是一般是查询不到的！</p>
                            </details>
                            <details>
                                <summary>抖音类业务查单教程</summary>
                                <p>例如您购买的是抖音商品，需要在浏览器打开您的作品链接，然后查看作品链接里“user/”后面的字母，输入快手号是一般是查询不到的！</p>
                            </details>
                            <details>
                                <summary>全民K歌类业务查单教程</summary>
                                <p>例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的！</p>
                            </details>
                        </div><hr>
                        <font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">好的</button>
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
var homepage=false;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>