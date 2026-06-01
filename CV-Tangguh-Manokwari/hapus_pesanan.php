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
    "DELETE FROM detail_pesanan
    WHERE pesanan_id='$id'"
);

mysqli_query(
    $conn,
    "DELETE FROM pesanan
    WHERE id='$id'"
);

echo "
<script>
alert('Pesanan berhasil dihapus');
window.location='admin.php';
</script>
";
?>