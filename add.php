<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'auth.php'; // 引入 auth.php
checkUserSession(); // 检查用户是否登录

include 'config.php'; // 数据库配置

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];

    // 插入推荐动画
    $stmt = $pdo->prepare("INSERT INTO recommendations (title, genre, description, rating) VALUES (?, ?, ?, ?)");
    
    if ($stmt->execute([$title, $genre, $description, $rating])) {
        // 插入成功后重定向到主页
        header("Location: index.php");
        exit();
    } else {
        // 如果插入失败，仍然重定向到主页
        header("Location: index.php");
        exit();
    }
} else {
    // 如果没有 POST 请求，重定向到主页
    header("Location: index.php");
    exit();
}
?>