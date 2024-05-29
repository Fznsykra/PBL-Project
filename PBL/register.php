<!-- ======= main ======= -->
<main id="main" class="main">
    <!--judul halaman-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
    <div class="pagetitle">
      <h1 class="text-black">Register</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="register.php">Register</a></li>
          <li class="breadcrumb-item active">Register</li>
        </ol>
      </nav>
    </div><!--end judul halaman-->


    <!-- Form Register -->
    <div class="container mt-3">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <form action="proses_signup.php" method="post">
            <div class="mb-3">
              <label class="form-label">Level:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="pimpinan" value="pimpinan" required>
                <label class="form-check-label text-dark" for="pimpinan">Pimpinan</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="adm" value="adm" required>
                <label class="form-check-label text-dark" for="adm">ADM</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="dosen" value="dosen" required>
                <label class="form-check-label text-dark" for="dosen">Dosen</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="mahasiswa" value="mhs" required>
                <label class="form-check-label text-dark" for="mhs">Mahasiswa</label>
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group mb-3">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-2 form-check d-grid gap-2">
              <button type="submit" class="btn btn-warning rounded-pill">Sign Up</button>
            </div>
          </form>
        </div>
      </div>
    </div>
        </div>
    </div><!-- End Form Register -->

  </main><!-- End main -->