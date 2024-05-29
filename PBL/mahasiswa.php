<!-- ======= main ======= -->
<main id="main" class="main">

  <?php
  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

  switch ($aksi) {
    case 'list':
      ?>

      <!-- data -->
      <h1>Daftar Data Mahasiswa</h1>
      <a href="index.php?page=mahasiswa&aksi=input" class="btn btn-warning mb-3">Tambah Mahasiswa</a>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        <div class="table-responsive">
      <table id="example" class="table table-bordered  table-striped table-hover mt-2">
        <thead>
          <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Jenis Kelamin</th>
            <th>Nama Kelas</th>
            <th>username</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $query = "SELECT * FROM mahasiswa JOIN kelas ON mahasiswa.id_kelas=kelas.id_kelas";
          $result = $db->query($query);

          foreach ($result as $row): ?>
            <tr>
              <td>
                <?= $row['nim'] ?>
              </td>
              <td>
                <?= $row['nama_mhs'] ?>
              </td>
              <td>
                <?= $row['jk'] ?>
              </td>
              <td>
                <?= $row['nama_kelas'] ?>
              </td>
              <td>
                <?= $row['username'] ?>
              </td>
              <td>
                <a class="badge bg-primary" href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['nim'] ?>">Edit</a>
                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                  href="proses-mahasiswa.php?proses=delete&nim=<?= $row['nim'] ?>">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


      <?php
      break;
    case 'input':
      ?>

      <form action="proses-mahasiswa.php?proses=insert" method="POST">

        <div>
          <h2>Input Data Mahasiswa</h2>
        </div>
        <form action="" method="post">

          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input type="text" name="nim">
            </div>
          </div>
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-10">
              <input type="text" name="nama_mhs">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <input type="radio" value="Pria" name="jk" checked>
              <label>Pria</label>
              <input type="radio" value="Wanita" name="jk">
              <label>Wanita</label>
            </div>
          </div>
          <div class="row mb-3">
            <label for="id_kelas" class="col-sm-2 col-form-label">ID Kelas</label>
            <div class="col-sm-10">
              <select name="id_kelas" class="form-select">
                <option value="" disabled selected>-- Choose ID Kelas --</option>
                <?php
                $prodi = mysqli_query($db, "SELECT * FROM kelas");
                while ($data_user = mysqli_fetch_array($prodi)) {
                  echo "<option value=" . $data_user['id_kelas'] . ">" . $data_user['nama_kelas'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <select name="username" class="form-select">
                <option value="" disabled selected>-- Choose Username --</option>
                <?php
                $prodi = mysqli_query($db, "SELECT * FROM user");
                while ($data_user = mysqli_fetch_array($prodi)) {
                  echo "<option value=" . $data_user['username'] . ">" . $data_user['username'] . "</option>";
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

      $get_id = $_GET['nim'];
      $sql = "SELECT * FROM mahasiswa JOIN kelas ON mahasiswa.id_kelas=kelas.id_kelas WHERE nim=$get_id";
      $result = $db->query($sql);
      //cek apakah ada data/row dari table tamu dengan id yang di kirim
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nim = $row['nim'];
        $id_kelas = $row['id_kelas'];
        $nama_mhs = $row['nama_mhs'];


      } else {
        echo "Data $get_id tidak tersedia";
        exit;
      }

      ?>

      <form action="proses-mahasiswa.php?proses=update" method="POST">

        <div>
          <h2>Edit Data Mahasiswa</h2>
        </div>
        <form action="" method="post">

          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input type="text" name="nim" value="<?= $row['nim']; ?>" readonly>
            </div>
          </div>
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-10">
              <input type="text" name="nama_mhs" value="<?= $row['nama_mhs']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <input type="radio" value="Pria" name="jk" <?= $row['jk'] == 'Pria' ? 'checked' : '' ?>>
              <label>Pria</label>

              <input type="radio" value="Wanita" name="jk" <?= $row['jk'] == 'Wanita' ? 'checked' : '' ?>>
              <label>Wanita</label>
            </div>
          </div>
          <div class="row mb-3">
            <label for="id_kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
            <select name="id_kelas" class="form-select">
              <option value="">--Pilih tahun ajaran--</option>
              <?php
              $id_kelas_query = mysqli_query($db, "SELECT * FROM kelas");
              while ($data_id_kelas = mysqli_fetch_array($id_kelas_query)) {
                $select = ($data_id_kelas['id_kelas'] == $row['id_kelas']) ? 'selected' : '';
                echo "<option $select value=" . $data_id_kelas['id_kelas'] . ">" . $data_id_kelas['nama_kelas'] . "</option>";
              }
              ?>
            </select>
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
          <button type="submit" class="btn btn-warning" name="submit">Simpan</button>
        </form>
      </form>
        </div>
      </div>


      <?php
      break;
  }
  ?>

</main><!-- End main -->