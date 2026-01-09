<?php
session_start();
include 'koneksi.php';

// Proteksi: Jika session keranjang tidak ada, buat jadi array kosong
if (!isset($_SESSION["keranjang"])) {
    $_SESSION["keranjang"] = array();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Bels Kitchen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <section class="cart-section">
        <h1 class="cart-title">Keranjang Belanja</h1>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $nomor = 1;
                $total_belanja = 0;
                
                if (empty($_SESSION["keranjang"])) {
                    echo "<tr><td colspan='6' style='padding:40px; text-align:center;'>Keranjang Anda masih kosong. <br><a href='index.php#menu' style='color:#ff85a2; font-weight:bold;'>Mulai Belanja Sekarang</a></td></tr>";
                } else {
                    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): 
                        // Ambil data produk
                        $ambil = $conn->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        
                        if ($pecah) {
                            $subtotal = $pecah["harga"] * $jumlah;
                            $total_belanja += $subtotal;
                ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah["nama_kue"]; ?></td>
                    <td>Rp <?php echo number_format($pecah["harga"]); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp <?php echo number_format($subtotal); ?></td>
                    <td>
                        <a href="hapus_keranjang.php?id=<?php echo $id_produk; ?>" onclick="return confirm('Hapus produk ini?')" style="text-decoration:none;">🗑️</a>
                    </td>
                </tr>
                <?php 
                        $nomor++; 
                        } else {
                            // Jika produk sudah dihapus dari database, otomatis hapus dari session
                            unset($_SESSION["keranjang"][$id_produk]);
                        }
                    endforeach; 
                } 
                ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" style="text-align:right; font-weight:bold;">Total Belanja</td>
                    <td colspan="2" style="font-weight:bold; color:#d63384;">Rp <?php echo number_format($total_belanja); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="cart-actions">
            <a href="index.php#menu" class="btn-back">Tambah Kue Lagi</a>
            
            <?php if (!empty($_SESSION["keranjang"])): ?>
            <form method="post" action="pembayaran.php">
                <input type="hidden" name="total_belanja" value="<?php echo $total_belanja; ?>">
                <button type="submit" name="checkout" class="btn-checkout">Lanjut Pembayaran</button>
            </form>
            <?php endif; ?>
        </div>
    </section>
</div>

</body>
</html>