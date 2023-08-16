<?php

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

// Periksa izin untuk menghapus data mahasiswa
if (isset($_POST['id_mahasiswa'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];

    // Query DELETE untuk menghapus data mahasiswa
    $query_hapus_mahasiswa = "DELETE FROM mahasiswa_abdulhakiimabyan WHERE id_mahasiswa = '$id_mahasiswa'";

    // Eksekusi query DELETE mahasiswa
    if (mysqli_query($conn, $query_hapus_mahasiswa)) {
        // Data mahasiswa berhasil dihapus
        // Redirect ke halaman daftar_mahasiswa.php
        header("Location: mahasiswa.php");
        exit();
    } else {
        // Terjadi kesalahan saat menghapus data mahasiswa
        echo "Terjadi kesalahan saat menghapus data mahasiswa: " . mysqli_error($conn);
    }
}

// Periksa izin untuk menghapus data ukm
if (isset($_POST['id_ukm'])) {
    $id_ukm = $_POST['id_ukm'];

    // Query DELETE untuk menghapus data ukm
    $query_hapus_ukm = "DELETE FROM ukm_abdulhakiimabyan WHERE id_ukm = '$id_ukm'";

    // Eksekusi query DELETE ukm
    if (mysqli_query($conn, $query_hapus_ukm)) {
        // Data ukm berhasil dihapus
        // Redirect ke halaman ukm.php
        header("Location: ukm.php");
        exit();
    } else {
        // Terjadi kesalahan saat menghapus data ukm
        echo "Terjadi kesalahan saat menghapus data ukm: " . mysqli_error($conn);
    }
}

// Periksa izin untuk menghapus data ukm
if (isset($_POST['id_anggota'])) {
    $id_anggota = $_POST['id_anggota'];

    // Query DELETE untuk menghapus data ukm
    $query_hapus_anggota = "DELETE FROM anggotaukm_abdulhakiimabyan WHERE id_anggota = '$id_anggota'";

    // Eksekusi query DELETE ukm
    if (mysqli_query($conn, $query_hapus_anggota)) {
        // Data ukm berhasil dihapus
        // Redirect ke halaman ukm.php
        header("Location: anggota.php");
        exit();
    } else {
        // Terjadi kesalahan saat menghapus data ukm
        echo "Terjadi kesalahan saat menghapus data ukm: " . mysqli_error($conn);
    }
}



// Tutup koneksi ke database
mysqli_close($conn);
?>
