<?php
require './db.php';
require './function.php';

// Uncomment this if you want to restrict access to admins only
// if (!isAdmin()) {
//     redirect('../public/index.php');
// }

// Check if the ID is provided in the URL
if (!isset($_GET['id'])) {
    redirect('manage_categories.php');
}

$id = $_GET['id'];

// Fetch the category details from the database
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

// If the category doesn't exist, redirect to the manage categories page
if (!$category) {
    redirect('manage_categories.php');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);

    // Validate the input
    if (empty($name)) {
        $error = "Category name is required.";
    } else {
        // Update the category in the database
        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);

        // Redirect to the manage categories page
        redirect('manage_categories.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Category</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BlogApp</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
           <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="create_category.php">Create Category</a></li>
            <li class="nav-item"><a class="nav-link" href="manage_posts.php">Manage Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Edit Category</h1>

    <!-- Display error message if any -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Edit Category Form -->
    <form method="POST">
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="manage_categories.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>