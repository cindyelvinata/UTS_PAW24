<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
    <div class="container">
        <h2>Halo, Selamat Datang</h2>
        <p>Silakan pilih opsi berikut ini:</p>
        <?php if (isset($_SESSION['username'])): ?>
            <p>Selamat datang kembali, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <a href="home.php" class="button">Home</a>
            <a href="logout.php" class="button">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="button">Login</a>
            <a href="register.php" class="button">Register</a>
        <?php endif; ?>
    </div>
</body>
</html>