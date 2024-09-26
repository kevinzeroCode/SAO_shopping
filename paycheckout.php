<?php
require_once 'config.php';
session_start();

// 檢查用戶是否已經登入
if (!isset($_SESSION['username'])) {
    // 如果未登入，將用戶重新導向到登入頁面
    header("Location: login.php");
    exit(); // 結束程式執行，確保用戶不會繼續訪問未授權的頁面
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單數據
    $payname = $_POST["payname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $totalAmount = $_POST["totalAmount"];
    $order = $_POST["order"];
    $orderdate = $_POST["time"];
    $userid = $_SESSION['user_id'];

    // 檢查變量是否有值
    if (empty($payname) || empty($phone) || empty($address) || empty($totalAmount) || empty($order) || empty($userid)) {
        echo "所有欄位都必須填寫。";
        exit(); // 結束程式執行
    }

    
    $sql1 = "
    INSERT INTO `orders`(`phone`, `address`, `customerid`, `total`, `payname`, `orderdate`) 
    VALUES ('$phone', '$address', '$userid', '$totalAmount', '$payname', '$orderdate')
    ";

    
    if ($conn->query($sql1) === TRUE) {
        $orderid = $conn->insert_id;
        echo "訂單已成功提交！訂單 id 是 " . $orderid . "\n";
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error . "\n";
    }

    foreach($order as $item){
        $productid = $item[0];
        $result = $conn->query("SELECT * FROM product WHERE productid = '$productid'");
    
        if ($result->num_rows > 0) {
            // productid 存在，可以插入新記錄
            $sql2 = "
            INSERT INTO `orderdetail`(`orderid`,`productid`, `name`, `price`, `amount`) 
            VALUES ('$orderid','$productid', '{$item[1]}', '{$item[2]}', '{$item[3]}')
            ";
            if ($conn->query($sql2) === TRUE) {
                echo "商品: '{$item[0]}', '{$item[1]}', '{$item[2]}', '{$item[3]}' 已成功添加到訂單中。\n";
            } else {
                echo "錯誤: " . $sql . "<br>" . $conn->error."\n";
            }
        } else {
            echo "錯誤: productid: $productid 在 product 表格中不存在。\n";
        }
    }
}
?>
