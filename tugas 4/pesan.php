<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $hari = $_POST['hari'];
    $peserta = $_POST['peserta'];

    if (empty($nama) || empty($hari) || empty($peserta)) {
        echo "<script>alert('Data form pemesanan harus diisi');</script>";
    } else {
        $harga = 0;
        $penginapan = isset($_POST['penginapan']) ? 1 : 0;
        $transportasi = isset($_POST['transportasi']) ? 1 : 0;
        $makanan = isset($_POST['makanan']) ? 1 : 0;

        if ($penginapan) $harga += 1000000;
        if ($transportasi) $harga += 1200000;
        if ($makanan) $harga += 500000;

        $total = $hari * $peserta * $harga;

        mysqli_query($conn,"INSERT INTO pemesanan VALUES(
            NULL,'$nama','$hari','$peserta',
            '$penginapan','$transportasi','$makanan',
            '$harga','$total'
        )");

        echo "<script>alert('Pemesanan berhasil');window.location='daftar_pesanan.php';</script>";
    }
}
?>

<form method="POST">
<h2>Form Pemesanan</h2>

Nama Pemesan <br>
<input type="text" name="nama"><br><br>

Waktu Perjalanan (Hari) <br>
<input type="number" name="hari"><br><br>

Jumlah Peserta <br>
<input type="number" name="peserta"><br><br>

Pelayanan Paket:<br>
<input type="checkbox" name="penginapan"> Penginapan (1.000.000)<br>
<input type="checkbox" name="transportasi"> Transportasi (1.200.000)<br>
<input type="checkbox" name="makanan"> Makanan (500.000)<br><br>

<button name="simpan">Simpan</button>
</form>
