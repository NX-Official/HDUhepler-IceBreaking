<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width"/>
<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css" />
</head>
	<body class=" mdui-theme-primary-indigo mdui-theme-accent-pink">
		<div class="mdui-container">
<?php
	//x{4E00}-\x{9FFF}
	function cleanInput($clean)
	{
		$clean = preg_replace('/[^\x{4E00}-\x{9FFF}a-zA-Z0-9_ ]+/u', '', $clean);
		$clean = substr($clean,0,20);
		return $clean;
	}
	session_start();
	if(empty($_SESSION[login]))echo "<script>window.location.href='./login.php';</script>\n";
	$nextID=(int)file_get_contents("./src/next_id.txt");
	if(!empty($_GET[school_number]))
	{
		$_GET[name]=cleanInput($_GET[name]);
		$_GET[school_number]=cleanInput($_GET[school_number]);
		$_GET[department]=cleanInput($_GET[department]);
		if(empty($_GET[school_number])||empty($_GET[name])||empty(department))
		{
			echo "<script>window.alert(\"无效的输入\");</script>\n";
			die();
		}
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
		
	
  <div class="mdui-textfield">
    <label class="mdui-textfield-label">Userid</label>
    <input class="mdui-textfield-input" type="text" disabled placeholder="
EOF;
		
	echo $nextID;
		
	echo<<<'EOF'
	"/>
			<div class="mdui-textfield-helper">用户编号是自动分配的 </div>
  </div>
		
		<div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">Name</label>
		<input class="mdui-textfield-input" type="text" name="name" maxlength="20" />
		<div class="mdui-textfield-error">姓名只能包含汉字或英文字母</div>
		<div class="mdui-textfield-helper">请输入您的姓名</div>
		  </div>
		  <div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">School number</label>
		<input class="mdui-textfield-input" type="text" name="school_number" maxlength="8" pattern="[0-9]+" required/>
		<div class="mdui-textfield-error">学号只能包含数字</div>
		<div class="mdui-textfield-helper">请输入您的学号</div>
		  </div>
		  
		   <div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">Department</label>
		<input class="mdui-textfield-input" type="text" name="department" maxlength="20" />
		<div class="mdui-textfield-error">部门只能包含汉字或英文字母或数字</div>
		<div class="mdui-textfield-helper">请输入您的部门</div>
		  </div>
		  
		  <br>
		<input class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple"  type="submit" value="注册">
		
EOF;
	}
	
		
?>
		</div >
		<script src="./mdui-v1.0.1/js/mdui.min.js"></script>
</body>
</html>
