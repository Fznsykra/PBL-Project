 <!-- ======= main ======= -->
 <main id="main" class="main">
    
    <!-- data -->
    <h1>Data User</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <div class="table-responsive">
    <table id="example" class="table table-bordered  table-striped table-hover mt-2">
      <thead>
        <tr>
          <th>No.</th>
          <th>Username</th>
          <th>email</th>
          <th>Level</th>
        </tr>
      </thead>
  
      <tbody>
        <?php
          $query = "SELECT username,email,level FROM user";
          $result = $db->query($query);
          $nomor = 1;
          foreach($result as $row) : ?>
            <tr>
              <td><?= $nomor++?></td>
              <td><?= $row['username'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['level'] ?></td>
            </tr>
          <?php endforeach ?>
      </tbody>
    </table>
        </div>
          </div>
    
    </main><!-- End main -->