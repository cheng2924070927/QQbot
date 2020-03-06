<?php
if(!defined('IN_CRONLITE'))exit();
class Price {
	private $zid;
	private $upzid;
	private $power;
	private $user;
	private $price_array = array();
	private $up_price_array = array();
	private $tool = array();
	private static $price_rules;

	public function __construct($zid,$siterow=null){
		global $DB;
		if($zid == 1)return;
		if(!$siterow)$siterow=$this->getSiteInfo($zid);
		$this->endtime = $siterow['endtime'];
		if($siterow['power']==2){
			$this->zid = $zid;
			$this->power = $siterow['power'];
			$this->price_array = @unserialize($siterow['price']);
		}elseif($siterow['power']==1){
			$this->zid = $zid;
			$this->power = $siterow['power'];
			$this->price_array = @unserialize($siterow['price']);
			if($data = $DB->get_row("SELECT zid,price FROM shua_site WHERE zid='{$siterow['upzid']}' and power=2 limit 1")){
				$this->up_price_array = @unserialize($data['price']);
				$this->upzid=$data['zid'];
			}
		}elseif($siterow['power']==0){
			$this->user = true;
			if($data = $DB->get_row("SELECT zid,upzid,power,price FROM shua_site WHERE zid='{$siterow['upzid']}' limit 1")){
				$this->zid = $data['zid'];
				$this->power = $data['power'];
				$this->price_array = @unserialize($data['price']);
				if($this->power == 1 && $data['upzid']>1 && $data = $DB->get_row("SELECT zid,price FROM shua_site WHERE zid='{$data['upzid']}' and power=2 limit 1")){
					$this->up_price_array = @unserialize($data['price']);
					$this->upzid=$data['zid'];
				}
			}
		}
	}
	public function setToolInfo($tid,$row=null){
		global $DB,$CACHE;
		if(!$row)$row=$this->getToolInfo($tid);
		if($row['prid']==0){ //不加价
		}elseif($price_rules = $this->getPriceRules($row['prid'])){ //应用加价模板
			$price = $row['price'];
			$row['price'] = round($price_rules['kind']==1?$price+$price_rules['p_0']:$price*$price_rules['p_0'], 2);
			$row['cost'] = round($price_rules['kind']==1?$price+$price_rules['p_1']:$price*$price_rules['p_1'], 2);
			$row['cost2'] = round($price_rules['kind']==1?$price+$price_rules['p_2']:$price*$price_rules['p_2'], 2);
		}else{ //对应加价模板被删除
			$row['cost'] = $row['price'];
			$row['cost2'] = $row['price'];
		}
		$this->tool=$row;
	}
	public function getToolPrice($tid){
		global $islogin2,$conf,$date;
		if($islogin2==1){
			if($this->user==true && $conf['user_level']==1){
				return $this->getToolCost($tid);
			}elseif($this->user==true || $conf['fenzhan_expiry']>0 && $this->endtime<$date){
			}elseif($this->power==1){
				return $this->getToolCost($tid);
			}elseif($this->power==2){
				return $this->getToolCost2($tid);
			}
		}
		$cost = $this->getToolCost($tid);
		if($this->price_array[$tid]['price'] && $this->price_array[$tid]['price']>=$cost && $cost>0){
			$price=$this->price_array[$tid]['price'];
		}elseif($this->up_price_array[$tid]['price'] && $this->up_price_array[$tid]['price']>=$cost && $cost>0){
			$price = $this->up_price_array[$tid]['price'];
		}elseif($cost>0 && $cost>$this->tool['price']){
			$price=$cost;
		}else{
			$price=$this->tool['price'];
		}
		return $price;
	}
	public function getToolCost($tid){
		$cost2 = $this->getToolCost2($tid);
		if($this->power<2 && $this->up_price_array[$tid]['cost'] && $this->up_price_array[$tid]['cost']>=$cost2){
			$cost = $this->up_price_array[$tid]['cost'];
		}elseif($this->power==2 && $this->price_array[$tid]['cost'] && $this->price_array[$tid]['cost']>=$cost2){
			$cost = $this->price_array[$tid]['cost'];
		}elseif($this->tool['cost']>0){
			$cost = $this->tool['cost'];
		}else{
			$cost = $this->tool['price'];
		}
		return $cost;
	}
	public function getToolCost2($tid){
		if($this->tool['cost2']>0){
			$cost = $this->tool['cost2'];
		}elseif($this->tool['cost']>0){
			$cost = $this->tool['cost'];
		}else{
			$cost = $this->tool['price'];
		}
		return $cost;
	}
	public function getToolDel($tid){
		return $this->price_array[$tid]['del'];
	}
	public function getFinalPrice($price, $num){
		if(!empty($this->tool['prices'])){
			$prices = explode(',',$this->tool['prices']);
			foreach($prices as $item){
				$arrs = explode('|',$item);
				if($num>=$arrs[0])$discount=$arrs[1];
			}
			$price -= $discount;
			if($price<=0)return false;
		}
		return $price;
	}
	public function setToolProfit($tid,$num,$name,$money,$orderid,$userid=0){
		global $DB,$islogin2,$conf,$date;
		if($userid == $this->zid)$islogin2=1;
		$toolPrice = $this->getFinalPrice($this->getToolPrice($tid), $num);
		if(round($toolPrice*$num,2) != round($money,2))return false;
		if($this->power==2){
			$profit=$toolPrice - $this->getToolCost2($tid);
			if($profit>0 && $profit<$money){
				$tc_point=round($profit*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->zid}'");
				$this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
		}elseif($this->power==1){
			$profit=$toolPrice - $this->getToolCost($tid);
			if($profit>0 && $profit<$money){
				$tc_point=round($profit*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->zid}'");
				$this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
			$profit2=$this->getToolCost($tid) - $this->getToolCost2($tid);
			if($profit2>0 && $profit2<$money && $this->upzid>1){
				$tc_point=round($profit2*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->upzid}'");
				$this->addPointRecord($this->upzid, $tc_point, '提成', '你下级网站(ZID:'.$this->zid.')用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
		}
		return $rs;
	}
	public function setPriceInfo($tid,$del,$price,$cost=0){
		global $DB;
		$this->price_array[$tid] = array();
		if($price != $this->tool['price'] || $cost>0 && $cost != $this->tool['cost'] || $del != $this->price_array[$tid]['del']){
			$this->price_array[$tid]['price'] = $price;
			if($this->power==2)$this->price_array[$tid]['cost'] = $cost;
			$this->price_array[$tid]['del'] = $del;
		}
		$price_data = serialize($this->price_array);
		return $DB->query("update shua_site set price='$price_data' where zid='{$this->zid}'");
	}
	private function addPointRecord($zid, $point = 0, $action = '提成', $bz = null, $orderid)
	{
		global $DB;
		$DB->query("INSERT INTO `shua_points` (`zid`, `action`, `point`, `bz`, `addtime`, `orderid`) VALUES ('$zid', '$action', '$point', '$bz', NOW(), '$orderid')");
	}
	private function getSiteInfo($zid){
		global $DB;
		$data = $DB->get_row("SELECT zid,upzid,power,price,endtime FROM shua_site WHERE zid='$zid' limit 1");
		return $data;
	}
	private function getToolInfo($tid){
		global $DB;
		$row=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
		return $row;
	}
	private function getPriceRules($id){
		global $DB,$CACHE;
		if(self::$price_rules) return self::$price_rules[$id];
		$price_rules = unserialize($CACHE->read('pricerules'));
		if(!$price_rules){
			$this->updatePriceRules();
		}else{
			self::$price_rules = $price_rules;
		}
		return self::$price_rules[$id];
	}
	private function updatePriceRules(){
		global $DB,$CACHE;
		$array = array();
		$rs=$DB->query("SELECT * FROM shua_price order by id asc");
		while($res = $DB->fetch($rs)){
			$array[$res['id']] = array('kind'=>$res['kind'], 'p_2'=>$res['p_2'], 'p_1'=>$res['p_1'], 'p_0'=>$res['p_0']);
		}
		$CACHE->save('pricerules', $array);
		self::$price_rules = $array;
	}
}
