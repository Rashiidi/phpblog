<?php
session_start(); // Ensure session is started

// Check if the session variable 'username' is set
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Database connection using PDO
$host = 'localhost';
$dbname = 'blog';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

// Create a new PDO instance
try {
    $pdo = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, output error message
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Fetch counts from database
$stmtUsers = $pdo->query("SELECT COUNT(*) FROM users");
$totalUsers = $stmtUsers->fetchColumn();

$stmtPosts = $pdo->query("SELECT COUNT(*) FROM posts");
$totalPosts = $stmtPosts->fetchColumn();

$stmtCategories = $pdo->query("SELECT COUNT(*) FROM categories");
$totalCategories = $stmtCategories->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /* Navbar Styling */
        nav {
            background-color: #343a40;
            padding: 10px;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        nav h1 {
            color: white;
            padding-left: ;
        }



        /* Main container styling */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Content Styling */
        .dashboard-stats p {
            font-size: 18px;
            margin: 10px 0;
        }

       
        
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
    
        <h1>BlogApp</h1>
        <a href="dashboard.php">Home</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_posts.php">Manage Posts</a>
        <a href="manage_categories.php">Manage Categories</a>
    </nav>


    <!-- Main content -->
    <div class="container">
        <div class="dashboard-stats">
            <p>Total Users: <?php echo $totalUsers; ?></p>
            <p>Total Posts: <?php echo $totalPosts; ?></p>
            <p>Total Categories: <?php echo $totalCategories; ?></p>
        </div>

        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="logout.php">Logout</a>
    </div>

   
</body>
</html>
