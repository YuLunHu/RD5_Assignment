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
  $UserName = $_POST["LoginID"];
  $Password = $_POST["LoginPassword"];
	if (trim($UserName) != "" && trim($Password) != "") // 去除前後的空白，判斷使用者名稱和密碼是否為空字串
	{
    $_SESSION['userName'] = $UserName; // 將使用者名稱存入session
    header("Location: index.php");
  }
  else {
    echo "<script> alert('您的帳號或密碼忘了輸入喔！'); </script>";
  }
	
}

?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style_ok.css" rel="stylesheet">
  <link rel="stylesheet" href="css/core-style.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>Lab - Login</title>
</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
      <nav class="classy-navbar" id="essenceNav">
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"><span></span><span></span><span></span></span>
        </div>
        <div class="classy-menu">
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>
          <div class="classynav">
            <ul>
              <li><a href="index.php">首頁</a></li>
              <li><a href="#">存款</a></li>
              <li><a href="#">提款</a></li>
              <li><a href="#">查詢餘額</a></li>
              <li><a href="#">查詢明細</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="col-md-12 text-center">
    <h2>會員登入</h2>
  </div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form class="ng-pristine ng-valid">
        <div class="login-form clearfix">
          <div class="form-title hidden-xs">
            帳號
          </div>
          <input type="text" name="LoginID" id="LoginID" tabindex="3" placeholder="請在此輸入帳號" autocomplete="on">
          <div class="form-title hidden-xs">
            密碼 <a href="login-forgot-pwd.asp">忘記密碼？</a>
          </div>
          <input type="password" name="LoginPassword" id="LoginPassword" tabindex="4" placeholder="請在此輸入密碼">
          <a class="visible-xs" href="login-forgot-pwd.asp">忘記密碼？</a>
        </div>
        <button name="btnOK" id="btnOK" type="submit" class="plain-btn -login-btn" onclick="Login()"
          tabindex="5">登入</button>
        <br>
      </form>
    </div>
  </div>
  <div class="col-md-12 text-center">
    <h4>還不是會員嗎？<a class="link-center" href="register.asp"><u>立刻註冊新帳號</u></a></h4>
  </div>



</body>

</html>