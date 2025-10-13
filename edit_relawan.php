<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM volunteers WHERE id=$id"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama_relawan'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $area = $_POST['area'];
    $ketersediaan = $_POST['ketersediaan'];
    $transportasi = $_POST['transportasi'];
    $alasan = $_POST['alasan'];

    mysqli_query($conn, "UPDATE volunteers SET 
        nama_relawan='$nama', 
        email='$email',
        telepon='$telepon',
        area='$area',
        ketersediaan='$ketersediaan',
        transportasi='$transportasi',
        alasan='$alasan'
        WHERE id=$id");

    echo "<script>alert('Data relawan berhasil diperbarui!');window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Relawan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {background: #4caf50}
        h2 {
        padding: 25px;
        max-width: 500px;
        margin: 20px auto;
        }
        form {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        max-width: 500px;
        margin: 20px auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        form input, form select, form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        }
        form button {
        background: #4caf50;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        }
        form button:hover {
        background: #2e7d32;
        }
    </style>
</head>
<body>
    <h2>Edit Data Relawan</h2>
    <form method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_relawan" value="<?= $data['nama_relawan']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $data['email']; ?>" required><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="telepon" value="<?= $data['telepon']; ?>" required><br><br>

        <label>Area Tinggal:</label><br>
        <input type="text" name="area" value="<?= $data['area']; ?>" required><br><br>

        <label>Ketersediaan:</label><br>
        <input type="text" name="ketersediaan" value="<?= $data['ketersediaan']; ?>" required><br><br>

        <label>Transportasi:</label><br>
        <input type="text" name="transportasi" value="<?= $data['transportasi']; ?>" required><br><br>

        <label>Alasan Bergabung:</label><br>
        <textarea name="alasan"><?= $data['alasan']; ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
        <a href="dashboard.php">Kembali</a>
    </form>
</body>
</html>
