<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width"/>
<link rel="stylesheet" href="./mdui-v1.0.1/css/mdui.css" />
</head>

<body>
<?php
session_start();
if(empty($_SESSION[login]))echo "<script>window.location.href='./login.php';</script>\n";
$uid=$_SESSION[uid];
$num=(int)file_get_contents("./src/$uid/pic/next_num.txt");
$allowtype=array("png");
$path="./src/$uid/pic";

if($_FILES['myfile']['error']>0)
{
	echo "上传错误：";
	switch($_FILES['myfile']['error'])
	{
		case 1:	die("上传文件过大");
		case 2: die("上传文件过大");
		case 3: die("文件只被部分上传");
		case 4: die("没有上传任何文件");
		default: die("未知错误");
	}
}

$hz=array_pop(explode(".",$_FILES['myfile']['name']));
if(!in_array(strtolower($hz),$allowtype))die("这个后缀是<b>{$hz}</b>，是不允许的文件类型");
	
$filename=$num.".".$hz;

if(!move_uploaded_file($_FILES['myfile']['tmp_name'],$path.'/'.$filename))
	die("不能移动到指定目录");
else
{
	echo "文件{$filename}上传成功，保存在{$path}目录中，大小为{$_FILES['myfile']['size']}字节";
	file_put_contents($path.'/'."next_num.txt",$num+1);
}
	
	
	
	
	
	
	
	
?>
</body>