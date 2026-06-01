<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}

include "config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
    WHERE id='$id'"
);

$produk = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Edit Produk</h1>

    <form
        action="update_produk.php"
        method="POST"
        enctype="multipart/form-data"
    >

        <input
            type="hidden"
            name="id"
            value="<?php echo $produk['id']; ?>"
        >

        <p>Nama Produk</p>

        <input
            type="text"
            name="nama_produk"
            value="<?php echo $produk['nama_produk']; ?>"
            required
        >

        <p>Harga</p>

        <input
            type="number"
            name="harga"
            value="<?php echo $produk['harga']; ?>"
            required
        >

        <p>Stok</p>

        <input
            type="number"
            name="stok"
            value="<?php echo $produk['stok']; ?>"
            required
        >

        <p>Produk Unggulan</p>

        <select name="unggulan">

            <option value="Ya"
            <?php if($produk['unggulan']=="Ya") echo "selected"; ?>>
                Ya
            </option>

            <option value="Tidak"
            <?php if($produk['unggulan']=="Tidak") echo "selected"; ?>>
                Tidak
            </option>

        </select>

        <p>Gambar Baru (opsional)</p>

        <input
            type="file"
            name="gambar"
        >

        <br><br>

        <button type="submit">
            Update Produk
        </button>

    </form>

</div>

</body>
</html>