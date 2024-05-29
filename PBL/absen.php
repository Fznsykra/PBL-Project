<!-- ======= main ======= -->
<main id="main" class="main">

    <?php
    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

    switch ($aksi) {
        case 'list':
            ?>
            <h1>Absensi</h1>
            <div class="row">
                <!-- Collapsable Card Example -->
                <div class="col-md-4 animated--fade-in">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#absen" class="d-block card-header py-3 bg-warning" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="absen">
                            <h6 class="m-0 text-black">Menu Pengisian Absensi</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="absen">
                            <div class="card-body">
                                <form role="form" action="index.php?page=absen&aksi=data" method="POST" name="postform"
                                    enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select name="kelas" class="form-select">
                                                <?php
                                                $kelas_query = mysqli_query($db, "SELECT * FROM kelas");
                                                while ($data_kelas = mysqli_fetch_array($kelas_query)) {
                                                    $select = (isset($_POST['kelas']) && $_POST['kelas'] == $data_kelas['id_kelas']) ? 'selected' : '';
                                                    echo "<option $select value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['nama_kelas'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-warning">Lihat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php if ($_SESSION['level'] == 'dosen' || 'adm') {
                ?>
                <div class="row">
                    <!-- Collapsable Card Example -->
                    <div class="col-md-4 animated--fade-in">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#absen1" class="d-block card-header py-3 bg-warning" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="absen">
                                <h6 class="m-0 text-black"> Mulai Absen</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="absen1">
                                <div class="card-body">
                                    <form role="form" action="index.php?page=absen&aksi=input" method="POST" name="postform"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" class="form-select">
                                                    <?php
                                                    $kelas_query = mysqli_query($db, "SELECT * FROM kelas");
                                                    while ($data_kelas = mysqli_fetch_array($kelas_query)) {
                                                        $select = (isset($_POST['kelas']) && $_POST['kelas'] == $data_kelas['id_kelas']) ? 'selected' : '';
                                                        echo "<option $select value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['nama_kelas'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            if ($_SESSION['level'] == 'mhs') {
                ?>
                <div class="row">
                    <!-- Collapsable Card Example -->
                    <div class="col-md-4 animated--fade-in">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#inputAbsen" class="d-block card-header py-3 bg-warning" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="inputAbsen">
                                <h6 class="m-0 text-black">Input Absensi</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="inputAbsen">
                                <div class="card-body">
                                    <form role="form" action="index.php?page=absen&aksi=hadir" method="POST" name="postform"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="matkul">Matakuliah Dan Dosen</label>
                                                <select name="matkul" class="form-select">
                                                    <?php

                                                    $matkul = mysqli_query($db, "SELECT * FROM matdos 
                                                                         JOIN matkul ON matdos.id_matkul = matkul.id_matkul 
                                                                         JOIN dosen ON matdos.nip = dosen.nip");

                                                    while ($data_matkul = mysqli_fetch_array($matkul)) {
                                                        echo "<option value=" . $data_matkul['id_matdos'] . ">" . $data_matkul['nama_matkul'] . " - " . $data_matkul['nama'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-warning">Hadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <?php
            }
            break;
        case 'data':
            ?>
            <h1>Data Absen</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped table-hover mt-2">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama Kelas</th>
                                    <th>Matakuliah</th>
                                    <th>Username</th>
                                    <th>Waktu</th>
                                    <th>keterangan</th>
                                    <?php
                                    if ($_SESSION['level'] == 'adm' || 'dosen') {
                                        ?>
                                        <th>Aksi</th>
                                        <?php
                                    } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    // Ambil username dari sesi
                                    $username = $_SESSION['username'];

                                    // Lakukan query untuk mendapatkan NIP dari tabel dosen yang sesuai dengan username
                                    $queryDosen = "SELECT nip FROM dosen WHERE username = '$username'";

                                    // Jalankan query, dan ambil hasilnya
                                    $resultDosen = mysqli_query($db, $queryDosen);

                                    // Periksa apakah query berhasil
                                    if ($resultDosen) {
                                        // Ambil data NIP dari hasil query
                                        $dataDosen = mysqli_fetch_assoc($resultDosen);

                                        // Periksa apakah NIP ditemukan
                                        if ($dataDosen) {
                                            // Simpan NIP ke dalam variabel $nip
                                            $nip = $dataDosen['nip'];

                                            // Lakukan query untuk mendapatkan nilai NIP dari tabel matdos
                                            $queryMatdos = "SELECT id_matkul FROM matdos WHERE nip = '$nip'";

                                            // Jalankan query, dan ambil hasilnya
                                            $resultMatdos = mysqli_query($db, $queryMatdos);

                                            // Periksa apakah query berhasil
                                            if ($resultMatdos) {
                                                // Ambil data NIP dari hasil query
                                                $dataMatdos = mysqli_fetch_assoc($resultMatdos);

                                                // Periksa apakah NIP ditemukan
                                                if ($dataMatdos) {
                                                    // Simpan NIP ke dalam variabel $nip
                                                    $id_matkul = $dataMatdos['id_matkul'];

                                                    // Sekarang $nip berisi NIP yang diambil dari tabel matdos
                        
                                                    $id_kelas = isset($_POST['kelas']) ? $_POST['kelas'] : null;
                                                    $query = "SELECT * FROM absensi JOIN mahasiswa ON absensi.nim= mahasiswa.nim JOIN kelas ON mahasiswa.id_kelas = kelas.id_kelas JOIN jadwal ON kelas.id_kelas = jadwal.id_kelas JOIN matdos ON jadwal.id_matdos=matdos.id_matdos JOIN matkul ON matdos.id_matkul = matkul.id_matkul WHERE kelas.id_kelas=$id_kelas AND matdos.id_matkul=$id_matkul ORDER BY mahasiswa.nim";
                                                    $result = $db->query($query);
                                                    foreach ($result as $row) {
                                                        echo "<tr>";
                                                        echo "<td>{$row['nim']}</td>";
                                                        echo "<td>{$row['nama_mhs']}</td>";
                                                        echo "<td>{$row['jk']}</td>";
                                                        echo "<td>{$row['nama_kelas']}</td>";
                                                        echo "<td>{$row['nama_matkul']}</td>";
                                                        echo "<td>{$row['username']}</td>";
                                                        echo "<td>{$row['waktu']}</td>";
                                                        echo "<td>{$row['keterangan']}</td>";

                                                        if ($_SESSION['level'] == 'adm' || $_SESSION['level'] == 'dosen') {
                                                            echo "<td>
                                                                    <a class='badge bg-primary' href='index.php?page=absen&aksi=edit&nim={$row['nim']}'>Edit</a>
                                                                    <a class='badge bg-danger' onclick='return confirm(\"Apakah Kamu Yakin Menghapusnya\")' 
                                                                    href='proses-absen.php?proses=delete&id_absen={$row['id_absen']}'>Hapus</a>
                                                                  </td>";
                                                        }
                                                        echo "</tr>";
                                                    }



                                                } else {
                                                    // Handle jika NIP tidak ditemukan di tabel matdos
                                                    echo "NIP tidak ditemukan di tabel matdos.";
                                                }
                                            } else {
                                                // Handle kesalahan jika query pada tabel matdos tidak berhasil
                                                echo "Error: " . mysqli_error($db);
                                            }
                                        } else {
                                            // Handle jika NIP tidak ditemukan di tabel dosen
                                            echo "NIP tidak ditemukan di tabel dosen.";
                                        }
                                    } else {
                                        // Handle kesalahan jika query pada tabel dosen tidak berhasil
                                        echo "Error: " . mysqli_error($db);
                                    }
                                } else {
                                    // Handle jika sesi username tidak tersedia
                                    echo "Username tidak tersedia di sesi.";
                                }
                                ?>
                                <button onclick="printPage()">Print</button>
                            </tbody>
                        </table>
                    </div>
                </div>



                <?php
                break;
        case 'input':

            // Ambil username dari sesi
            $username = $_SESSION['username'];

            // Query untuk mendapatkan NIP dari tabel dosen yang sesuai dengan username
            $queryDosen = "SELECT nip FROM dosen WHERE username = '$username'";
            $resultDosen = mysqli_query($db, $queryDosen);

            // Periksa apakah query berhasil
            if ($resultDosen) {
                $dataDosen = mysqli_fetch_assoc($resultDosen);

                // Periksa apakah data dosen ditemukan
                if ($dataDosen) {
                    $nip = $dataDosen['nip'];

                    // Query untuk mendapatkan id_matdos dari tabel matdos berdasarkan nip
                    $queryMatdos = "SELECT id_matdos FROM matdos WHERE nip = '$nip'";
                    $resultMatdos = mysqli_query($db, $queryMatdos);

                    // Periksa apakah query berhasil
                    if ($resultMatdos) {
                        $dataMatdos = mysqli_fetch_assoc($resultMatdos);

                        // Periksa apakah data matdos ditemukan
                        if ($dataMatdos) {

                            if ($_SESSION['level'] == 'dosen') {
                                $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : null;
                                $waktu = date('Y-m-d');
                                $id_matdos = $dataMatdos['id_matdos'];
                                $nim_query = mysqli_query($db, "SELECT nim FROM mahasiswa WHERE id_kelas=$kelas");
                                while ($data_nim = mysqli_fetch_array($nim_query)) {
                                    $nim = $data_nim['nim'];
                                    $query = "INSERT INTO absensi (nim, waktu, keterangan) VALUES ('$nim','$waktu', 'Belum Absen')";
                                    mysqli_query($db, $query);
                                }

                                echo "Sesi Absen Sedang Berlangsung";
                            } else {
                                echo "Hanya dosen yang dapat melakukan input data absensi.";
                            }
                        } else {
                            // Handle jika data matdos tidak ditemukan
                            echo "Data matdos tidak ditemukan";
                        }
                    } else {
                        // Handle kesalahan jika query pada tabel matdos tidak berhasil
                        echo "Error: " . mysqli_error($db);
                    }
                } else {
                    // Handle jika data dosen tidak ditemukan di tabel dosen
                    echo "Data dosen tidak ditemukan";
                }
            } else {
                // Handle kesalahan jika query pada tabel dosen tidak berhasil
                echo "Error: " . mysqli_error($db);
            }




            break;
        case "hadir": {
                // Ambil username dari sesi
                $username = $_SESSION['username'];
                $id_matdos = isset($_POST['matkul']) ? $_POST['matkul'] : null;

                // Query untuk mendapatkan NIM dan id_matdos dari tabel mahasiswa
                $queryMahasiswa = "SELECT nim FROM mahasiswa WHERE mahasiswa.username = '$username'";
                $resultMahasiswa = mysqli_query($db, $queryMahasiswa);

                // Periksa apakah query berhasil
                if ($resultMahasiswa) {
                    // Ganti mysqli_fetch_assoc dengan mysqli_fetch_array jika dibutuhkan
                    $dataMahasiswa = mysqli_fetch_assoc($resultMahasiswa);

                    // Periksa apakah data mahasiswa ditemukan
                    if ($dataMahasiswa) {
                        $nim = $dataMahasiswa['nim'];

                        // Query untuk mendapatkan id_matdos dari tabel matdos
                        $queryMatdos = "SELECT id_matdos FROM matdos WHERE id_matdos = '$id_matdos'";
                        $resultMatdos = mysqli_query($db, $queryMatdos);

                        // Periksa apakah query berhasil
                        if ($resultMatdos) {
                            $dataMatdos = mysqli_fetch_assoc($resultMatdos);

                            // Periksa apakah data matdos ditemukan
                            if ($dataMatdos) {
                                // Periksa apakah id_matdos dari database sama dengan id_matdos yang di-post
                                if ($id_matdos == $dataMatdos['id_matdos']) {
                                    $query = "UPDATE absensi SET keterangan = 'Hadir' WHERE nim = '$nim'";
                                    $resultUpdate = mysqli_query($db, $query);

                                    // Periksa apakah query UPDATE berhasil
                                    if ($resultUpdate) {
                                        echo "Keterangan berhasil diperbarui menjadi 'Hadir' untuk NIM $nim";
                                    } else {
                                        // Handle kesalahan jika query UPDATE tidak berhasil
                                        echo "Error updating record: " . mysqli_error($db);
                                    }
                                } else {
                                    echo "id_matdos yang di-post tidak sesuai dengan data di database";
                                }
                            } else {
                                echo "Data matdos tidak ditemukan";
                            }
                        } else {
                            // Handle kesalahan jika query pada tabel matdos tidak berhasil
                            echo "Error: " . mysqli_error($db);
                        }
                    } else {
                        // Handle jika data mahasiswa tidak ditemukan di tabel mahasiswa
                        echo "Data mahasiswa tidak ditemukan";
                    }
                } else {
                    // Handle kesalahan jika query pada tabel mahasiswa tidak berhasil
                    echo "Error: " . mysqli_error($db);
                }



            }
            break;
        case "edit": {?>

            <div class="row">
                <!-- Collapsable Card Example -->
                <div class="col-md-4 animated--fade-in">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#absen" class="d-block card-header py-3 bg-warning" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="absen">
                            <h6 class="m-0 text-black">Menu Pengisian Absensi</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="absen">
                            <div class="card-body">
                                <form role="form" action="index.php?page=absen&aksi=data" method="POST" name="postform"
                                    enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            
                                            </select>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-warning">Lihat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<?php
            }
            






    } ?>
</main><!-- End main -->