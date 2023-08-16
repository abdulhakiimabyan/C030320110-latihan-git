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

// Mendapatkan daftar mahasiswa
$query_mahasiswa = "SELECT * FROM mahasiswa_abdulhakiimabyan";
$result_mahasiswa = mysqli_query($conn, $query_mahasiswa);
$daftar_mahasiswa = mysqli_fetch_all($result_mahasiswa, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Halaman Mahasiswa</title>
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
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Daftar Mahasiswa</h3>
                    <a href="tambah_mahasiswa.php" class="btn btn-success">Tambah Mahasiswa</a>
                </div>
                <table id="table-datatables"class="table mt-3">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftar_mahasiswa as $mahasiswa) { ?>
                            <tr>
                                <td><?php echo $mahasiswa['nim']; ?></td>
                                <td><?php echo $mahasiswa['nama']; ?></td>
                                <td><?php echo $mahasiswa['tanggal_lahir']; ?></td>
                                <td><?php echo $mahasiswa['alamat']; ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form method="get" action="edit_mahasiswa.php">
                                            <input type="hidden" name="id" value="<?php echo $mahasiswa['id_mahasiswa']; ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                        </form>

                                        <form method="post" action="proses_hapus.php" onsubmit="return confirm('Yakin ingin hapus?')">
                                            <input type="hidden" name="id_mahasiswa" value="<?php echo $mahasiswa['id_mahasiswa']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script type="text/javascript"> 
    $(document).ready(function () {
        $('#table-datatables').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>
</body>

</html>

<?php
// Tutup koneksi ke database
mysqli_close($conn);
?>
