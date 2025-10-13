<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard FoodCycle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f7f7f7; color: #333; }
        .container { width: 90%; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { color: #2e7d32; text-align: center; margin-bottom: 30px; }
        .tabs { display: flex; justify-content: center; gap: 10px; margin-bottom: 20px; }
        .tabs button {
            padding: 10px 20px;
            background: #4caf50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }
        .tabs button:hover, .tabs button.active { background: #2e7d32; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #4caf50; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        a.btn { padding: 6px 12px; background: #4caf50; color: #fff; text-decoration: none; border-radius: 5px; font-size: 0.9rem; }
        a.btn:hover { background: #2e7d32; }
        .logout { float: right; color: #f44336; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" class="logout">Logout</a>
    <h1>Dashboard FoodCycle</h1>

    <div class="tabs">
        <button class="tablink active" onclick="openTab(event, 'donasi')">📦 Donasi</button>
        <button class="tablink" onclick="openTab(event, 'relawan')">🤝 Relawan</button>
        <button class="tablink" onclick="openTab(event, 'pesan')">💬 Pesan</button>
    </div>

    <!-- Tab Donasi -->
    <div id="donasi" class="tab-content active">
        <h2>Data Donasi Makanan</h2>
        <a href="tambah.php" class="btn btn-primary">+ Tambah Donasi</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Donatur</th>
                <th>Telepon</th>
                <th>Jenis Makanan</th>
                <th>Porsi</th>
                <th>Pickup</th>
                <th>Lokasi</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $donasi = mysqli_query($conn, "SELECT * FROM donations ORDER BY tanggal_donasi DESC");
            while ($d = mysqli_fetch_assoc($donasi)) {
                echo "<tr>
                    <td>$no</td>
                    <td>{$d['nama_donatur']}</td>
                    <td>{$d['telepon']}</td>
                    <td>{$d['jenis_makanan']}</td>
                    <td>{$d['jumlah_porsi']}</td>
                    <td>{$d['waktu_pickup']}</td>
                    <td>{$d['lokasi']}</td>
                    <td>{$d['catatan']}</td>
                    <td>
                        <a href='edit.php?id={$d['id']}' class='btn'>Edit</a>
                        <a href='hapus.php?id={$d['id']}' class='btn' style='background:#f44336' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </table>
    </div>

    <!-- Tab Relawan -->
    <div id="relawan" class="tab-content">
        <h2>Data Relawan</h2>
        <a href="tambah_relawan.php" class="btn">+ Tambah Relawan</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Area</th>
                <th>Ketersediaan</th>
                <th>Transportasi</th>
                <th>Alasan</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $relawan = mysqli_query($conn, "SELECT * FROM volunteers ORDER BY tanggal_daftar DESC");
            while ($r = mysqli_fetch_assoc($relawan)) {
                echo "<tr>
                    <td>$no</td>
                    <td>{$r['nama_relawan']}</td>
                    <td>{$r['email']}</td>
                    <td>{$r['telepon']}</td>
                    <td>{$r['area']}</td>
                    <td>{$r['ketersediaan']}</td>
                    <td>{$r['transportasi']}</td>
                    <td>{$r['alasan']}</td>
                    <td>
                        <a href='edit_relawan.php?id={$r['id']}' class='btn'>Edit</a>
                        <a href='hapus_relawan.php?id={$r['id']}' class='btn' style='background:#f44336' onclick=\"return confirm('Hapus relawan ini?')\">Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </table>
    </div>

    <!-- Tab Pesan -->
    <div id="pesan" class="tab-content">
        <h2>Pesan dari Pengguna</h2>
        <a href="tambah_pesan.php" class="btn">+ Tambah Pesan</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $pesan = mysqli_query($conn, "SELECT * FROM messages ORDER BY tanggal DESC");
            while ($p = mysqli_fetch_assoc($pesan)) {
                echo "<tr>
                    <td>$no</td>
                    <td>{$p['nama']}</td>
                    <td>{$p['email']}</td>
                    <td>{$p['pesan']}</td>
                    <td>{$p['tanggal']}</td>
                    <td>
                        <a href='edit_pesan.php?id={$p['id']}' class='btn'>Edit</a>
                        <a href='hapus_pesan.php?id={$p['id']}' class='btn' style='background:#f44336' onclick=\"return confirm('Hapus pesan ini?')\">Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</div>

<script>
function openTab(evt, tabName) {
    const contents = document.querySelectorAll(".tab-content");
    const tabs = document.querySelectorAll(".tablink");

    contents.forEach(c => c.classList.remove("active"));
    tabs.forEach(t => t.classList.remove("active"));

    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}
</script>

</body>
</html>
