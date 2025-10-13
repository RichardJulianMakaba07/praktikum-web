<?php
// koneksi.php
$host = "localhost";     // Nama host database (biasanya localhost)
$user = "root";          // Username MySQL
$pass = "";              // Password MySQL (kosong jika default XAMPP)
$db   = "foodcycle_db";  // Nama database yang akan digunakan

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
