<?php
require "koneksi.php";

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        //mengambi nilai yang dikirim dari inputan form
        $nip = $_POST['nip'];
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $jk = $_POST['jk'];

        // Cek apakah username sudah ada di dalam tabel dosen
        $check_username_query = "SELECT * FROM dosen WHERE username = '$username'";
        $check_username_result = $db->query($check_username_query);

        if ($check_username_result->num_rows > 0) {
            // Jika username sudah ada, tampilkan pesan kesalahan
            echo "Username sudah ada dalam database";
        } else {
            // Cek apakah NIP sudah ada di dalam tabel dosen
            $check_nip_query = "SELECT * FROM dosen WHERE nip = '$nip'";
            $check_nip_result = $db->query($check_nip_query);

            if ($check_nip_result->num_rows > 0) {
                // Jika NIP sudah ada, tampilkan pesan kesalahan
                echo "NIP sudah ada dalam database";
            } else {
                // Jika NIP dan username belum ada, lakukan operasi INSERT
                $insert_query = "INSERT INTO dosen(nip, username, nama, jk) VALUES ('$nip', '$username', '$nama', '$jk')";

                // Cek apakah query sukses atau gagal
                if ($db->query($insert_query) == TRUE) {
                    header("Location: index.php?page=dosen"); // Redirect
                } else {
                    echo "Data gagal disimpan" . $db->error;
                }
            }
        }


    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jk = $_POST['jk'];
        $username = $_POST['username'];

        $query = "UPDATE dosen SET nama='$nama',jk='$jk' WHERE nip='$nip'";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=dosen");
        } else {
            echo "Gagal Update Data" . $db->error;
        }
    }
}


if ($_GET['proses'] == 'delete') {

    require 'koneksi.php';

    $get_id = $_GET['nip'];

    $sql = "DELETE FROM dosen WHERE nip=$get_id";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=dosen");
    } else {
        echo "Gagal menghapus data" . $db->error;
    }
}

?>