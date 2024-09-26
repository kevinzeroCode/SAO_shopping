<?php
session_start();

include_once 'config.php';

$orderId = $_POST['orderId'];
$payname = $_POST['payname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$time = $_POST['time'];

// 更新資料庫中的訂單資料
$sql = "UPDATE orders 
        SET payname = '$payname', phone = '$phone', address = '$address', orderdate = '$time'
        WHERE orderid = '$orderId'";

if (mysqli_query($conn, $sql)) {
    echo "訂單更新成功";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
