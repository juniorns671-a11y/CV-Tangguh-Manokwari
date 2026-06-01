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
    "SELECT status
     FROM pesanan
     WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

$status = $data['status'];

if($status == "Menunggu Pembayaran"){

    $statusBaru = "Menunggu Verifikasi";

}elseif($status == "Menunggu Verifikasi"){

    $statusBaru = "Diproses";

}elseif($status == "Diproses"){

    $statusBaru = "Dikirim";

}elseif($status == "Dikirim"){

    $statusBaru = "Selesai";

}else{

    $statusBaru = "Selesai";
}

mysqli_query(
    $conn,
    "UPDATE pesanan
     SET status='$statusBaru'
     WHERE id='$id'"
);

header("Location: admin.php#pesanan".$id);
exit;

?>