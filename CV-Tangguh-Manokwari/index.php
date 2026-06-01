<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV. Tangguh Manokwari</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            CV. Tangguh Manokwari
        </div>

        <ul class="nav-links">
            <li>
                <a href="index.php">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>

            <li>
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping"></i> Keranjang
                </a>
            </li>

            <li>
                <a href="cek_pesanan.php">
                    <i class="fa-solid fa-truck"></i> Cek Pesanan
                </a>
            </li>

            <li>
                <a href="login.html">
                    <i class="fa-solid fa-user-shield"></i> Admin
                </a>
            </li>
        </ul>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <h1>Selamat Datang di CV. Tangguh Manokwari</h1>
        <p>Menyediakan kebutuhan sembako berkualitas dengan harga terbaik.</p>

        <a href="produk.php">
            Lihat Produk
        </a>
    </section>

    <!-- Produk -->
    <section class="produk">

        <h2>Produk Unggulan</h2>

        <div class="produk-container">

            <?php

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
    WHERE unggulan='Ya'
    AND status_produk='Aktif'"
);

            while($produk = mysqli_fetch_assoc($query)){

            ?>

            <div class="card">

                <img
                    src="<?php echo $produk['gambar']; ?>"
                    alt="<?php echo $produk['nama_produk']; ?>"
                >

                <h3>
                    <?php echo $produk['nama_produk']; ?>
                </h3>

                <p>
                    Rp <?php echo number_format($produk['harga'],0,',','.'); ?>
                </p>

                <span class="stok">
                    Stok: <?php echo $produk['stok']; ?>
                </span>

                <form action="tambah_keranjang.php" method="POST">

<input
    type="hidden"
    name="produk_id"
    value="<?php echo $produk['id']; ?>"
>

<input
    type="hidden"
    name="asal"
    value="index"
>

<button type="submit">

    <i class="fa-solid fa-cart-plus"></i>
    Beli

</button>

</form>

            </div>

            <?php } ?>

        </div>

    </section>

    <!-- Lokasi -->
    <section class="lokasi">

        <h2>Lokasi Toko</h2>

        <p>CV. Tangguh Manokwari</p>

        <p>
            <i class="fa-solid fa-location-dot"></i>
            Jl. Pasir, Pasar Wosi, Manokwari, Papua Barat
        </p>

        <p>
            <i class="fa-brands fa-whatsapp"></i>
            WhatsApp: 0853-4410-5430
        </p>

    </section>

    <!-- Footer -->
    <footer>
        <p>© 2026 CV. Tangguh Manokwari</p>
        <p>Manokwari, Papua Barat</p>
    </footer>

</body>
</html>