<?php
require './includes/common.php';

$qq=daddslashes($_GET['qq']);
if($qq && checkauth($qq)) {
	echo '1';
} else {
	echo '0';
}