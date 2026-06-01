<?php

include "config/koneksi.php";

$id = $_POST['id'];

$metode = $_POST['metode_pembayaran'];

$nama_file =
time()."_".$_FILES['bukti']['name'];

move_uploaded_file(
    $_FILES['bukti']['tmp_name'],
    "uploads/".$nama_file
);

mysqli_query(
    $conn,
    "UPDATE pesanan
    SET
    metode_pembayaran='$metode',
    bukti_pembayaran='$nama_file',
    status='Menunggu Verifikasi'
    WHERE id='$id'"
);

echo "
<script>
alert('Bukti pembayaran berhasil dikirim');
window.location='cek_pesanan.php';
</script>
";
?>