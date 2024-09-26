<?php
session_start(); // 开始会话
require_once 'config.php'; // 数据库连接

// 獲得 POST 数据
$username = $_POST['username'];
$password = $_POST['password'];

// 檢查輸入
if (empty($username) || empty($password)) {
    echo "请填寫所有欄位";
    exit;
}

// 從資料庫找用戶
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // 獲得用戶資料
    $user = $result->fetch_assoc();

    // 驗證密碼
    if (password_verify($password, $user['password_hash'])) {
        // 设置会话
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "登录成功"; 
    } else {
        echo "用户名或密码错误"; 
    }
} else {
    echo "用户名不存在"; 
}
?>
