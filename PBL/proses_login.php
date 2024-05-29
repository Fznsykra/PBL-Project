<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $db->query($query);
    $data=mysqli_fetch_array($result);

    if ($result->num_rows == 1) {
        $_SESSION['login'] = TRUE;
        $_SESSION['email'] = $email;
        $_SESSION['username']=$data['username'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['last_login']=$data['last_login'];

        // Login berhasil, arahkan ke halaman lain
        header("Location: index.php");
        exit;
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
}
