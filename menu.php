<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bels Kitchen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="logo">Bels Kitchen</div>
    <div class="nav-links">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">About</a>
        <a href="menu.php">Menu</a>
        <a href="contact.php">Contact</a>
        <a href="keranjang.php" class="cart-btn">Keranjang</a>
    </div>
</nav>

<section class="menu-header">
    <h1>Koleksi Kue Kami</h1>
    <p>Pilih kue favoritmu dan nikmati kelezatannya</p>
</section>

<div class="container">
    <?php
    $ambil = mysqli_query($conn, "SELECT * FROM produk");
    if (mysqli_num_rows($ambil) == 0) {
        echo "<p style='text-align:center; grid-column: 1/-1;'>Belum ada produk yang tersedia.</p>";
    }
    while($pecah = mysqli_fetch_assoc($ambil)){
    ?>
    <div class="card">
        <img src="img/<?php echo $pecah['Brownies']; ?>" alt="<?php echo $pecah['Brownies']; ?>" onerror="this.src='';">
        <div class="card-content">
            <h3><?php echo $pecah['nama_kue']; ?></h3>
            <p class="price">Rp <?php echo number_format($pecah['harga']); ?></p>
            <p class="desc"><?php echo substr($pecah['deskripsi'], 0, 60); ?>...</p>
            <a href="beli.php?id=<?php echo $pecah['id_produk']; ?>" class="btn-beli">Tambah ke Keranjang</a>
        </div>
    </div>
    <?php } ?>
</div>

<footer>
    <p>&copy; 2026 Bels Kitchen. All Rights Reserved.</p>
</footer>

</body>
</html>