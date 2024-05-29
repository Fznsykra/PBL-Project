<?php
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        $id_matkul = $_POST['id_matkul'];
        $nama_matkul = $_POST['nama_matkul'];
        $sks = $_POST['sks'];
        
    
        $query = "INSERT INTO matkul (id_matkul, nama_matkul, sks) VALUES ('$id_matkul', '$nama_matkul', '$sks')";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=matkul"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}


if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
        $id_matkul = $_POST['id_matkul'];
        $nama_matkul = $_POST['nama_matkul'];
        $sks = $_POST['sks'];

        

        $query = "UPDATE matkul SET nama_matkul='$nama_matkul', sks='$sks' WHERE id_matkul=$id_matkul";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=matkul");
        }else {
            echo "Gagal Update Data".$db->error;
        }
    }
}

if ($_GET['proses']=='delete') {
    
    require 'koneksi.php';

    $get_id = $_GET['id_matkul'];

    $sql = "DELETE FROM matkul WHERE id_matkul=$get_id";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=matkul");
    }else {
        echo "Gagal menghapus data".$db->error;
    }
}

?>