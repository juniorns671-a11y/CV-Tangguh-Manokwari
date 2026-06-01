<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}

include "config/koneksi.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE produk
    SET status_produk='Nonaktif'
    WHERE id='$id'"
);

echo "
<script>
alert('Produk dinonaktifkan');
window.location='kelola_produk.php';
</script>
";
?>