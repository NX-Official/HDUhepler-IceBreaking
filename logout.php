<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width"/>
	<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css"/>
</head>
<body>
	<?php
	$_SESSION =array();
	if(isset($_COOKIE[session_name()]))setcookie(session_name(),'',time()-42000,'/');
	session_destroy();
	echo "<script>window.location.href='./login.php';</script>\n";
?>
</body>
