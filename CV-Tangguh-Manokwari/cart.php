<?php
session_start();
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">

    <div class="logo">
        CV. Tangguh Manokwari
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="cart.php">Keranjang</a>
        </li>

    </ul>

</nav>

<section class="cart-page">

<h1>Keranjang Belanja</h1>

<?php

$total = 0;

if(
    !isset($_SESSION['cart']) ||
    count($_SESSION['cart']) == 0
){

    echo "<p>Keranjang masih kosong</p>";

}else{

    foreach($_SESSION['cart'] as $key => $produk_id){

        $query = mysqli_query(
            $conn,
            "SELECT * FROM produk
            WHERE id='$produk_id'"
        );

        $produk = mysqli_fetch_assoc($query);

        $total += $produk['harga'];

?>

<div class="cart-card">

    <h3>
        <?php echo $produk['nama_produk']; ?>
    </h3>

    <p>
        Rp <?php echo number_format($produk['harga']); ?>
    </p>

    <form
        action="hapus_keranjang.php"
        method="POST"
    >

        <input
            type="hidden"
            name="index"
            value="<?php echo $key; ?>"
        >

        <button
            type="submit"
            class="btn-hapus"
            onclick="return confirm('Hapus produk dari keranjang?')"
        >
            🗑 Hapus
        </button>

    </form>

</div>

<?php
    }
}
?>

<h2>
    Total:
    Rp <?php echo number_format($total); ?>
</h2>

<?php if($total > 0){ ?>

<form action="checkout.php" method="POST">

    <input
        type="text"
        name="nama_pelanggan"
        placeholder="Nama Pelanggan"
        required
    >

    <input
        type="text"
        name="nomor_hp"
        placeholder="Nomor HP"
        required
    >

    <textarea
        name="alamat"
        placeholder="Alamat Lengkap"
        required
    ></textarea>

    <button type="submit">
        Checkout
    </button>

</form>

<?php } ?>

</section>

</body>
</html>