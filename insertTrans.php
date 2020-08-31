<?php

// 先更新使用者帳戶資訊表內的餘額
$sqlCommand = "UPDATE `userAccountInfo` SET `balance` = '$afterBalance' WHERE `userName` = '$UserName'";
$result = mysqli_query($link, $sqlCommand);
$datetime = date("Y-m-d H:i:s", mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y')));

// 再將本次交易新增明細
$sqlCommand = "INSERT INTO `transaction` 
(`userID`, `trsansDate`, `tranType`, `beforeBalance`, `trade`, `afterBalance`) VALUES 
('$userID', '$datetime', '$selectTransType', '$balance', '$trade', '$afterBalance')";
$result = mysqli_query($link, $sqlCommand);

if ($result) {
    echo "<script> alert('交易完成，本次交易明細如下'); window.location='transaction.php' </script>";
    // --------------這邊要做顯示明細的功能-----------------
  } else {
    die('Error: ' . mysql_error()); //如果sql執行失敗輸出錯誤
  }

?>