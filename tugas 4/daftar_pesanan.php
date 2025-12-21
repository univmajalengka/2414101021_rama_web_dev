<?php include 'koneksi.php'; ?>
<h2>Daftar Pesanan</h2>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn,"SELECT * FROM pemesanan");
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $d['nama'] ?></td>
    <td>Rp <?= number_format($d['total']) ?></td>
    <td>
        <a href="edit_pesanan.php?id=<?= $d['id'] ?>">Edit</a> |
        <a href="hapus_pesanan.php?id=<?= $d['id'] ?>"
        onclick="return confirm('Yakin hapus pesanan?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
