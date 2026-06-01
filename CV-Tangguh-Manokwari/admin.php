<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}

include "config/koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<nav class="navbar">

    <div class="logo">
        Admin CV. Tangguh Manokwari
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">
                <i class="fa-solid fa-house"></i>
                Home
            </a>
        </li>

        <li>
            <a href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
                Keranjang
            </a>
        </li>

        <li>
            <a href="kelola_produk.php">
                <i class="fa-solid fa-box"></i>
                Kelola Produk
            </a>
        </li>

        <li>
            <a href="laporan.php">
                 <i class="fa-solid fa-chart-line"></i>
                 Laporan
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-user-shield"></i>
                <?php echo $_SESSION['admin']; ?>
            </a>
        </li>

        <li>
            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </li>

    </ul>

</nav>

<section class="cart-page admin-page">
<?php

$totalPesanan = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan"
    )
);

$totalMenunggu = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE status='Menunggu Pembayaran'"
    )
);

$totalVerifikasi = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE status='Menunggu Verifikasi'"
    )
);

$totalDiproses = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE status='Diproses'"
    )
);

$totalSelesai = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM pesanan
        WHERE status='Selesai'"
    )
);

?>

<div class="dashboard-stats">

    <div class="stat-card">
        <div class="stat-icon">📦</div>
        <div class="stat-number">
            <?php echo $totalPesanan; ?>
        </div>
        <div class="stat-label">
            Total Pesanan
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💳</div>
        <div class="stat-number">
            <?php echo $totalMenunggu; ?>
        </div>
        <div class="stat-label">
            Menunggu Pembayaran
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🔍</div>
        <div class="stat-number">
            <?php echo $totalVerifikasi; ?>
        </div>
        <div class="stat-label">
            Menunggu Verifikasi
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⚙️</div>
        <div class="stat-number">
            <?php echo $totalDiproses; ?>
        </div>
        <div class="stat-label">
            Diproses
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✅</div>
        <div class="stat-number">
            <?php echo $totalSelesai; ?>
        </div>
        <div class="stat-label">
            Selesai
        </div>
    </div>

</div>

    <h1>
        <i class="fa-solid fa-box-open"></i>
        Pesanan Masuk
    </h1>

    <p class="admin-subtitle">
        Kelola semua pesanan pelanggan CV. Tangguh Manokwari
    </p>

    <div id="admin-orders">

<?php

$queryPesanan = mysqli_query(
    $conn,
    "SELECT * FROM pesanan ORDER BY id DESC"
);

if(mysqli_num_rows($queryPesanan) == 0){

    echo "
    <div class='cart-card'>
        <h3>Belum ada pesanan masuk</h3>
    </div>
    ";

}else{

    while($pesanan = mysqli_fetch_assoc($queryPesanan)){
    ?>
    
    <div class="cart-card" id="pesanan<?php echo $pesanan['id']; ?>">
    
        <h3>Pesanan #<?php echo $pesanan['id']; ?></h3>
    
        <p><strong>Nama :</strong> <?php echo $pesanan['nama_pelanggan']; ?></p>
    
        <p><strong>No HP :</strong> <?php echo $pesanan['nomor_hp']; ?></p>
    
        <p><strong>Alamat :</strong> <?php echo $pesanan['alamat']; ?></p>
    
        <p><strong>Status :</strong> <?php echo $pesanan['status']; ?></p>
    
        <p><strong>Metode Bayar :</strong>
            <?php echo $pesanan['metode_pembayaran']; ?>
        </p>
    
        <?php if(!empty($pesanan['bukti_pembayaran'])){ ?>
    
            <p><strong>Bukti Pembayaran :</strong></p>
    
            <img
                src="uploads/<?php echo $pesanan['bukti_pembayaran']; ?>"
                width="250"
                style="border-radius:10px;margin-bottom:15px;"
            >
    
        <?php } ?>
    
        <p>
            <strong>Tanggal :</strong>
            <?php echo $pesanan['tanggal']; ?>
        </p>
    
        <h4>Daftar Produk</h4>
    
        <?php
    
        $idPesanan = $pesanan['id'];
    
        $queryDetail = mysqli_query(
            $conn,
            "SELECT detail_pesanan.*, produk.nama_produk
             FROM detail_pesanan
             JOIN produk
             ON detail_pesanan.produk_id = produk.id
             WHERE detail_pesanan.pesanan_id='$idPesanan'"
        );
    
        $totalPesanan = 0;
    
        while($detail = mysqli_fetch_assoc($queryDetail)){
    
            $subtotal =
            $detail['qty'] *
            $detail['harga'];
    
            $totalPesanan += $subtotal;
    
            echo "
            <p>
                • {$detail['nama_produk']}
                (Qty: {$detail['qty']})
            </p>
            ";
        }
    
        ?>
    
        <p>
            <strong>Total :</strong>
            Rp <?php echo number_format($totalPesanan,0,',','.'); ?>
        </p>
    
        <div class="action-buttons">
    
            <a
                href="update_status.php?id=<?php echo $pesanan['id']; ?>"
                class="btn-update"
            >
                ⚙ Update Status
            </a>
    
            <a
                href="nota.php?id=<?php echo $pesanan['id']; ?>"
                target="_blank"
                class="btn-nota"
            >
                🧾 Cetak Nota
            </a>
    
            <?php if($pesanan['status'] == 'Selesai'){ ?>
    
            <a
                href="hapus_pesanan.php?id=<?php echo $pesanan['id']; ?>"
                class="btn-delete"
                onclick="return confirm('Yakin ingin menghapus pesanan ini?')"
            >
                🗑 Hapus
            </a>
    
            <?php } ?>
    
        </div>
    
    </div>
    
    <?php
}
}
?>

    </div>

    <h2 class="stock-title">
        Monitoring Stok Barang
    </h2>

    <div id="stock-monitor">

<?php

$queryProduk = mysqli_query(
    $conn,
    "SELECT * FROM produk"
);

while($produk = mysqli_fetch_assoc($queryProduk)){

?>

        <div class="cart-card">

            <h3>
                <?php echo $produk['nama_produk']; ?>
            </h3>

            <p>
                Stok:
                <strong>
                    <?php echo $produk['stok']; ?>
                </strong>
            </p>

            <p>
                Harga:
                Rp <?php echo number_format($produk['harga'],0,',','.'); ?>
            </p>

        </div>

<?php } ?>

    </div>

</section>

</body>
</html>