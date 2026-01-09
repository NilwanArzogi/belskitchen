<?php
session_start();
include 'koneksi.php';

$total_belanja = 0;
foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
    $ambil = $conn->query("SELECT harga FROM produk WHERE id_produk='$id_produk'");
    $pecah = $ambil->fetch_assoc();
    $total_belanja += ($pecah['harga'] * $jumlah);
}

$tgl_sekarang = date("Y-m-d");

// Gunakan 'tanggal_pembelian' sesuai struktur tabel Anda
$sql = "INSERT INTO pesanan (tanggal_pembelian, total_pesanan, status_bayar) 
        VALUES ('$tgl_sekarang', '$total_belanja', 'Belum Bayar')";

if ($conn->query($sql)) {
    // Mengambil ID yang baru saja dibuat oleh database
    $id_pesanan_baru = $conn->insert_id;

    // Simpan juga detail produknya ke tabel pesanan_produk (supaya data barang tidak hilang)
    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
        $conn->query("INSERT INTO pesanan_produk (id_pesanan, id_produk, jumlah) 
                      VALUES ('$id_pesanan_baru', '$id_produk', '$jumlah')");
    }

    // Kosongkan keranjang
    unset($_SESSION["keranjang"]);

    // Pindah ke halaman pembayaran dengan membawa ID
    echo "<script>location='pembayaran.php?id=$id_pesanan_baru';</script>";
} else {
    die("Gagal Simpan: " . $conn->error);
}
?>