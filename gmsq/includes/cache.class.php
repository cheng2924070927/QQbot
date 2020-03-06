<?php
if(!defined('IN_CRONLITE'))exit();
class CACHE {
	public function get($key) {
		global $_CACHE;
		return $_CACHE[$key];
	}
	public function read($key = 'config') {
		global $DB;
		$row=$DB->get_row("SELECT v FROM shua_cache WHERE k='$key' limit 1");
		return $row['v'];
	}
	public function save($key ,$value) {
		if (is_array($value)) $value = serialize($value);
		global $DB;
		$value = addslashes($value);
		return $DB->query("REPLACE INTO shua_cache VALUES ('$key', '$value')");
	}
	public function pre_fetch(){
		global $_CACHE;
		$_CACHE=array();
		$cache = $this->read('config');
		$_CACHE = array_merge(@unserialize($cache),$_COOKIE);
		if(empty($_CACHE['version']) || $_GET['clearcache'])$_CACHE = $this->update();
		return $_CACHE;
	}
	public function update() {
		global $DB;
		$cache = array();
		$query = $DB->query('SELECT * FROM shua_config where 1');
		while($result = $DB->fetch($query)){
			if($result['k']=='cache') continue;
			$cache[ $result['k'] ] = $result['v'];
		}
		$this->save('config', $cache);
		return $cache;
	}
	public function clear($key = 'config') {
		global $DB;
		return $DB->query("UPDATE shua_cache SET v='' WHERE k='$key'");
	}
}
