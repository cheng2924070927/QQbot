<?php
if (!defined('IN_CRONLITE')) exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0"/>
    <title>
        <?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?>
    </title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>assets/maidong/css/main.css">
    <link rel="stylesheet" href="<?php echo $cdnserver?>assets/maidong/css/themes.css">
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css">
	<script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
        <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js">
        </script>
        <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js">
        </script>
    <![endif]-->
</head>
<body>
