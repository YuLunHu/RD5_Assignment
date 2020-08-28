<?php 

session_start();

if ($_SESSION["userName"] === "Guest") // 如果是訪客身份就導至登入頁面
{
	header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet">
<title>Lag - Member Page</title>
</head>
<body>

<table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
  <tr>
    <td class="title" align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">會員系統 － 會員專用</font></td>
  </tr>
  <tr>
    <td class="welcome" align="center" valign="baseline">--This page for member only-- <?php echo "<br>歡迎回來！ " . $_SESSION["userName"] ?></td>
  </tr>
  <tr>
    <td class="welcome" align="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a></td>
  </tr>
</table>

</body>
</html>