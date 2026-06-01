<?php

session_start();

$produk_id = $_POST['produk_id'];
$asal = $_POST['asal'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = $produk_id;

if($asal == "index"){

    echo "
    <script>
    alert('Produk berhasil ditambahkan ke keranjang');
    window.location='index.php';
    </script>
    ";

}else{

    echo "
    <script>
    alert('Produk berhasil ditambahkan ke keranjang');
    window.location='produk.php';
    </script>
    ";

}

exit;

?>