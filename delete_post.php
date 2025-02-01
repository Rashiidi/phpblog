<?php
require './db.php';
require './function.php';

// if (!isAdmin()) {
//     redirect('index.php');
// }

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);
redirect('manage_posts.php');