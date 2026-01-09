<div style="background: #fff0f3; padding: 20px; border-radius: 15px; border: 2px dashed #ff85a2; margin: 20px 0; text-align: center;">
    <h3 style="color: #d63384; margin-bottom: 10px;">📦 Jadwal Pengiriman</h3>
    <p style="font-size: 1.1rem;">
        Kue Anda dijadwalkan akan dikirim pada:<br>
        <strong style="font-size: 1.5rem; color: #333;">
            <?php echo date("d M Y", strtotime($pecah['tanggal_pengiriman'])); ?>
        </strong>
    </p>
    <small>*Pesanan diproses setelah bukti DANA dikonfirmasi Admin.</small>
</div>