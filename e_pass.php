<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改密码</title>
</head>
<style type="text/css">
tr,td{font-size:21px}
</style>
<center>
修改用户密码<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<?php
error_reporting(0);
if(!$_COOKIE["login"])
{
?>
<tr><td align="center">
尚未登录，点击<a href="login.php">这里</a>登录;
</td></tr>
<?php
}
else
{
	echo"<tr><td align=\"center\" bgcolor=\"#ccccff\"colspan=2>";
	echo"<a href=show.php>首页</a>";
	echo"&nbsp;&nbsp;<a href=userinfo.php>查看用户".$_COOKIE["login"]."注册信息</a>";
	echo"&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
	echo"</td></tr>";//显示头部
	if(!$_POST["pass"])//提交密码显示前台
	{
		echo"<tr>";
		?>
        <script language="javascript">
		function check(f)
		{
			if(f.pass.value=="")
			{
				alert("请输入原始密码");
				f.pass.focus();
				return false;
				}
			if(f.new_pass.value=="")
			{
				alert("请输入新密码");
				f.new_pass.focus();
				return false;
				}
			if(f.new_pass.value==f.pass.value)
			{
				alert("新密码和原密码一样，重新输入新密码");
				f.new_pass.select();
				return false;
				}
				if(f.new_pass.value!=f.re_pass.value)
				{
					alert("重复密码不正确");
					f.re_pass.select();
					return false;
					}
				
			}
		
		

</script>
<form method="post"action="<?php $_SERVER["PHP_SELF"]?>"onsubmit="return check(this)">
<?php
echo"<td>原始密码:</td>";
echo"<td><input type=password name=pass></td>";
echo"</tr>";
echo"<tr>";
echo"<td>新的密码:</td>";
echo"<td><input type=password name=new_pass></td>";
echo"</tr>";
echo"<tr>";
echo"<td>重复的新密码：</td>";
echo"<td><input type=password name=re_pass></td>";
echo"<tr>";
echo"<td colspan=2 align=center>";
echo"<input type=\"submit\" value=\"确认修改\">";
echo"</td>";
echo"</tr>";
echo"</form>";
}
else{
	$password=md5($_POST['pass']);//获取原始密码
	$new_pass=md5($_POST['new_pass']);
	include"config.php";
	$sql="SELECT COUNT(*) FROM $my_user WHERE name='$_COOKIE[login]' AND password='$password'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	if($row[0]==0)//密码不正确
	{
		
		echo"<meta http-equiv=\"refresh\"content=\"2;url=e_pass.php\">";
		echo"<tr><td align=\"center\">输入原始密码错误<p>两秒后返回重新输入</td></tr>";
		}else
		{
			$sql="UPDATE $my_user SET password='$newpass' WHERE name='$_COOKIE[login]' AND password='$password'";
			$re=mysqli_query($sql);
			if($re)
			{
				echo"<meta http-equiv=\"refresh\"content=\"2;url=userinfo.php\">";
				echo"<tr><td align=\"center\"成功修改用户密码<p>两秒后跳转到信息查看页面</td></tr>";
				
			}
			else{
				echo"<meta http-equiv=\"refresh\"content=\"2;url=e_pass.php\">";
				echo"<tr><td align=\"center\"修改用户密码失败<p>两秒后返回重新输入</td></tr>";			
			}
	}
	}
	}
?>

</form>

</table>

