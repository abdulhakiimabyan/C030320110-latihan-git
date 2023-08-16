<?php
// admin_session.php

// Fungsi ini akan memeriksa apakah sesi admin telah aktif
function isAdminLoggedIn()
{
    session_start();
    return isset($_SESSION['admin_id']);
}

// Fungsi ini akan mengarahkan pengguna ke halaman login admin jika tidak ada sesi admin yang aktif
function redirectToAdminLogin()
{
    header("Location: login.php"); // Ubah "admin_login.php" dengan halaman login admin Anda
    exit();
}
?>
