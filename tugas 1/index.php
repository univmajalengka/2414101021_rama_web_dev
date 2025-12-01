<?php
session_start();
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Desa Wisata Pulesari - Pemesanan Tiket Paralayang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Desa Wisata Pulesari</h1>
        <p>Pemesanan Tiket Paralayang</p>
    </header>
    
    <div class="banner">
        <h2>Selamat Datang di Paralayang Adventure</h2>
    </div>
    
    <nav>
        <a href="#home">Beranda</a>
        <a href="#about">About</a>
        <a href="#obyek">Obyek Wisata</a>
        <a href="#fasilitas">Fasilitas Wisata</a>
        <a href="#paket">Paket Wisata</a>
        <a href="#museum">Museum Salak</a>
        <a href="#pemesanan">Pemesanan</a>
        <a href="#galery">Galery</a>
    </nav>
    
    <section id="packages" class="packages">
        <div class="package">
            <img src="assets/images/paket1.jpg" alt="Paket Paralayang Dasar">
            <h3>Paket Paralayang Dasar</h3>
            <p>Tanggal: 1 Oktober 2023</p>
            <p>Harga Promo Mulai 650rb</p>
        </div>
        <div class="package">
            <img src="assets/images/paket2.jpg" alt="Paket Paralayang Premium">
            <h3>Paket Paralayang Premium</h3>
            <p>Tanggal: 5 Oktober 2023</p>
            <p>Harga Promo Mulai 850rb</p>
        </div>
    </section>
    
    <section class="video">
        <h3>Video Promosi Paralayang</h3>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
    </section>
    
    <footer>
        <p>Dibuat oleh [Nama Anda]</p>
        <img src="assets/images/into.jpg" alt="Foto Pembuat" class="creator-photo">
    </footer>
    
    <script src="assets/js/script.js"></script>
</body>
</html>