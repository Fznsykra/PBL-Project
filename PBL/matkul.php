<!-- ======= main ======= -->
<main id="main" class="main">

  <?php
  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

  switch ($aksi) {
    case 'list':
      ?>
      <!-- data -->
      <h1>Daftar Matakuliah</h1>
      <a href="index.php?page=matkul&aksi=input" class="btn btn-warning mb-3">Tambah Matakuliah</a>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        <div class="table-responsive">
      <table id="example" class="table table-bordered  table-striped table-hover mt-2">
        <thead>
          <tr>
            <th>ID Matakuliah</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $query = "SELECT * FROM matkul";
          $result = $db->query($query);

          foreach ($result as $row): ?>
            <tr>
              <td>
                <?= $row['id_matkul'] ?>
              </td>
              <td>
                <?= $row['nama_matkul'] ?>
              </td>
              <td>
                <?= $row['sks'] ?>
              </td>
              <td>
                <a class="badge bg-primary" href="index.php?page=matkul&aksi=edit&id_matkul=<?= $row['id_matkul'] ?>">Edit</a>
                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                  href="proses-matkul.php?proses=delete&id_matkul=<?= $row['id_matkul'] ?>">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


      <?php
      break;
    case 'input':
      ?>

      <form action="proses-matkul.php?proses=insert" method="POST">

        <div>
          <h2>Input Data Matakuliah</h2>
        </div>
        <form action="" method="post">
          <div class="row mb-3">
            <label for="nama_matkul" class="col-sm-2 col-form-label">Nama Matakuliah</label>
            <div class="col-sm-10">
              <input type="text" name="nama_matkul">
            </div>
          </div>
          <div class="row mb-3">
            <label for="sks" class="col-sm-2 col-form-label">SKS</label>
            <div class="col-sm-10">
              <input type="text" name="sks">
            </div>
          </div>
          <button type="submit" class="btn btn-warning" name="submit">Simpan</button>
        </form>
      </form>

      <?php
      break;
    case 'edit':

      $get_id = $_GET['id_matkul'];
      $sql = "SELECT * FROM matkul WHERE id_matkul=$get_id";
      $result = $db->query($sql);
      //cek apakah ada data/row dari table kelas dengan id yang di kirim
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_matkul = $row['id_matkul'];
        $nama_matkul = $row['nama_matkul'];
        $sks = $row['sks'];

      } else {
        echo "Data $get_id tidak tersedia";
        exit;
      }

      ?>


      <form action="proses-matkul.php?proses=update" method="POST">

        <div>
          <h2>Edit Data Matakuliah</h2>
        </div>
        <form action="" method="post">
          <div class="row mb-3">
            <label for="id_matkul" class="col-sm-2 col-form-label">ID Matakuliah</label>
            <div class="col-sm-10">
              <input type="text" name="id_matkul" value="<?php echo $row['id_matkul']; ?>" readonly>
            </div>
          </div>
          <div class="row mb-3">
            <label for="nama_matkul" class="col-sm-2 col-form-label">Nama Matakuliah</label>
            <div class="col-sm-10">
              <input type="text" name="nama_matkul" value="<?php echo $row['nama_matkul']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label for="sks" class="col-sm-2 col-form-label">SKS</label>
            <div class="col-sm-10">
              <input type="text" name="sks" value="<?php echo $row['sks']; ?>">
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