<?php
// logout.php

// Mulai sesi (pastikan sesi telah dimulai sebelumnya di halaman lain yang memerlukan fitur logout)
session_start();

// Hapus semua data sesi (termasuk data admin_id)
session_unset();

// Hapus sesi
session_destroy();

// Arahkan kembali ke halaman login admin
header("Location: login.php");
exit();
?>
