<?php
session_start();
require './db.php';
require './function.php';

// if (!isset($_SESSION['user_id'])) {
//     redirect('login.php'); // Redirect to login if not logged in
// }

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $_SESSION['user_id']]);
}

redirect('user.php'); // Redirect back to the dashboard after deletion