<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>退出登录</title>
<?php
	setcookie("login");
	echo"<meta http-equiv=\"refresh\"content=\"2;url=show.php\">";
	echo"<center>";
	echo"成功退出商城";echo"两秒后进入商品浏览页面";
	echo"</center>";
?>
</html>