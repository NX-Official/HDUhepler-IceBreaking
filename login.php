<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width"/>
	<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css"/>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
	<?php
	function cleanInput($input)
	{
		$clean = strtolower($input);
		$clean = preg_replace("/[^0-9]/", "", $clean);
		$clean = substr($clean,0,12);
		return $clean;
	}
	session_start();
	if(!empty($_SESSION[login]))echo "<script>window.location.href='./index.php';</script>\n";
	$MaxUid=(int)file_get_contents("./src/next_id.txt");
	
	$_GET[uid]=cleanInput($_GET[uid]);
	$_GET[school_number]=cleanInput($_GET[school_number]);
	
	if(!empty($_GET[uid]))
	{
		if($_GET[uid]>=$MaxUid)
		{
			echo "<script>window.alert(\"不存在此用户!\");</script>\n";
			echo "<script>window.location.href='./login.php';</script>\n";
			die(); 
		}
		$_SESSION[uid]=$_GET[uid];
		if($_GET[school_number]!=(int)file_get_contents("./src/$_SESSION[uid]/school_number.txt"))
		{
			echo "<script>window.alert(\"学号错误!\");</script>\n";
			echo "<script>window.location.href='./login.php';</script>\n";
			die();
		}
			
		else 
		{
			$_SESSION[login]=1;
			echo "<script>window.location.href='./login.php';</script>\n";
		}
	}
	else
	{
		//pattern="[0-9]+"
		echo<<<'EOF'
		
		<div class="mdui-container doc-container">
		
		<h1 class="doc-title mdui-text-center">助手破冰认人脸系统</h1>
		
		<form name="input" action="./login.php" method="get">
		<div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">UserID</label>
		<input class="mdui-textfield-input" type="text" name="uid"  required/>
		<div class="mdui-textfield-error">编号只能包含数字</div>
		<div class="mdui-textfield-helper">请输入您的用户编号</div>
		  </div>
		  <div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">School number</label>
		<input class="mdui-textfield-input" type="text" name="school_number" maxlength="8"  required/>
		<div class="mdui-textfield-error">学号只能包含数字</div>
		<div class="mdui-textfield-helper">请输入您的学号</div>
		  </div>
		  <br>
		<input class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple"  type="submit" value="登录">
		
		
		</div>
			</form>
			</div>
EOF;
	}
	?>
<script src="./mdui-v1.0.1/js/mdui.min.js"></script>
</body>
