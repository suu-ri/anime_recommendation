<?php
include 'auth.php'; // 引入 auth.php
checkUserSession(); // 调用会话检查函数
include 'config.php';
// 显示用户名
displayUsername();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];

    $stmt = $pdo->prepare("UPDATE recommendations SET title = ?, genre = ?, description = ?, rating = ? WHERE id = ?");
    $stmt->execute([$title, $genre, $description, $rating, $id]);

    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM recommendations WHERE id = ?");
$stmt->execute([$id]);
$recommendation = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recommendation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Anime Recommendation</h1>
    <!-- 登出按钮 -->
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>

    <?php
    // 处理登出请求
    if (isset($_POST['logout'])) {
        logoutUser(); // 调用登出函数
    }
    ?>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $recommendation['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($recommendation['title']); ?>" required>
        
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($recommendation['genre']); ?>">
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($recommendation['description']); ?></textarea>
        
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" value="<?php echo htmlspecialchars($recommendation['rating']); ?>" step="0.1" min="0" max="10" required>
        
        <button type="submit">Update Recommendation</button>
    </form>
</body>
</html>