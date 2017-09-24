<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加商品和编辑商品</title>
</head>

<style type="text/css">
tr,td{font-size:21px}
p{font-size:25px}
</style>
<?php
	echo"<center>";
	if(!$_COOKIE["login"])//用户未登录
	{
		echo"你没有登录<p>";
		echo"点击<a href=login.php>登录</a>，在执行页面";
		}else{
			$name=$_COOKIE["login"];
			include"config.php";//加载配置文件
			$sql="SELECT admin FROM $my_user WHERE name='$name'";
			$result=mysql_query($sql);
			$row=mysql_fetch_row($result);
			if($row[0]==0)//查询不到
			{
				echo"你乜有管理员权限";
				echo"请你用管理员身份<a href=login.php>登录</a>,在执行页面";
				}
				else{
					if(!$_POST["name"])//没有提供商品名称,显示前台
					{
						?>
<script language="javascript">
function check(f)
{
	if(f.name.value =="")
	{
		alert("请输入商品名称");
		f.name.focus();
		return false;
		}
		if(f.cost.value =="")
		{
			alert("请输入商品价格");
			f.cost.focus();
			return false;
			}
			if(f.num.value =="")
			{
			alert("请输入商品数目");
			f.num.focus();
			return false;	
			}
	}
</script>
mini商品系统添加商品<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"onsubmit="return check(this)">
<tr>
<td colspan="2" bgcolor="#333333"align="center">添加商品信息</td>
</tr>
<tr>
<td>添加商品名称</td>
<td><input type="text"name="name"></td>
</tr>
<tr>
<td>添加商品所属类别</td>
<td><select name="type" size=1>
<?php
include"config.php";
$sql="SELECT id,name FROM $my_type";//遍历商品类别，显示列表框
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
	echo"<option value=".$row[0].">";
	echo $row[1];
	echo"</option>";
	}
?>
</select>
</tr>
<tr>
<td>添加商品价格</td>
<td><input type="text" name="cost"></td>
</tr>
<tr>
<td>添加商品数目</td>
<td><input type="text" name="num"></td>
</tr>
<tr>
<td>添加商品介绍</td>
<td><input type="text" name="description"></td>
</tr>
<tr>
<td colspan=2  align="center"><input type="submit"value="添加"></td>
</tr>
</form>
</table>
<?php
					}
					else//后台处理
					{
						$name=$_POST["name"];
						$type=$_POST["type"];
						$cost=$_POST["cost"];
						$num=$_POST["num"];
						if($_POST["description"]!="")//如果有商品介绍
						{
							$description=$_POST["description"];
							
							}
							else{
								$description="暂无介绍";
								}
								$sql="UPDATE $my_type SET num=num+'$num' WHERE id='$type'";//更新数目和类别
								mysql_query($sql,$my_conn)or die(mysql_error());
								$sql="INSERT INTO $my_goods(name,type,cost,num,description)values('$name','$type','$cost','$num','$description')";
								$re=mysql_query($sql,$my_conn)or die(mysql_error());
								if($re)//添加成功
								{
									echo"添加商品信息成功：".$name."<p>";
									echo"点击<a href=show.php>这里</a>查看<p>";
									echo"点<a href=add_goods.php>这里</a>继续添加";
									
									}
						}
					}
			}
			echo"</center>";
?>
</html>