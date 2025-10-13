<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM messages WHERE id=$id");
echo "<script>alert('Pesan berhasil dihapus!');window.location='dashboard.php';</script>";
?>
