<?php
require "koneksi.php";

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        //mengambi nilai yang dikirim dari inputan form
        $nim = $_POST['nim'];
        $username = $_POST['username'];
        $nama_mhs = $_POST['nama_mhs'];
        $jk = $_POST['jk'];
        $id_kelas = $_POST['id_kelas'];

        // Cek apakah username sudah ada di dalam tabel dosen
        $check_username_query = "SELECT * FROM mahasiswa WHERE username = '$username'";
        $check_username_result = $db->query($check_username_query);

        if ($check_username_result->num_rows > 0) {
            // Jika username sudah ada, tampilkan pesan kesalahan
            echo "Username sudah ada dalam database";
        } else {
            // Cek apakah NIP sudah ada di dalam tabel dosen
            $check_nip_query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            $check_nip_result = $db->query($check_nip_query);

            if ($check_nip_result->num_rows > 0) {
                // Jika NIP sudah ada, tampilkan pesan kesalahan
                echo "NIP sudah ada dalam database";
            } else {
                // Jika NIP dan username belum ada, lakukan operasi INSERT
                $insert_query = "INSERT INTO mahasiswa(nim, username, id_kelas,nama_mhs, jk) VALUES ('$nim', '$username',$id_kelas, '$nama_mhs', '$jk')";

                // Cek apakah query sukses atau gagal
                if ($db->query($insert_query) == TRUE) {
                    header("Location: index.php?page=mahasiswa"); // Redirect
                } else {
                    echo "Data gagal disimpan" . $db->error;
                }
            }
        }


    }
}


if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
        $nim = $_POST['nim'];
        $id_kelas = $_POST['id_kelas'];
        $nama_mhs = $_POST['nama_mhs'];
        $jk = $_POST['jk'];
    

        $query = "UPDATE mahasiswa SET id_kelas='$id_kelas', nama_mhs='$nama_mhs', jk='$jk' WHERE nim=$nim";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=mahasiswa");
        }else {
            echo "Gagal Update Data".$db->error;
        }
    }
    list($tahun,$bulan,$tgl_lahir) = explode('-',$row['tgl_lahir']);
}


if ($_GET['proses']=='delete') {
    
    require 'koneksi.php';

    $get_nim = $_GET['nim'];

    $sql = "DELETE FROM mahasiswa WHERE nim='$get_nim'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=mahasiswa");
    }else {
        echo "Gagal menghapus data".$db->error;
    }
}



?>