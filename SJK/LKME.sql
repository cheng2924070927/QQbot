-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2020-03-12 04:44:04
-- 服务器版本: 5.6.43
-- PHP 版本: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `s8921143`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_daili`
--

CREATE TABLE IF NOT EXISTS `auth_daili` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `peie` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `last` datetime DEFAULT NULL,
  `dlip` varchar(15) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `auth_log`
--

CREATE TABLE IF NOT EXISTS `auth_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `auth_log`
--

INSERT INTO `auth_log` (`id`, `uid`, `type`, `date`, `city`, `data`) VALUES
(1, 'anle', '登陆平台', '2020-03-03 16:14:51', '', 'IP:223.90.130.255'),
(2, 'anle', '新增授权', '2020-03-03 16:16:06', '', '10101'),
(3, 'admin', '登陆平台', '2020-03-03 16:17:41', '', 'IP:223.90.130.255'),
(4, 'admin', '登陆平台', '2020-03-03 16:17:47', '', 'IP:223.90.130.255'),
(5, 'admin', '登陆平台', '2020-03-03 18:23:42', '', 'IP:223.90.130.255'),
(6, 'admin', '登陆平台', '2020-03-03 23:36:19', '', 'IP:223.90.130.255'),
(7, 'admin', '登陆平台', '2020-03-03 23:42:03', '', 'IP:223.90.130.255'),
(8, 'admin', '新增授权', '2020-03-03 23:43:31', '', '1'),
(9, 'admin', '删除授权', '2020-03-03 23:44:29', '', '1'),
(10, 'admin', '删除授权', '2020-03-03 23:59:12', '', '10101'),
(11, 'admin', '登陆平台', '2020-03-04 02:35:17', '', 'IP:223.90.130.255'),
(12, 'admin', '登陆平台', '2020-03-04 02:36:50', '', 'IP:223.90.130.255'),
(13, 'admin', '登录平台', '2020-03-04 02:55:35', '', 'IP:223.90.130.255'),
(14, 'admin', '登录平台', '2020-03-04 03:35:52', '', 'IP:223.90.130.255'),
(15, 'admin', '登录平台', '2020-03-04 03:38:11', '', 'IP:223.90.130.255'),
(16, 'admin', '登录平台', '2020-03-04 03:39:28', '', 'IP:223.90.130.255'),
(17, 'admin', '登录平台', '2020-03-04 18:04:20', '', 'IP:223.90.130.255'),
(18, '1', '登陆平台', '2020-03-10 01:38:52', '', 'IP:223.90.130.32'),
(19, '1', '新增授权', '2020-03-10 01:39:51', '', '1'),
(20, 'admin', '新增授权', '2020-03-10 01:40:47', '', '234'),
(21, 'admin', '删除授权', '2020-03-10 01:41:22', '', '234'),
(22, 'admin', '删除授权', '2020-03-10 01:41:25', '', '1'),
(23, '1', '新增授权', '2020-03-10 02:56:50', '', '2924070927'),
(24, '1', '删除授权', '2020-03-10 02:57:10', '', '2924070927'),
(25, 'admin', '登录平台', '2020-03-10 03:08:39', '', 'IP:223.90.130.32'),
(26, 'admin', '登录平台', '2020-03-10 03:29:17', '', 'IP:223.90.130.32'),
(27, 'admin', '登录平台', '2020-03-10 04:12:26', '', 'IP:223.90.130.32'),
(28, 'admin', '新增授权', '2020-03-10 04:12:38', '', '2924070927'),
(29, 'admin', '登录平台', '2020-03-12 04:24:21', '', 'IP:223.90.130.32'),
(30, 'admin', '删除授权', '2020-03-12 04:27:59', '', '2924070927');

-- --------------------------------------------------------

--
-- 表的结构 `auth_qqs`
--

CREATE TABLE IF NOT EXISTS `auth_qqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `qq` varchar(20) NOT NULL,
  `oqq` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `sign` varchar(20) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `auth_user`
--

CREATE TABLE IF NOT EXISTS `auth_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `last` datetime DEFAULT NULL,
  `dlip` varchar(15) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `auth_user`
--

INSERT INTO `auth_user` (`uid`, `user`, `pass`, `last`, `dlip`, `active`) VALUES
(1, 'admin', '123456', '2020-03-12 04:31:17', '223.90.130.32', 1);

-- --------------------------------------------------------

--
-- 表的结构 `shua_cache`
--

