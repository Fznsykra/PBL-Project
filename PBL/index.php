<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

include 'koneksi.php';

$query = "SELECT * FROM user WHERE username = '{$_SESSION['username']}'";
$result = $db->query($query);

if ($result->num_rows == 1) {
  $data = $result->fetch_assoc();
} else {
  echo "Pengguna atau Password Tidak Ditemukan";
  exit;
}

$last_login = $_SESSION["last_login"];
$username = $_SESSION["username"];
$level = $_SESSION["level"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    #main {
      background-image: url('image/1.png');
      background-size: cover;
      background-position: center;
    }
  </style>

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #fdb714;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block text-black">Attendance</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn text-black"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">

      <ul class="d-flex align-items-center">
        <li class="nav-item">
          <span class="d-none d-md-block text-gray-600 medium" style="margin-right: 20px;">Terakhir Login :<span
              class="text-black">
              <?= $last_login ?>
            </span></span>
        </li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle text-black"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2" style="margin-left: 10px;">
              <?= $username ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                <?= $username ?>
              </h6>
              <span>
                <?= $level ?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php?page=profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal"
                data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Pemanggilan Main ======= -->
  <div class="container">
    <?php
    $p = isset($_GET['page']) ? $_GET['page'] : 'home'; // ternary
    if ($p == 'home')
      include 'home.php';
    if ($p == 'registrasi')
      include 'register.php';
    if ($p == 'mahasiswa')
      include 'mahasiswa.php';
    if ($p == 'kelas')
      include 'kelas.php';
    if ($p == 'dosen')
      include 'dosen.php';
    if ($p == 'matkul')
      include 'matkul.php';
    if ($p == 'user')
      include 'user.php';
    if ($p == 'profile')
      include 'profile.php';
    if ($p == 'jadwal')
      include 'jadwal.php';
    if ($p == 'absen')
      include 'absen.php';
      if ($p == 'rfid')
      include 'rfid.php';

    ?>
  </div>
  <!-- End main -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" style="background-color: #1a2228;">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid text-black"></i>
          <span class="text-black">Dashboard</span>
        </a>
      </li>

      <ul class="sidebar-nav" id="sidebar-nav">
        <a class="nav-link collapsed text-black" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide text-black"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php?page=kelas">
              <i class="bi bi-circle text-warning"></i><span class="text-warning">Data Kelas</span>
            </a>
          </li>
        </ul>

        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php?page=dosen">
              <i class="bi bi-circle text-warning"></i><span class="text-warning">Data Dosen</span>
            </a>
          </li>
        </ul>

        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php?page=mahasiswa">
              <i class="bi bi-circle text-warning"></i><span class="text-warning">Data Mahasiswa</span>
            </a>
          </li>
        </ul>

        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php?page=matkul">
              <i class="bi bi-circle text-warning"></i><span class="text-warning">Data Matakuliah</span>
            </a>
          </li>
        </ul>

        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php?page=user">
              <i class="bi bi-circle text-warning"></i><span class="text-warning">Data User</span>
            </a>
          </li>
        </ul>

      </ul>

      <p class="nav-heading text-warning">Pages</p>
      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link " href="index.php?page=registrasi">
            <i class="bi bi-card-list text-black"></i>
            <span class="text-black">Register</span>
          </a>
        </li>
      </ul>

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link " href="index.php?page=jadwal">
            <i class="bi bi-calendar-week text-black"></i>
            <span class="text-black">Jadwal</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link " href="index.php?page=absen">
            <i class="bi bi-clipboard-check text-black"></i>
            <span class="text-black">Absensi</span>
          </a>
        </li>
      </ul>

    

  </aside><!-- End Sidebar-->

  <!--notifikasi-->
  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Modal Konfirmasi Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin keluar?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
          <a class="btn btn-warning" href="logout.php">Keluar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Konfirmasi Logout -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- table-->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>new DataTable('#example');</script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

   <!-- Bootstrap core JavaScript-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
        function printPage() {
            window.print();
        }
    </script>

</body>

</html>