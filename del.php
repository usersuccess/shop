<?php
	$id=$_GET['id'];//取得id
	mysql_connect('localhost','root','5267894')or die(mysql_error());
	mysql_select_db('chatroom');
	mysql_query('set names utf8');//连接数据库
	$sql="delete from gods where Id=$id";
	if(mysql_query($sql))
	{
		header('location:fenye.php');
	}
	else
	{
		die(mysql_error());	
	}
?>