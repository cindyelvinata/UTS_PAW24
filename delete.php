<?php

$conn = mysqli_connect("localhost", "root", "", "nama_database");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel
    $sql = "DELETE FROM furniture WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

header("Location: list.php");
exit();
?>