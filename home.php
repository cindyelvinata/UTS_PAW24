<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat datang, <?php echo $user; ?>!</h1>
        <p>Silakan pilih salah satu opsi di bawah ini:</p>
        <ul>
            <li><a href="list.php">Lihat List Barang</a></li>
            <li><a href="insert.php">Tambah Barang Baru</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</body>
</html>