<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    mysqli_query($conn, "INSERT INTO messages (nama, email, pesan)
                         VALUES ('$nama', '$email', '$pesan')");
    echo "<script>alert('Pesan berhasil ditambahkan!');window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pesan</title>
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
    <h2>Tambah Pesan Baru</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Isi Pesan:</label><br>
        <textarea name="pesan" required></textarea><br><br>

        <button type="submit" name="simpan">Simpan</button>
        <a href="dashboard.php">Batal</a>
    </form>
</body>
</html>
