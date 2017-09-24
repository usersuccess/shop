<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商品显示模块</title>
</head>
<?php
	include"header.php";//调用头部
?>
<p>
<?php
	if(!$_GET["id"]){
		echo"<meta http-equiv=\"refresh\"content=\"2;url=show.php\">";
		echo"没有提供商品<p>";
		echo"两秒后返回查看主页面";
	}
	else
	{
		
?>
<script language="javascript" src="style/js/mycat.js"></script>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<?php
	include"config.php";
	$sql="SELECT * FROM  $my_goods WHERE id='$_GET[id]'";//获取指定商品所有信息
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$sql="SELECT id,name FROM $my_type WHERE id='$row[type]'";//获取商品所属id和名称
	$result=mysql_query($sql);
	$type_info=mysql_fetch_array($result);
	echo"<tr>";
	echo"<td bgcolor=\"#3333CC\" colspan=2>";
	echo"<a href=show.php>首页</a>&nbsp;&nbsp;";
	echo"<a href=show_type.php?id=".$type_info["id"].">".$type_info["name"]."</a>&nbsp;&nbsp;";
	echo"查看".$row["name"]."的详细信息";//一下显示商品的所有信息
	echo"</td></tr>";
	echo"<tr>";
	echo"<td>商品名称</td>";
	echo"<td>".$row["name"]."</td>";
	echo"</tr>";
	echo"<tr>";
	echo"<td>商品售价</td>";
	echo"<td>".$row["cost"]."</td>";
	echo"</tr>";
	echo"<tr>";
	echo"<td>现有存货</td>";
	echo"<td>".$row["num"]."</td>";
	echo"</tr>";
	echo"<tr>";
	echo"<td>商品介绍</td>";
	echo"<td>".$row["description"]."</td>";
	echo"</tr>";
	if($_COOKIE["login"])
	{
	echo"<tr>";
	echo"<td colspan=\"2\"align=\"center\"><input type=\"button\" value=\"把该商品加入购物车\" onclick=SetCookie(\"cat".$row[id]."\",\"1\")></td>\n";
	echo"</tr>";
	}
	echo"</table>";
	}
?>

<body>
</body>
</html>