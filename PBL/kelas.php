<!-- ======= main ======= -->
<main id="main" class="main">

  <?php
  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

  switch ($aksi) {
    case 'list':
      ?>
      <!-- data -->
      <h1>Daftar Data Kelas</h1>
      <a href="index.php?page=kelas&aksi=input" class="btn btn-warning mb-3">Tambah Data Kelas</a>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          
        <div class="table-responsive">
          <table id="example" class="table table-bordered  table-striped table-hover mt-2">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Prodi</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "SELECT * FROM kelas JOIN tahun_ajaran ON kelas.id_thn_ajaran=tahun_ajaran.id_thn_ajaran";
              $result = $db->query($query);
              $nomor = 1;
              foreach ($result as $row): ?>
                <tr>
                  <td>
                    <?= $nomor++ ?>
                  </td>
                  <td>
                    <?= $row['id_kelas'] ?>
                  </td>
                  <td>
                    <?= $row['nama_kelas'] ?>
                  </td>
                  <td>
                    <?= $row['prodi'] ?>
                  </td>
                  <td>
                    <?= $row['thn_ajaran'] ?>
                  </td>
                  <td>
                    <a class="badge bg-primary"
                      href="index.php?page=kelas&aksi=edit&id_kelas=<?= $row['id_kelas'] ?>">Edit</a>
                    <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                      href="proses-kelas.php?proses=delete&id_kelas=<?= $row['id_kelas'] ?>">Hapus</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>


          <?php
          break;
    case 'input':
      ?>

          <form action="proses-kelas.php?proses=insert" method="POST">

            <div>
              <h2>Input Data Kelas</h2>
            </div>
            <form action="" method="post">
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kelas</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_kelas">
                </div>
              </div>
              <div class="row mb-3">
                <label for="prodi" class="col-sm-2 col-form-label">Prodi:</label><br>
                <div class="col-sm-10">
                  <select name="prodi" class="form-select" aria-label="Default select example">
                    <option selected>Choose Prodi</option>
                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                    <option value="Teknik Komputer">Teknik Komputer</option>
                    <option value="TRPL">TRPL</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="thn_ajaran" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                <div class="col-sm-10">
                  <select name="id_thn_ajaran" class="form-select">
                    <option value="">Choose Tahun Ajaran</option>
                    <?php
                    $tahun_ajaran = mysqli_query($db, "SELECT * FROM tahun_ajaran");
                    while ($data_tahun_ajaran = mysqli_fetch_array($tahun_ajaran)) {
                      echo "<option value=" . $data_tahun_ajaran['id_thn_ajaran'] . ">" . $data_tahun_ajaran['thn_ajaran'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-warning" name="submit">Simpan</button>
            </form>
          </form>

          <?php
          break;
    case 'edit':

      $get_id = $_GET['id_kelas'];
      $sql = "SELECT * FROM kelas JOIN tahun_ajaran ON kelas.id_thn_ajaran=tahun_ajaran.id_thn_ajaran WHERE id_kelas=$get_id";
      $result = $db->query($sql);
      //cek apakah ada data/row dari table tamu dengan id yang di kirim
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_kelas = $row['id_kelas'];
        $nama_kelas = $row['nama_kelas'];
        $prodi = $row['prodi'];
        $thn_ajaran = $row['thn_ajaran'];

      } else {
        echo "Data $get_id tidak tersedia";
        exit;
      }

      ?>

          <form action="proses-kelas.php?proses=update" method="POST">

            <div>
              <h2>Edit Data Kelas</h2>
            </div>
            <form action="" method="post">
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">ID KELAS</label>
                <div class="col-sm-10">
                  <input type="text" name="id_kelas" value="<?php echo $row['id_kelas']; ?>" readonly>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kelas</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_kelas" value="<?php echo $row['nama_kelas']; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="prodi" class="col-sm-2 col-form-label">Prodi:</label>
                <div class="col-sm-10">
                  <select name="prodi" class="form-select" aria-label="Default select example">
                    <option selected>Choose Prodi</option>
                    <option value="Manajemen Informatika" <?= $row['prodi'] == 'Manajemen Informatika' ? 'selected' : '' ?>>
                      Manajemen Informatika</option>
                    <option value="Teknik Komputer" <?= $row['prodi'] == 'Teknik Komputer' ? 'selected' : '' ?>>Teknik Komputer
                    </option>
                    <option value="TRPL" <?= $row['prodi'] == 'TRPL' ? 'selected' : '' ?>>TRPL</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="id_thn_ajaran" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                <div class="col-sm-10">
                  <select name="id_thn_ajaran" class="form-select">
                    <option value="">--Pilih tahun ajaran--</option>
                    <?php
                    $tahun_ajaran_query = mysqli_query($db, "SELECT * FROM tahun_ajaran");
                    while ($data_tahun_ajaran = mysqli_fetch_array($tahun_ajaran_query)) {
                      $select = ($data_tahun_ajaran['id_thn_ajaran'] == $row['id_thn_ajaran']) ? 'selected' : '';
                      echo "<option $select value=" . $data_tahun_ajaran['id_thn_ajaran'] . ">" . $data_tahun_ajaran['thn_ajaran'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>


              <button type="submit" class="btn btn-warning" name="submit">Update</button>
            </form>
          </form>
        </div>
      </div>


      <?php
      break;
  }
  ?>

</main><!-- End main -->