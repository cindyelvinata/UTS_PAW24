<?php
$conn = mysqli_connect("localhost", "root", "", "furniture_db");

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];

    if ($gambar) {
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
        $query = "UPDATE furniture SET nama_barang='$nama', deskripsi='$deskripsi', harga='$harga', gambar='$gambar' WHERE id='$id'";
    } else {
        $query = "UPDATE furniture SET nama_barang='$nama', deskripsi='$deskripsi', harga='$harga' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Barang berhasil diperbarui.";
        header("Location: list.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM furniture WHERE id='$id'");
$barang = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Barang</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $barang['id']; ?>">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo $barang['nama_barang']; ?>" required>
            <label>Deskripsi:</label>
            <textarea name="deskripsi" required><?php echo $barang['deskripsi']; ?></textarea><br>
            <label>Harga:</label>
            <input type="number" name="harga" value="<?php echo $barang['harga']; ?>" required>
            <label>Gambar:</label>
            <input type="file" name="gambar"><br>
            <input type="submit" value="Update">
        </form>
        <br><br>
        <a href="list.php">Kembali ke List Barang</a>
    </div>
</body>
</html>