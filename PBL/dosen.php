<!-- ======= main ======= -->
<main id="main" class="main">

  <?php
  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

  switch ($aksi) {
    case 'list':
      ?>
      <!-- data -->
      <h1>Daftar Nama Dosen</h1>
      <a href="index.php?page=dosen&aksi=input" class="btn btn-warning mb-3">Tambah Data Dosen</a>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        <div class="table-responsive">
      <table id="example" class="table table-bordered  table-striped table-hover mt-2">
        <thead>
          <tr>
            <th>No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $query = "SELECT * FROM dosen";
          $result = $db->query($query);
          $nomor = 1;
          foreach ($result as $row): ?>
            <tr>
              <td>
                <?= $nomor++ ?>
              </td>
              <td>
                <?= $row['nip'] ?>
              </td>
              <td>
                <?= $row['nama'] ?>
              </td>
              <td>
                <?= $row['jk'] ?>
              </td>
              <td>
                <?= $row['username'] ?>
              </td>
              <td>
                <a class="badge bg-primary" href="index.php?page=dosen&aksi=edit&nip=<?= $row['nip'] ?>">Edit</a>
                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                  href="proses-dosen.php?proses=delete&nip=<?= $row['nip'] ?>">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


      <?php
      break;
    case 'input':
      ?>

      <form action="proses-dosen.php?proses=insert" method="POST">

        <div>
          <h2>Input Data Dosen</h2>
        </div>
        <form action="" method="post">
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
              <input type="text" name="nip">
            </div>
          </div>
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama">
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
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <select name="username" class="form-select">
                <option value="">-- Choose Username --</option>
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

      $get_id = $_GET['nip'];
      $sql = "SELECT * FROM dosen WHERE nip='$get_id'";
      $result = $db->query($sql);
      //cek apakah ada data/row dari table tamu dengan id yang di kirim
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nip = $row['nip'];
        $nama = $row['nama'];
        $jk = $row['jk'];
        $username = $row['username'];

      } else {
        echo "Data $get_id tidak tersedia";
        exit;
      }

      ?>

      <form action="proses-dosen.php?proses=update" method="POST">

        <div>
          <h2>Edit Data Dosen</h2>
        </div>
        <form action="" method="post">
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
              <input type="text" name="nip" value="<?php echo $row['nip']; ?>" readonly>
            </div>
          </div>
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama" value="<?php echo $row['nama']; ?>">
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
            <label class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10" >
            <select name="username" class="form-select"  disabled>
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