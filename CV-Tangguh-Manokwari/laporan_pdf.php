<?php

session_start();

include "config/koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Laporan Penjualan</title>

<style>

<style>

body{
    font-family:Arial, sans-serif;
    padding:20px;
    color:#333;
}

.header{
    text-align:center;
    margin-bottom:20px;
}

.header h1{
    margin:0;
    color:#2e7d32;
}

.header p{
    margin:5px 0;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,
th,
td{
    border:1px solid #ccc;
}

th{
    background:#2e7d32;
    color:white;
}

th,
td{
    padding:10px;
    text-align:center;
}

.summary{
    margin-top:20px;
    text-align:right;
    font-weight:bold;
}

.ttd{
    margin-top:60px;
    text-align:right;
}

</style>

</style>

</head>

<body onload="window.print()">

<div class="header">

    <h1>CV. TANGGUH MANOKWARI</h1>

    <p>Sistem Penjualan Sembako Online</p>

    <p>Manokwari, Papua Barat</p>

    <h2>Laporan Penjualan</h2>

</div>

<hr>

<table>

<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Pelanggan</th>
    <th>Total</th>
</tr>

<?php

$no = 1;

$totalOmzet = 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM pesanan
    WHERE status='Selesai'"
);

while($pesanan = mysqli_fetch_assoc($query)){

    $idPesanan = $pesanan['id'];

    $detail = mysqli_query(
        $conn,
        "SELECT * FROM detail_pesanan
        WHERE pesanan_id='$idPesanan'"
    );

    $total = 0;

    while($d = mysqli_fetch_assoc($detail)){

        $total +=
        $d['qty'] *
        $d['harga'];

        $totalOmzet += $total;

    }

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $pesanan['tanggal']; ?></td>

<td><?php echo $pesanan['nama_pelanggan']; ?></td>

<td>
Rp <?php echo number_format($total,0,',','.'); ?>
</td>

</tr>

<?php } ?>

</table>

<?php

$totalTransaksi = $no - 1;

?>

<div class="summary">

    <p>
        Total Transaksi :
        <?php echo $totalTransaksi; ?>
    </p>

    <p>
        Total Omzet :
        Rp <?php echo number_format(
            $totalOmzet,
            0,
            ',',
            '.'
        ); ?>
    </p>

</div>

<div class="ttd">

    <p>
        Manokwari,
        <?php echo date('d F Y'); ?>
    </p>

    <br><br><br>

    <p>
        Admin CV. Tangguh Manokwari
    </p>

</div>

</body>
</html>