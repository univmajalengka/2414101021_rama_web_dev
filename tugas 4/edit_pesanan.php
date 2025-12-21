<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM pemesanan WHERE id=$id"));

if (isset($_POST['update'])) {
    mysqli_query($conn,"UPDATE pemesanan SET
        nama='$_POST[nama]',
        hari='$_POST[hari]',
        peserta='$_POST[peserta]'
        WHERE id=$id
    ");
    echo "<script>alert('Data diupdate');window.location='daftar_pesanan.php';</script>";
}
?>

<form method="POST">
Nama <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
Hari <input type="number" name="hari" value="<?= $data['hari'] ?>"><br>
Peserta <input type="number" name="peserta" value="<?= $data['peserta'] ?>"><br>
<button name="update">Update</button>
</form>
