<?php
session_start();

if (isset($_SESSION['username'])) {
    $redirect_url = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'dashboard.php';
    unset($_SESSION['redirect_after_login']);
    header("Location: $redirect_url");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } elseif ($username === 'admin' && $password === 'password123') {
        $_SESSION['username'] = $username;
        $_SESSION['welcome_message'] = "Selamat datang, $username! Anda berhasil login.";
        $redirect_url = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'dashboard.php';
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect_url");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

// Simpan URL asal jika ada
if (isset($_GET['redirect'])) {
    $_SESSION['redirect_after_login'] = $_GET['redirect'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FoodCycle</title>
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
                </ul>
            </div>
        </div>
    </nav>

    <section class="container" style="padding: 80px 20px;">
        <div class="contact-form-container" style="max-width: 500px; margin: 0 auto;">
            <h2 style="color: #2e7d32; text-align: center;">Login ke FoodCycle</h2>
            <?php if (isset($error)): ?>
                <div class="notification error show" style="margin-bottom: 20px;">
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            <form id="login-form" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <a href="#" class="forgot-password">Lupa Password?</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p style="text-align: center; margin-top: 15px;">Belum punya akun? <a href="#" class="register-link">Daftar sekarang</a></p>
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