<?php
require './db.php';
require './function.php';



$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$id]);
redirect('manage_categories.php');