<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "furniture_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Logika untuk menghapus barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $deleteQuery = "DELETE FROM furniture WHERE id='$id'";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: list.php");
        exit();
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
}

$query = "SELECT * FROM furniture";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="list-page">
    <div class="container">
        <h1>Produk Furniture</h1>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <li>
                <strong><?php echo htmlspecialchars($row['nama_barang']); ?></strong><br>
                <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_barang']); ?>" width="100"><br>
                <a href="detail.php?id=<?php echo $row['id']; ?>">Detail</a> | 
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <form method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </li>
            <?php endwhile; ?>
        </ul>
        <br>
        <a href="home.php">Kembali ke Home</a>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>