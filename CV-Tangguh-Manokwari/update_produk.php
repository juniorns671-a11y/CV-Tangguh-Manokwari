<?php

include "config/koneksi.php";

$id = $_POST['id'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$unggulan = $_POST['unggulan'];

if($_FILES['gambar']['name'] != ''){

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "images/".$gambar
    );

    $path = "images/".$gambar;

    mysqli_query(
        $conn,
        "UPDATE produk
        SET
        nama_produk='$nama_produk',
        harga='$harga',
        stok='$stok',
        unggulan='$unggulan',
        gambar='$path'
        WHERE id='$id'"
    );

}else{

    mysqli_query(
        $conn,
        "UPDATE produk
        SET
        nama_produk='$nama_produk',
        harga='$harga',
        stok='$stok',
        unggulan='$unggulan'
        WHERE id='$id'"
    );

}

echo "
<script>
alert('Produk berhasil diupdate');
window.location='kelola_produk.php';
</script>
";
?>