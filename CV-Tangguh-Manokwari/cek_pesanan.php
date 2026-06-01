<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pesanan</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<nav class="navbar">

    <div class="logo">
        CV. Tangguh Manokwari
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">
                Home
            </a>
        </li>

    </ul>

</nav>

<section class="cart-page">

    <h1>
        Cek Status Pesanan
    </h1>

    <form method="GET">

        <input
            type="text"
            name="nomor_hp"
            placeholder="Masukkan Nomor HP"
            required
        >

        <button type="submit">
            Cari Pesanan
        </button>

    </form>

    <br>

<?php

if(isset($_GET['nomor_hp'])){

    $nomor_hp = $_GET['nomor_hp'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE nomor_hp='$nomor_hp'
        ORDER BY id DESC"
    );

    if(mysqli_num_rows($query) > 0){

        while($pesanan = mysqli_fetch_assoc($query)){

?>

<div class="cart-card">

    <h3>
        Pesanan #<?php echo $pesanan['id']; ?>
    </h3>

    <p>
        <strong>Nama:</strong>
        <?php echo $pesanan['nama_pelanggan']; ?>
    </p>

    <p>
        <strong>Status:</strong>
        <?php echo $pesanan['status']; ?>
    </p>

    <a
        href="nota.php?id=<?php echo $pesanan['id']; ?>"
        target="_blank"
        >
        Cetak Nota
    </a>

<?php

$statusList = [
    "Menunggu Pembayaran",
    "Menunggu Verifikasi",
    "Diproses",
    "Dikirim",
    "Selesai"
];

$currentIndex = array_search(
    $pesanan['status'],
    $statusList
);

?>

<div style="margin-top:15px;">

    <strong>Progress Pesanan:</strong>

    <?php

    foreach($statusList as $index => $status){

        if($index <= $currentIndex){

            echo "
            <p style='color:green;font-weight:bold;'>
                ✓ $status
            </p>
            ";

        }else{

            echo "
            <p style='color:gray;'>
                ○ $status
            </p>
            ";

        }

    }

    ?>

</div>

    <p>
        <strong>Metode Pembayaran:</strong>
        <?php echo $pesanan['metode_pembayaran']; ?>
    </p>

    <p>
        <strong>Tanggal:</strong>
        <?php echo $pesanan['tanggal']; ?>
    </p>

</div>

<?php

        }

    }else{

        echo "
        <div class='cart-card'>
            <p>Pesanan tidak ditemukan.</p>
        </div>
        ";

    }

}

?>

</section>

</body>
</html>