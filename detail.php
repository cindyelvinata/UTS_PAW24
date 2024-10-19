<?php
$conn = mysqli_connect("localhost", "root", "", "furniture_db");

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM furniture WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Jika data ditemukan
        $barang = mysqli_fetch_assoc($result);
    } else {
        echo "Data barang tidak ditemukan.";
        exit();
    }
} else {
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Detail Barang</h1>
        <p><strong>Nama:</strong> <?php echo $barang['nama_barang']; ?></p>
        <p><strong>Deskripsi:</strong> <?php echo $barang['deskripsi']; ?></p>
        <p><strong>Harga:</strong> Rp<?php echo number_format($barang['harga'], 0, ',', '.'); ?></p>
        <p><strong>Gambar:</strong></p>
        <img src="uploads/<?php echo $barang['gambar']; ?>" alt="Gambar Barang" style="width:200px;">
        <br><br>
        <a href="list.php">Kembali ke List Barang</a>
    </div>
</body>
</html>