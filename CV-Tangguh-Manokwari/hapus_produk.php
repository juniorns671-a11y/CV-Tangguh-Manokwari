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
    "DELETE FROM produk
    WHERE id='$id'"
);

echo "
<script>
alert('Produk berhasil dihapus');
window.location='kelola_produk.php';
</script>
";
?>