<?php
include 'koneksi.php';

// Ambil data berdasarkan ID
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM donations WHERE id=$id");
$data = mysqli_fetch_assoc($result);

// Proses update
if (isset($_POST['update'])) {
    $nama = $_POST['nama_donatur'];
    $telepon = $_POST['telepon'];
    $jenis = $_POST['jenis_makanan'];
    $porsi = $_POST['jumlah_porsi'];
    $waktu = $_POST['waktu_pickup'];
    $lokasi = $_POST['lokasi'];
    $catatan = $_POST['catatan'];

    $query = "UPDATE donations SET 
                nama_donatur='$nama',
                telepon='$telepon',
                jenis_makanan='$jenis',
                jumlah_porsi='$porsi',
                waktu_pickup='$waktu',
                lokasi='$lokasi',
                catatan='$catatan'
              WHERE id=$id";
    mysqli_query($conn, $query);

    echo "<script>alert('Data donasi berhasil diperbarui!');window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Donasi</title>
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
    <h2>Edit Data Donasi</h2>
    <form action="" method="POST">
        <label>Nama Donatur:</label><br>
        <input type="text" name="nama_donatur" value="<?= $data['nama_donatur']; ?>" required><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="telepon" value="<?= $data['telepon']; ?>" required><br><br>

        <label>Jenis Makanan:</label><br>
        <input type="text" name="jenis_makanan" value="<?= $data['jenis_makanan']; ?>" required><br><br>

        <label>Jumlah Porsi:</label><br>
        <input type="number" name="jumlah_porsi" value="<?= $data['jumlah_porsi']; ?>" required><br><br>

        <label>Waktu Pickup:</label><br>
        <input type="datetime-local" name="waktu_pickup" value="<?= date('Y-m-d\TH:i', strtotime($data['waktu_pickup'])); ?>" required><br><br>

        <label>Lokasi Pickup:</label><br>
        <textarea name="lokasi" required><?= $data['lokasi']; ?></textarea><br><br>

        <label>Catatan:</label><br>
        <textarea name="catatan"><?= $data['catatan']; ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
        <a href="dashboard.php">Kembali</a>
    </form>
</body>
</html>
