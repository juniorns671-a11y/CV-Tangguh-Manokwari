<?php

session_start();

include "config/koneksi.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE produk
    SET status_produk='Aktif'
    WHERE id='$id'"
);

header("Location: kelola_produk.php");
exit;

?>