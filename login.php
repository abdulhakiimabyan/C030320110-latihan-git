<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
<?php
// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel untuk menyimpan data input pengguna
$username = $password = '';
$loginError = '';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim dari form login
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

        // Buat query untuk memeriksa kecocokan username dan password di tabel admin_users
        $sql_admin = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
        $result_admin = $conn->query($sql_admin);

        // Periksa hasil query admin
        if ($result_admin->num_rows > 0) {
            // Login sebagai admin berhasil
            // Simpan admin_id ke dalam sesi
            session_start();
            $_SESSION['admin_id'] = $result_admin->fetch_assoc()['admin_id'];
            // Redirect ke halaman index admin jika login berhasil
            header("Location: index.php");
            exit();
            } else {
                // Username atau password tidak cocok di kedua tabel
                $loginError = "Username atau password salah!";
            }
        }

// Tutup koneksi ke database
$conn->close();
?>
    <form method="POST" action="login.php">
    <img src="poliban.png" alt="Logo Poliban" width="100" height="100">
        <h2>Politeknik Negeri Banjarmasin</h2>
        <h3>Program Studi Teknik Informatika</h3>
        <label>Username :</label>
        <input type="text" name="username" required><br>
        <br>
        <label>Password :</label>
        <input type="password" name="password" required><br>
        <br>
        <input type="submit" value="Login">

        <?php if (!empty($loginError)) : ?>
            <p class="error-message"><?php echo $loginError; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
