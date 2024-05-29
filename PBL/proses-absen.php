<?php
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $prodi = $_POST['prodi'];
        $id_thn_ajaran = $_POST['id_thn_ajaran'];
        
    
        $query = "INSERT INTO kelas (id_kelas, nama_kelas, prodi, id_thn_ajaran) VALUES ('$id_kelas', '$nama_kelas', '$prodi','$id_thn_ajaran')";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=kelas"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}


if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
        $absen = $_POST['id_kelas'];
        $id_thn_ajaran = $_POST['id_thn_ajaran'];
        $prodi = $_POST['prodi'];
        $nama_kelas = $_POST['nama_kelas'];

        

        $query = "UPDATE kelas SET id_thn_ajaran=$id_thn_ajaran, prodi='$prodi',  nama_kelas='$nama_kelas' WHERE id_kelas=$id_kelas";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=kelas");
        }else {
            echo "Gagal Update Data".$db->error;
        }
    }
}

if ($_GET['proses']=='delete') {
    
    require 'koneksi.php';

    $get_absen = $_GET['id_absen'];

    $sql = "DELETE FROM absensi WHERE id_absen=$get_absen";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=absen");
    }else {
        echo "Gagal menghapus data".$db->error;
    }
}

?>