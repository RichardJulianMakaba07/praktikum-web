<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama_lengkap'];
    $password = md5($_POST['password']);
    $level = 'user'; // default

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, level) 
                             VALUES ('$username', '$password', '$nama', '$level')");
        echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - FoodCycle</title>
    <style>
        body { background: #f5f5f5; font-family: 'Poppins', sans-serif; }
        .register-box { width: 400px; margin: 100px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2e7d32; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 6px; }
        button { width: 100%; padding: 10px; background: #4caf50; color: #fff; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        button:hover { background: #2e7d32; }
        .link { text-align: center; margin-top: 10px; }
        .link a { color: #4caf50; text-decoration: none; }
        .link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Daftar Akun Baru</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Daftar</button>
        </form>
        <div class="link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
</body>
</html>
