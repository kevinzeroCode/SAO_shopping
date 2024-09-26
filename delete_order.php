<?php
session_start();

include_once 'config.php';

$orderId = $_POST['orderId'];

// 執行刪除訂單的 SQL 語句
$sql = "DELETE FROM orders WHERE orderid = $orderId";

// 執行 SQL 語句
if ($conn->query($sql) === TRUE) {
    // 如果刪除成功，返回成功訊息
    echo "true";
} else {
    // 如果刪除失敗，返回錯誤訊息
    echo "false " . $conn->error;
}

?>
