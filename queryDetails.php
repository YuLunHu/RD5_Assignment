<?php

session_start();

if (isset($_SESSION["nickName"])) {  // 判斷登入與否
    $nickName = $_SESSION["nickName"];
    $UserName = $_SESSION["userName"];
} else {
    echo "<script> alert('請先登入以使用此功能，即將為您跳轉至登入頁'); window.location='login.php' </script>";
}

if (isset($_POST["query"]))
{
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
}

require_once("connectMysql.php");

if ($startDate == $endDate) { // 若開始和結束都選擇一樣表示要查那天的資料，改語法用LIKE
    $sqlCommand = "SELECT * FROM (SELECT * FROM `transaction` WHERE `userID` = 
    (SELECT `userID` FROM `userAccountInfo` WHERE `userName` = '$UserName')) as T
    WHERE T.trsansTime LIKE '$startDate%' ORDER BY T.trsansTime DESC";
}
else {
    $sqlCommand = "SELECT * FROM (SELECT * FROM `transaction` WHERE `userID` = 
    (SELECT `userID` FROM `userAccountInfo` WHERE `userName` = '$UserName')) as T
    WHERE T.trsansTime BETWEEN '$startDate' AND (SELECT date_sub('$endDate',interval -1 day)) ORDER BY T.trsansTime DESC";
}

$result = mysqli_query($link, $sqlCommand);
mysqli_close($link);

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
  <title>查詢明細</title>

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
  <h2 style="margin-left: 70px"> <?= $nickName ?> , 以下為歷史交易明細，或是您可以選擇查詢的區間</h2>
  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form method="POST" class="ng-pristine ng-valid">
        <div class="login-form clearfix">

          <div class="form-title hidden-xs">開始日期</div>
          <input type="date" name="startDate" id="startDate" tabindex="1">
          <div class="form-title hidden-xs">結束日期</div>
          <input type="date" name="endDate" id="endDate" tabindex="2">

          <button name="query" id="query" type="submit" class="plain-btn -login-btn" tabindex="3">查詢</button>
      </form>
    </div>
  </div>

  <?php if (($result->num_rows) != 0) { ?>

  <div id="queryTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">

      <thead>
        <tr>
          <th scope="col" id="transID" class="height-100">交易編號</th>
          <th scope="col" id="trsansTime">交易時間</th>
          <th scope="col" id="beforeBalance">交易前餘額</th>
          <th scope="col" id="trade">本次交易金額</th>
          <th scope="col" id="afterBalance">交易後餘額</th>
        </tr>
      </thead>

      <tbody id="queryResult">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <th scope="col" id="transID" class="height-100"><?= $row['transID'] ?></th>
          <th scope="col" id="trsansTime"><?= $row['trsansTime'] ?></th>
          <th scope="col" id="beforeBalance"><?= $row['beforeBalance'] ?></th>
          <th scope="col" id="trade"><?= $row['trade'] ?></th>
          <th scope="col" id="afterBalance"><?= $row['afterBalance'] ?></th>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <?php } else { ?>
  <div class="col-md-12 text-center" style="color: red;">您選擇的區間查無資料！</div>
  <?php } ?>


  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>