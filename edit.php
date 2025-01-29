<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="edit.php?id=<?php echo $post['id']; ?>" method="POST">
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required>
    <textarea name="content" required><?php echo $post['content']; ?></textarea>
    <button type="submit">Update Post</button>
</form>

<?php
$servername = "localhost";
$username = "username"; // replace with your database username
$password = "password"; // replace with your database password
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
$stmt->bind_param("ssi", $title, $content, $id);

// Set parameters and execute
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_GET['id'];
$stmt->execute();

echo "Post updated successfully";

$stmt->close();
$conn->close();
?>
</body>
</html>