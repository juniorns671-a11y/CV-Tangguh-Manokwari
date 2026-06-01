<?php

include "config/koneksi.php";

$id = $_GET['id'];

$queryPesanan = mysqli_query(
    $conn,
    "SELECT * FROM pesanan
    WHERE id='$id'"
);

$pesanan = mysqli_fetch_assoc($queryPesanan);

?>

<!DOCTYPE html>
<html>
<head>

<title>Nota Pesanan</title>

<link rel="stylesheet" href="css/style.css">

<style>

.nota{
    max-width:800px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.nota table{
    width:100%;
    border-collapse:collapse;
}

.nota table th,
.nota table td{
    border:1px solid #ddd;
    padding:10px;
}

.print-btn{
    background:#2e7d32;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
    cursor:pointer;
    margin-bottom:20px;
}

@media print{

    .print-btn{
        display:none;
    }

}

</style>

</head>

<body>

<div class="nota">

<button
    class="print-btn"
    onclick="window.print()"
>
    Cetak Nota
</button>

<div align="center">

    <h1>
        CV. TANGGUH MANOKWARI
    </h1>

    <p>
        Jl. Trikora Wosi, Manokwari
        <br>
        Papua Barat
        <br>
        Telp: 0853-4410-5430
    </p>

    <hr>

    <h2>
        NOTA PEMBELIAN
    </h2>

</div>

<p>
    <strong>No Pesanan :</strong>
    <?php echo $pesanan['id']; ?>
</p>

<p>
    <strong>Tanggal :</strong>
    <?php echo $pesanan['tanggal']; ?>
</p>

<p>
    <strong>Nama :</strong>
    <?php echo $pesanan['nama_pelanggan']; ?>
</p>

<p>
    <strong>No HP :</strong>
    <?php echo $pesanan['nomor_hp']; ?>
</p>

<p>
    <strong>Alamat :</strong>
    <?php echo $pesanan['alamat']; ?>
</p>

<hr>

<h3>Daftar Produk</h3>

<table>

<tr>
    <th>Produk</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Subtotal</th>
</tr>

<?php

$total = 0;

$queryDetail = mysqli_query(
    $conn,
    "SELECT detail_pesanan.*, produk.nama_produk
    FROM detail_pesanan
    JOIN produk
    ON detail_pesanan.produk_id = produk.id
    WHERE pesanan_id='$id'"
);

while($detail = mysqli_fetch_assoc($queryDetail)){

    $subtotal =
    $detail['qty'] *
    $detail['harga'];

    $total += $subtotal;

?>

<tr>

<td>
    <?php echo $detail['nama_produk']; ?>
</td>

<td>
    <?php echo $detail['qty']; ?>
</td>

<td>
Rp <?php echo number_format(
    $detail['harga'],
    0,
    ',',
    '.'
); ?>
</td>

<td>
Rp <?php echo number_format(
    $subtotal,
    0,
    ',',
    '.'
); ?>
</td>

</tr>

<?php } ?>

</table>

<br>

<hr>

<h2 style="text-align:right;">

TOTAL PEMBAYARAN :

Rp <?php echo number_format(
    $total,
    0,
    ',',
    '.'
); ?>

</h2>

<hr>

<p>
    <strong>Status :</strong>
    <?php echo $pesanan['status']; ?>
</p>

<p>
    <strong>Metode Pembayaran :</strong>
    <?php echo $pesanan['metode_pembayaran']; ?>
</p>

<br><br>

<table width="100%">

<tr>

</div>

</body>
</html>