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
  <h2 style="text-align:center;" id="balance" name="balance" class="dollars"><?= $balance ?></h2>

  <script>
  
  let N = 0;
  $(document).ready(function() { // 點按金額可以屏蔽或顯示
    $("#balance").on('click', function() {
      N++;
      if (N % 2 == 1) {
        $(this).removeClass("dollars");
        $(this).addClass("hide");
      }
      else {
        $(this).removeClass("hide");
        $(this).addClass("dollars");
      }
    });
  });

  // function numberWithCommas(x) { // 將餘額以逗號分隔 <-------------------還沒接上去
  //   var parts = x.toString().split(".");
  //   parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  //   return parts.join(".");
  // }

  </script>


  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>