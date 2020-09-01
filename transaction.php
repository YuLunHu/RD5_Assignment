<?php 

session_start();
if (isset($_SESSION["nickName"])) {  // 判斷登入與否
    $nickName = $_SESSION["nickName"];
    $UserName = $_SESSION["userName"];
} else {
    echo "<script> alert('請先登入以使用此功能，即將為您跳轉至登入頁'); window.location='login.php' </script>";
}

if (isset($_POST["doTrans"])) // 執行交易
{
  $selectTransType = $_POST["selectTransType"];
  $trade = (int) $_POST["trade"];

  require_once("connectMysql.php");
  $sqlCommand = "SELECT `userID`, `balance` FROM `userAccountInfo` WHERE `userName` = '$UserName'";
  $result = mysqli_query($link, $sqlCommand);
  $row = mysqli_fetch_assoc($result);
  $userID = $row['userID']; // 帳戶編號
  $balance = $row['balance']; // 帳戶餘額

  if ($selectTransType == "deposit") { // 存款功能 <--------------------
    $afterBalance = $balance + $trade;
    require_once("insertTrans.php");
  }
  else { // 提款功能 <--------------------
    $afterBalance = $balance - $trade;
    if ($afterBalance >= 0) {
      require_once("insertTrans.php");
    }
    else {
      echo "<script> alert('交易失敗！餘額不足'); window.location = 'transaction.php' </script>";
    }
  }
  mysqli_close($link);
}

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
  <title>交易</title>

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
  <h2 style="margin-left: 70px">Hi! <?= $nickName ?> , 今天想來點什麼交易呢？</h2>
  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form method="POST" class="ng-pristine ng-valid">

        <div class="form-group row">
          <label class="col-5 col-form-label" for="selectTransType" style="font-size: 20px;">請選擇:</label>
          <select id="selectTransType" name="selectTransType">
            <option value="deposit">存款</option>
            <option value="withdraw">提款</option>
          </select>
        </div>

        <div class="login-form clearfix">
          <div class="form-title hidden-xs">金額</div>
          <input type="text" name="trade" id="trade" pattern="^[0-9]*[1-9][0-9]*$" required tabindex="1"
            placeholder="請在此輸入交易金額">

          <button name="doTrans" id="doTrans" type="submit" class="plain-btn -login-btn" tabindex="2">執行交易</button>
      </form>
    </div>
  </div>

  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>