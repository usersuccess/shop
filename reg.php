<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>用户注册</title>
</head>
<?php
	echo"<center>";
	if(!$_POST["name"])
	{
?>
<script language="javascript">
function check(f)
{
	if(f.name.value=="")
	{
		alert("请输入用户员名称");
		f.admin.focus();
		return false;
		}
		if(f.pass.value=="")
		{
			alert("请输入用户密码");
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
					alert("请输入注册用户员邮箱");
					f.mail.focus();
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
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#fffff"bordercolorlight="#990033"width="300">
<form method="post" action="<?php $SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan="2" bgcolor="#0066CC" align="center" >注册用户员信息</td>
</tr>
<tr>
<td>注册用户名称</td>
<td><input type="text" name="name"></td>
</tr>
<tr>
<td>用户密码</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>确认密码</td>
<td><input type="password"name="re_pass"></td>
</tr>
<tr>
<td>用户邮箱</td>
<td><input type="text"name="mail"></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="注册"></td>
</tr>
</form>
</table>
<?php
	}
	else
	{
		$name=$_POST["name"];//取得文件的值
		$pass=md5($_POST["pass"]);	//md5在线加密
		$mail=$_POST["mail"];
		$time=date("Y年m月d日");
		include"config.php";//加载配置文件
		$sql="SELECT count(*)  FROM $my_user WHERE name='$name'";
		$re=mysql_query($sql,$my_conn)or  die(mysql_error());
		$count=mysql_fetch_row($re);//获取同名用户数量
		if($count[0]>0)//因为只有一行所以count[0]就可以输出所有数
	{
			echo"已经存在用户名<p>";
			echo"点击<a href=reg.php>这里</a>注册新用户&nbsp;点击<a href=login.php>这里</a>登录";
		}
		else
		{
		$sql="INSERT INTO $my_user(name,password,email,reg_date)values('$name','$pass','$mail','$time')";
		$re=mysql_query($sql,$my_conn)or die(mysql_error());
		if($re)
		{
			echo "成功注册用户:".$name."<p>";
			echo"点击<a href=login.php>这里</a>登录";
			}	
		}
	}
	echo"</center>";
?>
</body>
</html>