<?php
require './db.php';
require './function.php';



$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);
redirect('manage_users.php');