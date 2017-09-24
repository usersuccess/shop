<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商品首页</title>
</head>
<?php
	include"header.php";//调用头部模块
?>
<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<?php
	include"config.php";//调用配置文件
	$sql="SELECT * FROM $my_type";//商品类别表
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);//获取所有商品类别数目
	if($num==0)
	{
		echo"<tr><td color bgcolor=\"#ccccff\" colspan=3>";
		echo"<center>尚么有任何商品种类</center>";
		echo"</td></tr>";
	}
	else
	{
		echo"<tr><td color bgcolor=\"#ccccff\" colspan=3><center>";
		echo"共拥有".$num."种商品";
		echo"</center></td></tr>";
		for($i=0;$i <ceil($num/3);$i++)//每行3个显示所有类别
		{
			echo"<tr>";
			for($j=0;$j<3;$j++)
			{
				echo"<td>";
				$row=mysql_fetch_array($result);//逐条获取记录
				if($row)
				{
					echo"<a href=show_type.php?id=".$row["id"].">".$row["name"]."</a>(".$row["num"].")";
					echo"<br>";
					echo $row["description"];
					}
					else
					{
						echo"尚无类别";
						}
						echo"</td>";
				}
				echo"</td>";
			}
		}
		echo"</table>";
?>
<body>
</body>
</html>