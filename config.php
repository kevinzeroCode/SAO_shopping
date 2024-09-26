<?php
// 資料庫連接參數
$servername = "127.0.0.1"; //原本是localhost
$username = "root"; 
$password ="E663663"; 
$dbname = "shopping"; 

// 建立資料庫連接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 檢查連線
if (!$conn) {
    die("資料庫連接失敗: " . mysqli_connect_error());
}
?>