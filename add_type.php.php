<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加和编辑类别</title>
</head>
<?php
	echo"<center>";
	if(!$_COOKIE["login"])
	{
		echo"您还没有登录";
		echo"请以管理员身份<a href=login.php>登录</a>,在执行界面";
		}
		else{
		$name=$_COOKIE["login"];
		include"config.php";
		$sql="SELECT admin FROM $my_user WHERE name='$name'";
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		if($row[0]==0)
		{
			echo"您没有权限<p>";
			echo"请以管理员身份<a href=login.php>登录</a>，在执行该界面";
			}
			else{
				if(!$_POST["name"])//如果没有提交类别名称显示前台
				{
					?>
     <script type="javascript">
	 function check(f)
	 {
		 if(f.name.value=="")
		 {
			 alert("请输入类别名称");
			 f.name.focus();
			 return false;
			 }
		 }
	 
	 </script>
     <style type="text/css">
	 tr,td,p{font-size:21px}
	 </style>
     mini商城添加系统<p>
     <table border="1"cellspacing="0"cellpadding="1"bordercolordark="#fffff"bordercolorlight="#990033"width="300">
     <form method=post action="<?php $_SERVER["PHP_SELF"]?>" onsubmit="return check(this)">
     <tr>
     <td colspan="2" bgcolor="#333366"align="center">添加类别信息</td>
     </tr>
     <tr>
     <td>添加类别名称</td>
     <td><input type="text"name="name"></td>
     </tr>
     <tr>
     <td>添加类别介绍</td>
     <td><input type="text"name="description"></td>
     </tr>
     <tr>
     <td colspan="2" align="center"><input type="submit"value="添加" ></td>
     </tr>
     </form>
     </table>
     <?php
				}else
				{
					$name=$_POST["name"];
					if($_POST["description"]!="")
					{
						$description=$_POST["description"];//获取类别介绍
						}
						else
						{
							$description="暂无介绍";
							}
			$sql="SELECT count(*) FROM $my_type WHERE name='$name'";//查看是否有同类别的名称
			$re=mysql_query($sql,$my_conn) or die(mysql_error());
			$count=mysql_fetch_row($re);
			if($count[0]>0)
			{
				echo"已存在同名类别<p>";
				echo"点击<a href=add_type.php>这里</a>重新添加类别";
				}
				else{
					$sql="INSERT INTO $my_type(name,description)values('$name','$description')";
					$re=mysql_query($sql,$my_conn)or die(mysql_error());
					if($re)
					{
						echo"成功添加类别：".$name."<p>";
						echo"点<a href=show.php>这里</a>查看";
						}
						}
					}

				}
		}
		echo"<center>";
?>

</html>