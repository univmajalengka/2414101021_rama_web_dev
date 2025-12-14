<?php

$server = "localhost";
$user = "root";
$password = "12345"; // CATATAN: Ganti dengan password MySQL Anda yang sebenarnya
$nama_database = "pendaftaran_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>