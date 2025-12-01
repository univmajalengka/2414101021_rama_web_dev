<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user'])) {
    die("Error: Anda belum login. <a href='login.php'>Login dulu</a>");
}

include 'config/db.php';
if ($conn->connect_error) {
    die("Error: Koneksi database gagal: " . $conn->connect_error);
}

$user_id = (int) $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    // Gunakan path absolut untuk menghindari masalah
    $target_dir = __DIR__ . "/uploads/";  // Path absolut ke folder uploads
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0755, true)) {
            die("Error: Tidak bisa buat folder uploads/. Periksa permission server.<br>");
        }
    }
    
    // Cek permission folder
    if (!is_writable($target_dir)) {
        die("Error: Folder uploads/ tidak writable. Permission harus 755/777.<br>");
    }
    
    // Validasi file
    $file_name = $_FILES["photo"]["name"];
    $file_size = $_FILES["photo"]["size"];
    $file_tmp = $_FILES["photo"]["tmp_name"];
    $file_error = $_FILES["photo"]["error"];
    
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($ext, $allowed)) {
        die("Error: Format file tidak didukung. Hanya JPG/PNG.<br>");
    }
    if ($file_size > 2000000) {
        die("Error: Ukuran file terlalu besar (max 2MB).<br>");
    }
    if ($file_error != 0) {
        die("Error upload file: " . $file_error . "<br>");
    }
    
    // Buat nama file unik
    $new_filename = uniqid("photo_") . "." . $ext;
    $target_file = $target_dir . $new_filename;
    
    // Upload file
    if (move_uploaded_file($file_tmp, $target_file)) {
        // Path relatif untuk database (untuk akses web)
        $relative_path = "uploads/" . $new_filename;
        
        // Update database
        $stmt = $conn->prepare("UPDATE users SET photo=? WHERE id=?");
        if (!$stmt) {
            die("Error prepare: " . $conn->error);
        }
        $stmt->bind_param("si", $relative_path, $user_id);
        if ($stmt->execute()) {
            // Update session
            $_SESSION['user']['photo'] = $relative_path;
            echo "Sukses: Foto berhasil diupdate! <a href='dashboard.php'>Kembali ke Dashboard</a><br>";
            echo "<img src='$relative_path' width='100' alt='Foto Baru'><br>";
        } else {
            echo "Error update database: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Error: Gagal upload file. Detail:<br>";
        echo "- Target dir: $target_dir<br>";
        echo "- Target file: $target_file<br>";
        echo "- Writable: " . (is_writable($target_dir) ? 'Yes' : 'No') . "<br>";
        echo "- File tmp: $file_tmp<br>";
        echo "- File size: $file_size bytes<br>";
    }
} else {
    echo "Error: Tidak ada file yang diupload atau bukan method POST.<br>";
}
$conn->close();
?>
