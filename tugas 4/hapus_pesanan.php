<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM pemesanan WHERE id=$id");
header("location:daftar_pesanan.php");
?>
