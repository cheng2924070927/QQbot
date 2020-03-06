<?php
/**
 * 分类管理
**/
include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$numrows=$DB->count("SELECT count(*) from shua_class");
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>排序操作</th><th style="min-width:150px">名称（<?php echo $numrows?>）</th><th>操作</th></tr></thead>
          <tbody><form id="classlist">
<?php

$rs=$DB->query("SELECT * FROM shua_class WHERE 1 order by sort asc");
while($res = $DB->fetch($rs))
{
	echo '<tr><td>
	<a class="btn btn-xs sort_btn" title="移到顶部" onclick="sort('.$res['cid'].',0)"><i class="fa fa-long-arrow-up"></i></a><a class="btn btn-xs sort_btn" title="移到上一行" onclick="sort('.$res['cid'].',1)"><i class="fa fa-chevron-circle-up"></i></a><a class="btn btn-xs sort_btn" title="移到下一行" onclick="sort('.$res['cid'].',2)"><i class="fa fa-chevron-circle-down"></i></a><a class="btn btn-xs sort_btn" title="移到底部" onclick="sort('.$res['cid'].',3)"><i class="fa fa-long-arrow-down"></i></a>
	</td><td><input type="text" class="form-control input-sm" name="name'.$res['cid'].'" value="'.$res['name'].'" placeholder="分类名称" required></td><td><span class="btn btn-primary btn-sm" onclick="editClass('.$res['cid'].')">修改</span>&nbsp;'.($res['active']==1?'<span class="btn btn-sm btn-success" onclick="setActive('.$res['cid'].',0)">显示</span>':'<span class="btn btn-sm btn-warning" onclick="setActive('.$res['cid'].',1)">隐藏</span>').'&nbsp;<a href="./shoplist.php?cid='.$res['cid'].'" class="btn btn-info btn-sm">商品</a>&nbsp;<span class="btn btn-sm btn-danger" onclick="delClass('.$res['cid'].')">删除</span></td></tr>';
}
echo '<tr><td><span class="btn btn-primary btn-sm" onclick="saveAll()">保存全部</span></td><td><input type="text" class="form-control input-sm" name="name" placeholder="分类名称" required></td><td colspan="3"><span class="btn btn-success btn-sm" onclick="addClass()"><span class="glyphicon glyphicon-plus"></span> 添加分类</span>&nbsp;&nbsp;<a href="./classlist.php?my=classimg" class="btn btn-info btn-sm">修改分类图片</a></td></tr>';
?>
          </tbody>
        </table>
      </div>