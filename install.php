<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>商城页面安装</title>
</head>
<?php
error_reporting(0);
	echo "<center>";
	if(!$_POST["admin"])
	{
?>
<script language="javascript">
function check(f)
{
	if(f.admin.value=="")
	{
		alert("请输入管理员名称");
		f.admin.focus();
		return false;
		}
		if(f.pass.value=="")
		{
			alert("请输入管理员密码");
			f.pass.focus();
			return false;
			}
			if(f.re_pass.value !=f.pass.value)
			{
					alert("密码验证错误");
					f.re_pass.focus();
					f.re_pass.select();
					return false;
				}
				if(f.mail.value=="")
				{
					alert("请输入管理员邮箱");
					f.mail.focus();
					return false;
					}
					if(f.type.value=="")
					{
					alert("请输入默认商品类别");
					f.type.focus();
					return false;	
						}
	}
</script>
<style type="text/css">
td{
font-size:21px;	
	}
</style>
<body>
mini商城系统<p>

<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#fffff"bordercolorlight="#990033"width="300">
<form method="post" action="<?php $SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan="2" bgcolor="#0066CC" align="center" >管理员信息</td>
</tr>
<tr>
<td>管理员名称</td>
<td><input type="text" name="admin"></td>
</tr>
<tr>
<td>管理员密码</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>确认密码</td>
<td><input type="password"name="re_pass"></td>
</tr>
<tr>
<td>管理员邮箱</td>
<td><input type="text"name="mail"></td>
</tr>
<tr>
<td colspan="2" bgcolor="#00FF33"align="center">商品类别信息</td>
</tr>
<tr>
<td>默认商品类别名称</td>
<td><input type="text"name="type"></td>
</tr>
<tr>
<td>默认商品类别介绍</td>
<td><input type="text"name="description"></td>
</tr>
<tr>
<td colspan="2"align="center"><input type="submit" value="确认安装"></td>
</tr>
</form>
</table>
<?php
	}
	else
	{
		$admin=$_POST["admin"];//获取文本信息
		$pass=md5($_POST["pass"]);
		$mail=$_POST["mail"];
		$type=$_POST["type"];
		$description=$_POST["description"];
		$time=date("Y年m月d日");
		include"config.php";//加载配置文件
		
		$sql="insert  into $my_type(name,description)values('$type','$description')";
		mysqli_query($link,$sql)or exit(mysqli_error($my_conn));//插入默认类别
		$sql="insert into $my_user(name,password,email,reg_date,admin)values('$admin','$pass','$mail','$time',1)";
		$re=mysqli_query($link,$sql)or exit(mysqli_error());//插入管理员信息
		if($re)
		{ 
			echo "成功进入系统";
			echo"点击<a href='reg.php'>这里</a>注册新用户&nbsp;点击<a href=login.php>这里</a>登录";
			}
			echo"</center>";
	}
?>
</body>
</html>