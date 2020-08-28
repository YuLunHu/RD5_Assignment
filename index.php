<?php 

session_start();
if (isset($_SESSION["userName"])) // 判斷登入與否
  $UserName = $_SESSION["userName"];
else 
  $UserName = "Guest"; // session中沒有使用者名稱即為Guest

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style_ok.css" rel="stylesheet">
  <link rel="stylesheet" href="css/core-style.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>首頁</title>
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

        <div style="position: absolute; color: blue; right: 0;">
          <div class="user-login-info">
            <a href="login.php">登入</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="col-md-12 text-center">
    <h2>Hi! <?= $UserName ?> , 祝您有美好的一天</h2>
  </div>


</body>

</html>