<?php
session_start();

function checkUserSession() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function displayUsername() {
    if (isset($_SESSION['username'])) {
        echo "<p>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</p>";
    }
}

function logoutUser() {
    if (isset($_SESSION['user_id'])) {
        session_destroy(); // 销毁会话
        header("Location: login.php"); // 重定向到登录页面
        exit();
    }
}
?>