<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];

    $stmt = $pdo->prepare("INSERT INTO recommendations (title, genre, description, rating) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $genre, $description, $rating]);

    header("Location: index.php");
    exit();
}
?>