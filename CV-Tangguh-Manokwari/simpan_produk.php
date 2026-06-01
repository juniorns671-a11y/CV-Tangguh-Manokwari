<?php

session_start();

include "config/koneksi.php";

$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$unggulan = $_POST['unggulan'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file(
    $tmp,
    "images/".$gambar
);

$pathGambar = "images/".$gambar;

mysqli_query(
    $conn,
    "INSERT INTO produk
    (
        nama_produk,
        harga,
        stok,
        gambar,
        unggulan
    )
    VALUES
    (
        '$nama_produk',
        '$harga',
        '$stok',
        '$pathGambar',
        '$unggulan'
    )"
);

echo "
<script>
alert('Produk berhasil ditambahkan');
window.location='kelola_produk.php';
</script>
";
?>