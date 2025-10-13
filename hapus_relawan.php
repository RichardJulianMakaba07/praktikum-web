<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM volunteers WHERE id=$id");
echo "<script>alert('Data relawan berhasil dihapus!');window.location='dashboard.php';</script>";
?>
