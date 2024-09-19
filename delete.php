<?php
include 'auth.php'; // 引入 auth.php
checkUserSession(); // 调用会话检查函数
include 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM recommendations WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit();
?>