<?php
include 'koneksi.php';

// Proses simpan data ke database
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_relawan'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $area = $_POST['area'];
    $ketersediaan = $_POST['ketersediaan'];
    $transportasi = $_POST['transportasi'];
    $alasan = $_POST['alasan'];

    $query = "INSERT INTO volunteers (nama_relawan, email, telepon, area, ketersediaan, transportasi, alasan)
              VALUES ('$nama', '$email', '$telepon', '$area', '$ketersediaan', '$transportasi', '$alasan')";
    mysqli_query($conn, $query);

    echo "<script>alert('Data relawan berhasil ditambahkan!');window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Relawan</title>
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
    <h2>Tambah Relawan Baru</h2>
    <form method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_relawan" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="telepon" required><br><br>

        <label>Area Tinggal:</label><br>
        <input type="text" name="area" required><br><br>

        <label>Ketersediaan:</label><br>
        <select name="ketersediaan" required>
            <option value="Hari Kerja">Hari Kerja</option>
            <option value="Akhir Pekan">Akhir Pekan</option>
            <option value="Fleksibel">Fleksibel</option>
            <option value="Darurat">Darurat</option>
        </select><br><br>

        <label>Transportasi:</label><br>
        <select name="transportasi" required>
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
            <option value="Sepeda">Sepeda</option>
            <option value="Transportasi Umum">Transportasi Umum</option>
        </select><br><br>

        <label>Alasan Bergabung:</label><br>
        <textarea name="alasan"></textarea><br><br>

        <button type="submit" name="simpan">Simpan</button>
        <a href="dashboard.php">Batal</a>
    </form>
</body>
</html>
