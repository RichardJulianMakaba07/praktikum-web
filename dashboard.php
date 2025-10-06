<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_after_login'] = 'dashboard.php';
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FoodCycle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="loading-spinner" class="loading-spinner"></div>
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="index.php" class="logo">FoodCycle</a>
                <ul class="nav-links">
                    <li><a href="index.php#home">Beranda</a></li>
                    <li><a href="index.php#about">Tentang Kami</a></li>
                    <li><a href="index.php#fitur">Fitur</a></li>
                    <li><a href="index.php#carakerja">Cara Kerja</a></li>
                    <li><a href="index.php#dampak">Dampak</a></li>
                    <li><a href="index.php#testimoni">Testimoni</a></li>
                    <li><a href="index.php#berita">Berita</a></li>
                    <li><a href="index.php#kontak">Kontak</a></li>
                    <li><a href="dashboard.php">Dashboard (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                <button class="btn btn-cta" data-action="donate">Mulai Donasi</button>
            </div>
        </div>
    </nav>

    <section class="container" style="padding: 80px 20px;">
        <div class="section-header">
            <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Pantau aktivitas Anda dan kelola donasi atau keikutsertaan sebagai relawan di FoodCycle.</p>
        </div>
        <div class="dashboard-stats">
            <div class="kartu kartu-stat">
                <h3>Total Donasi</h3>
                <p class="stat-number">12</p>
                <p>Porsi makanan telah Anda donasikan.</p>
            </div>
            <div class="kartu kartu-stat">
                <h3>Jadwal Aktif</h3>
                <p class="stat-number">3</p>
                <p>Jadwal pickup menunggu konfirmasi.</p>
            </div>
            <div class="kartu kartu-stat">
                <h3>Dampak</h3>
                <p class="stat-number">25</p>
                <p>Keluarga telah Anda bantu.</p>
            </div>
        </div>
        <div class="dashboard-actions">
            <button class="btn btn-primary" data-action="donate">Buat Donasi Baru</button>
            <button class="btn btn-secondary" data-action="volunteer">Daftar Relawan</button>
            <button class="btn btn-primary" data-action="contact">Hubungi Kami</button>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>© 2025 FoodCycle. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>