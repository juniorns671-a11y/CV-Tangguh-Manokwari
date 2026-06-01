<?php

session_start();

$index = $_POST['index'];

unset($_SESSION['cart'][$index]);

$_SESSION['cart'] =
array_values($_SESSION['cart']);

header("Location: cart.php");
exit;