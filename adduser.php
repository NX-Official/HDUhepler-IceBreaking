<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width"/>
<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css" />
</head>
<?php
	session_start();
	if(empty($_SESSION[login]))echo "<script>window.location.href='./login.php';</script>\n";
	
	if(!empty($_GET[school_number]))
	{
		$nextID=(int)file_get_contents("./src/next_id.txt");
		mkdir("./src/$nextID");
		mkdir("./src/$nextID/pic");
		file_put_contents("./src/$nextID/name.txt",$_GET[name]);
		file_put_contents("./src/$nextID/school_number.txt",$_GET[school_number]);
		file_put_contents("./src/$nextID/department.txt",$_GET[department]);
		file_put_contents("./src/$nextID/pic/next_num.txt",1);
		file_put_contents("./src/$nextID/show_pic.txt",1);
		file_put_contents("./src/next_id.txt",$nextID+1);
		echo "<script>window.alert(\"Add User Successfuly!Your UID is $nextID\");</script>\n";
		echo "<script>window.location.href='./logout.php';</script>\n";
	}
	else 
	{
		echo<<<'EOF'
	<form name="input" action="./adduser.php" method="get">
		School number: <input type="text" name="school_number">
		Name: <input type="text" name="name">
		Department: <input type="text" name="department">
		<input type="submit" value="Submit">

		</form>
EOF;
	}
	
		
?>