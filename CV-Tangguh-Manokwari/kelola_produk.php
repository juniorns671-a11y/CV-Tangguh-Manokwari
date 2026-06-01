<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit;
}

include "config/koneksi.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
    ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Kelola Produk</title>

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

    <h1>
        Kelola Produk
    </h1>

    <br>

    <a href="tambah_produk.php" class="btn-buy">
        + Tambah Produk
    </a>

    <br><br>

    <table width="100%" border="1" cellpadding="10">

        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

<?php while($produk = mysqli_fetch_assoc($query)){ ?>

        <tr>

            <td>

                <img
                    src="<?php echo $produk['gambar']; ?>"
                    width="100"
                >

            </td>

            <td>
                <?php echo $produk['nama_produk']; ?>
            </td>

            <td>
                Rp <?php echo number_format($produk['harga'],0,',','.'); ?>
            </td>

            <td>
    <?php echo $produk['stok']; ?>
</td>

<td>

<?php
if($produk['status_produk'] == 'Aktif'){
    echo "<span style='color:green;font-weight:bold;'>Aktif</span>";
}else{
    echo "<span style='color:red;font-weight:bold;'>Nonaktif</span>";
}
?>

</td>

<td>

<a href="edit_produk.php?id=<?php echo $produk['id']; ?>">
    Edit
</a>

|

<?php if($produk['status_produk'] == 'Aktif'){ ?>

<a href="nonaktifkan_produk.php?id=<?php echo $produk['id']; ?>">
    Nonaktifkan
</a>

<?php }else{ ?>

<a href="aktifkan_produk.php?id=<?php echo $produk['id']; ?>">
    Aktifkan
</a>

<?php } ?>

            </td>

        </tr>

<?php } ?>

    </table>

</div>

</body>
</html>