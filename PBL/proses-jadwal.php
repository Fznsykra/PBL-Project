<?php
require "koneksi.php";

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $id_matdos = $_POST['nama_matkul'];
        $id_kelas= $_POST['nama_kelas'];
        $id_ruang = $_POST['id_ruang'];
        $id_hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_berakhir = $_POST['jam_berakhir'];

        $query = "INSERT INTO jadwal (id_jadwal,id_matdos,id_kelas,id_ruang,id_hari,jam_mulai,jam_berakhir) VALUES (NULL ,'$id_matdos','$id_kelas','$id_ruang','$id_hari','$jam_mulai','$jam_berakhir')";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=jadwal");
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}


if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id_jadwal = $_POST['id_jadwal'];
        $nama_matkul = $_POST['nama_matkul'];
        $nama = $_POST['nama'];
        $nama_kelas = $_POST['nama_kelas'];
        $id_ruang = $_POST['id_ruang'];
        $ruang = $_POST['ruang'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_berakhir = $_POST['jam_berakhir'];

        $query = "UPDATE dosen SET nama='$nama',jk='$jk' WHERE nip='$nip'";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=jadwal");
        } else {
            echo "Gagal Update Data" . $db->error;
        }
    }
}


if ($_GET['proses'] == 'delete') {

    require 'koneksi.php';

    $get_id = $_GET['id_jadwal'];

    $sql = "DELETE FROM jadwal WHERE id_jadwal=$get_id";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=jadwal");
    } else {
        echo "Gagal menghapus data" . $db->error;
    }
}


?>