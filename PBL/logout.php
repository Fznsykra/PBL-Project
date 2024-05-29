<?php 
include('koneksi.php');
session_start();
$username = $_SESSION['username'];
$berhasil = true;
if($sql_login=mysqli_query($db, "UPDATE user SET last_login=now() WHERE username='$username'")){
    $_SESSION =[];
    session_unset();
    session_destroy();
    header("Location: login.php");
}
echo mysqli_error($koneksi);
?>