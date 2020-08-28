<?php 

session_start();
if (isset($_GET["logout"])) // 判斷是否有收到logout的值
{
  unset($_SESSION["userName"]); // 若有則代表使用者登出，將session清除
  
  $_SESSION['userName'] = "Guest"; // 回歸訪客的身份
	header("Location: index.php"); // 重導回首頁
	exit();
}

if (isset($_POST["btnOK"]))
{
  $UserName = $_POST["txtUserName"];
  $Password = $_POST["txtPassword"];
	if (trim($UserName) != "" && trim($Password) != "") // 去除前後的空白，判斷使用者名稱和密碼是否為空字串
	{
    $_SESSION['userName'] = $UserName; // 將使用者名稱存入session
    header("Location: index.php");
  }
  else {
    echo "<script> alert('您的帳號或密碼忘了輸入喔！'); </script>";
  }
	
}

if (isset($_POST["btnHome"]))
{
	header("Location: index.php");
	exit();
}
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="css/style.css" rel="stylesheet">
	<title>Lab - Login</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="login.php">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td class="title" colspan="2" align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">會員系統 - 登入</font></td>
    </tr>
    <tr>
      <td class="welcome" width="80" align="center" valign="baseline">帳號</td>
      <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
    </tr>
    <tr>
      <td class="welcome" width="80" align="center" valign="baseline">密碼</td>
      <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">
        <input class="btn" type="submit" name="btnOK" id="btnOK" value="登入" />
        <input class="btn" type="reset" name="btnReset" id="btnReset" value="註冊" />
        <input class="btn" type="submit" name="btnHome" id="btnHome" value="回首頁" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>