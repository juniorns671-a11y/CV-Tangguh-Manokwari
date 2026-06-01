<?php
session_start();
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - CV. Tangguh Manokwari</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
    .produk-container{
        display:flex;
        flex-wrap:wrap;
        gap:20px;
        justify-content:center;
        padding:30px;
    }

    .produk-card{
        background:#fff;
        width:280px;
        border-radius:15px;
        padding:15px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
        text-align:center;
    }

    .produk-card img{
        width:100%;
        height:220px;
        object-fit:cover;
        border-radius:10px;
    }

    .produk-card h3{
        margin-top:15px;
    }

    .harga{
        color:#2e7d32;
        font-weight:bold;
        font-size:20px;
        margin:10px 0;
    }

    .btn-beli{
        background:#2e7d32;
        color:white;
        border:none;
        padding:10px 20px;
        border-radius:8px;
        cursor:pointer;
    }
    </style>

</head>
<body>

<nav class="navbar">

    <div class="logo">
        CV. Tangguh Manokwari
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">
                Home
            </a>
        </li>

        <li>
            <a href="cart.php">
                Keranjang
            </a>
        </li>

    </ul>

</nav>

<section class="cart-page">

    <h1>Daftar Produk</h1>

    <div class="produk-container">

<?php

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
    WHERE status_produk='Aktif'"
);

while($produk = mysqli_fetch_assoc($query)){

?>

        <div class="produk-card">

            <img
                src="<?php echo $produk['gambar']; ?>"
                alt="<?php echo $produk['nama_produk']; ?>"
            >

            <h3>
                <?php echo $produk['nama_produk']; ?>
            </h3>

            <p class="harga">
                Rp <?php echo number_format($produk['harga'],0,',','.'); ?>
            </p>

            <p>
                Stok: <?php echo $produk['stok']; ?>
            </p>

            <form
    action="tambah_keranjang.php"
    method="POST"
>

<input
    type="hidden"
    name="produk_id"
    value="<?php echo $produk['id']; ?>"
>

<input
    type="hidden"
    name="asal"
    value="produk"
>

<button
    type="submit"
    class="btn-beli"
>
    <i class="fa-solid fa-cart-plus"></i>
    Beli
</button>

</form>

        </div>

<?php } ?>

    </div>

</section>

</body>
</html>