<?php
$sql = "SELECT COUNT(*) as total FROM mahasiswa";
$result = $db->query($sql);

$row = $result->fetch_assoc();
$totalData =$row['total'];

$sql1 = "SELECT COUNT(*) as total1 FROM kelas";
$result1 = $db->query($sql1);

$row1 = $result1->fetch_assoc();
$totalData1 = $row1['total1'];

$sql2 = "SELECT COUNT(*) as total2 FROM matkul";
$result2 = $db->query($sql2);

$row2 = $result2->fetch_assoc();
$totalData2 = $row2['total2'];
?>


<main id="main" class="main">
    <!--judul halaman-->
    <div class="pagetitle">
        <h1 class="text-black">Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!--end judul halaman-->

    <!--Layout main-->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Mahasiswa Yang diajar -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-black">Mahasiswa Yang Diajarkan</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people-fill text-warning"></i>
                                    </div>
                                    <div class="ps-3 text">
                                        <h6><?= $totalData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Mahasiswa Yang Diajarkan -->

                    <!-- Kelas Yang diajar -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title text-black">Kelas Yang Diajarkan</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-buildings-fill text-warning"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $totalData1 ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Kelas Yang Diajarkan -->

                    <!-- End Matakuliah Yang Diajarkan -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-black">Matakuliah Yang Diajarkan</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book-half text-warning"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $totalData2 ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Matakuliah Yang Diajarkan -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Waktu sekarang -->
                <div class="col-xxl-4 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h5 class="card-title text-black">Time</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clock-fill text-warning"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="current-time"></h6>
                                    <span class="text-black small pt-1 fw-bold" id="date"></span> <span
                                        class="text-muted small pt-2 ps-1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Waktu Sekarang -->
            </div><!-- End Right side columns -->


            <script>
                // Fungsi untuk mengupdate waktu secara periodik
                function updateTime() {
                    var currentTime = new Date();
                    // Mendapatkan jam, menit, dan detik
                    var hours = currentTime.getHours();
                    var minutes = currentTime.getMinutes();
                    var seconds = currentTime.getSeconds();
                    // Mendapatkan tanggal dalam Bahasa Indonesia
                    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    var date = currentTime.toLocaleDateString('id-ID', options);
                    // Format waktu untuk ditampilkan
                    var timeString = hours + ':' + minutes + ':' + seconds;
                    // Menampilkan waktu dan tanggal ke elemen HTML
                    document.getElementById('current-time').innerHTML = timeString;
                    document.getElementById('date').innerHTML = 'Tanggal: ' + date;
                }
                // Memanggil updateTime setiap detik
                setInterval(updateTime, 1000);
                // Memanggil updateTime saat halaman dimuat
                updateTime();
            </script>

            <!-- End Waktu Sekarang -->
        </div>
    </section>
    <!--End Layout main-->

</main>