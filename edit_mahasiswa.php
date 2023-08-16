<?php

// Sertakan file admin_session.php
require_once 'admin_session.php';
// Periksa apakah sesi admin telah aktif
if (!isAdminLoggedIn()) {
    // Jika tidak ada sesi admin yang aktif, arahkan ke halaman login admin
    redirectToAdminLogin();
}
require_once 'koneksi.php';

// Panggil file logout.php saat link logout diklik
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    include 'logout.php';
}

// Periksa apakah parameter nim ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_mahasiswa = "SELECT * FROM mahasiswa_abdulhakiimabyan WHERE id_mahasiswa = $id";

    $result_mahasiswa = mysqli_query($conn, $query_mahasiswa);
 // Periksa apakah mahasiswa ditemukan
 if (mysqli_num_rows($result_mahasiswa) > 0) {
    // mahasiswa ditemukan, ambil data mahasiswa
    $mahasiswa = mysqli_fetch_assoc($result_mahasiswa);
} else {
    // mahasiswa tidak ditemukan
    echo "mahasiswa tidak ditemukan.";
    exit();
}
} else {
// Parameter id tidak ditemukan dalam URL
echo "Parameter id tidak ditemukan.";
exit();
}

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];


    $query_update_mahasiswa = "UPDATE mahasiswa_abdulhakiimabyan SET nim = '$nim', nama = '$nama', tanggal_lahir = '$tanggal', alamat = '$alamat' WHERE id_mahasiswa = $id";

    // Eksekusi query SQL
    if (mysqli_query($conn, $query_update_mahasiswa)) {
        // Data mahasiswa berhasil diupdate
        // Redirect ke halaman mahasiswa.php
        header("Location: mahasiswa.php");
        exit();
    } else {
        // Terjadi kesalahan saat mengupdate data mahasiswa
        echo "Terjadi kesalahan saat mengupdate data mahasiswa: " . mysqli_error($conn);
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
    <title>Edit mahasiswa</title>
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
                    <h1>Edit Mahasiswa</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="post" action="edit_mahasiswa.php?id=<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="nim">NIM:</label>
                                    <input type="text" class="form-control" name="nim" value="<?php echo $mahasiswa['nim']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $mahasiswa['tanggal_lahir']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <input type="text" class="form-control" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                <a href="mahasiswa.php" class="btn btn-secondary">Batal</a>
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