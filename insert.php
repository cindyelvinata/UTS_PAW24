<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "furniture_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO furniture (nama_barang, deskripsi, harga, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $nama_barang, $deskripsi, $harga, $gambar);
        $stmt->execute();
        echo "<div class='success'>Barang berhasil ditambahkan!</div>";
    } else {
        echo "<div class='error'>Gagal mengupload gambar.</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
            <label>Deskripsi:</label>
            <textarea name="deskripsi" required></textarea>
            <label>Harga:</label>
            <input type="number" name="harga" required>
            <label>Upload Gambar:</label>
            <input type="file" name="gambar" required>
            <input type="submit" value="Tambah Barang">
        </form>
        <br>
        <a href="list.php">Kembali ke List Barang</a>
    </div>
</body>
</html>