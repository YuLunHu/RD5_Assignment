<?php 

session_start();

if (isset($_POST["register"]))
{
  $UserName = $_POST["userName"];
  $Password = $_POST["userPassword"];
  $confirmPassword = $_POST["confirmPassword"];
  $nickName = $_POST["nickName"];
  
  if ($Password == $confirmPassword) {
    require_once("connectMysql.php");

    $sqlCommand = "SELECT * FROM `userAccountInfo` WHERE `userName` = '$UserName'";
    $result = mysqli_query($link, $sqlCommand);

    if ($row = mysqli_fetch_assoc($result)) { // 驗證該帳號是否已存在
      echo "<script> alert('該帳號已被使用！') </script>";
    }
    else {
      $sqlCommand = "INSERT INTO `userAccountInfo` (`userName`, `userPassword`, `nickName`) VALUES ('$UserName', '$Password', '$nickName')";
      $result = mysqli_query($link, $sqlCommand);
      mysqli_close($link);

      if ($result) {
        echo "<script> alert('註冊成功，即將為您跳轉至首頁') </script>";
        // header("Location: index.php");
      }
      else {
        die('Error: ' . mysql_error());//如果sql執行失敗輸出錯誤
      }
    }
  }
  else {
    echo "<script> alert('您輸入的密碼兩次不一樣喔！') </script>";
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
  <title>註冊</title>
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
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div class="col-md-12 text-center">
    <h2>註冊帳號</h2>
  </div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form method="post" class="ng-pristine ng-valid">
        <div class="login-form clearfix">
          <div class="form-title hidden-xs">帳號</div>
          <input type="text" name="userName" id="userName" tabindex="3" placeholder="請設定帳號" required>
          <div class="form-title hidden-xs">密碼<a>（格式：需為8~12個字以上的英文或數字）</a></div>
          <input type="password" name="userPassword" id="userPassword" pattern="[a-zA-Z0-9]{8,12}" required tabindex="4"
            placeholder="請設定密碼">
          <div class="form-title hidden-xs">密碼確認</div>
          <input type="password" name="confirmPassword" id="confirmPassword" pattern="[a-zA-Z0-9]{8,}" require tabindex="4"
            placeholder="請再輸入一次密碼">
          <div class="form-title hidden-xs">暱稱</div>
          <input type="text" name="nickName" id="nickName" tabindex="3" placeholder="請在此輸入您的暱稱" required>
        </div>
        <button name="register" id="register" type="submit" class="plain-btn -login-btn" tabindex="5">註冊</button>
      </form>

    </div>
  </div>

</body>

</html>