CREATE TABLE IF NOT EXISTS `shua_cache` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shua_cache`
--

INSERT INTO `shua_cache` (`k`, `v`) VALUES
('config', 'a:100:{s:10:"adminlogin";s:19:"2020-03-12 03:58:29";s:9:"admin_pwd";s:6:"123456";s:10:"admin_user";s:5:"admin";s:5:"alert";s:0:"";s:11:"alipay2_api";s:1:"0";s:10:"alipay_api";s:1:"5";s:10:"alipay_key";s:0:"";s:10:"alipay_pid";s:0:"";s:7:"anounce";s:1232:"<p>\r\n<li class="list-group-item"><span class="btn btn-danger btn-xs">1</span> 签到萌宠机器人正版销售站</li>\r\n<li class="list-group-item"><span class="btn btn-success btn-xs">2</span> 下单后请联系我们的官方客服QQ：2924070927进行授权</li>\r\n<li class="list-group-item"><span class="btn btn-info btn-xs">3</span> 请在下单后的三天内联系我们，过期作废，请熟知！</li>\r\n<li class="list-group-item"><span class="btn btn-warning btn-xs">4</span> 只要是这里有的都可以正常下单，有问题可以联系客服</li>\r\n<li class="list-group-item"><span class="btn btn-primary btn-xs">5</span>这是一款支持50+签到业务、拥有多种功能的全智能机器人<br />一键签到,一健萌宠，功能丰富多彩！</li>\r\n<div class="btn-group btn-group-justified">\r\n<a target="_blank" class="btn btn-info" href="http://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes"><i class="fa fa-qq"></i> 联系官方客服</a>\r\n<a target="_blank" class="btn btn-warning" href="https://jq.qq.com/?_wv=1027&k=5pfaVtr"><i class="fa fa-users"></i> 加入官方QQ群</a>\r\n<a target="_blank" class="btn btn-danger" href="./"><i class="fa fa-cloud-download"></i> APP下载</a>\r\n</div></p>";s:6:"apikey";s:5:"29240";s:8:"appalert";s:0:"";s:6:"appurl";s:0:"";s:9:"blacklist";s:0:"";s:6:"bottom";s:0:"";s:5:"build";s:10:"2020-03-02";s:10:"captcha_id";s:0:"";s:11:"captcha_key";s:0:"";s:12:"captcha_open";s:1:"0";s:9:"cdnpublic";s:1:"1";s:9:"cdnserver";s:1:"0";s:9:"chatframe";s:0:"";s:5:"cishu";s:1:"3";s:7:"cjcishu";s:1:"3";s:7:"cjmoney";s:1:"0";s:5:"cjmsg";s:89:"您已经抽了三次啦！！！明天再来吧！<br />爱你么么哒~╰(￣ω￣ｏ)";s:10:"codepay_id";s:6:"478561";s:11:"codepay_key";s:32:"pLJYO6htwIbJsUWaGBmVSmGjm0vJiMIA";s:7:"cronkey";s:5:"29240";s:9:"datepoint";s:508:"a:7:{i:0;a:3:{s:4:"date";s:4:"0311";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:1;a:3:{s:4:"date";s:4:"0309";s:6:"orders";s:1:"3";s:5:"money";d:0.029999999999999999;}i:2;a:3:{s:4:"date";s:4:"0308";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:3;a:3:{s:4:"date";s:4:"0305";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:4;a:3:{s:4:"date";s:4:"0304";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:5;a:3:{s:4:"date";s:4:"0303";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:6;a:3:{s:4:"date";s:4:"0302";s:6:"orders";s:1:"0";s:5:"money";d:0;}}";s:4:"ddxg";s:4:"9999";s:11:"description";s:112:"这是一款支持50+签到业务的机器人,一键签到,一健萌宠，QQ空间云访客，功能丰富多彩";s:8:"epay_key";s:0:"";s:8:"epay_pid";s:0:"";s:8:"epay_url";s:0:"";s:10:"faka_input";s:1:"0";s:9:"faka_mail";s:231:"<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>签到萌宠机器人官网<br/>[domain]";s:12:"fanghong_url";s:38:"https://www.99zuan.cn/dwz.php?longurl=";s:11:"fenzhan_buy";s:1:"0";s:12:"fenzhan_cost";s:0:"";s:13:"fenzhan_cost2";s:0:"";s:14:"fenzhan_domain";s:110:"baidu.com,qq.com,请在后台配置一个专属开分站的域名.com,不支持官网域名直接开分站.com";s:13:"fenzhan_editd";s:0:"";s:14:"fenzhan_expiry";s:2:"12";s:12:"fenzhan_free";s:1:"0";s:12:"fenzhan_html";s:1:"0";s:12:"fenzhan_kami";s:1:"0";s:12:"fenzhan_page";s:1:"0";s:13:"fenzhan_price";s:3:"100";s:14:"fenzhan_price2";s:3:"200";s:14:"fenzhan_remain";s:0:"";s:13:"fenzhan_skimg";s:1:"0";s:16:"fenzhan_template";s:1:"0";s:14:"fenzhan_tixian";s:1:"0";s:15:"fenzhan_upgrade";s:0:"";s:11:"gg_announce";s:0:"";s:8:"gg_panel";s:0:"";s:10:"gg_reguser";s:0:"";s:9:"gg_search";s:464:"<span class="label label-primary">待处理</span> 说明您还没联系到我们的官方客服！请尽快联系！<p></p><p></p><span class="label label-success">已完成</span> 说明您的订单已处理完毕！<p></p><p></p><span class="label label-warning">处理中</span> 说明您正在和官方客服协商！<p></p><p></p><span class="label label-danger">有异常</span> 说明您没有联系我们或您的这一单出现了预料之外的情况！";s:8:"gift_log";s:1:"1";s:9:"gift_open";s:1:"1";s:11:"hide_tongji";s:1:"1";s:6:"iskami";s:1:"0";s:5:"kaurl";s:0:"";s:8:"keywords";s:91:"一键签到,一键萌宠,QQ空间云访客,自助下单,签到萌宠机器人,正版授权";s:4:"kfqq";s:10:"2924070927";s:6:"lqqapi";s:0:"";s:9:"mail_port";s:3:"465";s:9:"mail_smtp";s:11:"smtp.qq.com";s:5:"modal";s:0:"";s:8:"musicurl";s:0:"";s:6:"payapi";s:0:"";s:11:"pricejk_cid";s:1:"1";s:12:"pricejk_edit";s:1:"0";s:12:"pricejk_time";s:3:"600";s:11:"qiandao_day";s:1:"0";s:12:"qiandao_mult";s:1:"0";s:14:"qiandao_reward";s:1:"0";s:6:"qqjump";s:1:"0";s:9:"qqpay_api";s:1:"5";s:12:"shoppingcart";s:1:"1";s:8:"sitename";s:33:"签到萌宠机器人授权购买";s:5:"style";s:1:"1";s:6:"syskey";s:32:"1I21ZjQ14ioQsOglIMSLXWmGwb5AM5aG";s:8:"template";s:8:"yunshang";s:10:"tenpay_api";s:1:"0";s:10:"tenpay_key";s:0:"";s:10:"tenpay_pid";s:0:"";s:5:"title";s:18:"官方正版授权";s:10:"tixian_min";s:2:"10";s:11:"tixian_rate";s:2:"90";s:16:"tongji_cachetime";s:10:"1583179093";s:11:"tongji_time";s:3:"300";s:13:"ui_background";s:1:"3";s:7:"ui_bing";s:1:"0";s:7:"ui_shop";s:1:"2";s:10:"user_level";s:1:"0";s:9:"user_open";s:1:"0";s:11:"verify_open";s:1:"1";s:7:"version";s:4:"2009";s:9:"wxpay_api";s:1:"1";}'),
('tongji', 'a:7:{s:6:"orders";s:1:"0";s:7:"orders1";s:1:"0";s:7:"orders2";s:1:"0";s:5:"money";d:0;s:6:"money1";d:0;s:4:"site";s:1:"0";s:4:"gift";N;}');

-- --------------------------------------------------------

--
-- 表的结构 `shua_cart`
--

CREATE TABLE IF NOT EXISTS `shua_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) unsigned NOT NULL DEFAULT '1',
  `money` varchar(32) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_class`
--

CREATE TABLE IF NOT EXISTS `shua_class` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `shopimg` text,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `shua_class`
--

INSERT INTO `shua_class` (`cid`, `zid`, `sort`, `name`, `shopimg`, `active`) VALUES
(1, 1, 1, '签到萌宠机器人授权', 'https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.4/LovelyGod3.png', 1),
(2, 1, 2, '签到萌宠机器人插件授权', 'https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.4/LovelyGod3.png', 1),
(3, 1, 4, '云服务器购买', 'https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.4/LovelyGod3.png', 1),
(4, 1, 3, '签到萌宠机器人代理/授权商购买', 'https://cdn.jsdelivr.net/gh/cheng2924070927/Blog@v1.0.4/LovelyGod3.png', 1);

-- --------------------------------------------------------

--
-- 表的结构 `shua_config`
--

CREATE TABLE IF NOT EXISTS `shua_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shua_config`
--

INSERT INTO `shua_config` (`k`, `v`) VALUES
('adminlogin', '2020-03-12 04:22:31'),
('admin_pwd', '123456'),
('admin_user', 'admin'),
('alert', ''),
('alipay2_api', '0'),
('alipay_api', '5'),
('alipay_key', ''),
('alipay_pid', ''),
('anounce', '<p>\r\n<li class="list-group-item"><span class="btn btn-danger btn-xs">1</span> 签到萌宠机器人正版销售站</li>\r\n<li class="list-group-item"><span class="btn btn-success btn-xs">2</span> 下单后请联系我们的官方客服QQ：2924070927进行授权</li>\r\n<li class="list-group-item"><span class="btn btn-info btn-xs">3</span> 请在下单后的三天内联系我们，过期作废，请熟知！</li>\r\n<li class="list-group-item"><span class="btn btn-warning btn-xs">4</span> 只要是这里有的都可以正常下单，有问题可以联系客服</li>\r\n<li class="list-group-item"><span class="btn btn-primary btn-xs">5</span>这是一款支持50+签到业务、拥有多种功能的全智能机器人<br />一键签到,一健萌宠，功能丰富多彩！</li>\r\n<div class="btn-group btn-group-justified">\r\n<a target="_blank" class="btn btn-info" href="http://wpa.qq.com/msgrd?v=3&uin=2924070927&site=qq&menu=yes"><i class="fa fa-qq"></i> 联系官方客服</a>\r\n<a target="_blank" class="btn btn-warning" href="https://jq.qq.com/?_wv=1027&k=5pfaVtr"><i class="fa fa-users"></i> 加入官方QQ群</a>\r\n<a target="_blank" class="btn btn-danger" href="./"><i class="fa fa-cloud-download"></i> APP下载</a>\r\n</div></p>'),
('apikey', '29240'),
('appalert', ''),
('appurl', ''),
('blacklist', ''),
('bottom', ''),
('build', '2020-03-02'),
('cache', ''),
('captcha_id', ''),
('captcha_key', ''),
('captcha_open', '0'),
('cdnpublic', '1'),
('cdnserver', '0'),
('chatframe', ''),
('cishu', '3'),
('cjcishu', '3'),
('cjmoney', '0'),
('cjmsg', '您已经抽了三次啦！！！明天再来吧！<br />爱你么么哒~╰(￣ω￣ｏ)'),
('codepay_id', '478561'),
('codepay_key', 'pLJYO6htwIbJsUWaGBmVSmGjm0vJiMIA'),
('cronkey', '29240'),
('datepoint', 'a:7:{i:0;a:3:{s:4:"date";s:4:"0311";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:1;a:3:{s:4:"date";s:4:"0309";s:6:"orders";s:1:"3";s:5:"money";d:0.029999999999999999;}i:2;a:3:{s:4:"date";s:4:"0308";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:3;a:3:{s:4:"date";s:4:"0305";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:4;a:3:{s:4:"date";s:4:"0304";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:5;a:3:{s:4:"date";s:4:"0303";s:6:"orders";s:1:"0";s:5:"money";d:0;}i:6;a:3:{s:4:"date";s:4:"0302";s:6:"orders";s:1:"0";s:5:"money";d:0;}}'),
('ddxg', '9999'),
('description', '这是一款支持50+签到业务的机器人,一键签到,一健萌宠，QQ空间云访客，功能丰富多彩'),
('epay_key', ''),
('epay_pid', ''),
('epay_url', ''),
('faka_input', '0'),
('faka_mail', '<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>签到萌宠机器人官网<br/>[domain]'),
('fanghong_url', 'https://www.99zuan.cn/dwz.php?longurl='),
('fenzhan_buy', '0'),
('fenzhan_cost', ''),
('fenzhan_cost2', ''),
('fenzhan_domain', 'baidu.com,qq.com,请在后台配置一个专属开分站的域名.com,不支持官网域名直接开分站.com'),
('fenzhan_editd', ''),
('fenzhan_expiry', '12'),
('fenzhan_free', '0'),
('fenzhan_html', '0'),
('fenzhan_kami', '0'),
('fenzhan_page', '0'),
('fenzhan_price', '100'),
('fenzhan_price2', '200'),
('fenzhan_remain', ''),
('fenzhan_skimg', '0'),
('fenzhan_template', '0'),
('fenzhan_tixian', '0'),
('fenzhan_upgrade', ''),
('gg_announce', ''),
('gg_panel', ''),
('gg_reguser', ''),
('gg_search', '<span class="label label-primary">待处理</span> 说明您还没联系到我们的官方客服！请尽快联系！<p></p><p></p><span class="label label-success">已完成</span> 说明您的订单已处理完毕！<p></p><p></p><span class="label label-warning">处理中</span> 说明您正在和官方客服协商！<p></p><p></p><span class="label label-danger">有异常</span> 说明您没有联系我们或您的这一单出现了预料之外的情况！'),
('gift_log', '1'),
('gift_open', '1'),
('hide_tongji', '1'),
('iskami', '0'),
('kaurl', ''),
('keywords', '一键签到,一键萌宠,QQ空间云访客,自助下单,签到萌宠机器人,正版授权'),
('kfqq', '2924070927'),
('lqqapi', ''),
('mail_port', '465'),
('mail_smtp', 'smtp.qq.com'),
('modal', ''),
('musicurl', ''),
('payapi', ''),
('pricejk_cid', '1'),
('pricejk_edit', '0'),
('pricejk_time', '600'),
('qiandao_day', '0'),
('qiandao_mult', '0'),
('qiandao_reward', '0'),
('qqjump', '0'),
('qqpay_api', '5'),
('shoppingcart', '1'),
('sitename', '签到萌宠机器人授权购买'),
('style', '1'),
('syskey', '1I21ZjQ14ioQsOglIMSLXWmGwb5AM5aG'),
('template', 'yunshang'),
('tenpay_api', '0'),
('tenpay_key', ''),
('tenpay_pid', ''),
('title', '官方正版授权'),
('tixian_min', '10'),
('tixian_rate', '90'),
('tongji_cachetime', '1583179093'),
('tongji_time', '300'),
('ui_background', '3'),
('ui_bing', '0'),
('ui_shop', '2'),
('user_level', '0'),
('user_open', '0'),
('verify_open', '1'),
('version', '2009'),
('wxpay_api', '1');

-- --------------------------------------------------------

--
-- 表的结构 `shua_faka`
--

CREATE TABLE IF NOT EXISTS `shua_faka` (
  `kid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL,
  `km` varchar(255) DEFAULT NULL,
  `pw` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `usetime` datetime DEFAULT NULL,
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_gift`
--

CREATE TABLE IF NOT EXISTS `shua_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `tid` int(11) unsigned NOT NULL,
  `rate` int(3) NOT NULL,
  `ok` tinyint(1) NOT NULL DEFAULT '0',
  `not` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `shua_gift`
