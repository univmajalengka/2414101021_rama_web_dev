<?php
// Mulai session di atas semua
session_start();

// Debug: Uncomment baris ini untuk lihat isi session (hapus setelah test)
// echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit();

// Cek apakah user sudah login dengan validasi ketat
if (!isset($_SESSION['user']) || !is_array($_SESSION['user']) || empty($_SESSION['user']['id'])) {
    // Jika belum login, redirect dengan pesan error
    header('Location: login.php?error=not_logged_in');
    exit();
}

// Jika sudah login, ambil data user (line 17 diperbaiki)
$user = $_SESSION['user'];  // Sekarang aman

// Include database jika perlu (misalnya untuk query tiket)
include 'config/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard">
    <button class="login-btn" onclick="window.location.href='logout.php'">Logout</button>
    <h2>Dashboard - Selamat Datang, <?php echo htmlspecialchars($user['username'] ?? 'Pengguna'); ?></h2>
    
    <?php if (!empty($user['photo']) && file_exists($user['photo'])) { ?>
        <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Foto Anda" width="100"><br>
    <?php } else { ?>
        <p>Foto profil tidak ditemukan. <a href="#update_photo">Update Foto</a></p>
    <?php } ?>
    
    <h3>CRUD Pemesanan Tiket</h3>
    <a href="crud/create_ticket.php">Tambah Tiket</a> | 
    <a href="crud/read_ticket.php">Lihat Tiket</a>
    
    <!-- Tambahan: Link update foto jika belum ada -->
    <h3>Update Foto Profil</h3>
    <form method="POST" enctype="multipart/form-data" action="update_photo.php">
        <input type="file" name="photo" required><br>
        <button type="submit">Update Foto</button>
    </form>
    
    <!-- Konten dashboard lainnya -->
</body>
</html>