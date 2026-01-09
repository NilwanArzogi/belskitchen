<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bels Kitchen - Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<nav>
    <div class="logo">Bels Kitchen</div>
    <div class="nav-links">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Contact</a>
        
        <a href="keranjang.php" class="cart-icon">
            <i class="fa-solid fa-basket-shopping"></i>
            <?php if(isset($_SESSION['keranjang'])): ?>
                <span class="badge"><?php echo count($_SESSION['keranjang']); ?></span>
            <?php endif; ?>
        </a>
    </div>
</nav>

<header class="hero" id="home">
    <div class="hero-content">
        <h1>Kelezatan Autentik dari Dapur Bels</h1>
        <p>Menghadirkan kue-kue premium dengan bahan pilihan untuk momen spesial Anda.</p>
        <a href="#menu" class="btn-hero">Lihat Menu Kami</a>
    </div>
</header>

<section class="about-section" id="about">
    <div class="about-container">
        <div class="about-image">
            <img src="img/logo.jpeg" alt="Dapur Bels Kitchen">
        </div>
        <div class="about-text">
            <h2>Tentang Bels Kitchen</h2>
            <p>Berawal dari hobi membuat kue di dapur rumah, <strong>Bels Kitchen</strong> kini hadir untuk menyajikan kebahagiaan di setiap gigitan. Kami percaya bahwa bahan-bahan premium adalah kunci rasa yang tak terlupakan.</p>
            <ul class="about-list">
                <li>Custom Birthday Cakes</li>
                <li>Premium Cookies</li>
                <li>Artisan Pastries</li>
            </ul>
            <div class="about-misi">
                <h3>Visi & Misi</h3>
                <p>Menjadi dapur kue pilihan utama yang memberikan kehangatan bagi setiap perayaan keluarga Indonesia.</p>
            </div>
        </div>
    </div>
</section>

<section class="menu-section" id="menu">
    <h2 class="section-title">Menu Kami</h2>
    <p style="text-align:center; color:#888; margin-bottom:30px;">Pilih kue favoritmu dan nikmati kelezatannya</p>
    
    <div class="container">
        <?php
        // Mengambil semua produk dari database
        $ambil = mysqli_query($conn, "SELECT * FROM produk");
        while($pecah = mysqli_fetch_assoc($ambil)){
        ?>
        <div class="card">
            <img src="img/<?php echo $pecah['foto']; ?>" alt="<?php echo $pecah['nama_kue']; ?>">
            
            <div class="card-content">
                <h3><?php echo $pecah['nama_kue']; ?></h3>
                <p class="price">Rp <?php echo number_format($pecah['harga']); ?></p>
                <a href="beli.php?id=<?php echo $pecah['id_produk']; ?>" class="btn-beli">Tambah ke Keranjang</a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<section class="contact-section" id="contact">
    <h2 class="section-title">Hubungi Kami</h2>
    <p style="text-align:center; color:#888; margin-bottom:40px;">Klik tombol di bawah ini untuk memesan atau tanya-tanya langsung via WhatsApp.</p>

    <div class="contact-container-simple">
        <div class="contact-card">
            <h3>Alamat Toko</h3>
            <p>Jl. Danau Poso Gg Meriam No.14, Binjai</p>

            <h3 style="margin-top:20px;">Jam Buka</h3>
            <p>Senin - Sabtu (09.00 - 18.00)</p>

            <a href="https://wa.me/6283801578333?text=Halo%20Bels%20Kitchen,%20saya%20ingin%20tanya%20tentang%20kue..." target="_blank" class="btn-wa-large">
                Chat via WhatsApp Sekarang
            </a>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2026 Bels Kitchen. All Rights Reserved.</p>
</footer>

</body>
</html>