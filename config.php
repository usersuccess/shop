<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>配置文件</title>
</head>
<?php
	$my_user="mini_user";
	$my_type="mini_type";
	$my_goods="mini_goods";
	$my_sales="mini_sales";
	$link=mysqli_connect('localhost','root','','site')or exit(mysqli_error());//连接服务器//选择操作的数据库
	mysqli_query($link,"set names utf8");//设置编码
?>

<body>
</body>
</html>