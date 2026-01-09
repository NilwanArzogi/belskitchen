<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Tambah Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Tambah Menu Bels Kitchen</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Kue</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" required>
            </div>
            <div class="form-group">
                <label>Foto Kue</label>
                <input type="file" name="foto" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" style="width:100%"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn-submit">Simpan Menu</button>
        </form>
    </div>

    <?php
    if (isset($_POST['simpan'])) {
        $nama_file = $_FILES['foto']['name'];
        $lokasi_file = $_FILES['foto']['tmp_name'];
        
        // Pindahkan file foto ke folder img
        move_uploaded_file($lokasi_file, "img/" . $nama_file);

        // Simpan data ke database
        $conn->query("INSERT INTO produk (nama_kue, harga, foto, deskripsi) 
                      VALUES ('$_POST[nama]', '$_POST[harga]', '$nama_file', '$_POST[deskripsi]')");

        echo "<script>alert('Menu Berhasil Ditambahkan!'); window.location='index.php';</script>";
    }
    ?>
</body>
</html>