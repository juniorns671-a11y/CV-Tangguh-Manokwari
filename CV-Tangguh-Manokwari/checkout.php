<?php

session_start();

include "config/koneksi.php";

$nama_pelanggan = $_POST['nama_pelanggan'];
$nomor_hp = $_POST['nomor_hp'];
$alamat = $_POST['alamat'];

mysqli_query(
    $conn,
    "INSERT INTO pesanan
    (
        nama_pelanggan,
        nomor_hp,
        alamat,
        status
    )
    VALUES
    (
        '$nama_pelanggan',
        '$nomor_hp',
        '$alamat',
        'Menunggu Pembayaran'
    )"
);

$pesanan_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $produk_id){

    $queryProduk = mysqli_query(
        $conn,
        "SELECT * FROM produk
        WHERE id='$produk_id'"
    );

    $produk = mysqli_fetch_assoc($queryProduk);

    mysqli_query(
        $conn,
        "INSERT INTO detail_pesanan
        (
            pesanan_id,
            produk_id,
            qty,
            harga
        )
        VALUES
        (
            '$pesanan_id',
            '$produk_id',
            1,
            '".$produk['harga']."'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE produk
        SET stok = stok - 1
        WHERE id='$produk_id'"
    );
}

unset($_SESSION['cart']);

header("Location: upload_bukti.php?id=$pesanan_id");
exit;
?>