<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户历史订单</title>
</head>

<body>
<style type="text/css">
p,tr,td{font-size:21px}
</style>
<center>
查看用户历史订单<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<?php
if(!$_COOKIE["login"])//无用户登录
{
?>
<tr><td align="center">
尚未登录，点<a href="login.php">这里</a>登录
</td></tr>
</form>
<?php }
else{
	echo"<tr><td align=\"center\"bgcolor=\"#ccccff\"colspan=5>";
	echo"<a href=show.php>首页";
	echo"&nbsp;&nbsp;<a href=userinfo.php>查看用户".$_COOKIE["login"]."注册信息</a>";
	echo"&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
	echo"</td></tr>";
	include"config.php";
	$sql="SELECT * FROM $my_sales WHERE sale_user_name='$_COOKIE[login]'";
	$result=mysql_query($sql);//遍历所有的订单
	$num=mysql_num_rows($result);//获取订单数
	if($num==0)
	{
		echo"<tr><td colspan=5>尚没有用户".$_COOKIE[login]."的订单</td></tr>";}
		else
		{
			echo"<tr><td>商品名称</td><td>购买数量</td><td>总价格</td><td>订单状态</td><td>购买时间</td></tr>";
			while($row=mysql_fetch_array($result))//遍历结果集，返回索引数组
			{
				echo"<tr>";
				echo"<td>";
				$sql=" select name from $my_goods WHERE id='$row[sale_goods_id]'";
				$temp=mysql_fetch_row(mysql_query($sql));
				echo"$temp[0]";//商品名称
				echo"</td>";
				echo"<td>".$row[sale_goods_num]."</td>";//一次购买数量
				echo"<td>".$row[sale_cost]."</td>";//总价格
				echo"<td>";
				if($row[sale_state]==0)echo"未处理";
					else echo"已处理";
					echo"</td>";
					echo"<td>".$row[sale_date]."</td>";//下单日期
					echo"</td>";
					echo"</tr>";	
				}
			}
	
	}
?>
</table>
</body>
</html>