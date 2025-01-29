<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="post.php" method="POST">
    <input type="text" name="title" placeholder="Post Title" required>
    <textarea name="content" placeholder="Post Content" required></textarea>
    <button type="submit">Create Post</button>
</form>


<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "blog";

// Create connection
$conn = new mysqli('localhost', 'root', '', 'blog');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);

// Set parameters and execute
$title = isset($_POST['title']) ? $_POST['title'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$stmt->execute();

echo "New post created successfully";

$stmt->close();
$conn->close();
?>
</body>
</html>