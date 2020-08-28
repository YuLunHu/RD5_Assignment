<?php 

session_start(); // 啟動session
if (isset($_SESSION["userName"])) // 判斷登入與否
  $UserName = $_SESSION["userName"];
else 
  $UserName = "Guest"; // session中沒有使用者名稱即為Guest

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet">
<title>首頁</title>
</head>
<body>

<table width="300" border="0" align="center" cellpadding="7" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td class="title" align="center" bgcolor="#CCCCCC">會員系統 - 首頁</font></td>
  </tr>
  <tr>

  <?php if ($UserName == "Guest") { ?>
    <td align="center" valign="baseline">
      <input class="btn" type="button" onclick="javascript:location.href='login.php'" value="登入"></input>
  <?php } else { ?>
    <td  align="center" valign="baseline">
      <input class="btn" type="button" onclick="javascript:location.href='login.php?logout=1'" value="登出"></input>
  <?php } ?>
    | <input class="btn" type="button" onclick="javascript:location.href='member.php'" value="會員專用頁"></input>

  </tr>
  <tr>
    <td class="welcome" align="center" bgcolor="#CCCCCC"><?php echo "Welcome! " . $UserName ?></td>
  </tr>
  
</table>

</body>
</html>