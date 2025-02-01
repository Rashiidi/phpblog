<?php
require './db.php';
require './function.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$total_posts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Dashboard</title>
    <style>
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BlogApp</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            
        <li class="nav-item">
                <a class="nav-link" href="create_post.php">create post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_posts.php">Manage Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_users.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_categories.php">Manage Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Dashboard</h1>
    <p>Total Posts: <?php echo $total_posts; ?></p>
    <p>Total Users: <?php echo $total_users; ?></p>
    <p>Total Categories: <?php echo $total_categories; ?></p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>