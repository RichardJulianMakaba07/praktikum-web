<?php
session_start();
$welcome_message = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : null;
if ($welcome_message) {
    unset($_SESSION['welcome_message']); // Hapus setelah ditampilkan
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodCycle - Berbagi Makanan, Berbagi Harapan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="loading-spinner" class="loading-spinner"></div>
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="index.php" class="logo">FoodCycle</a>
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#carakerja">Cara Kerja</a></li>
                    <li><a href="#dampak">Dampak</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li><a href="dashboard.php">Dashboard (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
                <button class="btn btn-cta" data-action="donate">Mulai Donasi</button>
            </div>
        </div>
    </nav>

    <?php if ($welcome_message): ?>
        <div class="notification success show">
            <span><?php echo htmlspecialchars($welcome_message); ?></span>
            <button class="notification-close">&times;</button>
        </div>
    <?php endif; ?>

    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Berbagi Makanan, <span class="highlight">Berbagi Harapan</span></h1>
                    <p>Platform digital yang menghubungkan donatur makanan dengan mereka yang membutuhkan. Mari bersama-sama mengurangi food waste dan membantu sesama.</p>
                    <div class="hero-buttons">
                        <button class="btn btn-primary" data-action="donate">Donasi Sekarang</button>
                        <button class="btn btn-secondary" data-action="volunteer">Jadi Relawan</button>
                    </div>
                    <div class="statistik">
                        <div class="item-statistik">
                            <span class="angka-statistik">10K+</span>
                            <span class="label-statistik">Makanan Diselamatkan</span>
                        </div>
                        <div class="item-statistik">
                            <span class="angka-statistik">5K+</span>
                            <span class="label-statistik">Keluarga Terbantu</span>
                        </div>
                        <div class="item-statistik">
                            <span class="angka-statistik">500+</span>
                            <span class="label-statistik">Mitra Donatur</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="assets/gambar1.jpg" alt="FoodCycle">
                    <div class="kartu kartu-mengambang kartu1">
                        <h4>100 Porsi</h4>
                        <p>Diselamatkan hari ini</p>
                    </div>
                    <div class="kartu kartu-mengambang kartu2">
                        <h4>50 Keluarga</h4>
                        <p>Mendapat bantuan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="features">
        <div class="container">
            <div class="section-header">
                <h2>Mengapa Memilih FoodCycle?</h2>
                <p>Platform terpercaya yang memudahkan proses donasi makanan dengan teknologi modern dan sistem yang transparan</p>
            </div>
            <div class="features-grid">
                <div class="kartu kartu-fitur">
                    <h3>Mudah Digunakan</h3>
                    <p>Interface yang intuitif memungkinkan siapa saja dapat berdonasi atau menerima bantuan makanan dengan mudah melalui smartphone</p>
                </div>
                <div class="kartu kartu-fitur">
                    <h3>Berbasis Lokasi</h3>
                    <p>Sistem GPS terintegrasi menghubungkan donatur dengan penerima dalam radius terdekat untuk distribusi yang efisien</p>
                </div>
                <div class="kartu kartu-fitur">
                    <h3>Aman & Terpercaya</h3>
                    <p>Sistem verifikasi berlapis dan tracking real-time memastikan makanan sampai ke tangan yang tepat dengan aman</p>
                </div>
                <div class="kartu kartu-fitur">
                    <h3>Real-time Updates</h3>
                    <p>Notifikasi langsung untuk setiap donasi, pickup, dan delivery agar semua pihak selalu mendapat informasi terkini</p>
                </div>
                <div class="kartu kartu-fitur">
                    <h3>Dashboard Analytics</h3>
                    <p>Pantau dampak kontribusi Anda dengan statistik detail tentang makanan yang telah diselamatkan dan keluarga yang terbantu</p>
                </div>
                <div class="kartu kartu-fitur">
                    <h3>Komunitas Peduli</h3>
                    <p>Bergabung dengan jaringan relawan dan organisasi yang berkomitmen untuk mengurangi food waste di Indonesia</p>
                </div>
            </div>
        </div>
    </section>

    <section id="carakerja" class="cara-kerja">
        <div class="container">
            <div class="section-header">
                <h2>Cara Kerja FoodCycle</h2>
                <p>Proses sederhana dalam 4 langkah untuk mulai berbagi makanan dan membantu sesama</p>
            </div>
            <div class="langkah">
                <div class="item-langkah">
                    <div class="nomor-langkah">1</div>
                    <h3>Daftar & Verifikasi</h3>
                    <p>Buat akun dan lengkapi profil Anda. Tim kami akan memverifikasi untuk memastikan keamanan komunitas</p>
                </div>
                <div class="item-langkah">
                    <div class="nomor-langkah">2</div>
                    <h3>Posting Makanan</h3>
                    <p>Upload foto makanan yang ingin didonasikan beserta detail lokasi, jumlah porsi, dan waktu pickup</p>
                </div>
                <div class="item-langkah">
                    <div class="nomor-langkah">3</div>
                    <h3>Matching & Koordinasi</h3>
                    <p>Sistem akan mencocokkan dengan penerima terdekat dan mengatur jadwal pickup yang sesuai</p>
                </div>
                <div class="item-langkah">
                    <div class="nomor-langkah">4</div>
                    <h3>Distribusi & Feedback</h3>
                    <p>Relawan mengambil dan mendistribusikan makanan, lalu memberikan update dan feedback melalui aplikasi</p>
                </div>
            </div>
        </div>
    </section>

    <section id="dampak" class="dampak">
        <div class="container">
            <div class="section-header">
                <h2 style="color: white">Dampak Yang Telah Kami Ciptakan</h2>
                <p style="color: white">Bersama-sama, kita telah membuat perubahan nyata dalam mengurangi food waste dan membantu masyarakat</p>
            </div>
            <div class="grid-dampak">
                <div class="dampak-stat">
                    <span class="angka-dampak">15,234</span>
                    <span class="label-dampak">Kg Makanan Diselamatkan</span>
                </div>
                <div class="dampak-stat">
                    <span class="angka-dampak">8,567</span>
                    <span class="label-dampak">Keluarga Terbantu</span>
                </div>
                <div class="dampak-stat">
                    <span class="angka-dampak">1,234</span>
                    <span class="label-dampak">Donatur Aktif</span>
                </div>
                <div class="dampak-stat">
                    <span class="angka-dampak">25</span>
                    <span class="label-dampak">Kota Terjangkau</span>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>Misi Kami</h3>
                    <p>FoodCycle hadir untuk menciptakan Indonesia tanpa kelaparan dan limbah makanan. Kami menghubungkan restoran, UMKM, dan individu yang memiliki makanan surplus dengan komunitas yang membutuhkan melalui teknologi digital yang mudah digunakan.</p>
                    <p>Didirikan pada tahun 2023, kami telah bermitra dengan ratusan donatur dan relawan di seluruh Indonesia untuk menyelamatkan ribuan kilogram makanan dan mendistribusikannya ke keluarga, panti asuhan, dan komunitas marginal. Setiap donasi membantu mengurangi emisi karbon dan mendukung lingkungan yang lebih bersih.</p>
                    <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                </div>
                <div class="about-image">
                    <img src="assets/gambar2.jpg" alt="Tentang FoodCycle">
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="testimoni">
        <div class="container">
            <div class="section-header">
                <h2>Apa Kata Mereka</h2>
                <p>Cerita dari donatur, relawan, dan penerima yang telah menjadi bagian dari perjalanan FoodCycle</p>
            </div>
            <div class="testimoni-grid">
                <div class="kartu kartu-testimoni">
                    <p class="teks-testimoni">"FoodCycle membuat saya merasa berkontribusi nyata. Donasi makanan dari restoran saya kini sampai ke keluarga yang membutuhkan dengan cepat dan aman."</p>
                    <div class="penulis-testimoni">
                        <div class="avatar-penulis"></div>
                        <div class="author-info">
                            <h4>Ani Susanti</h4>
                            <p>Pemilik Restoran, Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="kartu kartu-testimoni">
                    <p class="teks-testimoni">"Sebagai relawan, saya bangga bisa mengantar makanan ke panti asuhan. Aplikasi FoodCycle sangat membantu koordinasi!"</p>
                    <div class="penulis-testimoni">
                        <div class="avatar-penulis"></div>
                        <div class="author-info">
                            <h4>Budi Santoso</h4>
                            <p>Relawan, Surabaya</p>
                        </div>
                    </div>
                </div>
                <div class="kartu kartu-testimoni">
                    <p class="teks-testimoni">"Makanan yang kami terima dari FoodCycle sangat membantu anak-anak di panti. Terima kasih atas kebaikan hati semua donatur!"</p>
                    <div class="penulis-testimoni">
                        <div class="avatar-penulis"></div>
                        <div class="author-info">
                            <h4>Ibu Ratna</h4>
                            <p>Pengelola Panti Asuhan, Bandung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="news">
        <div class="container">
            <div class="section-header">
                <h2>Berita Terbaru</h2>
                <p>Ikuti kabar terbaru tentang inisiatif dan dampak FoodCycle di seluruh Indonesia</p>
            </div>
            <div class="news-grid">
                <div class="kartu kartu-berita">
                    <div class="news-image"><img src="assets/gambar3.jpg" alt="Berita 1"></div>
                    <div class="news-content">
                        <h3 class="news-title">FoodCycle Capai 1 Ton Makanan Diselamatkan di Jakarta</h3>
                        <p class="kutipan-berita">Pada bulan ini, FoodCycle berhasil menyelamatkan 1 ton makanan surplus dari restoran dan UMKM di Jakarta, didistribusikan ke 500 keluarga.</p>
                        <a href="#" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="kartu kartu-berita">
                    <div class="news-image"><img src="assets/gambar4.jpg" alt="Berita 2"></div>
                    <div class="news-content">
                        <h3 class="news-title">Kerjasama Baru dengan Pasar Tradisional</h3>
                        <p class="kutipan-berita">FoodCycle kini bermitra dengan pasar tradisional di Surabaya untuk mengumpulkan sayuran dan buah surplus, mendukung petani lokal.</p>
                        <a href="#" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="kartu kartu-berita">
                    <div class="news-image"><img src="assets/gambar5.jpg" alt="Berita 3"></div>
                    <div class="news-content">
                        <h3 class="news-title">Relawan FoodCycle Rayakan Hari Lingkungan</h3>
                        <p class="kutipan-berita">Pada Hari Lingkungan Sedunia, relawan FoodCycle mengadakan kampanye edukasi tentang pengurangan limbah makanan di 10 kota.</p>
                        <a href="#" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Mari Mulai Berbagi Hari Ini</h2>
            <p>Bergabunglah dengan ribuan orang yang telah memilih untuk membuat perbedaan. Setiap kontribusi Anda sangat berarti.</p>
            <div class="cta-buttons">
                <button class="btn btn-primary" data-action="donate">Mulai Donasi</button>
                <button class="btn btn-secondary" data-action="volunteer">Jadi Relawan</button>
            </div>
        </div>
    </section>

    <footer id="kontak" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>FoodCycle</h3>
                    <p>Platform digital yang menghubungkan surplus makanan dengan mereka yang membutuhkan. Bersama-sama kita ciptakan Indonesia tanpa kelaparan dan waste makanan.</p>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Twitter</a>
                        <a href="#" class="social-link">Instagram</a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Menu Utama</h3>
                    <a href="#home">Beranda</a>
                    <a href="#about">Tentang Kami</a>
                    <a href="#fitur">Fitur</a>
                    <a href="#carakerja">Cara Kerja</a>
                    <a href="#dampak">Dampak</a>
                    <a href="#testimoni">Testimoni</a>
                    <a href="#berita">Berita</a>
                    <a href="#kontak">Kontak</a>
                </div>
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <a href="#" data-action="donate">Donasi Makanan</a>
                    <a href="#">Minta Bantuan</a>
                    <a href="#" data-action="volunteer">Jadi Relawan</a>
                    <a href="#">Partnership</a>
                    <a href="#">Laporan Dampak</a>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p>Email: <a href="mailto:hello@foodcycle.id">hello@foodcycle.id</a></p>
                    <p>Telp: <a href="tel:+6281212345678">+62 812 1234 5678</a></p>
                </div>
            </div>
            <div class="contact-form-container">
                <h3>Kirim Pesan</h3>
                <form id="contact-form">
                    <div class="form-group">
                        <input type="text" name="contact-name" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="contact-email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="contact-message" placeholder="Pesan Anda" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" data-action="contact">Kirim Pesan</button>
                </form>
            </div>
            <div class="footer-bottom">
                <p>© 2025 FoodCycle. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>