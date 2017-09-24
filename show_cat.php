<!DOCTYPE HTML>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>查看并统计购物车模块</title>
<?php
echo"<style type=\"text/css\">
<--
tr,td{font-size:21px}
-->
</style>";
echo"<center>\n";
if(!$_POST['mycat'])//如果没有提交订单则显示订单信息
{
	include"config.php";
	echo"<table border=\"1\" cellpadding=\"1\" cellspacing=\"0\"bordercolordark=\"#33FF99\"bordercolorlight=\"#CC00CC\"width=\"80%\">\n";
	echo"<form method=\"post\"action=\"".$_SERVER["PHP_SELF"]."\">\n";
	echo"<input type=\"hidden\" name=\"mycat\"value=\"post\">";
	echo"<tr>";
	echo"<td colspan=\"4\"><center><h2>您的购物车信息</h2></center>";
	echo"</tr>";
	echo"<tr>";
	echo"<td>选择</td>";
	echo"<td>名称</td>";
	echo"<td>单价</td>";
	echo"<td>数量</td>";
	echo"</tr>";
	$temp=array_keys($_COOKIE);//获取Cookie数组键名
	$j=0;
	for($i=0;$i<count($temp);$i++)//遍历用键名构成的数组
	{
		if(ereg("cat","$temp[$i]"))//如果键名包含cat(用于标记购物车)
		{
			$catid=ereg_replace("cat","",$temp[$i]);//获取被提交的id，ereg_replace吧cat替换成空
			$sql="select * from $my_goods where id='$catid'";//获取商品指定的信息
			$result=mysql_query($sql,$my_conn);
			$rows=mysql_fetch_array($result);
			echo"<input type=\"hidden\"name=\"id[]\"value=\"".$rows[id]."\">";
			echo"<input type=\"hidden\"name=\"type[]\"value=\"".$rows[type]."\">";
			echo"<tr>";
			echo"<td><input type=\"checkbox\"name=\"c[".$j."]\"
			value=\"".$rows[name]."\">";
			echo"<td>".$rows[name]."</td>";
			echo"<td><input type=\"text\"
			 value=\"".$rows[cost]."\"name=\"m[]\" readonly enable=false size=\"5\"></td>";
			echo"<td>";
			echo"<select name=\"t[]\"size=\"1\">";//购买商品数目通过select选框来实现
			for($cc=1;$cc<($rows["num"]+1);$cc++)
			{
				echo"<option value=".$cc.">".$cc."</option>";
				}
				echo"</select>";
				echo"</td>\n";
				echo"</tr>\n";
				$j++;
			
		
			
			}
		}
		echo"<tr>";
		echo"<td colspan=\"4\"><center>";
		echo"<input type=\"submit\"value=\"生成订单\">";
		echo"<input type=\"button\"value=\"继续购物\"onclick=window.close()>";
		echo"</center></td>";
		echo"</tr>";
		echo"</form>";
		echo"</table>";
	}else //如果提交了订单
	{
		
		$id=$_POST["id"];
		$m=$_POST["m"];
		$t=$_POST["t"];
		$c=$_POST["c"];
		$type=$_POST["type"];
		$time=date("Y年m月d日");
		echo $time;
		if(count($c)==0)//被选中项为0
		{
			echo"你没有选择商品";
			echo"<input type=button value=重新选择 onclick=history.go(-1)>";
			}
			else{
				
				require"config.php";//调用配置文件
				$sql="insert into $my_sales(sale_goods_id,sale_goods_num,sale_user_name,sale_cost,sale_date)values";//构建插入订单记录的sql语句主体
				echo"<table border=\"1\" cellpadding=\"1\" cellspacing=\"0\"bordercolordark=\"#33FF99\"bordercolorlight=\"#CC00CC\"width=\"80%\">";
				
				echo"<tr><td colspan=\"4\"><center>您选购了以下商品：</center></td></tr>";
				echo"<tr>";
				echo"<td>名称</td>";
				echo"<td>单价</td>";
				echo"<td>数量</td>";
				echo"<td>小计</td>";
				echo"</tr>";
				$i=0; 
				foreach($c as $key=>$value)//遍历每一项选择的商品
				{ 
					$temp=$id[$key];
					
					$temp2=$m[$key];
					$temp3=$t[$key];
					$temp4=$type[$key];
					$update="UPDATE $my_goods,$my_type set $my_goods.num=$my_goods.num-$temp3,$my_type.num=$my_type.num-$temp3      WHERE $my_goods.id=$temp and $my_type.id=$temp4";
					mysql_query($update)or die(mysql_error());
					echo"<tr>";
					echo"<td>".$value."</td>";//商品名称
					echo"<td>".$temp2."</td>";//商品单价
					echo"<td>".$temp3."</td>";//购买数量
					$z[$i]=($temp2*$temp3);//当前项总金额
					$sql=$sql."('$temp','$temp3','$_COOKIE[login]','$z[$i]','$time')";echo $update;
					if($i<count($c)-1)//如果不是最后一项，则在SQL后加逗号
					{
						$sql=$sql.",";
						}
						echo"<td>".$z[$i]."</td>";//输出小计
						echo"</tr>";
						$i++;
					}
					$s=array_sum($z);//获取总额 
					echo"<tr><td colspan=\"4\"><center>总计:".$s."</center></td></tr>";
					
					$re=mysql_query($sql);//执行插入语句生成订单
					if($re)
					{
						echo"<tr><td colspan=4><center>已经生成订单,点<input type=button value=这里结束操作 onclick=window.close()></center></td></tr>";
						
						}
						else{
							echo"<tr><td colspan=4><center>生成订单错误,点<input type=button value=这里结束操作 onclick=window.close()></center></td></tr>";
							
							}
							echo"</table>";
				}
		}
?>


