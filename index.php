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
	
//	$_SESSION["uid"]

?>

<!-- 头部 -->
<header class="mdui-appbar mdui-appbar-fixed" id="content-header">
	<div class="mdui-toolbar mdui-color-theme">
		<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#content-drawer', swipe: true}">
			<i class="mdui-icon material-icons">menu</i>
		</span> 
		<a href="./index.php" class="mdui-typo-headline ">Main</a> 
	</div>
</header>

<!-- 侧边栏 -->
<div class="mdui-drawer" id="content-drawer">
	<ul class="mdui-list">
		<a href="./index.php">
		<li class="mdui-list-item mdui-ripple mdui-list-item-active"> 
			<i class="mdui-list-item-icon mdui-icon material-icons  mdui-text-color-deep-orange">home</i>
			<div class="mdui-list-item-content">Main</div>
		</li>
		</a>
		<a href="./person.php">
		<li class="mdui-list-item mdui-ripple"> 
			<i class="mdui-list-item-icon mdui-icon material-icons  mdui-text-color-blue">account_box</i>
			<div class="mdui-list-item-content">Person</div>
		</li>
		</a>
	</ul>
</div>

<!-- 内容 -->

<div class="mdui-container">

		<?php
	
		$sumID=(int)file_get_contents("./src/next_id.txt")-1;
		//echo ("sumID: $sumID <br>");
		$show_pic=mt_rand(1,$sumID);
		//echo ("shou_pic: $show_pic <br>");
		while(file_get_contents("./src/$show_pic/show_pic.txt")==0 || file_get_contents("./src/$show_pic/pic/next_num.txt")==1)
		{
			//echo ("shou_pic: $show_pic <br>");
			$show_pic=mt_rand(1,$sumID);
		}
		//echo ("shou_pic: $show_pic <br>");	
		
		$pos=rand(1,$sumID);
		$picID=rand(1,(int)file_get_contents("./src/$show_pic/pic/next_num.txt")-1);
	
		echo("<img src=\"./src/$show_pic/pic/{$picID}.png\">");
		echo "<br>这是？";
		$list[$pos]=$show_pic;
		for ($i=1;$i<=4;$i++)
		{
			if($i==$pos)continue;
			$another=rand(1,$sumID);
			while (in_array($another,$list))$another=rand(1,$sumID);
			$list[$i]=$another;
		}
		function show_others($x)
		{
			$wrongName=file_get_contents("./src/$x/name.txt");
			echo("<br><button type=\"button\" onclick=\"alert('你错啦!')\">$wrongName</button>");
		}
		for($i=1;$i<=4;$i++)
		{
			$rightName=file_get_contents("./src/$show_pic/name.txt");
			if($i!=$pos)show_others($list[$i]);
			else echo("<br><button type=\"button\" onclick=\"alert('你对啦!')\">$rightName</button>");
		}
		
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

</div>


<!-- MDUI JavaScript --> 
<script src="./mdui-v1.0.1/js/mdui.min.js"></script>
</body>
</html>

