<?php
include "config/koneksi.php";

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Bukti Pembayaran</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="cart-page">

    <h1>Upload Bukti Pembayaran</h1>

    <div class="cart-card">

        <h3>Silakan Transfer Terlebih Dahulu</h3>

        <p>
            <strong>BCA :</strong>
            1234567890
        </p>

        <p>
            <strong>Atas Nama :</strong>
            CV. Tangguh Manokwari
        </p>

        <hr><br>

        <form
            action="simpan_bukti.php"
            method="POST"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="id"
                value="<?php echo $id; ?>"
            >

            <label>Metode Pembayaran</label>

            <select
                name="metode_pembayaran"
                required
            >

                <option value="">
                    Pilih Metode
                </option>

                <option value="Transfer BCA">
                    Transfer BCA
                </option>

                <option value="Transfer BRI">
                    Transfer BRI
                </option>

                <option value="Transfer Mandiri">
                    Transfer Mandiri
                </option>

            </select>

            <br><br>

            <label>Upload Bukti Transfer</label>

            <input
                type="file"
                name="bukti"
                accept="image/*"
                required
            >

            <br><br>

            <button
                type="submit"
                class="btn-buy"
            >
                Kirim Bukti Pembayaran
            </button>

        </form>

    </div>

</section>

</body>
</html>