--

INSERT INTO `shua_gift` (`id`, `name`, `tid`, `rate`, `ok`, `not`) VALUES
(2, '1天官方正版机器人插件授权', 11, 0, 0, 0),
(4, '签到萌宠机器人插件永久授权', 10, 0, 0, 0),
(5, '阿里云企业服务器', 10, 0, 0, 0),
(6, '签到萌宠机器人插件正版授权一年', 10, 0, 0, 0),
(7, '钻石代理商', 4, 0, 0, 0),
(8, '授权代理商', 4, 0, 0, 0),
(9, '黄金代理商', 4, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shua_giftlog`
--

CREATE TABLE IF NOT EXISTS `shua_giftlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '0',
  `tid` int(11) unsigned NOT NULL,
  `gid` int(11) unsigned NOT NULL,
  `userid` varchar(32) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `input` varchar(64) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `shua_giftlog`
--

INSERT INTO `shua_giftlog` (`id`, `zid`, `tid`, `gid`, `userid`, `ip`, `addtime`, `tradeno`, `input`, `status`) VALUES
(1, 1, 11, 2, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-03 04:35:50', NULL, NULL, 0),
(2, 1, 0, 3, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-03 04:37:04', NULL, NULL, 0),
(3, 1, 0, 0, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-03 04:37:36', NULL, NULL, 0),
(4, 1, 0, 3, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-03 04:39:19', NULL, NULL, 0),
(5, 1, 0, 3, '464d6c46e563cead1acc866cc75b7cae', '223.90.130.255', '2020-03-04 13:21:11', NULL, NULL, 0),
(6, 1, 0, 3, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-05 02:40:59', NULL, NULL, 0),
(7, 1, 0, 0, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-05 02:45:56', NULL, NULL, 0),
(8, 1, 0, 0, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.255', '2020-03-05 02:46:00', NULL, NULL, 0),
(9, 1, 0, 0, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.32', '2020-03-06 00:34:25', NULL, NULL, 0),
(10, 1, 0, 0, 'f6751eaa4160ae347859a635e77c907e', '223.90.130.32', '2020-03-06 00:59:28', NULL, NULL, 0),
(11, 1, 0, 0, '464d6c46e563cead1acc866cc75b7cae', '223.90.130.32', '2020-03-09 23:53:15', NULL, NULL, 0),
(12, 1, 0, 0, '464d6c46e563cead1acc866cc75b7cae', '223.90.130.32', '2020-03-09 23:53:20', NULL, NULL, 0),
(13, 1, 0, 0, '464d6c46e563cead1acc866cc75b7cae', '223.90.130.32', '2020-03-09 23:53:24', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shua_invite`
--

CREATE TABLE IF NOT EXISTS `shua_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `qq` varchar(20) NOT NULL,
  `key` varchar(30) NOT NULL,
  `ip` varchar(25) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qq` (`qq`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_invitelog`
--

CREATE TABLE IF NOT EXISTS `shua_invitelog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(11) unsigned NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `orderid` int(11) unsigned DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_kms`
--

CREATE TABLE IF NOT EXISTS `shua_kms` (
  `kid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `km` varchar(255) NOT NULL,
  `value` int(11) unsigned NOT NULL DEFAULT '0',
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  `money` varchar(32) DEFAULT NULL,
  `orderid` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_logs`
--

CREATE TABLE IF NOT EXISTS `shua_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(32) NOT NULL,
  `param` varchar(255) NOT NULL,
  `result` text,
  `addtime` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `shua_logs`
--

INSERT INTO `shua_logs` (`id`, `action`, `param`, `result`, `addtime`, `status`) VALUES
(1, '后台登录', 'IP:223.90.130.32', '', '2020-03-05 13:40:13', 1),
(2, '后台登录', 'IP:223.90.130.32', '', '2020-03-09 19:02:50', 1),
(3, '后台登录', 'IP:223.90.130.32', '', '2020-03-09 19:05:11', 1),
(4, '后台登录', 'IP:223.90.130.32', '', '2020-03-09 19:07:18', 1),
(5, '后台登录', 'IP:223.90.130.32', '', '2020-03-09 19:16:08', 1),
(6, '后台登录', 'IP:223.90.130.32', '', '2020-03-10 01:48:19', 1),
(7, '后台登录', 'IP:223.90.130.32', '', '2020-03-12 01:44:34', 1),
(8, '后台登录', 'IP:223.90.130.32', '', '2020-03-12 03:58:29', 1),
(9, '后台登录', 'IP:223.90.130.32', '', '2020-03-12 04:05:20', 1),
(10, '后台登录', 'IP:223.90.130.32', '', '2020-03-12 04:21:41', 1),
(11, '后台登录', 'IP:223.90.130.32', '', '2020-03-12 04:22:31', 1);

-- --------------------------------------------------------

--
-- 表的结构 `shua_message`
--

CREATE TABLE IF NOT EXISTS `shua_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `addtime` datetime NOT NULL,
  `count` int(11) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_orders`
--

CREATE TABLE IF NOT EXISTS `shua_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `input` varchar(128) NOT NULL,
  `input2` varchar(128) DEFAULT NULL,
  `input3` varchar(128) DEFAULT NULL,
  `input4` varchar(128) DEFAULT NULL,
  `input5` varchar(128) DEFAULT NULL,
  `value` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `djzt` tinyint(2) NOT NULL DEFAULT '0',
  `djorder` varchar(32) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `result` text,
  `userid` varchar(32) DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zid` (`zid`),
  KEY `input` (`input`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `shua_orders`
--

INSERT INTO `shua_orders` (`id`, `tid`, `zid`, `input`, `input2`, `input3`, `input4`, `input5`, `value`, `status`, `djzt`, `djorder`, `url`, `result`, `userid`, `tradeno`, `money`, `addtime`, `endtime`) VALUES
(1, 24, 1, '2924070927', '', '', '', '', 1, 1, 0, NULL, NULL, NULL, '5adedc3b1d9290a412cbbad74cc7bc29', '20200309200007441', 0.01, '2020-03-09 21:42:46', NULL),
(2, 24, 1, '292470927', '', '', '', '', 1, 1, 0, NULL, NULL, NULL, '5adedc3b1d9290a412cbbad74cc7bc29', '20200309215108699', 0.01, '2020-03-09 21:53:21', NULL),
(3, 24, 1, '1265818203', '', '', '', '', 1, 0, 0, NULL, NULL, NULL, '5adedc3b1d9290a412cbbad74cc7bc29', '20200309215817889', 0.01, '2020-03-09 21:58:52', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `shua_pay`
--

CREATE TABLE IF NOT EXISTS `shua_pay` (
  `trade_no` varchar(64) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) unsigned NOT NULL DEFAULT '1',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `money` varchar(32) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `inviteid` int(11) unsigned DEFAULT NULL,
  `domain` varchar(64) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shua_pay`
--

INSERT INTO `shua_pay` (`trade_no`, `type`, `zid`, `tid`, `input`, `num`, `addtime`, `endtime`, `name`, `money`, `ip`, `userid`, `inviteid`, `domain`, `status`) VALUES
('20200303002204606', 'qqpay', 1, 1, '2924070927', 1, '2020-03-03 00:22:04', NULL, '签到萌宠机器人授权-月卡', '6', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303044326402', 'qqpay', 1, 19, '2924070927', 1, '2020-03-03 04:43:26', NULL, '测试商品', '0.01', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303044345381', 'wxpay', 1, 19, '2924070927', 1, '2020-03-03 04:43:45', NULL, '测试商品', '0.01', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303044440167', 'alipay', 1, 19, '2924070927', 1, '2020-03-03 04:44:40', NULL, '测试商品', '0.01', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303044743997', 'qqpay', 1, 19, '2924070927', 1, '2020-03-03 04:47:43', NULL, '测试商品', '0.01', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303045110831', 'alipay', 1, 19, '292470927', 1, '2020-03-03 04:51:10', NULL, '测试商品', '0.01', '223.90.130.255', 'f6751eaa4160ae347859a635e77c907e', 0, NULL, 0),
('20200303045941718', 'qqpay', 1, 19, '66666', 1, '2020-03-03 04:59:41', NULL, '测试商品', '0.01', '182.147.12.73', '2d8d10de1dd050e4fc03bbfc04caef44', 0, NULL, 0),
('20200309200007441', 'qqpay', 1, 24, '2924070927', 1, '2020-03-09 20:00:07', '2020-03-09 21:42:46', '测试商品', '0.01', '223.90.130.32', '5adedc3b1d9290a412cbbad74cc7bc29', 0, NULL, 1),
('20200309215108699', 'qqpay', 1, 24, '292470927', 1, '2020-03-09 21:51:08', '2020-03-09 21:53:21', '测试商品', '0.01', '223.90.130.32', '5adedc3b1d9290a412cbbad74cc7bc29', 0, NULL, 1),
('20200309215748143', 'wxpay', 1, 24, '1265818203', 1, '2020-03-09 21:57:48', NULL, '测试商品', '0.01', '223.90.130.32', '5adedc3b1d9290a412cbbad74cc7bc29', 0, NULL, 0),
('20200309215817889', 'alipay', 1, 24, '1265818203', 1, '2020-03-09 21:58:17', '2020-03-09 21:58:53', '测试商品', '0.01', '223.90.130.32', '5adedc3b1d9290a412cbbad74cc7bc29', 0, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shua_points`
--

CREATE TABLE IF NOT EXISTS `shua_points` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '0',
  `action` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bz` varchar(1024) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `orderid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zid` (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_price`
--

CREATE TABLE IF NOT EXISTS `shua_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '0',
  `kind` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 倍数 1 价格',
  `name` varchar(255) NOT NULL,
  `p_0` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_1` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_2` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_qiandao`
--

CREATE TABLE IF NOT EXISTS `shua_qiandao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `qq` varchar(20) DEFAULT NULL,
  `reward` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `continue` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `zid` (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_shequ`
--

CREATE TABLE IF NOT EXISTS `shua_shequ` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `paypwd` varchar(255) DEFAULT NULL,
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `shua_shequ`
--

INSERT INTO `shua_shequ` (`id`, `url`, `username`, `password`, `paypwd`, `paytype`, `type`, `status`) VALUES
(1, 'lovek.me', '测试', '测试对接', '', 1, 12, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shua_site`
--

CREATE TABLE IF NOT EXISTS `shua_site` (
  `zid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `upzid` int(11) unsigned NOT NULL DEFAULT '0',
  `utype` int(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `domain` varchar(50) DEFAULT NULL,
  `domain2` varchar(50) DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `rmb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `point` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) DEFAULT NULL,
  `pay_name` varchar(50) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `sitename` varchar(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `kaurl` varchar(50) DEFAULT NULL,
  `anounce` text,
  `bottom` text,
  `modal` text,
  `alert` text,
  `price` text,
  `ktfz_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_price2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_domain` text,
  `addtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `template` varchar(10) DEFAULT NULL,
  `msgread` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`zid`),
  KEY `domain` (`domain`),
  KEY `domain2` (`domain2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_tixian`
--

CREATE TABLE IF NOT EXISTS `shua_tixian` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) NOT NULL,
  `pay_name` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zid` (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shua_tools`
--

CREATE TABLE IF NOT EXISTS `shua_tools` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `cid` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `value` int(11) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prid` int(11) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prices` varchar(100) DEFAULT NULL,
  `input` varchar(250) NOT NULL,
  `inputs` varchar(255) DEFAULT NULL,
  `desc` text,
  `alert` text,
  `shopimg` text,
  `validate` tinyint(2) NOT NULL DEFAULT '0',
  `permission` tinyint(2) NOT NULL DEFAULT '0',
  `min` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `is_curl` tinyint(2) NOT NULL DEFAULT '0',
  `curl` varchar(255) DEFAULT NULL,
  `repeat` tinyint(2) NOT NULL DEFAULT '0',
  `multi` tinyint(1) NOT NULL DEFAULT '0',
  `shequ` int(3) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_type` int(11) NOT NULL DEFAULT '0',
  `goods_param` varchar(180) DEFAULT NULL,
  `close` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `shua_tools`
--

INSERT INTO `shua_tools` (`tid`, `zid`, `cid`, `sort`, `name`, `value`, `price`, `prid`, `cost`, `cost2`, `prices`, `input`, `inputs`, `desc`, `alert`, `shopimg`, `validate`, `permission`, `min`, `max`, `is_curl`, `curl`, `repeat`, `multi`, `shequ`, `goods_id`, `goods_type`, `goods_param`, `close`, `active`, `uptime`) VALUES
(1, 1, 1, 1, '签到萌宠机器人-月卡', 0, 8.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人正版授权使用一个月，可叠加购买！(下单1份 = 一个月)</center>\r\n<center>本商品是用我们搭建好的机器人，邀请进群直接使用！无需自备服务器！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(2, 1, 1, 2, '签到萌宠机器人-季卡', 0, 23.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人正版授权一季(3个月)，下单1份=3个月，可叠加购买！</center>\r\n<center>本商品是用我们搭建好的机器人，邀请进群直接使用！无需自备服务器！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(3, 1, 1, 3, '签到萌宠机器人-年卡', 0, 70.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人正版授权使用一年，可叠加购买！下单1份 = 一年(12个月)</center>\r\n<center>本商品是用我们搭建好的机器人，邀请进群直接使用！无需自备服务器！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(4, 1, 1, 4, '签到萌宠机器人-官方活动！福利的脚步不停息！', 0, 100.00, 0, 0.00, 0.00, NULL, '请看简介！此商品禁止下单！有钱的大佬随意', '', '<center>邀请您的朋友来购买我们的机器人授权，您的朋友买满两个月我们将奖励您一个月！</center>\r\n<center>也就是说您的朋友在这里一次性买满6个月的话，您可以免费获得3个月的正版授权！</center>\r\n<center>您的朋友如果一次性在这里买了一年的话，您可以免费获得半年的正版授权！</center>\r\n<center>以此类推！</center>\r\n<center>想了解本次活动的更多内容请联系我们的官方客服QQ：2924070927 进行咨询！</center><br />\r\n<center>兑奖方式：</center>\r\n<center>1.联系我们的官方客服QQ：2924070927</certer>\r\n<center>2.提供您朋友的订单号与您朋友的授权主人QQ号和机器人QQ号</center>', '为用户发放福利！感谢您的信任，爱你~', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(5, 1, 2, 5, '签到萌宠机器人插件-月卡', 0, 8.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人插件授权一月，（1份=1个月）可叠加购买！</center>\r\n<center>需要自备服务器！</center>\r\n<center>服务器我们也有卖，价格便宜实惠，配置中等偏上！您的首选！</center>\r\n<center>免除了您辛辛苦苦找服务器商结果服务器又卡又不好用得尴尬场面！</center>\r\n<center>我们提供一站式服务！</center>\r\n', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(6, 1, 2, 6, '签到萌宠机器人插件-季卡', 0, 23.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人插件授权一季(3个月)，（1份=3个月）可叠加购买！</center>\r\n<center>需要自备服务器！</center>\r\n<center>服务器我们也有卖，价格便宜实惠，配置中等偏上！您的首选！</center>\r\n<center>免除了您辛辛苦苦找服务器商结果服务器又卡又不好用得尴尬场面！</center>\r\n<center>我们提供一站式服务！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(7, 1, 2, 7, '签到萌宠机器人插件-年卡', 0, 70.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>签到萌宠机器人插件授权一年，（1份=1年）可叠加购买！</center>\r\n<center>需要自备服务器！</center>\r\n<center>服务器我们也有卖，价格便宜实惠，配置中等偏上！您的首选！</center>\r\n<center>免除了您辛辛苦苦找服务器商结果服务器又卡又不好用得尴尬场面！</center>\r\n<center>我们提供一站式服务！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(9, 1, 2, 9, '签到萌宠机器人插件-永久卡', 0, 200.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>此商品是签到萌宠机器人永久授权！</center>\r\n<center>终身免费使用！购买后联系官方客服QQ：2924070927 授权！</center>\r\n<center>服务器我们也有卖您可以选择使用我们的服务器</center>\r\n<center>价格便宜实惠，配置中等偏上！您的首选！</center>\r\n<center>免除了您辛辛苦苦找服务器商结果服务器又卡又不好用得尴尬场面！</center>\r\n<center>我们提供一站式服务！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(10, 1, 2, 10, '签到萌宠机器人-官方活动！福利的脚步不停息！', 0, 500.00, 0, 0.00, 0.00, NULL, '请看简介！此商品禁止下单！当然，有钱的大佬可以随意！', '', '<center>邀请您的朋友来购买我们的机器人插件授权</center>\r\n<center>您的朋友买满两个月我们将奖励您一个月！</center>\r\n<center>也就是说您的朋友在这里一次性买满6个月的话，您可以免费获得3个月的正版授权！</center>\r\n<center>您的朋友如果一次性在这里买了一年的话，您可以免费获得半年的正版授权！</center>\r\n<center>以此类推！（活动不包括永久卡）</center>\r\n<center>想了解本次活动的更多内容请联系我们的官方客服QQ：2924070927 进行咨询！</center><br />\r\n<center>兑奖方式：</center>\r\n<center>1.联系我们的官方客服QQ：2924070927</center>\r\n<center>2.提供您朋友的订单号与您朋友的授权主人QQ号和机器人QQ号</center>', '为用户发放福利！感谢您的信任，爱你~', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(11, 1, 2, 11, '签到萌宠机器人插件-体验卡', 0, 1.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>此商品是<b>体验一天</b>签到萌宠机器人插件正版授权</center>\r\n<center>购买后联系官方客服QQ：2924070927 授权</center>\r\n<center>服务器我们也有卖，价格便宜实惠，配置中等偏上！您的首选！</center>\r\n<center>免除了您辛辛苦苦找服务器商结果服务器又卡又不好用得尴尬场面！</center>\r\n<center>我们提供一站式服务！</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(12, 1, 1, 12, '签到萌宠机器人-体验卡', 0, 1.00, 0, 0.00, 0.00, NULL, '主人QQ', '机器人QQ', '<center>此商品是体验一天签到萌宠机器人正版授权</center>\r\n<center>购买后联系官方客服QQ：2924070927 授权</center>', '购买后请尽快联系QQ：2924070927进行授权，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(13, 1, 3, 13, '体验版云服务器', 0, 1.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>此商品为1天服务器体验</center>\r\n<center>购买后联系QQ：2924070927 开通服务器！</center>\r\n<center>体验型服务器配置如下：</center>\r\n<center>CPU：2核</center>\r\n<center>内存： 1G ECC</center>\r\n<center>硬盘： 20G SSD</center>\r\n<center>地址： 共享IPv4 1个</center>\r\n<center>带宽：3M峰值</center>\r\n<center>系统： Windows7/10</center>', '购买后联系QQ：2924070927开通服务器，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(14, 1, 3, 14, 'KVM云服务器-热门促销', 0, 5.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>此商品为KVM服务器使用30天，服务器带有控制面板，您可以随心控制！</center>\r\n<center>购买后联系QQ：2924070927 开通服务器！</center>\r\n<center>如果是续费请先联系客服再购买！！买错不退！</center>\r\n<center>服务器配置如下：</center>\r\n<center>CPU：2核</center>\r\n<center>内存： 1G ECC</center>\r\n<center>硬盘： 20G SSD</center>\r\n<center>地址： 共享IPv4 1个</center>\r\n<center>带宽：10M峰值</center>\r\n<center>系统： Windows7/10</center>', '购买后联系QQ：2924070927开通服务器，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 1, 1, 0, 0, 0, 'qq', 0, 1, 0),
(15, 1, 3, 15, '江西云服务器-活动促销', 0, 40.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>此商品为江西服务器使用365天，服务器带有控制面板，您可以随心控制!</center>\r\n<center>购买后联系QQ：2924070927开通服务器</center>\r\n<center>如果是续费请先联系客服再购买！！买错不退！</center>\r\n<center>服务器配置如下：</center>\r\n<center>CPU： 2核</center>\r\n<center>内存： 1G ECC</center>\r\n<center>硬盘： 10G SSD</center>\r\n<center>地址： IPv4 IP 1个</center>\r\n<center>带宽： 100M共享</center>\r\n<center>系统： Windows XP/7/2003</center>', '购买后联系QQ：2924070927开通服务器，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(16, 1, 3, 16, '香港云服务器', 0, 560.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>此商品为香港云服务器使用720天，服务器带有控制面板，您可以随心控制!</center>\r\n<center>购买后联系QQ：2924070927开通服务器</center>\r\n<center>如果是续费请先联系客服再购买！！买错不退！</center>\r\n<center>服务器配置如下：</center>\r\n<center>CPU： 2核</center>\r\n<center>内存： 2G ECC</center>\r\n<center>硬盘： 80G SSD</center>\r\n<center>地址： IPv4 IP 1个</center>\r\n<center>带宽： 2M独享</center>\r\n<center>系统： Windows/Linux</center>', '购买后联系QQ：2924070927开通服务器，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(17, 1, 3, 17, '佛山云服务器A型', 0, 8.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>此商品为佛山A型服务器使用30天</center>\r\n<center>购买后联系QQ：2924070927开通服务器</center>\r\n<center>如果是续费请先联系客服再购买！！买错不退！</center>\r\n<center>佛山A型服务器配置如下：</center>\r\n<center>CPU：双核心</center>\r\n<center>内存： 1024 MB ECC</center>\r\n<center>硬盘： 11G Raid 10</center>\r\n<center>地址：共享IPv4 IP 1个</center>\r\n<center>带宽： 100Mbps 共享</center>\r\n<center>系统： Windows XP/7/2003</center>', '购买后联系QQ：2924070927开通服务器，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(18, 1, 3, 18, '阿里云企业认证', 0, 100.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>阿里云企业认证！</center>\r\n<center>需要您准备一个未注册过阿里云的手机号</center>\r\n<center>帮您阿里云企业认证，然后还送一年阿里云企业级服务器！</center>\r\n<center>阿里云企业级服务器有多强大大家都懂，买来可搭建游戏！</center>\r\n<br />\r\n<center>赠送阿里云企业服务器配置如下：</center>\r\n<center>2核2G，宽带1M，40G高效云盘</center>\r\n<center>可弹性扩展、安全、稳定、易用</center>\r\n<br />\r\n<center>可选操作系统：</center>\r\n<center>CentOS  7.6 64位</center>\r\n<center>CentOS  7.5 64位</center>\r\n<center>CentOS  7.4 64位</center>\r\n<center>CentOS  7.3 64位</center>\r\n<center>CentOS  7.2 64位</center>\r\n<center>CentOS  6.9 64位</center>\r\n<center>CentOS  6.8 64位</center>\r\n<center>CentOS  6.10 64位</center>\r\n<center>Windows Server  Version 1903 数据中心版 64位中文版（不含UI）</center>\r\n<center>Windows Server  Version 1903 数据中心版 64位英文版（不含UI）</center>\r\n<center>Windows Server  2019 数据中心版 64位中文版</center>\r\n<center>Windows Server  2019 数据中心版 64位英文版</center>\r\n<center>Windows Server  2016 数据中心版 64位中文版</center>\r\n<center>Windows Server  2016 数据中心版 64位英文版</center>\r\n<center>Windows Server  2012  R2 数据中心版 64位中文版</center>\r\n<center>Windows Server  2012 R2 数据中心版 64位英文版</center>\r\n<center>Windows Server  2008 标准版 SP2 32位中文版</center>\r\n<center>Windows Server  2008 R2 企业版 64位中文版</center>\r\n<center>Windows Server  2008 R2 企业版 64位英文版</center>\r\n<center>Ubuntu  18.04 64位</center>\r\n<center>Ubuntu  16.04 64位</center>\r\n<center>Ubuntu  16.04 32位</center>\r\n<center>Ubuntu  14.04 64位</center>\r\n<center>Ubuntu  14.04 32位</center>\r\n<center>Aliyun Linux  2.1903 64位</center>\r\n<center>Debian  9.9 64位</center>\r\n<center>Debian  9.8 64位</center>\r\n<center>Debian  9.6 64位</center>\r\n<center>Debian  8.9 64位</center>\r\n<center>Debian  8.11 64位</center>\r\n<center>SUSE Linux  Enterprise Server 12 SP4 64位</center>\r\n<center>SUSE Linux  Enterprise Server 12 SP2 64位</center>\r\n<center>SUSE Linux  Enterprise Server 11 SP4 64位</center>\r\n<center>OpenSUSE  42.3 64位</center>\r\n<center>CoreOS  2023.4.0 64位</center>\r\n<center>CoreOS  1745.7.0 64位</center>\r\n<center>FreeBSD  11.2 64位</center>\r\n<br />\r\n<center>企业服务器非常强大</center>\r\n<center>可以说是您用100元购买了一台企业级服务器送了一个阿里云企业认证</center>\r\n<center>阿里云企业认证还能让您免费领取一些普通用户领不到的好东西</center>\r\n<center>我们卖的这个价格已经非常良心了！！！</center>\r\n<center>老规矩，购买后联系QQ：2924070927进行企业认证</center>\r\n<center>认证完了还送一年企业级服务器！</center>', '购买后联系QQ：2924070927企业认证，超过三天还未联系我们您的订单将被作废，请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'qq', 0, 1, 0),
(21, 1, 4, 21, '黄金代理商', 0, 60.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>签到萌宠机器人永久黄金代理商，全功能开放，低价拿卡，无限添加机器人授权！</center>', '购买后请尽快联系QQ：2924070927开通代理商，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 1, 0, 0, 'qq', 0, 1, 0),
(22, 1, 4, 22, '钻石代理商', 0, 110.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>签到萌宠机器人永久钻石代理商，全功能开放，超低价拿卡！拿卡接近免费！无限添加机器人授权！</center>', '购买后请尽快联系QQ：2924070927开通代理商，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 1, 0, 0, 'qq', 0, 1, 0),
(23, 1, 4, 23, '授权代理商', 0, 430.00, 0, 0.00, 0.00, NULL, '您的QQ', '', '<center>签到萌宠机器人永久授权代理商，全功能开放，超低价拿卡！无限添加机器人授权，您还可以给别人无限开通黄金代理或钻石代理！您拥有开通代理商的特权！</center>', '购买后请尽快联系QQ：2924070927开通代理商，超过三天未联系我们您的订单将自动作废！请熟知！', '', 0, 0, 0, 0, 0, '', 0, 0, 1, 0, 0, 'qq', 0, 1, 0),
(24, 1, 1, 24, '测试商品', 0, 0.01, 0, 0.00, 0.00, NULL, '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, 1, 1, 0, 0, 'qq', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shua_workorder`
--

CREATE TABLE IF NOT EXISTS `shua_workorder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) unsigned NOT NULL DEFAULT '0',
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `addtime` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `zid` (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yc_kami`
--

CREATE TABLE IF NOT EXISTS `yc_kami` (
  `id` int(11) NOT NULL,
  `km` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
