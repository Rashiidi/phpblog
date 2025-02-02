<?php
session_start();
require './db.php';
require './function.php';

// if (!isset($_SESSION['user_id'])) {
//     redirect('login.php'); // Redirect to login if not logged in
// }

// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch user's posts
$stmt_posts = $pdo->prepare("SELECT * FROM posts WHERE user_id = ?");
$stmt_posts->execute([$user_id]);
$posts = $stmt_posts->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>User Dashboard</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BlogApp</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="edit_profile.php">Edit Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="../public/logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <h2>Your Posts</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No posts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>