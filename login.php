<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登录模块</title>
</head>
<?php
error_reporting(E_ERROR);
if(!$_POST['name'])//没有提交用户名则显示前台
{
	echo"<center>";
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
<style type="text/css">
tr,td{font-size:21px}
</style>
<body>
mini商城登录程序<p>
<table border="1"cellspacing="0"cellpadding="1"bordercolordark="#00CCFF"bordercolorlight="#FF0000"width="300">
<form  method="post"action="<?php $_SERVER["PHP_SELF"]?>" onSubmit="return check(this)">
<tr>
<td colspan="2"bgcolor="#FF0000"align="center">登录用户信息</td>
</tr>
<tr>
<td>用户名称</td>
<td><input type="text"name="name"></td>
</tr>
<tr>
<td>用户密码</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>登录有效期</td>
<td>
<select name=c_1 size=1>
<option value=0>不保存</option>
<option value=<?php echo 3600*24?>>一天</option>
<option value=<?php echo 3600*24*7?>>一周</option>
<option value=<?php echo 3600*24*30?>>一个月</option>
</select>
</td>
</tr>
<tr>
<td colspan="2"align="center"><input type="submit"value="登录"></td>
</tr>
</form>
</table><!-- -->
<?php
}else
{
	$name=$_POST["name"];
	$pass=md5($_POST["pass"]);
	$c_1=$_POST["c_1"];//获取cookie保存期
	include"config.php";//加载配置文件
	$sql="SELECT count(*) FROM $my_user WHERE name='$name' AND password='$pass'";
	echo $sql;//查询操作
	$re=mysqli_query($link,$sql)or exit(mysqli_error());
	$count=mysqli_fetch_row($re);//获取结果集
	echo $count;
	
	 if($count[0]>0)
	{
		setcookie("login",$name,time()+$c_1);//写入cookie
		echo"<meta http-equiv=\"refresh\"content=\"2;url=show.php\">";
		echo"<center>";
		echo"成功登录mini商城系统<p>";
		echo"两秒后进入浏览商品界面";
	}else{
		echo"<center>";
		echo"<meta http-equi/v=\"refresh\"content=\"2;url=login.php\">";
		echo"不存在制定用户<p>";
		echo"或者输入的用户名或者密码错误<p>";
		echo"2秒后返回重新输入";
		
		}
	} 
	echo"</center>";
?>
</body>
</html>