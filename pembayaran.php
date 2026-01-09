<?php
session_start();
include 'koneksi.php';

if (empty($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, silakan belanja dulu!');</script>";
    echo "<script>location='index.php#menu';</script>";
    exit();
}

// Menghitung kembali total belanja untuk keamanan data
$total_bayar = 0;
foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
    $ambil = $conn->query("SELECT harga FROM produk WHERE id_produk = '$id_produk'");
    $pecah = $ambil->fetch_assoc();
    if ($pecah) {
        $total_bayar += ($pecah['harga'] * $jumlah);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Bels Kitchen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dana-container">
    <h2 class="dana-header">Konfirmasi Pembayaran</h2>
    
    <div class="alert-info" style="background: #e7f3fe; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; color: #0c5460;">
        Total yang harus dibayar: <br>
        <strong style="font-size: 1.5rem;">Rp <?php echo number_format($total_bayar); ?></strong>
    </div>

    <div class="qris-box">
        <p>Silakan scan QRIS DANA di bawah ini:</p>
        <img src="img/qr.jpeg" alt="QRIS DANA Bels Kitchen">
        <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">A/N BELS KITCHEN</p>
    </div>

    <form action="proses_konfirmasi.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="total_bayar" value="<?php echo $total_bayar; ?>">
        
        <div style="text-align: left; margin-top: 20px;">
            <label style="font-weight: bold; font-size: 0.9rem;">Nama Pengirim (Sesuai Akun Bank/E-Wallet):</label>
            <input type="text" name="nama" placeholder="Name" required>
            
            <label style="font-weight: bold; font-size: 0.9rem;">Upload Bukti Transfer:</label>
            <input type="file" name="bukti" accept="image/*" required>
        </div>

        <button type="submit" class="btn-dana">Kirim Konfirmasi Pembayaran</button>
    </form>
    
    <a href="keranjang.php" style="display: block; margin-top: 15px; color: #888; text-decoration: none; font-size: 0.9rem;">← Kembali ke Keranjang</a>
</div>

</body>
</html>