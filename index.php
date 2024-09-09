<?php
include 'config.php';

// Check if sorting by rating is requested
$sortByRating = isset($_GET['sort_by_rating']) ? true : false;

// Get recommendation list
$query = "SELECT * FROM recommendations" . ($sortByRating ? " ORDER BY rating DESC" : " ORDER BY created_at DESC");
$stmt = $pdo->query($query);
$recommendations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anime Recommendation Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Anime Recommendation Platform</h1>
    
    <form action="add.php" method="POST">
        <h2>Add Anime Recommendation</h2>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre">
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" step="0.1" min="0" max="10" required>
        
        <button type="submit">Submit Recommendation</button>
    </form>

    <h2>Recommendation List</h2>
    <a href="?sort_by_rating=true"><button>Sort by Rating</button></a>
    <ul>
        <?php foreach ($recommendations as $recommendation): ?>
            <li>
                <strong><?php echo htmlspecialchars($recommendation['title']); ?></strong> (<?php echo htmlspecialchars($recommendation['genre']); ?>)
                <p><?php echo htmlspecialchars($recommendation['description']); ?></p>
                <p>Rating: <?php echo htmlspecialchars($recommendation['rating']); ?></p>
                <a class="edit" href="edit.php?id=<?php echo $recommendation['id']; ?>">Edit</a>
                <a class="delete" href="delete.php?id=<?php echo $recommendation['id']; ?>" onclick="return confirm('Are you sure you want to delete this recommendation?');">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>