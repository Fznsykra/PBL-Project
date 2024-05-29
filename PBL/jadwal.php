<!-- ======= main ======= -->
<main id="main" class="main">

  <?php
  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

  switch ($aksi) {
    case 'list':
      ?>
      <!-- data -->
      <h1>Jadwal</h1>
      <?php
      if ($_SESSION['level'] == 'adm') {
        ?>
        <a href="index.php?page=jadwal&aksi=input" class="btn btn-warning mb-3">Tambah Data Jadwal</a>
        <?php
      }
      ?>
      <div class="card shadow mb-3">
        <div class="container-fluid card-header py-3">
          <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover mt-2">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Mata Kuliah</th>
                  <th>Nama Dosen</th>
                  <th>Kelas</th>
                  <th>Kode Ruang</th>
                  <th>Ruang</th>
                  <th>Hari</th>
                  <th>Jam Mulai</th>
                  <th>Jam Berakhir</th>
                  <?php
                  if ($_SESSION['level'] == 'adm') {
                    ?>
                    <th>Aksi</th>
                    <?php
                  } ?>
                </tr>
              </thead>

              <tbody>
                <?php
                function getHariIndonesia($dayIndex)
                {
                  $days = [
                    'minggu',
                    'senin',
                    'selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu'
                  ];

                  // Pastikan $dayIndex berada dalam rentang 0-6
                  $dayIndex = ($dayIndex >= 0 && $dayIndex <= 6) ? $dayIndex : 0;

                  return $days[$dayIndex];
                }

                // Contoh penggunaan
                $hariIni = date('w'); // Mendapatkan indeks hari ini (0-6)
                $hariIndonesia = getHariIndonesia($hariIni);
                $query = "SELECT * FROM jadwal JOIN matdos ON jadwal.id_matdos=matdos.id_matdos JOIN matkul ON matdos.id_matkul=matkul.id_matkul JOIN dosen ON  matdos.nip=dosen.nip JOIN user ON dosen.username=user.username JOIN ruang ON jadwal.id_ruang=ruang.id_ruang JOIN hari ON jadwal.id_hari=hari.id_hari JOIN kelas ON jadwal.id_kelas=kelas.id_kelas WHERE user.username='$username'";
                $result = $db->query($query);
                $nomor = 1;
                foreach ($result as $row): ?>
                  <tr>
                    <td>
                      <?= $nomor++ ?>
                    </td>
                    <td>
                      <?= $row['nama_matkul'] ?>
                    </td>
                    <td>
                      <?= $row['nama'] ?>
                    </td>
                    <td>
                      <?= $row['nama_kelas'] ?>
                    </td>
                    <td>
                      <?= $row['id_ruang'] ?>
                    </td>
                    <td>
                      <?= $row['ruang'] ?>
                    </td>
                    <td>
                      <?= $row['hari'] ?>
                    </td>
                    <td>
                      <?= $row['jam_mulai'] ?>
                    </td>
                    <td>
                      <?= $row['jam_berakhir'] ?>
                    </td>
                    <?php
                  if ($_SESSION['level'] == 'adm') {
                    ?>
                    <td>
                      <a class="badge bg-primary"
                        href="index.php?page=jadwal&aksi=edit&id_jadwal=<?= $row['id_jadwal'] ?>">Edit</a>
                      <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                        href="proses-jadwal.php?proses=delete&id_jadwal=<?= $row['id_jadwal'] ?>">Hapus</a>
                    </td>
                    <?php
                  } ?>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>


            <?php
            break;
    case 'input':
      ?>

            <form action="proses-jadwal.php?proses=insert" method="POST">

              <div>
                <h2>Input Data Jadwal</h2>
              </div>
              <form action="" method="post">
                <div class="row mb-3">
                  <label for="nama_matkul" class="col-sm-2 col-form-label">Matakuliah Dan Dosen</label>
                  <div class="col-sm-10">
                    <select name="nama_matkul" class="form-select">
                      <option value="">-- Choose Matakuliah --</option>
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
                <div class="row mb-3">
                  <label for="nama_kelas" class="col-sm-2 col-form-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="nama_kelas" class="form-select">
                      <option value="">-- Choose Kelas --</option>
                      <?php
                      $kelas = mysqli_query($db, "SELECT * FROM kelas");
                      while ($data_kelas = mysqli_fetch_array($kelas)) {
                        echo "<option value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['nama_kelas'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="id_ruang" class="col-sm-2 col-form-label">Kode Ruang</label>
                  <div class="col-sm-10">
                    <select name="id_ruang" id="id_ruang" class="form-select">
                      <option value="">-- Choose Kode Ruang --</option>
                      <?php
                      $ruang = mysqli_query($db, "SELECT * FROM ruang");
                      while ($data_ruang = mysqli_fetch_array($ruang)) {
                        echo "<option value=" . $data_ruang['id_ruang'] . ">" . $data_ruang['id_ruang'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="ruang" class="col-sm-2 col-form-label">Ruang</label>
                  <div class="col-sm-10">
                    <select name="ruang" id="ruang" class="form-select">
                      <option value="" disabled selected>-- Choose Ruang --</option>
                      <?php
                      $ruang = mysqli_query($db, "SELECT * FROM ruang");
                      while ($data_ruang = mysqli_fetch_array($ruang)) {
                        echo "<option value=" . $data_ruang['id_ruang'] . " disabled selected>" . $data_ruang['ruang'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <script>
                  // Menambahkan event listener untuk memantau perubahan pada input "Kode Ruang"
                  document.getElementById('id_ruang').addEventListener('change', function () {
                    // Mengatur nilai input "Ruang" sesuai dengan pilihan yang dibuat di input "Kode Ruang"
                    document.getElementById('ruang').value = this.value;
                  });

                  // Menambahkan event listener untuk memantau perubahan pada input "Ruang"
                  document.getElementById('ruang').addEventListener('change', function () {
                    // Mengatur nilai input "Kode Ruang" sesuai dengan pilihan yang dibuat di input "Ruang"
                    document.getElementById('id_ruang').value = this.value;
                  });
                </script>



                <div class="row mb-3">
                  <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                  <div class="col-sm-10">
                    <select name="hari" class="form-select">
                      <option value="">-- Choose Hari --</option>
                      <option value="1">Senin</option>
                      <option value="2">Selasa</option>
                      <option value="3">Rabu</option>
                      <option value="4">Kamis</option>
                      <option value="5">Jumat</option>
                      <option value="6">Saptu</option>

                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                  <div class="col-sm-10">
                    <input type="text" name="jam_mulai">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jam_berakhir" class="col-sm-2 col-form-label">Jam Berakhir</label>
                  <div class="col-sm-10">
                    <input type="text" name="jam_berakhir">
                  </div>
                </div>
                <button type="submit" class="btn btn-warning" name="submit">Simpan</button>
              </form>
            </form>

            <?php
            break;
    case 'edit':

      $get_id = $_GET['id_jadwal'];
      $sql = "SELECT * FROM jadwal WHERE id_jadwal='$get_id'";
      $result = $db->query($sql);
      //cek apakah ada data/row dari table tamu dengan id yang di kirim
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_jadwal = $row['id_jadwal'];
        $nama_matkul = $row['nama_matkul'];
        $nama = $row['nama'];
        $nama_kelas = $row['nama_kelas'];
        $id_ruang = $row['id_ruang'];
        $ruang = $row['ruang'];
        $hari = $row['hari'];
        $jam_mulai = $row['jam_mulai'];
        $jam_berakhir = $row['jam_berakhir'];

      } else {
        echo "Data $get_id tidak tersedia";
        exit;
      }

      ?>

            <form action="proses-jadwal.php?proses=update" method="POST">

              <div>
                <h2>Edit Data Dosen</h2>
              </div>
              <form action="" method="post">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Id Jadwal</label>
                  <div class="col-sm-10">
                    <input type="text" name="id_jadwal" value="<?php echo $row['id_jadwal']; ?>" readonly>
                  </div>
                </div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <select name="username" class="form-select" disabled>
                      <option value="">--Pilih Username--</option>
                      <?php
                      $user = mysqli_query($db, "SELECT * FROM user");
                      while ($data_user = mysqli_fetch_array($user)) {
                        $select = ($data_user['username'] == $row['username']) ? 'selected' : '';
                        echo "<option $select value=" . $data_user['id'] . ">" . $data_user['username'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="nama_matkul" class="col-sm-2 col-form-label">Matakuliah</label>
                  <div class="col-sm-10">
                    <select name="nama_matkul" class="form-select" disabled>
                      <?php
                      $matkul = mysqli_query($db, "SELECT * FROM matkul");
                      while ($data_matkul = mysqli_fetch_array($matkul)) {
                        $select = ($data_matkul['id_matkul'] == $row['id_matkul']) ? 'selected' : '';
                        echo "<option $select value=" . $data_matkul['id_matkul'] . ">" . $data_matkul['nama_matkul'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Dosen</label>
                  <div class="col-sm-10">
                    <select name="nama" class="form-select" disabled>
                      <option value="">-- Choose Nama Dosen --</option>
                      <?php
                      $dosen = mysqli_query($db, "SELECT * FROM dosen");
                      while ($data_dosen = mysqli_fetch_array($dosen)) {
                        echo "<option value=" . $data_dosen['nip'] . ">" . $data_dosen['nama'] . "</option>";
                        $select = ($data_matkul['id_matkul'] == $row['id_matkul']) ? 'selected' : '';
                        echo "<option $select value=" . $data_matkul['id_matkul'] . ">" . $data_matkul['nama_matkul'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama_kelas" class="col-sm-2 col-form-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="nama_kelas" class="form-select" disabled>
                      <option value="">-- Choose Kelas --</option>
                      <?php
                      $kelas = mysqli_query($db, "SELECT * FROM kelas");
                      while ($data_kelas = mysqli_fetch_array($kelas)) {
                        $select = ($data_kelas['id_kelas'] == $row['id_kelas']) ? 'selected' : '';
                        echo "<option $select value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['nama_kelas'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="id_ruang" class="col-sm-2 col-form-label">Kode Ruang</label>
                  <div class="col-sm-10">
                    <select name="id_ruang" class="form-select" disabled>
                      <option value="">-- Choose Ruang --</option>
                      <?php
                      $ruang = mysqli_query($db, "SELECT * FROM ruang");
                      while ($data_ruang = mysqli_fetch_array($ruang)) {
                        $select = ($data_ruang['id_ruang'] == $row['id_ruang']) ? 'selected' : '';
                        echo "<option $select value=" . $data_ruang['id_ruang'] . ">" . $data_ruang['id_ruang'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                  <div class="col-sm-10">
                    <select name="hari" class="form-select" disabled>
                      <option value="">-- Choose Hari --</option>
                      <?php
                      $hari = mysqli_query($db, "SELECT * FROM hari");
                      while ($data_hari = mysqli_fetch_array($hari)) {
                        $select = ($data_hari['id_hari'] == $row['id_hari']) ? 'selected' : '';
                        echo "<option $select value=" . $data_hari['id_hari'] . ">" . $data_hari['hari'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                  <div class="col-sm-10">
                    <input type="text" name="jam_mulai" value="<?php echo $row['jam_mulai']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jam_berakhir" class="col-sm-2 col-form-label">Jam Berakhir</label>
                  <div class="col-sm-10">
                    <input type="text" name="jam_berakhir" value="<?php echo $row['jam_berakhir']; ?>">
                  </div>
                </div>
                <button type="submit" class="btn btn-warning" name="submit">Update</button>
              </form>
            </form>
          </div>


          <?php
          break;
  }
  ?>

</main><!-- End main -->