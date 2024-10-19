<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo isset($title) ? $title : 'Situs Furniture'; ?></title>
</head>
<body>
    <div class="header">
        <h1>Welcome to Furniture Store</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <p>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Log Out</a></p>
        <?php else: ?>
            <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>