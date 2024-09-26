<?php
require_once 'config.php'; 

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// 驗證輸入
if (empty($username) || empty($email) || empty($password)) {
    echo "請填寫所有字段";
    exit;
}

// 檢查用戶是否存在
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "用戶名稱或電子郵箱已存在";
    exit;
}

//新增用戶
$password_hash = password_hash($password, PASSWORD_DEFAULT); // 安全加密密码
$stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password_hash);
$stmt->execute();

echo "註冊成功";
// $output = shell_exec("C:\xampp\htdocs\RegSendMail.py". escapeshellarg($email));
?>
