<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Produk</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

    <h1>Tambah Produk</h1>

    <form
        action="simpan_produk.php"
        method="POST"
        enctype="multipart/form-data"
    >

        <p>Nama Produk</p>

        <input
            type="text"
            name="nama_produk"
            required
        >

        <p>Harga</p>

        <input
            type="number"
            name="harga"
            required
        >

        <p>Stok</p>

        <input
            type="number"
            name="stok"
            required
        >

        <p>Gambar Produk</p>

        <input
            type="file"
            name="gambar"
            required
        >
        <p>Produk Unggulan?</p>

<select name="unggulan">

    <option value="Tidak">
        Tidak
    </option>

    <option value="Ya">
        Ya
    </option>

</select>

        <br><br>

        <button type="submit">
            Simpan Produk
        </button>

    </form>

</div>

</body>
</html>