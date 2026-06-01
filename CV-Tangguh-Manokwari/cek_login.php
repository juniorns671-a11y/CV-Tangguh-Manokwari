<?php

session_start();

include "config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM admin
     WHERE username='$username'
     AND password='$password'"
);

if(mysqli_num_rows($query) > 0){

    $_SESSION['admin'] = $username;

    header("Location: admin.php");
    exit;

}else{

    echo "
    <script>
        alert('Username atau Password Salah!');
        window.location='login.html';
    </script>
    ";

}
?>