<!DOCTYPE HTML><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>类别显示模块</title>
</head>
<style type="text/css">
tr,td{font-size:21px}
</style>
<?php
	include"header.php";
?>

<p>
<?php
if(!$_GET["id"])//如果没有制定的id
{
	
	echo"<meta http-equiv=\"refresh\"content=\"2;url=show.php\">";//输出内容到并重定向到首页
	echo"没有提供类别ID<p>";
	echo"两秒后返回查看主页";
	}
	else
	{
?>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">

<?php
	include"config.php";
	$sql="SELECT name FROM $my_type WHERE id='$_GET[id]'";//通过id取得类别名称
	$result=mysql_query($sql);
	$name=mysql_fetch_row($result);
	echo"<tr><td bgcolor=\"#ccccff\"colspan=3>";
	echo"<a href=show.php>首页</a>&nbsp;&nbsp;查看所有".$name[0]."记录";
	echo"&nbsp;&nbsp;";
	$sql="SELECT * FROM $my_goods WHERE type='$_GET[id]'";//遍历商品表中属于该类的商品
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num==0)
	{
		echo"<center>该类别没有任何商品</center>";
		echo"</td></tr>";
		}
		else
		{
			echo"共有".$num."种商品";
			echo"</td></tr>";
			for($i=0;$i<ceil($num/3);$i++)
			{
				echo"<tr>";
				for($j=0;$j<3;$j++)
				{
					echo"<td>";
					$row=mysql_fetch_array($result);//获取记录
					if($row)
					{
						echo"<a href=show_goods.php?id=".$row["id"].">".$row["name"]."</a>(".$row["num"].")";
						echo"<br>";
						echo $row["description"];
						}
						else{
							echo"尚无商品";
							}
							echo"</td>";
					}
					echo"</tr>";
					
				}
			}
			echo"</table>";
	}

?>


