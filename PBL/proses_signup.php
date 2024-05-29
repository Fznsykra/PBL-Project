<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    // Periksa apakah email sudah terdaftar
    $query_check_email = "SELECT * FROM user WHERE email = '$email'";
    $result_check_email = $db->query($query_check_email);

    if ($result_check_email->num_rows > 0) {
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Jika email belum terdaftar, lakukan proses sign-up
        $query_signup = "INSERT INTO user (email, username, password, level) VALUES ('$email', '$username', '$password', '$level')";
        $result_signup = $db->query($query_signup);

        if ($result_signup) {
            // Sign-up berhasil, set session variable
            $_SESSION['signup_success'] = true;
        } else {
            echo "Sign-up gagal. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Add your stylesheet link here -->
</head>
<body>
    <!-- Your HTML content here -->

    <script>
        <?php
        // Check if signup_success is set and true
        if (isset($_SESSION['signup_success']) && $_SESSION['signup_success']) {
            // Reset the session variable
            unset($_SESSION['signup_success']);
        ?>
            // Display a pop-up message using JavaScript
            alert("Registrasi Akun Berhasil.");
window.location.href = 'index.php';
        <?php
        }
        ?>
    </script>
</body>
</html>