<?php

// 先更新使用者帳戶資訊表內的餘額
$sqlCommand = "UPDATE `userAccountInfo` SET `balance` = '$afterBalance' WHERE `userName` = '$UserName'";
$result = mysqli_query($link, $sqlCommand);
$datetime = date("Y-m-d H:i:s", mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y')));

// 再將本次交易新增明細
$sqlCommand = "INSERT INTO `transaction` 
(`userID`, `trsansTime`, `transType`, `beforeBalance`, `trade`, `afterBalance`) VALUES 
('$userID', '$datetime', '$selectTransType', '$balance', '$trade', '$afterBalance')";
$result = mysqli_query($link, $sqlCommand);

if ($result) {

  // 查詢本次交易的交易編號
  $sqlCommand = "SELECT `transID`, `afterBalance` FROM `transaction` WHERE `trsansTime` = '$datetime'";
  $result = mysqli_query($link, $sqlCommand);
  $row = mysqli_fetch_assoc($result);

  $_SESSION['transID'] = $row['transID'];
  $_SESSION['datetime'] = $datetime;
  $_SESSION['beforeBalance'] = $balance;
  $_SESSION['trade'] = $trade;
  $_SESSION['afterBalance'] = $row['afterBalance'];

  echo "<script> alert('交易完成，本次交易明細如下'); window.location='transDetails.php' </script>";
} else {
  die('Error: ' . mysql_error()); //如果sql執行失敗輸出錯誤
}

?>