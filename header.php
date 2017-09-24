<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>头文件部分</title>
</head>

<style type="text/css">
tr,td{font-size:21px}
</style>

<center>
mini商城系统显示页面<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#33FF99"bordercolorlight="#CC00CC"width="80%">
<body>
<?php
error_reporting(E_ERROR);
	if(!$_COOKIE["login"])//如果用户未登录，显示登录表单
	{
?>
<script language="javascript">
function check(f)
{
	if(f.name.value=="")
	{
		alert("请输入登录用户名称");
		f.name.focus();
		return false;
		}
	if(f.pass.value=="")
	{
		alert("请输入登录密码");
		f.pass.focus();
		return false;	
			}
	}
   </script>
   <form method="post" action="login.php"onsubmit="return check(this)">
   <tr><td align="right">
   尚未登录，用户名<input type="text"name="name"size=6>密码<input type="password"name="pass"size=6>
   有效期<select name=c_1 size=1>
   <option value=0>不保存</option>
   <option value=<?php echo 3600*24?>>一天</option>
   <option value=<?php echo 3600*24*7?>>一周</option>
   <option value=<?php echo 3600*24*30?>>一月</option>
   </select><input type="submit"value="登录">
   </td></tr>
   </form>
   
<?php
	}
	else
	{
		echo"<tr><td align=\"right\">";//\\是用来转义字符的
		echo"欢迎你：";
		echo"<a href=userinfo.php>".$_COOKIE["login"]."</a>";//显示查看用户的信息链接
		echo"&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
		echo"</td></tr>";
		}
?>
</table>
</body>
</html>