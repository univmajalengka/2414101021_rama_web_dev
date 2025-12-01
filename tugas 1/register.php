<?php
include 'config/db.php';

// Cek koneksi database dulu
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);  // Gunakan password_hash() di produksi
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Validasi input dasar
    if (empty($username) || empty($password) || empty($email)) {
        echo "Semua field harus diisi!<br>";
        exit();
    }
    
    // Upload foto (opsional, dengan validasi)
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "uploads/";
        $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];
        if (in_array($ext, $allowed) && $_FILES["photo"]["size"] < 2000000) {  // Max 2MB
            $photo = $target_dir . uniqid() . "." . $ext;  // Nama unik
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $photo)) {
                echo "Gagal upload foto.<br>";
                $photo = '';  // Reset jika gagal
            }
        } else {
            echo "Foto tidak valid (harus JPG/PNG, <2MB).<br>";
        }
    }
    
    // Cek apakah username sudah ada
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        echo "Username sudah ada, pilih yang lain.<br>";
        $check_stmt->close();
        exit();
    }
    $check_stmt->close();
    
    // Prepared statement untuk insert (line 26 diperbaiki dengan error check)
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, photo) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Error prepare statement: " . $conn->error);  // Debug jika line 26 gagal
    }
    $stmt->bind_param("ssss", $username, $password, $email, $photo);
    if ($stmt->execute()) {
        echo "Registrasi berhasil! <a href='login.php'>Login Sekarang</a>";
    } else {
        echo "Error insert: " . $stmt->error . "<br>";  // Pesan error detail
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Daftar Akun Baru</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="file" name="photo" accept="image/*"><br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</body>
</html>