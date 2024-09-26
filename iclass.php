<?php

// MySQL 連線資訊
$servername = "localhost"; // 資料庫伺服器位置，預設為本地
$username = "root"; // 資料庫使用者名稱
$password = ""; // 資料庫密碼
$database = "northwind"; // 資料庫名稱

// 建立連線
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// SQL 查詢語句
$sql = "SELECT * FROM Product";

// 執行查詢
$result=$conn->query($sql);

// 檢查查詢結果是否有資料
if ($result->num_rows > 0) {
    // 輸出資料
    while ($row=$result->fetch_assoc()) {
        echo "ProductID: " 
        .$row["productName"]
        . " - UnitPrice: " 
        . $row["unitPrice"]
        . "<br>";
    }
} else {
    echo "0 筆結果";
}

// 關閉連線
$conn->close();

?>