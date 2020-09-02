<?php

session_start();

if (isset($_SESSION["nickName"])) {  // 判斷登入與否
    $nickName = $_SESSION["nickName"];
    $UserName = $_SESSION["userName"];
} else {
    echo "<script> alert('請先登入以使用此功能，即將為您跳轉至登入頁'); window.location='login.php' </script>";
}

require_once("connectMysql.php");

$sqlCommand = "SELECT `balance` FROM `userAccountInfo` WHERE `userName` = '$UserName'";
$result = mysqli_query($link, $sqlCommand);
mysqli_close($link);
$row = mysqli_fetch_assoc($result);
$balance = $row['balance'];
$formatBalance = number_format($balance,2,'.',','); // 千分位逗號分隔

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style_ok.css" rel="stylesheet">
  <link rel="stylesheet" href="css/core-style.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>查詢餘額</title>

</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

      <nav class="classy-navbar" id="essenceNav">
        <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>
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
              <li><a href="transaction.php">存/提款</a></li>
              <li><a href="queryBalance.php">查詢餘額</a></li>
              <li><a href="queryDetails.php">查詢明細</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="header-meta d-flex clearfix justify-content-end">
        <div class="search-area">
          <div style="float: right;">
            <div class="user-login-info">
              <a href="register.php">註冊</a>
            </div>
          </div>
          <div style="float: right;">
            <div class="user-login-info">
              <?php if ($nickName == "Guest") { ?>
              <a href="login.php">登入</a>
              <?php } else { ?>
              <a href="login.php?logout=1">登出</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>


  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>
  <h2 style="margin-left: 70px"> <?= $nickName ?> , 您的帳戶可用餘額為：</h2>


  <div style="height: 60px">
    <h2 style="text-align:center;display:none;" id="balance" name="balance" class="dollars"><?= $formatBalance ?></h2>
    <img id="eye" name="eye" style="margin:auto;display:block;" src="img/core-img/coin_dollar.png" alt="">
  </div>
  <div>
    <h3 style="text-align:center;">目前餘額
    <img id="eyeClosed" name="eyeClosed" style="vertical-align:middle;" src="img/core-img/eye_closed.png" alt=""></h3>
  </div>


  <script>
    // 顯示餘額（預設為屏蔽）
    $(document).ready(function () {
      $("#eyeClosed").on('click', function () {
        var x = document.getElementById("balance");
        var y = document.getElementById("eye");
        var z = document.getElementById("eyeClosed");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";
          z.src = "img/core-img/eye.png";
        }
        else {
          x.style.display = "none";
          y.style.display = "block";
          z.src = "img/core-img/eye_closed.png";
        }
      });
    });

  </script>

  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>