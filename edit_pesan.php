<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM messages WHERE id=$id"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    mysqli_query($conn, "UPDATE messages SET nama='$nama', email='$email', pesan='$pesan' WHERE id=$id");
    echo "<script>alert('Pesan berhasil diperbarui!');window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesan</title>
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
    <h2>Edit Pesan</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $data['email']; ?>" required><br><br>

        <label>Isi Pesan:</label><br>
        <textarea name="pesan"><?= $data['pesan']; ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
        <a href="dashboard.php">Kembali</a>
    </form>
</body>
</html>
