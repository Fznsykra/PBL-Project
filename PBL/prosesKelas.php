<?php
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $id_dosen= $_POST['id_dosen'];
    
        $query = "INSERT INTO kelas (id_kelas, nama_kelas,id_dosen) 
                    VALUES ('$id_kelas', '$nama_kelas', '$id_dosen')";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=mahasiswa"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses']=='update') {
    //query update
    if (isset($_POST['submit'])) {
        $nim = $_POST['nim'];
        $nama_mhs = $_POST['nama_mhs'];
        $tanggal = $_POST['tanggal_lahir'];
        $bulan = $_POST['bulan_lahir'];
        $tahun = $_POST['tahun_lahir'];
        $tgl_lahir = $tahun . '-' . $bulan . '-' . $tanggal;
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];
        $prodi_id = $_POST['prodi_id'];
    
        $query = "UPDATE mahasiswa SET nama_mhs='$nama_mhs', tgl_lahir='$tgl_lahir', 
            jenis_kelamin='$jenis_kelamin',prodi_id='$prodi_id', hobi='$hobi', alamat='$alamat' WHERE nim='$nim'";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=mahasiswa"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses']=='delete') {
    //query delete
    
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $nim = $_GET['nim'];

    // Hapus data mahasiswa berdasarkan NIM
    $query = "DELETE FROM mahasiswa WHERE nim='$nim'";
    if ($db->query($query) === TRUE) {
        header("Location: index.php?page=mahasiswa");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}
}
?>