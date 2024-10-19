<?php
$conn = mysqli_connect("localhost", "root", "", "furniture_db");
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    if (mysqli_query($conn, $query)) {
        $message = "<div class='success'>Pendaftaran Sukses! <a href='login.php'>Silakan login</a></div>";
    } else {
        $message = "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <input type="submit" value="Register">
        </form>
    </div>
    
    <!-- Pemberitahuan registrasi -->
    <?php echo $message; ?> 
</body>
</html>