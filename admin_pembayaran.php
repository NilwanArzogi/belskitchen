<?php include 'koneksi.php'; ?>
<h2>Data Pembayaran Pelanggan</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Pesanan</th>
        <th>Nama</th>
        <th>Bank</th>
        <th>Jumlah</th>
        <th>Bukti Foto</th>
        <th>Aksi</th>
    </tr>
    <?php
    $ambil = mysqli_query($conn, "SELECT * FROM pembayaran");
    while($pecah = mysqli_fetch_assoc($ambil)){
    ?>
    <tr>
        <td><?php echo $pecah['id_pesanan']; ?></td>
        <td><?php echo $pecah['nama_penyetor']; ?></td>
        <td><?php echo $pecah['bank']; ?></td>
        <td>Rp <?php echo number_format($pecah['jumlah']); ?></td>
        <td>
            <a href="bukti_transfer/<?php echo $pecah['bukti_foto']; ?>" target="_blank">Lihat Foto</a>
        </td>
        <td>
            <a href="konfirmasi_lunas.php?id=<?php echo $pecah['id_pesanan']; ?>">Terima Pembayaran</a>
        </td>
    </tr>
    <?php } ?>
</table>