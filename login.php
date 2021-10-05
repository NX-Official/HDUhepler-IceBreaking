<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width"/>
	<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css"/>
</head>

<body>
	<?php
	session_start();
	if(!empty($_SESSION[login]))echo "<script>window.location.href='./index.php';</script>\n";
	$MaxUid=(int)file_get_contents("./src/next_id.txt");
	if(!empty($_GET[uid]))
	{
		if($_GET[uid]>=$MaxUid)
		{
			echo "<script>window.alert(\"User not found!\");</script>\n";
			echo "<script>window.location.href='./login.php';</script>\n";
		}
		$_SESSION[uid]=$_GET[uid];
		if($_GET[school_number]!=(int)file_get_contents("./src/$_SESSION[uid]/school_number.txt"))
		{
			echo "<script>window.alert(\"wrong school number!\");</script>\n";
			echo "<script>window.location.href='./login.php';</script>\n";
		}
			
		else 
		{
			$_SESSION[login]=1;
			echo "<script>window.location.href='./login.php';</script>\n";
		}
	}
	else
	{
		echo<<<'EOF'
		<form name="input" action="./login.php" method="get">

		UserID: <input type="text" name="uid">
		School number: <input type="text" name="school_number">
		<input type="submit" value="Submit">

		</form>
EOF;
	}
	?>

</body>