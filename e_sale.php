<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>处理订单</title>
</head>

<body>
<style type="text/css">
tr,td{font-size:21px}
</style>
<?php
echo"<center>";
error_reporting(E_ERROR);
if(!$_COOKIE["login"])
{
	echo"你还没有登录";
	echo"请以管理员的身份<a href=login.php>登录</a>";
	}
	else{
		$name=$_COOKIE["login"];//取得用户名
		include"config.php";
		$sql="select admin from $my_user where name='$name'";
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		if($row[0]==0)
		{
			echo"你没有管理员权限";
			echo"请以管理员的身份<a href=login.php>登录</a>";
			}
		else{
			if(!$_GET["id"])//没有提供处理订单的id
			{
				echo"管理所有未处理的订单";
				include"config.php";
				$sql="select * from $my_sales where sale_state='0'";
				$result=mysql_query($sql);//这是查询数目的一种方法
				$num=mysql_num_rows($result);//还可以select count(*)
				if($num==0)echo"没有未处理的订单<p>点<a href=show.php>这里</a>返回首页";
				else{
					echo"<table border=\"1\" cellpadding=\"1\" cellspacing=\"0\"bordercolordark=\"#33FF99\"bordercolorlight=\"#CC00CC\"width=\"80%\">";
					echo"<tr><td>编号</td><td>购买人</td><td>商品名称</td><td>购买数量</td><td>总价格</td><td>购买时间</td><td>处理</td></tr>";
					while($row=mysql_fetch_array($result))//遍历结果集
					{echo"<tr>";
					echo"<td>".$row[id]."</td>";
					echo"<td>".$row[sale_user_name]."</td>";
					echo"<td>";
					$sql="select name from $my_goods where id='$row[sale_goods_id]'";
					$temp=mysql_fetch_row(mysql_query($sql));
					echo $temp[0];//商品名称
					echo"</td>";
					echo"<td>".$row[sale_goods_num]."</td>";//数量
					echo"<td>".$row[sale_cost]."</td>";//总价
					echo"<td>".$row[sale_date]."</td>";//时间
					echo"<td><a href=e_sale.php?id=".$row[id].">处理</a></td>";
					echo"</tr>";
						}
					}
				}
				else{
					$id=$_GET["id"];
					$sql="update $my_sales set sale_state='1' where id='$id'";
					$re=mysql_query($sql,$my_conn)or die(mysql_error());
					
					if($re)
					{
						echo"<meta http-equiv=\"refresh\" content=\"2;url=e_sale.php\">";
						echo"成功处理订单".$id."<p>";
						echo"两秒之后返回";
						}
						else{
							echo"<meta http-equiv=\"refresh\" content=\"2;url=e_sale.php\">";
							echo"处理订单".$id."失败<p>";
							echo"两秒后返回";
							}
					}
			}
		}
		echo"</center>";
?>
</body>
</html>