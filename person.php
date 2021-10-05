<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width"/>
<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css" />
</head>

<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-indigo">
<?php
	session_start();
	if(empty($_SESSION[login]))echo "<script>window.location.href='./login.php';</script>\n";
	$uid=$_SESSION[uid];
	if($_GET[change]=='0'||$_GET[change]=='1')
	{
		//echo("change to $_GET[change]");
		file_put_contents("./src/$uid/show_pic.txt",$_GET[change]);
	}
		   
//	$_SESSION["uid"]

?>

<!-- 头部 -->
<header class="mdui-appbar mdui-appbar-fixed" id="content-header">
	<div class="mdui-toolbar mdui-color-theme">
		<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#content-drawer', swipe: true}">
			<i class="mdui-icon material-icons">menu</i>
		</span> 
		<a href="./index.php" class="mdui-typo-headline ">Person</a> 
	</div>
</header>

<!-- 侧边栏 -->
<div class="mdui-drawer" id="content-drawer">
	<ul class="mdui-list">
		<a href="./index.php">
		<li class="mdui-list-item mdui-ripple"> 
			<i class="mdui-list-item-icon mdui-icon material-icons  mdui-text-color-deep-orange">home</i>
			<div class="mdui-list-item-content">Main</div>
		</li>
		</a>
		<a href="./person.php">
		<li class="mdui-list-item mdui-ripple mdui-list-item-active"> 
			<i class="mdui-list-item-icon mdui-icon material-icons  mdui-text-color-blue">account_box</i>
			<div class="mdui-list-item-content">Person</div>
		</li>
		</a>
	</ul>
</div>

<!-- 内容 -->

<div class="mdui-container">
	<a href="./logout.php">
		<button type="button">注销账户</button>
	</a>
	<a href="./adduser.php">
		<button type="button">添加账户</button>
	</a>
	<?php
	///test/demo_form.php?name1=value1&name2=value2
	
		/*<form name="input" action="./person.php" method="get">
		<input type="hidden" name="change" value="0">
		<input type="submit" value="不显示我的照片">

		</form>*/
	if(file_get_contents("./src/$uid/show_pic.txt")==1)echo<<<'EOF'
	<a href="./person.php?change=0">
		<button type="button">不显示我的照片</button>
	</a>
	

EOF;
	else echo<<<'EOF'
	<a href="./person.php?change=1">
		<button type="button">显示我的照片</button>
	</a>
EOF;
	?>
	<br><br>
	<?php
	
	$uid=$_SESSION[uid];
	$name=file_get_contents("./src/$uid/name.txt");
	$school_number=file_get_contents("./src/$uid/school_number.txt");
	$department=file_get_contents("./src/$uid/department.txt");
	$nextPicNum=(int)file_get_contents("./src/$uid/pic/next_num.txt");
	$picNum=$nextPicNum-1;
	echo("UserID: $uid<br>");
	echo("Name: $name<br>");
	echo("School number: $school_number<br>");
	echo("Department: $department<br>");
	echo("<br>");
	echo("在此上传照片(*.png)：<br>");
	echo<<<'EOF'
	<form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	选择文件：<input type="file" name="myfile">
	<input type="submit" value="上传文件">
	</form>
	<br><br>
EOF;
	echo("你目前已经上传了 $picNum 张照片：");
	for($i=1;$i<=$picNum;$i++)
	{
		echo("<br>");
		echo("第{$i}张：");
		echo("<br>");
		echo("<img src=\"./src/$uid/pic/{$i}.png\">");
	}
		
	?>

</div>
<!-- MDUI JavaScript --> 
<script src="./mdui-v1.0.1/js/mdui.min.js"></script>
</body>
</html>

