<?php
session_start(); 

// 清除会话
session_unset(); 
session_destroy();


header("Location: shopping_first.php"); 
exit;
?>
