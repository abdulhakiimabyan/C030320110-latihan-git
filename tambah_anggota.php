<?php

require_once 'koneksi.php';
// Sertakan file admin_session.php
require_once 'admin_session.php';
// Periksa apakah sesi admin telah aktif
if (!isAdminLoggedIn()) {
    // Jika tidak ada sesi admin yang aktif, arahkan ke halaman login admin
    redirectToAdminLogin();
}


// Panggil file logout.php saat link logout diklik
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    include 'logout.php';
}

$query_anggota = "SELECT *
FROM mahasiswa_abdulhakiimabyan";
$result_anggota = mysqli_query($conn, $query_anggota);
$anggota_ids = mysqli_fetch_all($result_anggota, MYSQLI_ASSOC);

$query_ukm = "SELECT *
FROM ukm_abdulhakiimabyan";
$result_ukm = mysqli_query($conn, $query_ukm);
$ukm_ids = mysqli_fetch_all($result_ukm, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id_mahasiswa  = $_POST['id_mahasiswa'];
    $id_ukm = $_POST['id_ukm'];

    // Query SQL untuk insert data ukm baru
    $query_tambah_anggota = "INSERT INTO anggotaukm_abdulhakiimabyan (id_mahasiswa, id_ukm) VALUES ('$id_mahasiswa','$id_ukm')";

    // Eksekusi query SQL
    if (mysqli_query($conn, $query_tambah_anggota)) {
        header("Location: anggota.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menambahkan data anggota: " . mysqli_error($conn);
        exit();
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tambah Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/404ags/admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Politeknik Negeri Banjarmasin</a>
        <!-- Navbar-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="?action=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Panel Admin</div>
        <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Home
        </a>
        <a class="nav-link" href="mahasiswa.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Mahasiswa
        </a>
        <a class="nav-link" href="ukm.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Unit Kegiatan Mahasiswa
        </a>
        <a class="nav-link" href="anggota.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Pendaftaran Anggota
        </a>
    </div>
</div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-4">
                    <h1>Tambah Anggota</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="post" action="tambah_anggota.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id_mahasiswa">Nama Mahasiswa:</label>
                                    <select class="form-control" name="id_mahasiswa" required>
                                        <?php foreach ($anggota_ids as $anggota) : ?>
                                            <option value="<?php echo $anggota['id_mahasiswa']; ?>"><?php echo $anggota['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_ukm">Nama UKM:</label>
                                    <select class="form-control" name="id_ukm" required>
                                        <?php foreach ($ukm_ids as $ukm) : ?>
                                            <option value="<?php echo $ukm['id_ukm']; ?>"><?php echo $ukm['nama_ukm']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
</body>

</html>
