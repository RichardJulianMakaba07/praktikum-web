<?php
include 'koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM donations WHERE id=$id");

echo "<script>alert('Data donasi berhasil dihapus!');window.location='dashboard.php';</script>";
?>
