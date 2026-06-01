<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}

include "config/koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Laporan Penjualan</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<nav class="navbar">

    <div class="logo">
        Laporan Penjualan
    </div>

    <ul class="nav-links">

        <li>
            <a href="admin.php">
                Dashboard
            </a>
        </li>

        <li>
            <a href="logout.php">
                Logout
            </a>
        </li>

    </ul>

</nav>

<div class="container">

<h1 class="laporan-title">
📊 Laporan Penjualan
</h1>

<table class="laporan-table">

        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Status</th>
            <th>Total</th>
        </tr>

<?php

$no = 1;

$totalOmzet = 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM pesanan
    WHERE status='Selesai'
    ORDER BY tanggal DESC"
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

    }

    $totalOmzet += $total;

?>

<tr>

    <td><?php echo $no++; ?></td>

    <td><?php echo $pesanan['tanggal']; ?></td>

    <td><?php echo $pesanan['nama_pelanggan']; ?></td>

    <td><?php echo $pesanan['status']; ?></td>

    <td>
        Rp <?php echo number_format($total,0,',','.'); ?>
    </td>

</tr>

<?php } ?>

</table>

    <br>

<?php

$totalTransaksi = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE status='Selesai'"
    )
);

?>

<div class="laporan-summary">

    <div class="summary-card">
        <h3>🛒 Total Transaksi</h3>
        <p><?php echo $totalTransaksi; ?></p>
    </div>

    <div class="summary-card">
        <h3>💰 Total Omzet</h3>
        <p>
            Rp <?php echo number_format(
                $totalOmzet,
                0,
                ',',
                '.'
            ); ?>
        </p>
    </div>

</div>

<br>

<a
    href="laporan_pdf.php"
    class="btn-pdf"
>
    📄 Cetak Laporan
</a>

</div>

</body>
</html>