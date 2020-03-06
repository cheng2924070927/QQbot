<?php
if(!defined('IN_CRONLITE'))exit();
$classhide = explode(',',$siterow['class']);
?>
<?php
if($conf['ui_shop']==1){
//分类图片宫格
?>
	<div id="goodType" <?php if(isset($_GET['cid'])){?>style="display: none"<?php }?>>
	<div class="row">
<?php
$rs=$DB->query("select * from shua_class where active=1 order by sort asc");
while($row = $DB->fetch($rs)){
	if($is_fenzhan && in_array($row['cid'], $classhide))continue;
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
	$count=$DB->count("SELECT count(*) from shua_tools where cid={$row['cid']} and active=1");
?>
		<div class="col-lg-4 col-xs-6">
			<a href="javascipt:void(0)" class="widget animation-fadeInQuick goodTypeChange" data-id="<?php echo $row["cid"]?>">
				<img class="lazy" width="100%" data-original="<?php echo $productimg?>">
				<div class="widget-content text-center">
					<strong><?php echo $row["name"]?></strong>
					<p class="text-muted" style="margin-bottom:10px;text-align:center;">分类<?php echo $count?>个商品</p>
					<button type="button" data-id="<?php echo $row["cid"]?>" class="btn btn-rounded btn-info btn-block goodTypeChange">点击进入</button>
				</div>
			</a>
		</div>
<?php
}
?>
	</div>
	</div>
	<div id="goodTypeContent" <?php if(!isset($_GET['cid'])){?>style="display: none"<?php }?>>
		<div style="text-align: center;">
			<img src="" data-name="thumb" width="50%" >
		</div>
		<br>
		<input type="hidden" name="cid" id="cid" value="0"/>
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">选择商品</div>
			<select name="tid" id="tid" class="form-control" onchange="getPoint();"><option value="0">请选择商品</option></select>
		</div></div>
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">商品价格</div>
			<input type="text" name="need" id="need" class="form-control" disabled/>
		</div></div>
		<div class="form-group" id="display_left" style="display:none;">
			<div class="input-group"><div class="input-group-addon">库存数量</div>
			<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
		</div></div>
		<div class="form-group" id="display_num" style="display:none;">
			<div class="input-group">
			<div class="input-group-addon">下单份数</div>
			<span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
			<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
			<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
		</div></div>
		<div id="inputsname"></div>
		<div id="alert_frame" class="alert alert-success animated rubberBand" style="display:none;background: linear-gradient(to right,#71D7A2,#5ED1D7);font-weight: bold;color:white;"></div>
		<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br />
		<button type="button" class="btn btn-default btn-block btn-sm backType">返回重选分类</button><br />
	</div>

<?php
}elseif($conf['ui_shop']==2){
//分类图片列表
?>
	<div id="goodType" <?php if(isset($_GET['cid'])){?>style="display: none"<?php }?>>
	<table class="table table-striped table-borderless table-vcenter table-hover">
         <tbody>
<?php
$rs=$DB->query("select * from shua_class where active=1 order by sort asc");
while($row = $DB->fetch($rs)){
	if($is_fenzhan && in_array($row['cid'], $classhide))continue;
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
	$count=$DB->count("SELECT count(*) from shua_tools where cid={$row['cid']} and active=1");
?>
			<tr class="widget animation-fadeInQuick onclick goodTypeChange" data-id="<?php echo $row["cid"]?>">
                <td class="text-center" style="width: 100px;">
                    <img data-original="<?php echo $productimg?>" width="50" style="height:50px" alt="avatar" class="lazy img-circle img-thumbnail img-thumbnail-avatar">
                </td>
                <td>
                    <h3 class="widget-heading h4"><strong><?php echo $row["name"]?></strong></h3>
					<span class="text-muted">分类<?php echo $count?>个商品</span>
                </td>
                <td class="text-right">
                    <button type="button" data-id="<?php echo $row["cid"]?>" class="btn btn-rounded btn-info goodTypeChange">点击进入</button>
                </td>
            </tr>
<?php
}
?>
		   </tbody>
        </table>
	</div>
	<div id="goodTypeContent" <?php if(!isset($_GET['cid'])){?>style="display: none"<?php }?>>
		<div style="text-align: center;">
			<img src="" data-name="thumb" width="50%" >
		</div>
		<br>
		<input type="hidden" name="cid" id="cid" value="0"/>
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">选择商品</div>
			<select name="tid" id="tid" class="form-control" onchange="getPoint();"><option value="0">请选择商品</option></select>
		</div></div>
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">商品价格</div>
			<input type="text" name="need" id="need" class="form-control" disabled/>
		</div></div>
		<div class="form-group" id="display_left" style="display:none;">
			<div class="input-group"><div class="input-group-addon">库存数量</div>
			<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
		</div></div>
		<div class="form-group" id="display_num" style="display:none;">
			<div class="input-group">
			<div class="input-group-addon">下单份数</div>
			<span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
			<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
			<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
		</div></div>
		<div id="inputsname"></div>
		<div id="alert_frame" class="alert alert-success animated rubberBand" style="display:none;background: linear-gradient(to right,#71D7A2,#5ED1D7);font-weight: bold;color:white;"></div>
		<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br />
		<button type="button" class="btn btn-default btn-block btn-sm backType">返回重选分类</button><br />
	</div>

<?php
}else{
//经典模式
$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">请选择分类</option>';
$select_count=0;
while($res = $DB->fetch($rs)){
	if($is_fenzhan && in_array($res['cid'], $classhide))continue;
	$select_count++;
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
if($select_count==0)$hideclass = true;
?>
		<div id="goodTypeContents">
			<?php echo $conf['alert']?>
			<div class="form-group" id="display_selectclass"<?php if($hideclass){?> style="display:none;"<?php }?>>
				<div class="input-group"><div class="input-group-addon">选择分类</div>
				<select name="tid" id="cid" class="form-control"><?php echo $select?></select>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索商品" id="showSearchBar"></span></div>
			</div></div>
			<div class="form-group" id="display_searchBar" style="display:none;">
				<div class="input-group"><div class="input-group-addon">搜索商品</div>
				<input type="text" id="searchkw" class="form-control" placeholder="搜索商品" onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索" id="doSearch"></span></div>
                <div class="input-group-addon"><span class="glyphicon glyphicon-remove onclick" title="关闭" id="closeSearchBar"></span></div>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control" onchange="getPoint();"><option value="0">请选择商品</option></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品价格</div>
				<input type="text" name="need" id="need" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_left" style="display:none;">
				<div class="input-group"><div class="input-group-addon">库存数量</div>
				<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_num" style="display:none;">
                <div class="input-group">
                <div class="input-group-addon">下单份数</div>
                <span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
				<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
				<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
			</div></div>
			<div id="inputsname"></div>
			<div id="alert_frame" class="alert alert-success animated rubberBand" style="display:none;background: linear-gradient(to right,#71D7A2,#5ED1D7);font-weight: bold;color:white;"></div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br />
		</div>
<?php } ?>